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
            FOREIGN KEY (userId) REFERENCES users(id) ON DELETE CASCADE
        );
    SQL;

        try {
            $this->db->exec($sqlUsers);
            $this->db->exec($sqlTasks);
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
        $datas = [
            'id' => $id,
            'nom' => $user->rendNom(),
            'prenom' => $user->rendPrenom(),
            'email' => $user->rendEmail(),
            'noTel' => $user->rendNoTel(),
            'motDePasse' => password_hash($user->rendMotDePasse(), PASSWORD_DEFAULT),
        ];
        $sql = "UPDATE users SET nom=:nom, prenom=:prenom, email=:email, noTel=:noTel, motDePasse=:motDePasse WHERE id=:id";
        $this->db->prepare($sql)->execute($datas);
        return true;
    }

    public function rendPersonnes(string $nom): array
    {
        $sql = "SELECT * FROM users WHERE nom = :nom;";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('nom', $nom, \PDO::PARAM_STR);
        $stmt->execute();
        $donnees = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $tabUsers = [];
        if ($donnees) {
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

    public function ajouteTache(Task $task): int
    {
        $datas = [
            'userId' => $task->rendUserId(),
            'titre' => $task->rendTitre(),
            'description' => $task->rendDescription(),
            'dateEcheance' => $task->rendDateEcheance(),
            'statut' => $task->rendStatut(),
        ];
        $sql = "INSERT INTO tasks (userId, titre, description, dateEcheance, statut) VALUES "
            . "(:userId, :titre, :description, :dateEcheance, :statut)";
        $this->db->prepare($sql)->execute($datas);
        return $this->db->lastInsertId();
    }

    public function rendTaches(): array
    {
        $sql = "SELECT * FROM tasks;";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function modifieTache(int $id, Task $task): bool
    {
        $datas = [
            'id' => $id,
            'titre' => $task->rendTitre(),
            'description' => $task->rendDescription(),
            'dateEcheance' => $task->rendDateEcheance(),
            'statut' => $task->rendStatut(),
        ];
        $sql = "UPDATE tasks SET titre=:titre, description=:description, dateEcheance=:dateEcheance, statut=:statut WHERE id=:id";
        $this->db->prepare($sql)->execute($datas);
        return true;
    }

    public function supprimeTache(int $id): bool
    {
        $sql = "DELETE FROM tasks WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function getTasksByUserId(int $userId): array
    {
        $sql = "SELECT * FROM tasks WHERE userId = :userId;";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':userId', $userId, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getAllTaches(): array
    {
        // SQL pour récupérer toutes les tâches
        $sql = "SELECT * FROM tasks";

        // Exécution de la requête
        $stmt = $this->db->query($sql);

        // Récupération des résultats sous forme de tableau associatif
        $donnees = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // Si des tâches sont trouvées, nous les retournerons sous forme d'objets Task
        $tabTaches = [];
        if ($donnees) {
            foreach ($donnees as $donnee) {
                // Ici, vous pouvez instancier un objet Task pour chaque enregistrement de tâche
                $tache = new Task(
                    $donnee['titre'],
                    $donnee['description'],
                    $donnee['userId'],
                    $donnee['dateEcheance'],
                    $donnee['statut'],
                    $donnee['id']
                );
                $tabTaches[] = $tache;
            }
        }

        // Retourne un tableau d'objets Task
        return $tabTaches;
    }
}
