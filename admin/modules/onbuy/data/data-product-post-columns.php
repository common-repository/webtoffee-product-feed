<?php

if (!defined('WPINC')) {
    exit;
}


$post_columns = array(
    
    'SKU' => 'sku[SKU]',
    'Product_Name' => 'Product Title[Product_Name]',
    'Description' => 'Product Description[Description]',
    'Default_Image' => 'Main Image[Default_Image]',    
    'Brand' => 'Product brand[Brand]',
    'Category' => 'OnBuy Product Category[onbuy_product_category]',
    'Condition' => 'Condition[Condition]',
    'EAN/UPC' => 'EAN/UPC',
);

return apply_filters('wt_pf_onbuy_product_post_columns', $post_columns);

