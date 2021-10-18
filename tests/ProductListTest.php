<?php

use PHPUnit\Framework\TestCase;
use App\Services\ProductList;
use App\Models\Catalog;
use App\Helpers\Helper;
use App\Models\Supplier;
use App\Models\Barcode;

class ProductListTest extends TestCase
{
    public function setUp() : void
    {
        parent::setUp();
        $this->prod_list = new ProductList();
    }

    public function test_product_list_is_merged_with_all_parameters(){

        $catalog = [
          ['001', 'Product ABC'] , ['002', 'Product DEF'] , ['003', 'Product GHI']
        ];
        $suppliers = [
          ['123', 'Supplier A'] , ['224', 'Supplier B'], ['226', 'Supplier C']
        ];
        $barcodes = [
            ['123', '001', 'z27867'],
            ['123', '001', 'z27868'],
            ['224', '002', 'z27869'],
            ['224', '002', 'z27869'],
            ['226', '003', 'z27870'],
        ];
        $catalogInstance = Helper::arrayToInstance($catalog, Catalog::class);
        $supplierInstance = Helper::arrayToInstance($suppliers, Supplier::class);
        $barcodeInstance = Helper::arrayToInstance($barcodes, Barcode::class);

        $output = $this->prod_list->mergeProducts($catalogInstance,$supplierInstance,$barcodeInstance,'A');
        // Assert that the expected list has merged properties.
        $expectedOutput = [
                            'SKU' => '001',
                            'Description' => 'Product ABC',
                            'SupplierName' => 'Supplier A',
                            'SupplierID' => '123',
                            'Barcode' => 'z27867',
                            'Source' => 'A'
                        ];

        self::assertEquals($expectedOutput,$output[0]);

    }
}
