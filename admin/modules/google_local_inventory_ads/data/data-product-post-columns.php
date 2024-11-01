<?php

if (!defined('WPINC')) {
	exit;
}


$post_columns = array(
	'store_code' => 'Store Code[store_code]',
	'id' => 'Product Id[id]',
        'title' => 'Product Title[title]',
        'description' => 'Product Description[description]', 
        'link' => 'Link[link]',
        'image_link' => 'Image link[image_link]',
        'brand' => 'Manufacturer[brand]',
        'gtin' => 'GTIN[gtin]',
	'quantity' => 'Quantity[quantity]',
	'price' => 'Regular Price[price]',
	'sale_price' => 'Sale Price[sale_price]',
	'sale_price_effective_date' => 'Sale Price Effective Date[sale_price_effective_date]',
	'availability' => 'Stock Status[availability]',
        'condition' => 'Condition[condition]',
	'pickup_method' => 'Pickup Method[pickup_method]',
	'pickup_sla' => 'Pickup SLA[pickup_sla]',
        'energy_efficiency_class' => 'Energy Efficiency Class[energy_efficiency_class]',
        'min_energy_efficiency_class' => 'Min Energy Efficiency Class[energy_efficiency_class]',
        'max_energy_efficiency_class' => 'Max Energy Efficiency Class[energy_efficiency_class]',
        'link_template' => 'Link template[link_template]',
        'mobile_link_template' => 'Mobile link template[mobile_link_template]',
    
    
);

return apply_filters('wt_pf_glpi_product_post_columns', $post_columns);

