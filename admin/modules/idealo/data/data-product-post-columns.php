<?php

if (!defined('WPINC')) {
    exit;
}

$post_columns = array(
                
            'sku'                          => 'Product SKU[sku]',
            'title'                        => 'Product Title[title]',
            'price'                        => 'Price [price]',
            'description'                  => 'Product Description[description]',
            'url'                          => 'Product URL[url]',
            'categoryPath'                 => 'Product Categories[categoryPath]',            
            'imageUrls'                    => 'Image URLs[imageUrls]',
            //'checkout'                     => 'Checkout [checkout]', 
            //'fulfillmentType'              => 'Fulfillment Type [fulfillmentType]',
            //'checkoutLimitPerPeriod'       => 'Checkout Limit [checkoutLimitPerPeriod]',
            'basePrice'                    => 'Base Price [basePrice]'
);

return apply_filters('wt_pf_idealo_product_post_columns',$post_columns);


