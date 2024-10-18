<?php

namespace dbManager;

class DbManagerCRUD implements I_ApiCRUD {

    private $db;

    public function __construct() {
        $config = parse_ini_file('config' . DIRECTORY_SEPARATOR . 'db.ini', true);
        $dsn = $config['dsn'];
        $username = $config['username'];
        $password = $config['password'];
        $this->db = new \PDO($dsn, $username, $password);
        if (!$this->db) {
            die("Problème de connection à la base de données");
        }
    }

    public function creeTablePersonnes(): bool {
        $sql = <<<COMMANDE_SQL
            CREATE TABLE IF NOT EXISTS personnes (
		id INTEGER PRIMARY KEY AUTOINCREMENT,
                nom VARCHAR(120) NOT NULL,
                prenom VARCHAR(120) NOT NULL,
                email VARCHAR(120) NOT NULL UNIQUE,
                noTel VARCHAR(20) NOT NULL UNIQUE
            );
COMMANDE_SQL;

        try {
            $this->db->exec($sql);
            $ok = true;
        } catch (PDOException $e) {
            $e->getMessage();
            $ok = false;
        }
        return $ok;
    }

    public function ajoutePersonne(Personne $personne): int {
        $datas = [
            'nom' => $personne->rendNom(),
            'prenom' => $personne->rendPrenom(),
            'email' => $personne->rendEmail(),
            'noTel' => $personne->rendNoTel(),
        ];
        $sql = "INSERT INTO personnes (nom, prenom, email, noTel) VALUES "
                . "(:nom, :prenom, :email, :noTel)";
        $this->db->prepare($sql)->execute($datas);
        return $this->db->lastInsertId();
    }

    public function modifiePersonne(int $id, Personne $personne): bool {
        $datas = [
            'id' => $id,
            'nom' => $personne->rendNom(),
            'prenom' => $personne->rendPrenom(),
            'email' => $personne->rendEmail(),
            'noTel' => $personne->rendNoTel(),
        ];
        $sql = "UPDATE personnes SET nom=:nom, prenom=:prenom, email=:email, noTel=:noTel WHERE id=:id";
        $this->db->prepare($sql)->execute($datas);
        return true;
    }

    public function rendPersonnes(string $nom): array {
        $sql = "SELECT * From personnes WHERE nom = :nom;";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('nom', $nom, \PDO::PARAM_STR);
        $stmt->execute();
        $donnees = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        $tabPersonnes = [];
        if ($donnees) {
            foreach ($donnees as $donneesPersonne) {
                $p = new Personne(
                        $donneesPersonne["prenom"],
                        $donneesPersonne["nom"],
                        $donneesPersonne["email"],
                        $donneesPersonne["noTel"],
                        $donneesPersonne["id"],
                );
                $tabPersonnes[] = $p;
            }
        }
        return $tabPersonnes;
    }

    public function supprimePersonne(int $id): bool {
        $sql = "DELETE FROM personnes WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam('id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

}
