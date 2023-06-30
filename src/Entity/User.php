<?php

namespace App\Entity;

final class User
{
    public function __construct(
        private string $firstname,
        private string $lastname,
        private string $email,
    ) {}

}