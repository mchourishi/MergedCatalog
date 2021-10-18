<?php
namespace App\Models;

class MergedCatalog
{
    public $SKU;
    public $Description;
    public $Source;

    public function __construct(string $SKU, string $Description, string $Source)
    {
        $this->SKU = $SKU;
        $this->Description = $Description;
        $this->Source = $Source;
    }
}
