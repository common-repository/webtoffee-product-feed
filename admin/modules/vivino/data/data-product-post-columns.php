<?php

if (!defined('WPINC')) {
    exit;
}


$post_columns = array(
                
            'id'                           => 'Product Id[product-id]',
            'title'                        => 'Product Title[product-name]',            
            'link'                         => 'Product URL[link]',    
            'price'                        => 'Price', 
);

return apply_filters('wt_pf_vivino_product_post_columns',$post_columns);


