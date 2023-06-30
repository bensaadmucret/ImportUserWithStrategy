<?php

namespace App\Import;

interface ImportContextInterface
{
    public function setStrategy( ImportInterface $strategy): self;
    public function execute( string $file): array;
}