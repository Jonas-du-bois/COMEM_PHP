<?php
namespace dbManager;

require_once('./config/autoload.php');

use dbManager\I_ApiCRUD;

class DbManagerCRUD implements I_ApiCRUD {

    private $db;

    public function __construct() {
        $config = parse_ini_file('config' . DIRECTORY_SEPARATOR . 'db.ini', true);
        $dsn = $config['dsn'];
        $username = $config['username'];
        $password = $config['password'];
        $this->db = new \PDO($dsn, $username, $password);
        if (!$this->db) {
            die("Problème de connexion à la base de données");
        }
    }

    public function creeTable(): bool {
        $sql = <<<COMMANDE_SQL
            CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                nom VARCHAR(120) NOT NULL,
                prenom VARCHAR(120) NOT NULL,
                email VARCHAR(120) NOT NULL UNIQUE,
                noTel VARCHAR(20) NOT NULL UNIQUE,
                motDePasse VARCHAR(255) NOT NULL
            );
COMMANDE_SQL;

        try {
            $this->db->exec($sql);
            return true;
        } catch (\PDOException $e) {
            echo "Erreur lors de la création de la table: " . $e->getMessage();
            return false;
        }
    }

    public function ajoutePersonne(Users $user): int {
        $datas = [
            'nom' => $user->rendNom(),
            'prenom' => $user->rendPrenom(),
            'email' => $user->rendEmail(),
            'noTel' => $user->rendNoTel(),
            'motDePasse' => password_hash($user->rendMotDePasse(), PASSWORD_DEFAULT),
        ];
        $sql = "INSERT INTO users (nom, prenom, email, noTel, motDePasse) VALUES "
                . "(:nom, :prenom, :email, :noTel, :motDePasse)";
        $this->db->prepare($sql)->execute($datas);
        return $this->db->lastInsertId();
    }

    public function modifiePersonne(int $id, Users $user): bool {
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

    public function rendPersonnes(string $nom): array {
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

    public function supprimePersonne(int $id): bool {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function verifierIdentifiants(string $email, string $motDePasse): bool {
        $sql = "SELECT motDePasse FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
        $stmt->execute();

        // Récupérer le mot de passe haché
        $hashedPassword = $stmt->fetchColumn();

        // Vérifier si le mot de passe correspond
        return $hashedPassword && password_verify($motDePasse, $hashedPassword);
    }

    public function compterNbUsers(): int {
        // La requête SQL pour compter les utilisateurs
        $countQuery = "SELECT COUNT(*) as total_users FROM users";

        try {
            // Préparer et exécuter la requête
            $stmt = $this->db->prepare($countQuery);
            $stmt->execute();  // Exécution de la requête
            // Récupérer le résultat de la requête
            $result = $stmt->fetch(\PDO::FETCH_ASSOC);  // Utilisation de fetch pour récupérer une ligne en tant que tableau associatif
            // Vérifier si le résultat existe et retourner le nombre total d'utilisateurs
            if ($result && isset($result['total_users'])) {
                return (int) $result['total_users'];  // Conversion en entier
            } else {
                return 0;  // Retourner 0 si aucun utilisateur n'est trouvé
            }
        } catch (\PDOException $e) {
            // Gestion des erreurs en cas de problème avec la base de données
            echo "Erreur lors du comptage des utilisateurs : " . $e->getMessage();
            return 0;  // Retourner 0 en cas d'erreur
        }
    }
}
