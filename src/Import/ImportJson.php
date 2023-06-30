<?php

namespace App\Import;

use App\Entity\User;

final class ImportJson implements ImportInterface
{
    /**
     * @param string $file
     * @return array<array-key, User>
     */
    public function import(string $file): array
    {
        $file = json_decode(file_get_contents($file), true);
        return array_map(
            static fn(array $user): User => new User($user['firstname'], $user['lastname'], $user['email']),
             $file
        );

    }

    /**
     * @param string $file
     * @return bool
     */
    public function isSupported(string $file): bool
    {
        $supportedExtensions = ['json'];
        $extension = pathinfo($file, PATHINFO_EXTENSION);

        return in_array($extension, $supportedExtensions);
    }
}
