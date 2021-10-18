<?php
namespace App\Models;


class Product
{
    public $SKU;
    public $Description;
    public $SupplierID;
    public $SupplierName;
    public $Barcode;
    public $Source;

    public function __construct(string $SKU, string $Description, string $SupplierID, string $SupplierName,
                                string $Barcode, string $Source)
    {
        $this->SKU = $SKU;
        $this->Description = $Description;
        $this->SupplierID = $SupplierID;
        $this->SupplierName = $SupplierName;
        $this->Barcode = $Barcode;
        $this->Source = $Source;
    }
}
