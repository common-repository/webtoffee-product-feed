<?php

if (!defined('WPINC')) {
    exit;
}

if (!class_exists('Webtoffee_Product_Feed_Google_ProductReviewsExport')) {

    class Webtoffee_Product_Feed_Google_ProductReviewsExport {

        public $parent_module = null;
        public $product;
        public $current_product_id;
        public $form_data;
        public $comment;

        public function __construct($parent_object) {

            $this->parent_module = $parent_object;
        }

        public function prepare_header() {

            $export_columns = $this->parent_module->get_selected_column_names();

            return apply_filters('wt_pf_alter_product_feed_csv_columns', $export_columns);
        }

        /**
         * Prepare data that will be exported.
         */
        public function prepare_data_to_export($form_data, $batch_offset, $step) {

            $this->form_data = $form_data;

            $exc_stock_status = !empty($form_data['post_type_form_data']['item_outofstock']) ? $form_data['post_type_form_data']['item_outofstock'] : '';
            
            if('' === $exc_stock_status){
                $exc_stock_status = !empty($form_data['post_type_form_data']['wt_pf_exclude_outofstock']) ? $form_data['post_type_form_data']['wt_pf_exclude_outofstock'] : '';
            }
            
            $item_parentonly = !empty($form_data['post_type_form_data']['item_parentonly']) ? $form_data['post_type_form_data']['item_parentonly'] : '';

            if( '' === $item_parentonly ){
                $item_parentonly = !empty($form_data['post_type_form_data']['wt_pf_include_parent_only']) ? $form_data['post_type_form_data']['wt_pf_include_parent_only'] : '';
            }
            
            $prod_exc_categories = !empty($form_data['post_type_form_data']['item_exc_cat']) ? $form_data['post_type_form_data']['item_exc_cat'] : array();            
            $prod_inc_categories = !empty($form_data['post_type_form_data']['item_inc_cat']) ? $form_data['post_type_form_data']['item_inc_cat'] : array();

            $cat_filter_type = !empty($form_data['post_type_form_data']['cat_filter_type']) ? $form_data['post_type_form_data']['cat_filter_type'] : '';
            if( '' === $cat_filter_type ){
                $cat_filter_type = !empty($form_data['post_type_form_data']['wt_pf_export_cat_filter_type']) ? $form_data['post_type_form_data']['wt_pf_export_cat_filter_type'] : 'include_cat';
            }
            
            $inc_exc_category = !empty($form_data['post_type_form_data']['inc_exc_cat']) ? $form_data['post_type_form_data']['inc_exc_cat'] : array();
            if( empty($inc_exc_category) ){
                $inc_exc_category = !empty($form_data['post_type_form_data']['wt_pf_inc_exc_category']) ? $form_data['post_type_form_data']['wt_pf_inc_exc_category'] : array();
            }
            
            
            if ('include_cat' === $cat_filter_type) {
                $prod_inc_categories = $inc_exc_category;
            } else {
                $prod_exc_categories = $inc_exc_category;
            }

            
            $brand_filter_type = !empty($form_data['post_type_form_data']['wt_pf_export_brand_filter_type']) ? $form_data['post_type_form_data']['wt_pf_export_brand_filter_type'] : 'include_brand';
            $inc_exc_brand = !empty($form_data['post_type_form_data']['wt_pf_inc_exc_brand']) ? $form_data['post_type_form_data']['wt_pf_inc_exc_brand'] : array();

            if ('include_brand' === $brand_filter_type) {
                $prod_inc_brands = $inc_exc_brand;
            } else {
                $prod_exc_brands = $inc_exc_brand;
            }            

            $prod_exc = !empty($form_data['post_type_form_data']['item_exc_prd']) ? $form_data['post_type_form_data']['item_exc_prd'] : array();

            if( empty($prod_exc) ){
                $prod_exc = !empty($form_data['post_type_form_data']['wt_pf_exclude_products']) ? $form_data['post_type_form_data']['wt_pf_exclude_products'] : array();
            }
            
            /* WPML
             * 
             */
            $item_post_lang = !empty($form_data['post_type_form_data']['item_post_lang']) ? $form_data['post_type_form_data']['item_post_lang'] : '';

            if( '' === $item_post_lang ){
                $item_post_lang = !empty($form_data['post_type_form_data']['wt_pf_export_post_language']) ? $form_data['post_type_form_data']['wt_pf_export_post_language'] : '';
            }
            
            $prod_tags = !empty($form_data['filter_form_data']['wt_pf_product_tags']) ? $form_data['filter_form_data']['wt_pf_product_tags'] : array();
            
            $prod_types = !empty($form_data['post_type_form_data']['item_product_type']) ? $form_data['post_type_form_data']['item_product_type'] : array();
            
            if( empty( $prod_types ) ){
                $prod_types = !empty($form_data['post_type_form_data']['wt_pf_product_types']) ? $form_data['post_type_form_data']['wt_pf_product_types'] : array();
            }
            
            
            $prod_status = !empty($form_data['filter_form_data']['wt_pf_product_status']) ? $form_data['filter_form_data']['wt_pf_product_status'] : array();

            $export_sortby = !empty($form_data['filter_form_data']['wt_pf_sort_columns']) ? $form_data['filter_form_data']['wt_pf_sort_columns'] : 'ID';
            $export_sort_order = !empty($form_data['filter_form_data']['wt_pf_order_by']) ? $form_data['filter_form_data']['wt_pf_order_by'] : 'ASC';

            $export_limit = !empty($form_data['filter_form_data']['wt_pf_limit']) ? intval($form_data['filter_form_data']['wt_pf_limit']) : 999999999; //user limit
            $current_offset = !empty($form_data['filter_form_data']['wt_pf_offset']) ? intval($form_data['filter_form_data']['wt_pf_offset']) : 0; //user offset

            $batch_count = !empty($form_data['advanced_form_data']['wt_pf_batch_count']) ? $form_data['advanced_form_data']['wt_pf_batch_count'] : Webtoffee_Product_Feed_Sync_Common_Helper::get_advanced_settings('default_export_batch');
            $batch_count = apply_filters('wt_product_feed_limit_per_request', $batch_count); //ajax batch limit

            $real_offset = ($current_offset + $batch_offset);

            if ($batch_count <= $export_limit) {
                if (($batch_offset + $batch_count) > $export_limit) { //last offset
                    $limit = $export_limit - $batch_offset;
                } else {
                    $limit = $batch_count;
                }
            } else {
                $limit = $export_limit;
            }

            $product_array = array();
            $total_products = 0;
            if ($batch_offset < $export_limit) {
                $args = array(
                    'post_type' => 'product',
                    'number' => $limit,
                    'offset' => $real_offset,
                    'return' => 'ids',
                    'paginate' => true,
                    'status' => 'any',
                );

                $args = apply_filters("wt_feed_product_review_args", $args);

                $review_query = new WP_Comment_Query;
                $reviews = $review_query->query($args);

                $total_reviews = 0;
                if ($batch_offset == 0) { //first batch
                    $review_query = new WP_Comment_Query;
                    $review_count = $review_query->query(
                            array(
                                'count' => true,
                                'post_type' => 'product',
                                'status' => 'any',
                            )
                    );

                    $total_reviews = $review_count;
                }


                foreach ($reviews as $key => $review) {

                    $product_array[] = $this->generate_row_data($review);
                }
            }

            $return_products = array(
                'total' => $total_reviews,
                'data' => $product_array,
            );
            if (0 == $batch_offset && 0 == $total_products) {
                $return_products['no_post'] = __('Nothing to export under the selected criteria. Please try adjusting the filters.', 'webtoffee-product-feed');
            }
            return $return_products;
        }

        protected function generate_row_data($comment) {

            $export_columns = $this->parent_module->get_selected_column_names();
            $this->review = $comment;
            $this->current_product_id = $comment->comment_post_ID;
            $row = array();

            $review_swap_key = array(
                'gtin',
                'mpn',
                'sku',
                'brand',
            );
            $review_combined_key = array(
                'reviewer_name',
                'reviewer_id'
            );
            foreach ($export_columns as $key => $value) {

                if (in_array($key, $review_swap_key)) {
                    $value = 'review_product_details';
                    $key = 'products';
                }

                if (in_array($key, $review_combined_key)) {
                    $value = 'reviewer_name_id';
                    $key = 'reviewer';
                }

                if (strpos($value, 'meta:') !== false) {
                    $mkey = str_replace('meta:', '', $value);
                    $row[$key] = get_comment_meta($comment->ID, $mkey, true);
                    // TODO
                    // wt_image_ function can be replaced with key exist check
                } elseif (strpos($value, 'wt_static_map_vl:') !== false) {
                    $static_feed_value = str_replace('wt_static_map_vl:', '', $value);
                    $row[$key] = $static_feed_value;
                } elseif (method_exists($this, $value)) {
                    $row[$key] = $this->$value($key, $value, $export_columns);
                } else {
                    $row[$key] = '';
                }
            }

            return apply_filters("wt_batch_product_export_row_data_{$this->parent_module->module_base}", $row, $comment);
        }

        /**
         * 
         * @param type $catalog_attr
         * @param type $review_attr
         * @param type $export_columns
         */
        public function review_id($catalog_attr, $review_attr, $export_columns) {

            return apply_filters('wt_feed_filter_review_id', $this->review->comment_ID, $this->review);
        }

        public function reviewer_name() {

            return apply_filters('wt_feed_filter_reviewer_name', $this->review->comment_author, $this->review);
        }

        public function reviewer_name_id($catalog_attr, $product_attr, $export_columns) {

            $reviewer_name_id = array();
            $reviewer_name_id['name'] = $this->review->comment_author;
            $reviewer_name_id['reviewer_id'] = $this->review->user_id;
            return apply_filters('wt_feed_filter_reviewer_name_id', $reviewer_name_id, $this->review);
        }

        public function reviewer_id($catalog_attr, $product_attr, $export_columns) {

            return apply_filters('wt_feed_filter_reviewer_id', $this->review->user_id, $this->review);
        }

        public function review_timestamp($catalog_attr, $product_attr, $export_columns) {

            $date_time = $this->review->comment_date_gmt;
                    
            $review_date = date("Y-m-d\TH:i:s\Z", strtotime( $date_time ) );

            return apply_filters('wt_feed_filter_review_timestamp', $review_date, $this->review);
        }

        public function review_title($catalog_attr, $product_attr, $export_columns) {

            $title = get_comment_meta($this->review->comment_ID, 'title', true);

            if ('' == $title) {
                $title = get_comment_meta($this->review->comment_ID, 'reviewx_title', true);
            }
            return apply_filters('wt_feed_filter_review_title', $title, $this->review);
        }

        public function content($catalog_attr, $product_attr, $export_columns) {

            return apply_filters('wt_feed_filter_review_content', $this->review->comment_content, $this->review);
        }

        public function review_url($catalog_attr, $product_attr, $export_columns) {

            $product = wc_get_product($this->current_product_id);
            $product_url = '';
            if ($product instanceof WC_Product) {
                $product_url = $product->get_permalink();
            }
            $review_url_details = array( '@attributes' => array( 'type' => 'group'), '@value' => $product_url ) ;
            return apply_filters('wt_feed_filter_review_url', $review_url_details, $this->review);
        }

        public function ratings($catalog_attr, $product_attr, $export_columns) {

            $rating = get_comment_meta($this->review->comment_ID, 'rating', true);

            $review_rating_details = array('overall' => array( '@attributes' => array( 'min' =>1, 'max' => 5), '@value' => $rating ) ) ;
            
            return apply_filters('wt_feed_filter_review_rating', $review_rating_details, $this->review);
        }

        public function is_spam($catalog_attr, $product_attr, $export_columns) {

            $is_spam = ( 'spam' === $this->review->comment_approved ) ? 'true' : 'false';
            return apply_filters('wt_feed_filter_review_is_spam', $is_spam, $this->review);
        }

        public function product_sku() {

            $product = wc_get_product($this->current_product_id);
            $sku = '';
            if ($product instanceof WC_Product) {
                $sku = $product->get_sku();
            }
            return apply_filters('wt_feed_filter_review_skus', $sku, $this->review);
        }

        public function product_gtin() {


            $custom_gtin = get_post_meta($this->current_product_id, '_wt_feed_gtin', true);
            if ( !$custom_gtin ) {
                $custom_gtin = get_post_meta($this->current_product_id, '_wt_google_gtin', true);
            }
            $gtin = ('' == $custom_gtin) ? '' : $custom_gtin;
            return apply_filters('wt_feed_filter_review_gtins', $gtin, $this->review);
        }

        public function product_mpn() {

            $custom_mpn = get_post_meta($this->current_product_id, '_wt_feed_mpn', true);
            if ( !$custom_mpn ) {
                $custom_mpn = get_post_meta($this->current_product_id, '_wt_google_mpn', true);
            }
            $mpn = ('' == $custom_mpn) ? '' : $custom_mpn;
            return apply_filters('wt_feed_filter_review_mpns', $mpn, $this->review);
        }

        public function product_brand() {


            $custom_brand = get_post_meta($this->current_product_id, '_wt_feed_brand', true);
            if ( !$custom_brand ) {
                $custom_brand = get_post_meta($this->current_product_id, '_wt_google_brand', true);
            }
            if ( !$custom_brand ) {

                $brand = get_the_term_list($this->current_product_id, 'product_brand', '', ', ');

                $has_brand = true;
                if (is_wp_error($brand) || false === $brand) {
                    $has_brand = false;
                }

                if (!$has_brand && is_plugin_active('perfect-woocommerce-brands/perfect-woocommerce-brands.php')) {
                    $brand = get_the_term_list($this->current_product_id, 'pwb-brand', '', ', ');
                }

                $string = is_wp_error($brand) || !$brand ? wp_strip_all_tags(self::get_store_name()) : self::clean_string($brand);
                $length = 100;
                if (extension_loaded('mbstring')) {

                    if (mb_strlen($string, 'UTF-8') <= $length) {
                        return apply_filters('wt_feed_filter_product_brands', $string, $this->current_product_id);
                    }

                    $length -= mb_strlen('...', 'UTF-8');

                    $brand_string = mb_substr($string, 0, $length, 'UTF-8') . '...';
                    return apply_filters('wt_feed_filter_product_brands', $brand_string, $this->current_product_id);
                } else {

                    $string = filter_var($string, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW);
                    $string = filter_var($string, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);

                    if (strlen($string) <= $length) {
                        return apply_filters('wt_feed_filter_product_brands', $string, $this->current_product_id);
                    }

                    $length -= strlen('...');

                    $brand_string = substr($string, 0, $length) . '...';
                    return apply_filters('wt_feed_filter_product_brands', $brand_string, $this->current_product_id);
                }
            } else {
                return apply_filters('wt_feed_filter_product_brands', $custom_brand, $this->current_product_id);
            }
        }

        public function review_product_details($catalog_attr, $product_attr, $export_columns) {
            $reviewe_product = array();

            $product = wc_get_product($this->current_product_id);

            if ($product instanceof WC_Product) {
                $reviewe_product['product'] = array(
                    'product_ids' => array(
                        'gtins' => array( 'gtin' => $this->product_gtin() ),
                        'mpns' => array( 'mpn' => $this->product_mpn() ),
                        'skus' => array('sku' => $this->product_sku() ),
                        'brands' => array( 'brand' => $this->product_brand() ),
                    )
                );
                $reviewe_product['product']['product_name'] = $product->get_name();
                $reviewe_product['product']['product_url'] = $product->get_permalink();
            }
            return apply_filters('wt_feed_filter_product_product_details', $reviewe_product, $this->current_product_id);            
        }

        public function product_name($catalog_attr, $product_attr, $export_columns) {

            $product = wc_get_product($this->current_product_id);
            $product_name = '';
            if ($product instanceof WC_Product) {
                $product_name = $product->get_name();
            }

            return apply_filters('wt_feed_filter_product_title', $product_name, $this->current_product_id);
        }

        public function product_url($catalog_attr, $product_attr, $export_columns) {

            $product = wc_get_product($this->current_product_id);
            $product_url = '';
            if ($product instanceof WC_Product) {
                $product_url = $product->get_permalink();
            }

            return apply_filters('wt_feed_filter_product_url', $product_url, $this->current_product_id);
        }
        public function link($catalog_attr, $product_attr, $export_columns) {

            $product = wc_get_product($this->current_product_id);
            $product_url = '';
            if ($product instanceof WC_Product) {
                $product_url = $product->get_permalink();
            }

            return apply_filters('wt_feed_filter_product_link', $product_url, $this->current_product_id);
        }        

        /**
         * Get product name.
         *
         * @return mixed|void
         */
        public function long_title($catalog_attr, $product_attr, $export_columns) {

            $title = $this->product->get_name();

            // Add all available variation attributes to variation title.
            if ($this->product->is_type('variation') && !empty($this->product->get_attributes())) {
                $title = $this->parent_product->get_name();
                $attributes = [];
                foreach ($this->product->get_attributes() as $slug => $value) {
                    $attribute = $this->product->get_attribute($slug);
                    if (!empty($attribute)) {
                        $attributes[$slug] = $attribute;
                    }
                }

                // set variation attributes with separator
                $separator = ',';

                $variation_attributes = implode($separator, $attributes);

                //get product title with variation attribute
                $get_with_var_attributes = apply_filters("wt_feed_get_product_title_with_variation_attribute", true, $this->product);

                if ($get_with_var_attributes) {
                    $title .= " - " . $variation_attributes;
                }
            }

            return apply_filters('wt_feed_filter_product_title', $title, $this->product);
        }

        public static function get_store_name() {

            $url = get_bloginfo('name');
            return ( $url) ? ( $url ) : 'My Store';
        }

        public function item_group_id($catalog_attr, $product_attr, $export_columns) {

            $id = ( $this->product->is_type('variation') ? $this->product->get_parent_id() : $this->product->get_id() );

            return apply_filters('wt_feed_filter_product_item_group_id', $id, $this->product);
        }

        public function availability($catalog_attr, $product_attr, $export_columns) {
            $status = $this->product->get_stock_status();
            if ('instock' === $status) {
                $status = 'in_stock';
            } elseif ('outofstock' === $status) {
                $status = 'out_of_stock';
            } elseif ('onbackorder' === $status) {
                $status = 'backorder';
            } elseif ('preorder' === $status) {
                $status = 'preorder';
            }


            return apply_filters('wt_feed_filter_product_availability', $status, $this->product);
        }

    }

}
