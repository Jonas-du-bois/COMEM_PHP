<?php

namespace M521\Taskforce\dbManager;

use \Exception;
use DateTime;

class Task
{
    private $id;
    private $titre;          // Correspond à la colonne 'titre' dans la base
    private $description;    // Correspond à la colonne 'description' dans la base
    private $userIds = [];   // Liste des IDs des utilisateurs assignés à la tâche
    private $dateEcheance;   // Correspond à la colonne 'dateEcheance' dans la base
    private $statut;         // Correspond à la colonne 'statut' dans la base
    private $createdAt;

    /**
     * Construit une nouvelle tâche avec les paramètres spécifiés
     * @param string        $titre Titre de la tâche
     * @param string|null   $description Description de la tâche
     * @param array|null    $userIds Liste des IDs des utilisateurs assignés
     * @param string|null   $dateEcheance Date limite au format 'YYYY-MM-DD'
     * @param string        $statut Statut de la tâche (à_faire, en_cours, terminé)
     * @param int           $id Identifiant unique de la tâche (par défaut 0)
     * @throws Exception    Lance une exception si un paramètre obligatoire est incorrect
     */
    public function __construct(
        string $titre,
        string $description = null,
        array $userIds = null,
        string $dateEcheance = null,
        string $statut = 'à_faire',
    ) {
        if (empty($titre)) {
            throw new Exception('Il faut un titre pour la tâche.');
        }
        if (!in_array($statut, ['a_faire', 'en_cours', 'termine'])) {
            throw new Exception('Le statut est invalide. Valeurs acceptées : à_faire, en_cours, terminé.');
        }

        if (!empty($dateEcheance) && !$this->isValidDate($dateEcheance)) {
            throw new Exception('La date limite est invalide. Utilisez le format YYYY-MM-DD.');
        }

        $this->titre = $titre;
        $this->description = $description;
        $this->userIds = $userIds ?? [];
        $this->dateEcheance = $dateEcheance;
        $this->statut = $statut;
        $this->createdAt = (new DateTime())->format('Y-m-d H:i:s');
    }

    /**
     * Vérifie si une date est valide au format YYYY-MM-DD
     * @param string $date Date à vérifier
     * @return bool
     */
    private function isValidDate(string $date): bool
    {
        $d = DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
    }

    // Getters et Setters pour accéder aux propriétés

    public function rendId(): int
    {
        return $this->id;
    }

    public function rendTitre(): string
    {
        return $this->titre;
    }

    public function modifieTitre(string $titre): void
    {
        if (empty($titre)) {
            throw new Exception('Le titre ne peut pas être vide.');
        }
        $this->titre = $titre;
    }

    public function rendDescription(): ?string
    {
        return $this->description;
    }

    public function modifieDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function rendUserIds(): array
    {
        return $this->userIds;
    }

    public function modifieUserIds(array $userIds): void
    {
        $this->userIds = $userIds;
    }

    public function rendDateEcheance(): ?string
    {
        return $this->dateEcheance;
    }

    public function modifieDateEcheance(?string $dateEcheance): void
    {
        if (!empty($dateEcheance) && !$this->isValidDate($dateEcheance)) {
            throw new Exception('La date limite est invalide. Utilisez le format YYYY-MM-DD.');
        }
        $this->dateEcheance = $dateEcheance;
    }

    public function rendStatut(): string
    {
        return $this->statut;
    }

    public function modifieStatut(string $statut): void
    {
        if (!in_array($statut, ['à_faire', 'en_cours', 'terminé'])) {
            throw new Exception('Le statut est invalide. Valeurs acceptées : à_faire, en_cours, terminé.');
        }
        $this->statut = $statut;
    }

    public function rendCreatedAt(): string
    {
        return $this->createdAt;
    }
}
