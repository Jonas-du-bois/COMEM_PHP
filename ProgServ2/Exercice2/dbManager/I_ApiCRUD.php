<?php

namespace dbManager;

interface I_ApiCRUD {
    public function creeTable(): bool;
    public function ajoutePersonne(Users $users): int;
    public function rendPersonnes(string $nom): array;
    public function modifiePersonne(int $id, Users $users): bool;
    public function supprimePersonne(int $id) : bool;
}