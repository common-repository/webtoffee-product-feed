<?php

if (!defined('WPINC')) {
    exit;
}

$post_columns = array(
                
            'google_product_category'      => 'Category',
            'brand'                        => 'Brand', 
            'title'                        => 'Product Name',
            'description'                  => 'Product Description',
            'availability'                 => 'Product Status',     
            'package_weight' => 'Package Weight',
            'package_length' => 'Package Length',
            'package_width' => 'Package Width',
            'package_height' => 'Package Height',           
);

return apply_filters('wt_pf_tiktokshop_product_post_columns',$post_columns);


