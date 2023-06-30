<?php
namespace App\Import;

use App\Entity\User;

final class ImportContext implements ImportContextInterface
{
    /**
     * @var array<ImportInterface>
     */
    private array $strategies = [];

    public function setStrategy(ImportInterface $strategy): self
    {
        $this->strategies[] = $strategy;
        return $this;
    }

    /**
     * @param string $file
     * @return array<array-key, User>
     * @throws \Exception
     */
    public function execute(string $file): array
    {

           foreach ($this->strategies as $strategy) {
               if($strategy->isSupported($file)){
                   return $strategy->import($file);
               }

          }

        throw new \Exception('Unsupported file format');
    }


}
