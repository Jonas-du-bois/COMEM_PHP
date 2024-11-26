<?php

namespace M521\Taskforce\dbManager;

use M521\Taskforce\dbManager\I_ApiCRUD;

class DbManagerCRUD implements I_ApiCRUD
{
    private $db;

    public function __construct()
    {
        //$config = parse_ini_file('config' . DIRECTORY_SEPARATOR . 'db.ini', true);
        $config = parse_ini_file(__DIR__ . '/../config/db.ini');
        $dsn = $config['dsn'];
        $username = $config['username'];
        $password = $config['password'];
        $this->db = new \PDO($dsn, $username, $password);
        if (!$this->db) {
            die("Problème de connexion à la base de données");
        }
    }

    //commentaire test

    public function creeTable(): bool
    {
        $sqlUsers = <<<SQL
            CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                nom VARCHAR(120) NOT NULL,
                prenom VARCHAR(120) NOT NULL,
                email VARCHAR(120) NOT NULL UNIQUE,
                noTel VARCHAR(20) NOT NULL UNIQUE,
                motDePasse VARCHAR(255) NOT NULL,
                token VARCHAR(255) DEFAULT NULL,
                is_confirmed BOOLEAN DEFAULT 0
            );
        SQL;

        $sqlTasks = <<<SQL
            CREATE TABLE IF NOT EXISTS tasks (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                userId INTEGER NOT NULL,
                titre TEXT NOT NULL,
                description TEXT DEFAULT NULL,
                dateEcheance DATE DEFAULT NULL,
                statut TEXT CHECK(statut IN ('a_faire', 'en_cours', 'termine')) DEFAULT 'a_faire',
                createdAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
                FOREIGN KEY (userId) REFERENCES users(id) ON DELETE CASCADE
            );
        SQL;

        $sqlTaskUsers = <<<SQL
            CREATE TABLE IF NOT EXISTS task_users (
                taskId INTEGER NOT NULL,
                userId INTEGER NOT NULL,
                PRIMARY KEY (taskId, userId),
                FOREIGN KEY (taskId) REFERENCES tasks(id) ON DELETE CASCADE,
                FOREIGN KEY (userId) REFERENCES users(id) ON DELETE CASCADE
            );
        SQL;

