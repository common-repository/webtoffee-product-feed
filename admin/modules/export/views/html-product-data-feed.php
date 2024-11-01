<?php
/**
 * Product Data - WebToffee Product Feed
 *
 */
defined('ABSPATH') || exit;
?>
<div id="wt_feed_data" class="panel woocommerce_options_panel">

    <?php
    
    global $post; 
    $custom_product_fields_setting = get_option('wt_pf_enabled_product_fields', array());
    $show_all = false;
    if(empty($custom_product_fields_setting)){
        $show_all = true;
    }
    ?>
    <?php if( $show_all ||  1 == $custom_product_fields_setting['discard'] ): ?>
    	<div class="options_group wt_fbfeed_discard">
		<?php                

                $discard_val = get_post_meta($post->ID, '_wt_feed_discard', true);                 
                
		woocommerce_wp_checkbox(
			array(
				'id'          => '_wt_feed_discard',
				'label'       => _x( 'Exclude from feed', 'product data setting title', 'webtoffee-product-feed' ),
				'description' => _x( 'Enable the checkbox to exclude the product from the feed.', 'product data setting desc', 'webtoffee-product-feed' ),
				'desc_tip'    => false,
                                'value'       => $discard_val,
			)
		);
		?>
	</div>
    <?php endif; ?>
	<div class="options_group">
		<?php
                if( $show_all ||  1 == $custom_product_fields_setting['brand'] ):
                    $brand_val = get_post_meta($post->ID, '_wt_feed_brand', true);              
                    woocommerce_wp_text_input(
                                    array(
                                            'id'          => '_wt_feed_brand',
                                            'label'       => _x('Brand', 'product data setting title', 'webtoffee-product-feed'),
                                            'description' => _x('The brand of the product.', 'product data setting desc', 'webtoffee-product-feed'),
                                            'desc_tip'    => true,
                                            'value'       => $brand_val,
                                    )
                    );
                endif;
                       
                if( $show_all ||  1 == $custom_product_fields_setting['gtin'] ):
                    $gtin_val = get_post_meta($post->ID, '_wt_feed_gtin', true);              
                    woocommerce_wp_text_input(
                                    array(
                                            'id' => '_wt_feed_gtin',
                                            'label' => __('GTIN', 'webtoffee-product-feed'),
                                            'desc_tip' => true,
                                            'description' => _x('The Global Trade Item Number (GTIN) is an identifier for trade items.', 'product data setting desc', 'webtoffee-product-feed'),
                                            'value' => $gtin_val,
                                    )
                    );
                endif;
                
                if( $show_all ||  1 == $custom_product_fields_setting['mpn'] ):
                    $mpn_val = get_post_meta($post->ID, '_wt_feed_mpn', true);                
                    woocommerce_wp_text_input(
                                    array(
                                            'id' => '_wt_feed_mpn',
                                            'label' => __('MPN', 'webtoffee-product-feed'),
                                            'desc_tip' => true,
                                            'description' => _x('A manufacturer part number (MPN) is a series of numbers and/or letters given to a part by its manufacturer.', 'product data setting desc', 'webtoffee-product-feed'),
                                            'value' => $mpn_val,
                                    )
                    );  
                endif;
                
                if( $show_all ||  1 == $custom_product_fields_setting['han'] ):
                    $han_val = get_post_meta($post->ID, '_wt_feed_han', true);                 
                    woocommerce_wp_text_input(
                                    array(
                                            'id' => '_wt_feed_han',
                                            'label' => __('HAN', 'webtoffee-product-feed'),
                                            'desc_tip' => true,
                                            'description' => _x('A Manufacturer Article Number (HAN) is a unique identification number assigned by manufacturers to identify their own products.', 'product data setting desc', 'webtoffee-product-feed'),
                                            'value' => $han_val,
                                    )
                    );
                endif;  
                
                if( $show_all ||  1 == $custom_product_fields_setting['ean'] ):
                    $ean_val = get_post_meta($post->ID, '_wt_feed_ean', true);                 
                    woocommerce_wp_text_input(
                                    array(
                                            'id' => '_wt_feed_ean',
                                            'label' => __('EAN', 'webtoffee-product-feed'),
                                            'desc_tip' => true,
                                            'description' => _x('A European Article Number (EAN) is a unique identification number assigned by manufacturers to identify their own products.', 'product data setting desc', 'webtoffee-product-feed'),
                                            'value' => $ean_val,
                                    )
                    );                
                endif; 
                
                if( $show_all ||  1 == $custom_product_fields_setting['condition'] ):
                    $product_conditions = Webtoffee_Product_Feed_Sync_Common_Helper::wt_feed_get_product_conditions();

                    $condition_val = get_post_meta($post->ID, '_wt_feed_condition', true);              

                    woocommerce_wp_select(
                            array(
                                    'id'          => '_wt_feed_condition',
                                    'label'       => _x( 'Condition', 'product data setting title', 'webtoffee-product-feed' ),
                                    'description' => _x( 'The product condition.', 'product data setting desc', 'webtoffee-product-feed' ),
                                    'desc_tip'    => true,
                                    'options'     => array( '' => _x( 'Default', 'setting option', 'webtoffee-product-feed' ) ) + $product_conditions,
                                    'value'       => $condition_val,
                            )
                    );  
                endif;    

                if( $show_all ||  1 == $custom_product_fields_setting['agegroup'] ):
                    $age_group = Webtoffee_Product_Feed_Sync_Common_Helper::get_age_group();

                    $agegroup_val = get_post_meta($post->ID, '_wt_feed_agegroup', true);             

                    woocommerce_wp_select(
                                    array(
                                            'id' => '_wt_feed_agegroup',
                                            'label' => _x('Age group', 'product data setting title', 'webtoffee-product-feed'),
                                            'description' => _x('The product age group.', 'product data setting desc', 'webtoffee-product-feed'),
                                            'desc_tip' => true,
                                            'options' => array('' => _x('Default', 'setting option', 'webtoffee-product-feed')) + $age_group,
                                            'value' => $agegroup_val,
                                    )
                    );
                endif;    

                if( $show_all ||  1 == $custom_product_fields_setting['gender'] ):
                    $product_gender = Webtoffee_Product_Feed_Sync_Common_Helper::get_geneder_list();

                    $gender_val = get_post_meta($post->ID, '_wt_feed_gender', true);               

                    woocommerce_wp_select(
                                    array(
                                            'id' => '_wt_feed_gender',
                                            'label' => _x('Gender', 'product data setting title', 'webtoffee-product-feed'),
                                            'description' => _x('The product gender.', 'product data setting desc', 'webtoffee-product-feed'),
                                            'desc_tip' => true,
                                            'options' => array('' => _x('Default', 'setting option', 'webtoffee-product-feed')) + $product_gender,
                                            'value' => $gender_val,
                                    )
                    );
                endif;    
                
                if( $show_all ||  1 == $custom_product_fields_setting['size'] ):
                    $size_val = get_post_meta($post->ID, '_wt_feed_size', true);               

                    woocommerce_wp_text_input(
                                    array(
                                            'id' => '_wt_feed_size',
                                            'label' => _x('Size', 'product data setting title', 'webtoffee-product-feed'),
                                            'description' => _x('The size of the item. Enter the size as a word, abbreviation or number, such as "small", "XL", "12" or "one size". Character limit: 200. eg:- Medium', 'product data setting desc', 'webtoffee-product-feed'),
                                            'desc_tip' => true,
                                            'value' => $size_val,
                                    )
                    );
                endif;    
                
                if( $show_all ||  1 == $custom_product_fields_setting['color'] ):
                    $color_val = get_post_meta($post->ID, '_wt_feed_color', true);              

                    woocommerce_wp_text_input(
                                    array(
                                            'id' => '_wt_feed_color',
                                            'label' => _x('Color', 'product data setting title', 'webtoffee-product-feed'),
                                            'description' => _x('The main colour of the item. Describe the colour in words, not a hex code. Character limit: 200. eg:- Royal blue', 'product data setting desc', 'webtoffee-product-feed'),
                                            'desc_tip' => true,
                                            'value' => $color_val,
                                    )
                    );
                endif;    
                
                if( $show_all ||  1 == $custom_product_fields_setting['material'] ):
                    $material_val = get_post_meta($post->ID, '_wt_feed_material', true); 

                    woocommerce_wp_text_input(
                            array(
                                    'id'          => '_wt_feed_material',
                                    'label'       => _x( 'Material', 'product data setting title', 'webtoffee-product-feed' ),
                                    'description' => _x( 'The material the item is made from, such as cotton, polyester, denim or leather. Character limit: 200. eg:- leather', 'product data setting desc', 'webtoffee-product-feed' ),
                                    'desc_tip'    => true,
                                    'value' => $material_val,
                            )
                    );
                endif;    
                
                if( $show_all ||  1 == $custom_product_fields_setting['pattern'] ):
                    $pattern_val = get_post_meta($post->ID, '_wt_feed_pattern', true);             

                    woocommerce_wp_text_input(
                            array(
                                    'id'          => '_wt_feed_pattern',
                                    'label'       => _x( 'Pattern', 'product data setting title', 'webtoffee-product-feed' ),
                                    'description' => _x( 'The pattern or graphic print on the item. Character limit: 100. eg:- striped', 'product data setting desc', 'webtoffee-product-feed' ),
                                    'desc_tip'    => true,
                                    'value' => $pattern_val,
                            )
                    ); 
                endif;    
                
                
                
                if( $show_all ||  1 == $custom_product_fields_setting['unit_pricing_measure'] ):
                    $unit_pricing_measure_val = get_post_meta($post->ID, '_wt_feed_unit_pricing_measure', true);

                    woocommerce_wp_text_input(
                                    array(
                                            'id' => '_wt_feed_unit_pricing_measure',
                                            'label' => _x('Unit pricing measure', 'product data setting title', 'webtoffee-product-feed'),
                                            'description' => _x('Use the unit pricing measure [unit_pricing_measure] attribute to define the measure and dimension of your product. This value allows users to understand the exact cost per unit for your product.', 'product data setting desc', 'webtoffee-product-feed'),
                                            'desc_tip' => true,
                                            'value' => $unit_pricing_measure_val,
                                    )
                    );
                endif;    
                
                if( $show_all ||  1 == $custom_product_fields_setting['unit_pricing_base_measure'] ):
                    $unit_pricing_base_measure_val = get_post_meta($post->ID, '_wt_feed_unit_pricing_base_measure', true);

                    woocommerce_wp_text_input(
                                    array(
                                            'id' => '_wt_feed_unit_pricing_base_measure',
                                            'label' => _x('Unit pricing base measure', 'product data setting title', 'webtoffee-product-feed'),
                                            'description' => _x('The unit pricing base measure [unit_pricing_base_measure] attribute lets you include the denominator for your unit price. For example, you might be selling "150ml" of perfume, but customers are interested in seeing the price per "100ml".', 'product data setting desc', 'webtoffee-product-feed'),
                                            'desc_tip' => true,
                                            'value' => $unit_pricing_base_measure_val,
                                    )
                    );
                endif;    

                
                if( $show_all ||  1 == $custom_product_fields_setting['energy_efficiency_class'] ):
                    $energy_efficiency_class_val = get_post_meta($post->ID, '_wt_feed_energy_efficiency_class', true);

                    woocommerce_wp_text_input(
                            array(
                                    'id'          => '_wt_feed_energy_efficiency_class',
                                    'label'       => _x( 'Energy efficiency class', 'product data setting title', 'webtoffee-product-feed' ),
                                    'description' => _x( 'The [energy_efficiency_class] attributes to tell customers the energy label of your product.', 'product data setting desc', 'webtoffee-product-feed' ),
                                    'desc_tip'    => true,
                                    'value' => $energy_efficiency_class_val,
                            )
                    );
                endif;
                
                if( $show_all ||  1 == $custom_product_fields_setting['min_energy_efficiency_class'] ):
                    $min_energy_efficiency_class = get_post_meta($post->ID, '_wt_feed_min_energy_efficiency_class', true);

                    woocommerce_wp_text_input(
                            array(
                                    'id'          => '_wt_feed_min_energy_efficiency_class',
                                    'label'       => _x( 'Minimum Energy efficiency class', 'product data setting title', 'webtoffee-product-feed' ),
                                    'description' => _x( 'The [min_energy_efficiency_class] attributes to tell customers the energy label of your product.', 'product data setting desc', 'webtoffee-product-feed' ),
                                    'desc_tip'    => true,
                                    'value' => $min_energy_efficiency_class,
                            )
                    );
                endif;
                
                
                if( $show_all ||  1 == $custom_product_fields_setting['max_energy_efficiency_class'] ):
                    $max_energy_efficiency_class = get_post_meta($post->ID, '_wt_feed_max_energy_efficiency_class', true);

                    woocommerce_wp_text_input(
                            array(
                                    'id'          => '_wt_feed_max_energy_efficiency_class',
                                    'label'       => _x( 'Maximum Energy efficiency class', 'product data setting title', 'webtoffee-product-feed' ),
                                    'description' => _x( 'The [max_energy_efficiency_class] attributes to tell customers the energy label of your product.', 'product data setting desc', 'webtoffee-product-feed' ),
                                    'desc_tip'    => true,
                                    'value' => $max_energy_efficiency_class,
                            )
                    );
                endif;
                

                if( $show_all ||  1 == $custom_product_fields_setting['glpi_pickup_method'] ):
                    $glpi_pickup_methods = array(
                            'buy' => __( 'Buy', 'webtoffee-product-feed' ),
                            'reserve' => __( 'Reserve', 'webtoffee-product-feed' ),
                            'ship to store' => __( 'Ship to store', 'webtoffee-product-feed' ),
                            'not supported' => __( 'Not supported', 'webtoffee-product-feed' ),
                    );

                    $glpi_pickup_method_val = get_post_meta($post->ID, '_wt_feed_glpi_pickup_method', true);

                    woocommerce_wp_select(
                            array(
                                    'id'          => '_wt_feed_glpi_pickup_method',
                                    'label'       => _x( 'Pickup method', 'product data setting title', 'webtoffee-product-feed' ),
                                    'description' => _x( 'The product Pickup method, used in google local product inventory.', 'product data setting desc', 'webtoffee-product-feed' ),
                                    'desc_tip'    => true,
                                    'options'     => array( '' => _x( 'Default', 'setting option', 'webtoffee-product-feed' ) ) + $glpi_pickup_methods,
                                    'value' => $glpi_pickup_method_val,
                            )
                    );
                endif;
		
                if( $show_all ||  1 == $custom_product_fields_setting['glpi_pickup_sla'] ):
                    $glpi_pickup_sla = array(
                            'same day' => __( 'Same day', 'webtoffee-product-feed' ),
                            'next day' => __( 'Next day', 'webtoffee-product-feed' ),
                            '2-day' => __( '2 Day', 'webtoffee-product-feed' ),
                            '3-day' => __( '3 Day', 'webtoffee-product-feed' ),
                            '4-day' => __( '4 Day', 'webtoffee-product-feed' ),
                            '5-day' => __( '5 Day', 'webtoffee-product-feed' ),
                            '6-day' => __( '6 Day', 'webtoffee-product-feed' ),
                            'multi-week' => __( 'Multi week', 'webtoffee-product-feed' ),
                    );
                    $glpi_pickup_sla_val = get_post_meta($post->ID, '_wt_feed_glpi_pickup_sla', true);

                    woocommerce_wp_select(
                            array(
                                    'id'          => '_wt_feed_glpi_pickup_sla',
                                    'label'       => _x( 'Pickup SLA', 'product data setting title', 'webtoffee-product-feed' ),
                                    'description' => _x( 'The product Pickup SLA, used in google local product inventorr.', 'product data setting desc', 'webtoffee-product-feed' ),
                                    'desc_tip'    => true,
                                    'options'     => array( '' => _x( 'Default', 'setting option', 'webtoffee-product-feed' ) ) + $glpi_pickup_sla,
                                    'value' => $glpi_pickup_sla_val,
                            )
                    );  
                endif;
                
                if( $show_all ||  1 == $custom_product_fields_setting['custom_label_0'] ):
                    $custom_label_0 = get_post_meta($post->ID, '_wt_feed_custom_label_0', true);
               
                    woocommerce_wp_text_input(
                            array(
                                    'id'          => '_wt_feed_custom_label_0',
                                    'label'       => _x( 'Custom label 0', 'product data setting title', 'webtoffee-product-feed' ),
                                    'description' => _x( 'Additional custom label for the item. Character limit: 100. eg:- Summer Sale', 'product data setting desc', 'webtoffee-product-feed' ),
                                    'desc_tip'    => true,
                                    'value' => $custom_label_0,
                            )
                    );
                endif;
                
                if( $show_all ||  1 == $custom_product_fields_setting['custom_label_1'] ):
                    $custom_label_1 = get_post_meta($post->ID, '_wt_feed_custom_label_1', true);

                    woocommerce_wp_text_input(
                            array(
                                    'id'          => '_wt_feed_custom_label_1',
                                    'label'       => _x( 'Custom label 1', 'product data setting title', 'webtoffee-product-feed' ),
                                    'description' => _x( 'Additional custom label for the item. Character limit: 100. eg:- Summer Sale', 'product data setting desc', 'webtoffee-product-feed' ),
                                    'desc_tip'    => true,
                                    'value' => $custom_label_1,
                            )
                    );
                endif;    
                
                if( $show_all ||  1 == $custom_product_fields_setting['custom_label_2'] ):
                    $custom_label_2 = get_post_meta($post->ID, '_wt_feed_custom_label_2', true);

                    woocommerce_wp_text_input(
                            array(
                                    'id'          => '_wt_feed_custom_label_2',
                                    'label'       => _x( 'Custom label 2', 'product data setting title', 'webtoffee-product-feed' ),
                                    'description' => _x( 'Additional custom label for the item. Character limit: 100. eg:- Summer Sale', 'product data setting desc', 'webtoffee-product-feed' ),
                                    'desc_tip'    => true,
                                    'value' => $custom_label_2,
                            )
                    );
                endif;    
                
                if( $show_all ||  1 == $custom_product_fields_setting['custom_label_3'] ):
                    $custom_label_3 = get_post_meta($post->ID, '_wt_feed_custom_label_3', true);

                    woocommerce_wp_text_input(
                            array(
                                    'id'          => '_wt_feed_custom_label_3',
                                    'label'       => _x( 'Custom label 3', 'product data setting title', 'webtoffee-product-feed' ),
                                    'description' => _x( 'Additional custom label for the item. Character limit: 100. eg:- Summer Sale', 'product data setting desc', 'webtoffee-product-feed' ),
                                    'desc_tip'    => true,
                                    'value' => $custom_label_3,
                            )
                    );
                endif;
                
                if( $show_all ||  1 == $custom_product_fields_setting['custom_label_4'] ):
                    $custom_label_4 = get_post_meta($post->ID, '_wt_feed_custom_label_4', true);

                    woocommerce_wp_text_input(
                            array(
                                    'id'          => '_wt_feed_custom_label_4',
                                    'label'       => _x( 'Custom label 4', 'product data setting title', 'webtoffee-product-feed' ),
                                    'description' => _x( 'Additional custom label for the item. Character limit: 100. eg:- Summer Sale', 'product data setting desc', 'webtoffee-product-feed' ),
                                    'desc_tip'    => true,
                                    'value' => $custom_label_4,
                            )
                    );
                endif;    

                if( $show_all ||  1 == $custom_product_fields_setting['availability_date'] ):
                    $availability_date = get_post_meta($post->ID, '_wt_feed_availability_date', true);
                    woocommerce_wp_text_input(
                            array(
                                    'id'          => '_wt_feed_availability_date',
                                    'label'       => _x( 'Availability date', 'product data setting title', 'webtoffee-product-feed' ),
                                    'description' => _x( 'Availability date', 'product data setting desc', 'webtoffee-product-feed' ),
                                    'desc_tip'    => true,
                                    'placeholder' => esc_html( "YYYY-MM-DD" ),
                                    'value' => $availability_date,
                                    'class' => 'date-picker'
                            )
                    ); 
                endif;    

                if( $show_all ||  1 == $custom_product_fields_setting['_wt_google_google_product_category'] ):
                    if(class_exists('Webtoffee_Product_Feed_Sync_Google')){
                        $google_categories = Webtoffee_Product_Feed_Sync_Google::get_category_array();
                        woocommerce_wp_select(
                                array(
                                        'id'          => '_wt_google_google_product_category',
                                        'label'       => _x( 'Google Product category', 'product data setting title', 'webtoffee-product-feed' ),
                                        'description' => sprintf( _x('A product category value provided by %1$s Google %2$s feed.', 'product data setting desc', 'webtoffee-product-feed'), '<a style="color:#93BBF9;" href="https://www.google.com/basepages/producttype/taxonomy.en-US.txt" target="_blank">', '</a>' ),
                                        'desc_tip'    => true,
                                        'options'     => array( '' => _x( 'Default', 'setting option', 'webtoffee-product-feed' ) ) + $google_categories,
                                        'class'       => 'wt-feed-google-product-cat  wc-enhanced-select',
                                )
                        );   
                    }
                endif;    
                
                if( $show_all ||  1 == $custom_product_fields_setting['_wt_facebook_fb_product_category'] ):
                    if(class_exists('Webtoffee_Product_Feed_Sync_Facebook')){		
                        $fb_categories = Webtoffee_Product_Feed_Sync_Facebook::get_category_array();
                        woocommerce_wp_select(
                                array(
                                        'id'          => '_wt_facebook_fb_product_category',
                                        'label'       => _x( 'Facebook Product category', 'product data setting title', 'webtoffee-product-feed' ),
                                        'description' => sprintf( _x('A product category value provided by %1$s Facebook %2$s feed.', 'product data setting desc', 'webtoffee-product-feed'), '<a style="color:#93BBF9;" href="https://www.facebook.com/products/categories/en_US.txt" target="_blank">', '</a>' ),
                                        'desc_tip'    => true,
                                        'options'     => array( '' => _x( 'Default', 'setting option', 'webtoffee-product-feed' ) ) + $fb_categories,
                                        'class'       => 'wt-feed-facebook-product-cat  wc-enhanced-select',
                                )
                        );
                    }
                endif;    
                
		?>
	</div>
</div>