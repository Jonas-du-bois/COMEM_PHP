<?php

namespace M521\Taskforce\dbManager;

interface I_ApiCRUD {
    public function creeTable(): bool;

    //----------Users----------

    /**
     * Ajoute un utilisateur dans la base de données.
     * @param Users $users Instance de la classe Users à insérer.
     * @return int Identifiant de l'utilisateur inséré.
     */
    public function ajoutePersonne(Users $users): int;

    /**
     * Retourne une liste d'utilisateurs filtrée par nom.
     * @param string $nom Nom à rechercher.
     * @return array Tableau des utilisateurs correspondant.
     */
    public function rendPersonnes(string $nom): array;

    /**
     * Modifie les données d'un utilisateur spécifique.
     * @param int $id Identifiant de l'utilisateur.
     * @param Users $users Instance contenant les nouvelles données.
     * @return bool Retourne true si la modification a réussi, sinon false.
     */
    public function modifiePersonne(int $id, Users $users): bool;

    /**
     * Supprime un utilisateur.
     * @param int $id Identifiant de l'utilisateur.
     * @return bool Retourne true si la suppression a réussi, sinon false.
     */
    public function supprimePersonne(int $id): bool;

    /**
     * Vérifie si les identifiants d'un utilisateur sont valides.
     * @param string $email Email de l'utilisateur.
     * @param string $motDePasse Mot de passe de l'utilisateur.
     * @return string Retourne un token si les identifiants sont valides.
     */
    public function verifierIdentifiants(string $email, string $motDePasse): string;

    /**
     * Compte le nombre total d'utilisateurs.
     * @return int Nombre d'utilisateurs.
     */
    public function compterNbUsers(): int;

    /**
     * Récupère un utilisateur par son token d'authentification.
     * @param string $token Token de l'utilisateur.
     * @return Users|null Retourne une instance de Users ou null si aucun utilisateur n'est trouvé.
     */
    public function getUserByToken($token): ?array;

    /**
     * Confirme l'inscription d'un utilisateur.
     * @param int $userId Identifiant de l'utilisateur.
     * @return bool Retourne true si la confirmation a réussi, sinon false.
     */
    public function confirmeInscription(int $userId): bool;

    //----------Tasks----------

    /**
     * Ajoute une tâche dans la base de données.
     * @param Task $tasks Instance de la classe Task à insérer.
     * @return int Identifiant de la tâche insérée.
     */
    public function ajouteTache(Task $tasks): int;

    /**
     * Retourne toutes les tâches.
     * @return array Tableau des tâches.
     */
    public function rendTaches(): array;

    /**
     * Modifie une tâche existante.
     * @param int $id Identifiant de la tâche.
     * @param Task $tasks Instance contenant les nouvelles données.
     * @return bool Retourne true si la modification a réussi, sinon false.
     */
    public function modifieTache(int $id, Task $tasks): bool;

    /**
     * Supprime une tâche.
     * @param int $id Identifiant de la tâche.
     * @return bool Retourne true si la suppression a réussi, sinon false.
     */
    public function supprimeTache(int $id): bool;

    /**
     * Récupère les tâches assignées à un utilisateur spécifique.
     * @param int $userId Identifiant de l'utilisateur.
     * @return array Tableau des tâches assignées à cet utilisateur.
     */
    public function getTasksByUserId(int $userId): array;
}
