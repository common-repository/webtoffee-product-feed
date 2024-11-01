<?php

if (!defined('WPINC')) {
    exit;
}


$post_columns = array(
    'id' => 'ProductId',
    'title' => 'Title',
    'description' => 'Description',
    'currency' => 'Currency',
    'price_without_vat' => 'NormalPriceWithoutVAT',
    'vat_rate' => 'VATRate',
    'sku_id' => 'SkuId',
    'ean' => 'EAN',
    'isbn' => 'ISBN',
    'brand' => 'Brand',
    'Category' => 'Category',
    'availability' => 'StockStatus',
    'quantity' => 'StockQuantity',
    'package_weight' => 'PackageWeight',
);

return apply_filters('wt_pf_fruugo_product_post_columns', $post_columns);

