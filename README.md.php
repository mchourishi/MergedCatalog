# Catalog Merge
PHP based CLI tool to merge catalog from Company A & Company B.

## Description
- Consolidates product catalog into one set of products.
- CLI tool, just run `php app.php`
- The application first reads catalog, barcode and suppliers csv files.
- Then creates a superset containing barcode, supplier and catalog for every product.
- The superset is then grouped by SKU's and Barcode to remove any duplicate products.

## Server Requirements
- PHP 8.0.11
- Composer

## Installation
- Run ``composer install`` to install dependencies. This will install phpunit.

### Run
- From Command Line change directory to MergedCatalog installation directory.
- Run `php app.php`
- Check output in files/output.csv

### Run Tests
- Run  ```vendor/bin/phpunit tests/``` from MergedCatalog directory.
