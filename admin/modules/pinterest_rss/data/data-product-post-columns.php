<?php

if (!defined('WPINC')) {
    exit;
}

$post_columns = array(
    'title' => 'Product Title[title]',
    'description' => 'Product Description[description]',
    'link' => 'Product URL[link]',
    'image_link' => 'Product Image[image]',
    //'pubDate' => 'PubDate',
    //'guid' => 'guid',
    //'identifier_exists' => 'identifier_exists'
);

return apply_filters('wt_pf_pinterest_rss_product_post_columns', $post_columns);