        try {
            $this->db->exec($sqlUsers);
            $this->db->exec($sqlTasks);
            $this->db->exec($sqlTaskUsers);
            return true;
        } catch (\PDOException $e) {
            echo "Erreur lors de la création des tables: " . $e->getMessage();
            return false;
        }
    }

    // ---------- Méthodes pour les utilisateurs ----------

    public function ajoutePersonne(Users $user): int
    {
        $datas = [
            'nom' => $user->rendNom(),
            'prenom' => $user->rendPrenom(),
            'email' => $user->rendEmail(),
            'noTel' => $user->rendNoTel(),
            'motDePasse' => password_hash($user->rendMotDePasse(), PASSWORD_DEFAULT),
            'token' => $user->rendToken(),
        ];
        $sql = "INSERT INTO users (nom, prenom, email, noTel, motDePasse, token) VALUES "
            . "(:nom, :prenom, :email, :noTel, :motDePasse, :token)";
        $this->db->prepare($sql)->execute($datas);
        return $this->db->lastInsertId();
    }


    public function modifiePersonne(int $id, Users $user): bool
    {
        $motDePasse = $user->rendMotDePasse();

        // Vérification simple : un hash bcrypt commence par $2y$
        if (!str_starts_with($motDePasse, '$2y$')) {
            throw new \InvalidArgumentException("Le mot de passe doit être préalablement hashé.");
        }

        $datas = [
            'id' => $id,
            'nom' => $user->rendNom(),
            'prenom' => $user->rendPrenom(),
            'email' => $user->rendEmail(),
            'noTel' => $user->rendNoTel(),
            'motDePasse' => $motDePasse,
        ];
        $sql = "UPDATE users SET nom=:nom, prenom=:prenom, email=:email, noTel=:noTel, motDePasse=:motDePasse WHERE id=:id";
        $this->db->prepare($sql)->execute($datas);
        return true;
    }

    public function rendPersonnes(string $email): array
    {
        $sql = "SELECT * FROM users WHERE email = :email;";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email, \PDO::PARAM_STR);

        try {
            $stmt->execute();
            $donnees = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            $tabUsers = [];

            foreach ($donnees as $donneesUser) {
                $user = new Users(
                    $donneesUser["prenom"],
                    $donneesUser["nom"],
                    $donneesUser["email"],
                    $donneesUser["noTel"],
                    $donneesUser["motDePasse"],
                    $donneesUser["id"]
                );
                $tabUsers[] = $user;
            }

            return $tabUsers;
        } catch (\PDOException $e) {
            // Log l'erreur ou la gérer d'une manière appropriée
            error_log("Erreur lors de la récupération des utilisateurs : " . $e->getMessage());
            return [];
        }
    }

    public function rendAllUtilisateur(): array
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $donnees = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $tabUsers = [];

        foreach ($donnees as $donneesUser) {
            $user = new Users(
                $donneesUser["prenom"],
                $donneesUser["nom"],
                $donneesUser["email"],
                $donneesUser["noTel"],
                $donneesUser["motDePasse"],
                $donneesUser["id"]
            );
            $tabUsers[] = $user;
        }

        return $tabUsers;
    }

    public function supprimePersonne(int $id): bool
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function verifierIdentifiants(string $email, string $motDePasse): string
    {
        $sql = "SELECT motDePasse, is_confirmed FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
        $stmt->execute();

        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($result) {
            if (!$result['is_confirmed']) {
                return 'not_confirmed';
            }

            if (password_verify($motDePasse, $result['motDePasse'])) {
                return 'success';
            } else {
                return 'wrong_password';
            }
        }
        return 'email_not_found';
    }

    public function compterNbUsers(): int
    {
        $countQuery = "SELECT COUNT(*) as total_users FROM users";
        try {
            $stmt = $this->db->prepare($countQuery);
            $stmt->execute();
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);
            return $result ? (int) $result['total_users'] : 0;
        } catch (\PDOException $e) {
            echo "Erreur lors du comptage des utilisateurs : " . $e->getMessage();
            return 0;
        }
    }

    public function getUserByToken($token): ?array
    {
        $sql = "SELECT * FROM users WHERE token = :token";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':token', $token);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC); // Récupère un tableau ou false
        return $result ?: null; // Retourne null si $result est false
    }

    public function confirmeInscription(int $userId): bool
    {
        $sql = "UPDATE users SET is_confirmed = 1, token = NULL WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $userId, \PDO::PARAM_INT);
        try {
            return $stmt->execute();
        } catch (\PDOException $e) {
            echo "Erreur lors de la confirmation de l'inscription: " . $e->getMessage();
            return false;
        }
    }

    // ---------- Méthodes pour les tâches ----------


    public function createTask(Task $task): int
    {
        // Première étape : Création de la tâche dans la table tasks
        $sql = "INSERT INTO tasks (userId, titre, description, dateEcheance, statut) 
                VALUES (:userId, :titre, :description, :dateEcheance, :statut)";
        $stmt = $this->db->prepare($sql);
    
        $params = [
            ':userId' => $task->rendUserIds()[0],  // On utilise juste un utilisateur pour la tâche ici, mais on va gérer plusieurs plus tard
            ':titre' => $task->rendTitre(),
            ':description' => $task->rendDescription(),
            ':dateEcheance' => $task->rendDateEcheance(),
            ':statut' => $task->rendStatut()
        ];
    
        try {
            // Exécution de l'insertion de la tâche
            $stmt->execute($params);
    
            // Récupérer l'ID de la tâche insérée
            $taskId = $this->db->lastInsertId();
    
            // Deuxième étape : Associer les utilisateurs à la tâche dans la table task_users
            $sqlTaskUser = "INSERT INTO task_users (taskId, userId) VALUES (:taskId, :userId)";
            $stmtTaskUser = $this->db->prepare($sqlTaskUser);
    
            // Insertion de l'association dans task_users pour chaque utilisateur
            foreach ($task->rendUserIds() as $userId) {
                $stmtTaskUser->execute([
                    ':taskId' => $taskId, // ID de la tâche insérée
                    ':userId' => $userId  // ID de l'utilisateur
                ]);
            }
    
            return $taskId;
        } catch (\PDOException $e) {
            echo "Erreur lors de la création de la tâche : " . $e->getMessage();
            return 0;
        }
    }
    /**
     * Associe des utilisateurs à une tâche dans la table de jointure.
     * @param int $taskId ID de la tâche
     * @param array $userIds Liste des IDs des utilisateurs
     * @throws \Exception
     */
    public function assignUsersToTask(int $taskId, array $userIds): void
    {
        try {
            // Supprimer toutes les associations existantes pour cette tâche
            $stmt = $this->db->prepare("DELETE FROM task_users WHERE taskId = :taskId");
            $stmt->bindValue(':taskId', $taskId);
            $stmt->execute();

            // Ajouter les nouvelles associations
            $stmt = $this->db->prepare("INSERT INTO task_users (taskId, userId) VALUES (:taskId, :userId)");
            foreach ($userIds as $userId) {
                $stmt->bindValue(':taskId', $taskId);
                $stmt->bindValue(':userId', $userId);
                $stmt->execute();
            }
        } catch (\PDOException $e) {
            throw new \Exception('Erreur lors de l\'assignation des utilisateurs à la tâche : ' . $e->getMessage());
        }
    }
    /**
     * Récupère une tâche en fonction de son ID.
     * @param int $taskId ID de la tâche
     * @return Task Objet Task récupéré
     * @throws \Exception Si la tâche n'existe pas
     */
    public function getTaskById(int $taskId): Task
{
    try {
        $stmt = $this->db->prepare("SELECT * FROM tasks WHERE id = :task_id");
        $stmt->bindValue(':task_id', $taskId);
        $stmt->execute();
        $taskData = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$taskData) {
            throw new \Exception('Tâche introuvable.');
        }

        // Récupérer les utilisateurs associés à la tâche
        $stmt = $this->db->prepare("SELECT userId FROM task_users WHERE taskId = :taskId");
        $stmt->bindValue(':taskId', $taskId);
        $stmt->execute();
        $userIds = $stmt->fetchAll(\PDO::FETCH_COLUMN);

        // Crée une instance de Task avec les données récupérées
        return new Task(
            $taskData['titre'],
            $taskData['description'],
            $taskData['dateEcheance'],
            $taskData['statut'],
            $userIds, // Liste des IDs d'utilisateurs
            //$taskData['id']
        );
    } catch (\PDOException $e) {
        throw new \Exception('Erreur lors de la récupération de la tâche : ' . $e->getMessage());
    }
}
    /**
     * Met à jour une tâche existante.
     * @param Task $task Objet Task avec les nouvelles données
     * @throws \Exception Si la mise à jour échoue
     */
    public function updateTask(Task $task): void
    {
        try {
            $stmt = $this->db->prepare("
                UPDATE tasks
                SET titre = :titre, description = :description, 
                    dateEcheance = :dateEcheance, statut = :statut
                WHERE id = :id
            ");
            $stmt->bindValue(':titre', $task->rendTitre());
            $stmt->bindValue(':description', $task->rendDescription());
            $stmt->bindValue(':dateEcheance', $task->rendDateEcheance());
            $stmt->bindValue(':statut', $task->rendStatut());
            $stmt->bindValue(':id', $task->rendId());
            $stmt->execute();

            // Mettre à jour les utilisateurs associés
            $this->assignUsersToTask($task->rendId(), $task->rendUserIds());
        } catch (\PDOException $e) {
            throw new \Exception('Erreur lors de la mise à jour de la tâche : ' . $e->getMessage());
        }
    }

    /**
     * Supprime une tâche de la base de données.
     * @param int $taskId ID de la tâche à supprimer
     * @throws \Exception Si la suppression échoue
     */
    public function deleteTask(int $taskId): void
    {
        try {
            // Supprimer les utilisateurs associés
            $stmt = $this->db->prepare("DELETE FROM task_users WHERE task_id = :task_id");
            $stmt->bindValue(':task_id', $taskId);
            $stmt->execute();

            // Supprimer la tâche
            $stmt = $this->db->prepare("DELETE FROM tasks WHERE id = :task_id");
            $stmt->bindValue(':task_id', $taskId);
            $stmt->execute();
        } catch (\PDOException $e) {
            throw new \Exception('Erreur lors de la suppression de la tâche : ' . $e->getMessage());
        }
    }

    /**
     * Récupère toutes les tâches.
     * @return Task[] Tableau d'objets Task
     * @throws \Exception
     */
    public function getAllTasks(): array
    {
        try {
            $stmt = $this->db->query("SELECT * FROM tasks");
            $tasks = [];

            while ($taskData = $stmt->fetch(\PDO::FETCH_ASSOC)) {
                // Récupérer les utilisateurs associés
                $stmtUsers = $this->db->prepare("SELECT user_id FROM task_users WHERE task_id = :task_id");
                $stmtUsers->bindValue(':task_id', $taskData['id']);
                $stmtUsers->execute();
                $userIds = $stmtUsers->fetchAll(\PDO::FETCH_COLUMN);

                $tasks[] = new Task(
                    $taskData['titre'],
                    $taskData['description'],
                    $userIds,
                    $taskData['dateEcheance'],
                    $taskData['statut'],
                    //$taskData['id']
                );
            }

            return $tasks;
        } catch (\PDOException $e) {
            throw new \Exception('Erreur lors de la récupération des tâches : ' . $e->getMessage());
        }
    }

    public function getTasksByUserId(int $userId): array
{
    try {
        // Préparer la requête SQL pour récupérer toutes les tâches associées à un utilisateur
        $stmt = $this->db->prepare("
            SELECT t.* FROM tasks t
            JOIN task_users tu ON t.id = tu.taskId
            WHERE tu.userId = :userId
        ");
        $stmt->bindValue(':userId', $userId);
        $stmt->execute();

        // Tableau pour stocker les tâches récupérées
        $tasks = [];

        // Récupérer les résultats et les formater en objets Task
        while ($taskData = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            // Pour chaque tâche, récupérer également les utilisateurs associés
            $stmtUsers = $this->db->prepare("SELECT userId FROM task_users WHERE taskId = :taskId");
            $stmtUsers->bindValue(':taskId', $taskData['id']);
            $stmtUsers->execute();
            $userIds = $stmtUsers->fetchAll(\PDO::FETCH_COLUMN);

            // Ajouter chaque tâche dans le tableau de retour
            $tasks[] = new Task(
                $taskData['titre'],
                $taskData['description'],
                $userIds,
                $taskData['dateEcheance'],
                $taskData['statut'],
                //$taskData['id']  // Inclure l'ID de la tâche
            );
        }

        return $tasks;

    } catch (\PDOException $e) {
        // Gestion des erreurs
        throw new \Exception('Erreur lors de la récupération des tâches : ' . $e->getMessage());
    }
}

public function getTasksByUserIdAndStatus($userId, $status) {
    try {
        // Préparer la requête pour récupérer les tâches en fonction de l'utilisateur et du statut
        $stmt = $this->db->prepare('
            SELECT t.id, t.titre, t.description, t.dateEcheance, t.statut
            FROM tasks t
            JOIN task_users tu ON t.id = tu.taskId
            WHERE tu.userId = :userId AND t.statut = :status
        ');
        // Exécuter la requête avec les paramètres
        $stmt->execute(['userId' => $userId, 'status' => $status]);

        // Tableau pour stocker les tâches
        $tasks = [];
        
        // Boucler sur les résultats
        while ($taskData = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            // Instancier l'objet Task pour chaque ligne de résultats
            // Si le constructeur de Task attend un tableau pour les utilisateurs, on envoie un tableau vide
            // ou la valeur que vous voulez envoyer (par exemple, un tableau d'IDs d'utilisateurs si nécessaire)
            $task = new Task(
                $taskData['titre'],
                $taskData['description'],
                [], // Tableau vide pour les utilisateurs si ce n'est pas nécessaire
                $taskData['dateEcheance'],
                $taskData['statut']
            );
            
            // Ajouter la tâche au tableau
            $tasks[] = $task;
        }

        // Retourner le tableau de tâches
        return $tasks;

    } catch (\PDOException $e) {
        // Gérer l'erreur en cas de problème
        throw new \Exception("Erreur lors de la récupération des tâches : " . $e->getMessage());
    }
}



}
