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



