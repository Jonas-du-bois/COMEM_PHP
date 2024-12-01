<?php

function getUserByEmail($email, $dbManager) {
    $userInfoArray = $dbManager->rendPersonnes($email);
    return !empty($userInfoArray) ? $userInfoArray[0] : null;
}

function getStatusBadgeClass(string $statut): string
{
    $badgeClasses = [
        'À faire' => 'bg-danger',   
        'En cours' => 'bg-warning',     
        'Terminé' => 'bg-success',   
    ];

    return $badgeClasses[$statut] ?? 'bg-secondary';  // Par défaut, gris
}

function getSortOrder(string $column): string
{
    $currentOrder = $_GET['order'] ?? 'ASC';
    $currentSort = $_GET['sort'] ?? '';
    
    // Inverser l'ordre si on reclique sur la même colonne
    if ($currentSort === $column) {
        return $currentOrder === 'ASC' ? 'DESC' : 'ASC';
    }

    return 'ASC'; // Ordre par défaut
}




