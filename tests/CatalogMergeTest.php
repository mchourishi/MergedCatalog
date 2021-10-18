<?php

use PHPUnit\Framework\TestCase;
use App\Services\ProductList;
use App\Models\Catalog;
use App\Helpers\Helper;
use App\Models\Supplier;
use App\Models\Barcode;
use App\Models\Product;
use App\Services\CatalogMerge;

class CatalogMergeTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->prod_list = new ProductList();
        $this->catalog_merge = new CatalogMerge();
    }

    public function test_catalog_merge(){

        $catalogA = [
          ['001', 'Product ABC'] , ['002', 'Product DEF'] , ['003', 'Product GHI']
        ];
        $catalogB = [
            ['B001', 'Product ABC'] , ['B002', 'Product DEF'] , ['003', 'Product GHI']
        ];
        $suppliersA = [
          ['123', 'Supplier A'] , ['224', 'Supplier B'], ['226', 'Supplier C']
        ];
        $suppliersB = [
            ['123', 'Supplier B1'] , ['224', 'Supplier B2'], ['226', 'Supplier B3']
        ];
        $barcodesA = [
            ['123', '001', 'z27867'],
            ['123', '001', 'z27868'],
            ['224', '002', 'z27869'],
            ['224', '002', 'z27869'],
            ['226', '003', 'z27870'],
        ];
        $barcodesB = [
            ['123', 'B001', 'z27867'],
            ['123', 'B001', 'zb7866'],
            ['224', 'B002', 'z27899'],
            ['224', 'B002', 'z27889'],
            ['226', '003', 'z27870'],
        ];
        $catalogAInstance = Helper::arrayToInstance($catalogA, Catalog::class);
        $supplierAInstance = Helper::arrayToInstance($suppliersA, Supplier::class);
        $barcodeAInstance = Helper::arrayToInstance($barcodesA, Barcode::class);

        $outputA = $this->prod_list->mergeProducts($catalogAInstance,$supplierAInstance,$barcodeAInstance,'A');
        $listA = Helper::arrayToInstance($outputA,Product::class);

        $catalogBInstance = Helper::arrayToInstance($catalogB, Catalog::class);
        $supplierBInstance = Helper::arrayToInstance($suppliersB, Supplier::class);
        $barcodeBInstance = Helper::arrayToInstance($barcodesB, Barcode::class);

        $outputB = $this->prod_list->mergeProducts($catalogBInstance,$supplierBInstance,$barcodeBInstance,'B');
        $listB = Helper::arrayToInstance($outputB,Product::class);
        $mergedProds = array_merge($listA,$listB);

        $result = $this->catalog_merge->catalogMerge($mergedProds);

        // Assert Result contains unique products.

        self::assertTrue(in_array([
            'SKU' => '001',
            'Description' => 'Product ABC',
            'Source' => 'A'
        ],$result));

        self::assertTrue(in_array([
            'SKU' => '002',
            'Description' => 'Product DEF',
            'Source' => 'A'
        ],$result));

        self::assertTrue(in_array([
            'SKU' => '003',
            'Description' => 'Product GHI',
            'Source' => 'A'
        ],$result));

        self::assertTrue(in_array([
            'SKU' => 'B002',
            'Description' => 'Product DEF',
            'Source' => 'B'
        ],$result));

        self::assertFalse(in_array([
            'SKU' => '003',
            'Description' => 'Product GHI',
            'Source' => 'B'
        ],$result));

    }
}
