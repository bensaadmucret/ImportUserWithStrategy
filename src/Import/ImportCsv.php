<?php

namespace App\Import;

use App\Entity\User;

final class ImportCsv implements ImportInterface
{
    /**
     * @param string $file
     * @return array<array-key, User>
     * @throws \Exception
     */
    public function import(string $file): array
    {
        $fileContents = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if ($fileContents === false) {
            throw new \Exception('Failed to read the CSV file.');
        }

        // Supprimer la première ligne du tableau $fileContents
        array_shift($fileContents);

        $users = [];

        foreach ($fileContents as $line) {
            $data = str_getcsv($line);
            if (count($data) === 3) {
                $users[] = new User($data[0], $data[1], $data[2]);
            }
        }

        return $users;
    }

    /**
     * @param string $file
     * @return bool
     */
    public function isSupported(string $file): bool
    {
        $supportedExtensions = ['csv'];
        $extension = pathinfo($file, PATHINFO_EXTENSION);

        return in_array($extension, $supportedExtensions);
    }

}