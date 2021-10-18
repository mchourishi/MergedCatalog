<?php

namespace App;

use App\Helpers\Helper;
use App\Models\Barcode;
use App\Models\Catalog;
use App\Models\Product;
use App\Models\Supplier;
use App\Services\CatalogMerge;
use App\Services\CSVReader;
use App\Services\ProductList;
use App\Services\CSVWriter;

/**
 * Merges Catalog and writes to CSV.
 * Class Merge
 * @package App
 */
class Merge
{

    private const FILE_PATH = "files/";

    public function __construct()
    {
        $this->prod_merge = new ProductList();
        $this->catalog_merge = new CatalogMerge();
    }

    public function merge()
    {
        $productA = $this->getList('A');
        $productB = $this->getList('B');
        // Merge Both Lists
        $mergedProds = array_merge($productA,$productB);
        // Group list to get unique products.
        $result = $this->catalog_merge->catalogMerge($mergedProds);
        // Write Result to Output.csv
        CSVWriter::writer(self::FILE_PATH."output.csv", $result);
    }

    public function getList($source){
        $catalog = CSVReader::reader(self::FILE_PATH . "catalog".$source.".csv");
        $suppliers = CSVReader::reader(self::FILE_PATH . "suppliers".$source.".csv");
        $barcodes = CSVReader::reader(self::FILE_PATH . "barcodes".$source.".csv");

        $catalogInstance = Helper::arrayToInstance($catalog, Catalog::class);
        $suppliersInstance = Helper::arrayToInstance($suppliers, Supplier::class);
        $barcodesInstance = Helper::arrayToInstance($barcodes, Barcode::class);

        $product = $this->prod_merge->mergeProducts($catalogInstance, $suppliersInstance, $barcodesInstance,$source);
        return Helper::arrayToInstance($product,Product::class);
    }


}
