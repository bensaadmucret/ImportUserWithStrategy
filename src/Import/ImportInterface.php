<?php
declare(strict_types=1);

namespace App\Import;

use App\Entity\User;

interface ImportInterface
{
    /**
     * @param string $file
     * @return array<array-key, User>
     */
    public function import(string $file): array;

    /**
     * @param string $file
     * @return bool
     */
    public function isSupported(string $file): bool;

}