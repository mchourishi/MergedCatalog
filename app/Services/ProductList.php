<?php

namespace App\Services;

/**
 * Merges Catalog, Supplier and Barcode. Returns array containing parameters from them.
 * Class ProductList
 * @package App\Services
 */
class ProductList
{
    public function mergeProducts($catalogs, $suppliers, $barcodes, $source)
    {
        $product = [];
        foreach ($barcodes as $key => $barcode) {
            $prodItem = [];
            $supplierObj = array_values(array_filter($suppliers, function ($supplier) use($barcode) {
                return $barcode->SupplierID == $supplier->ID;
            }));

            $catalogObj = array_values(array_filter($catalogs, function ($catalog) use($barcode) {
                return $barcode->SKU == $catalog->SKU;
            }));

            $prodItem['SKU'] = $barcode->SKU;
            $prodItem['Description'] = ($catalogObj && $catalogObj[0]->Description) ? $catalogObj[0]->Description : '';
            $prodItem['SupplierName'] = ($supplierObj && $supplierObj[0]->Name) ? $supplierObj[0]->Name : '';
            $prodItem['SupplierID'] = $barcode->SupplierID;
            $prodItem['Barcode'] = $barcode->Barcode;
            $prodItem['Source'] = $source;

            $product[] = $prodItem;
        }
        return $product;
    }
}
