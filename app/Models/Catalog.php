<?php

namespace App\Models;

class Catalog
{
    public $SKU;
    public $Description;

    public function __construct(string $SKU, string $Description)
    {
        $this->SKU = $SKU;
        $this->Description = $Description;
    }
}
