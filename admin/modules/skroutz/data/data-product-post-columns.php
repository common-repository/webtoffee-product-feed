<?php

if (!defined('WPINC')) {
    exit;
}

$post_columns = array(
                
            'id'                           => 'Product Id[id]',
            'title'                        => 'Product Title[title]',
            'description'                  => 'Product Description[description]',
            'link'                         => 'Product URL[link]',
            'mobile_link'                  => 'Product URL[mobile_link]',
            'category'                     => 'Product Categories[category] ',
            'image'                        => 'Main Image[image]',
            'additionalimage'              => 'Additional Images [additionalimage]',
            'condition'                    => 'Condition[condition]',
);

return apply_filters('wt_pf_skroutz_product_post_columns',$post_columns);