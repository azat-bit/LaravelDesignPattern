<?php

namespace App\Interfaces;

interface UserServiceInterface
{
    public function getAll();
    public function getById($id);
    public function store(array $data);
    public function update($id, array $data);
    public function destroy($id);
    public function attemptLogin(array $credentials): bool;
}
