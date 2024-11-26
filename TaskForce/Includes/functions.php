<?php

function getUserByEmail($email, $dbManager) {
    $userInfoArray = $dbManager->rendPersonnes($email);
    return !empty($userInfoArray) ? $userInfoArray[0] : null;
}

function getTaskStatusClass($statut) {
    switch ($statut) {
        case 'a faire':
            return 'task-todo';
        case 'en cours':
            return 'task-in-progress';
        case 'termine':
            return 'task-completed';
        default:
            return ''; 
    }
}



