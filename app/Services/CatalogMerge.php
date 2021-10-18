<?php
namespace App\Services;

/**
 * Merges Catalog first by grouping it on SKU and then on Barcode to get unique products.
 * Class CatalogMerge
 * @package App\Services
 */
class CatalogMerge
{
    public function catalogMerge($products){

        $skuGroup = array();
        $result = [];
        // Groupby SKU, the result array will be all unique SKUs products
        foreach (array($products) as $elements) {
            foreach ($elements as $element){
                if(!array_key_exists($element->SKU, $skuGroup)) {
                    $skuGroup[$element->SKU] = $element;
                }
            }
        }
        // Groupby Barcode from the unique SKU products.
        $barcodeGroup = array();
        foreach ($skuGroup as $item){
            if(!array_key_exists($item->Barcode, $barcodeGroup)) {
                $barcodeGroup[$item->Barcode] = $item;
            }
        }

        // Format Array to only have SKU,Description and Source.
        foreach ($barcodeGroup as $product){
            $merged = [];
            $merged['SKU'] = $product->SKU;
            $merged['Description'] = $product->Description;
            $merged['Source'] = $product->Source;
            $result[] = $merged;
        }

        return $result;
    }
}
