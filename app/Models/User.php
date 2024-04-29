<?php

namespace App\Models;

class User
{
    public string $username;
    public string $password;
    public array $roles;

    public function __construct(string $username, string $password, array $roles)
    {
        $this->username = $username;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->roles = $roles;
    }
}