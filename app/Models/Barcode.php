<?php

namespace App\Models;

class Barcode
{
    public $SKU;
    public $SupplierID;
    public $Barcode;

    public function __construct(string $SupplierID, string $SKU, string $Barcode)
    {
        $this->SupplierID = $SupplierID;
        $this->SKU = $SKU;
        $this->Barcode = $Barcode;
    }
}
