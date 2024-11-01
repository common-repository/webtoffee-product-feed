<?php

if (!defined('WPINC')) {
    exit;
}


$post_columns = array(
                
    'id' => 'ITEM_ID',
    'title' => 'PRODUCTNAME',
    'name' => 'PRODUCT',
    'description' => 'DESCRIPTION',
    'link' => 'URL',
    'image_link' => 'IMGURL',
    'image_link_alternate' => 'IMGURL_ALTERNATIVE',
    //'video_url' => 'VIDEO_URL',
    'price_with_tax' => 'PRICE_VAT',
    'sku_id' => 'PRODUCTNO',
    'ean' => 'EAN',
    'brand' => 'MANUFACTURER',
    'category' => 'CATEGORYTEXT',
    'item_group_id' => 'ITEMGROUP_ID',
    //'heureka_cpc' => 'HEUREKA_CPC' // price per click is CZK 1,000. If you don't want to bid, don't include the tag at all.
);

return apply_filters('wt_pf_heureka_product_post_columns',$post_columns);


