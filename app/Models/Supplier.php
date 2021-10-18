<?php

namespace App\Models;

class Supplier
{
    public $ID;
    public $Name;

    public function __construct(string $ID, string $Name)
    {
        $this->ID = $ID;
        $this->Name = $Name;
    }
}
