<?php

namespace App\Import;

use App\Entity\User;

final class ImportXml implements ImportInterface
{
    /**
     * @param string $file
     * @return array<array-key, User>
     */
    public function import(string $file): array
    {
        $users = [];
        $file = simplexml_load_file($file);
        foreach ($file as $row) {
            $users[] = new User($row->firstname, $row->lastname, $row->email);
        }
        return $users;

    }

    /**
     * @param string $file
     * @return bool
     */
    public function isSupported(string $file): bool
    {
        $supportedExtensions = ['xml'];
        $extension = pathinfo($file, PATHINFO_EXTENSION);

        return in_array($extension, $supportedExtensions);
    }
}