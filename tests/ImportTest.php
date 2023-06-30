<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Import\ImportContext;
use App\Import\ImportCsv;
use App\Import\ImportJson;
use App\Import\ImportXml;
use App\Entity\User;

final class ImportTest extends TestCase
{
    private ImportContext $importContext;

    protected function setUp(): void
    {
        $this->importContext = (new ImportContext())
            ->setStrategy(new ImportCsv())
            ->setStrategy(new ImportJson())
            ->setStrategy(new ImportXml())
            ;
    }

    /**
     * @dataProvider providerFile
     * @throws \Exception
     */
    public function testImport(string $file): void
    {
        $users = $this->importContext->execute($file);
        $this->assertCount(6, $users);
        $this->assertIsArray($users);
        $this->assertContainsOnlyInstancesOf(User::class, $users);
    }

    public function providerFile(): \Generator
    {
        yield 'csv'  => [__DIR__.'/fixtures/user.csv'];
        yield 'json' => [__DIR__.'/fixtures/user.json'];
        yield 'xml'  => [__DIR__.'/fixtures/user.xml'];
    }
}
