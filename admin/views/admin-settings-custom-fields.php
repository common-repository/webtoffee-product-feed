<?php
if (!defined('WPINC')) {
    die;
}
?>
<style>
    .wt_card_margin {
        margin-bottom: 0.0rem;
        width : 31%;
        height : 300px;
        float: left;
        margin: 10px 150px 20px 15px;
    }
    .card {
        margin: 10px 10px 20px 10px;
        padding-left:px;
        border: 0;
        box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
        -webkit-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
        -moz-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
        -ms-box-shadow: 0px 0px 10px 0px rgba(82, 63, 105, 0.1);
    }
    .card {
        height: 360px;
        position: relative;
        display: flex;
        flex-direction: column;
        min-width: 0;
        word-wrap: break-word;
        background-color: #ffffff;
        background-clip: border-box;
        border: 1px solid #e6e4e9;
        border-radius: 8px;
    }
    .wt_heading_1{
        text-align:center;
        font-style: normal;
        font-weight: bold;
        font-size: 82px;
        display: block !important;
    }
    .wt_heading_2{
        text-align:center;
        font-style: normal;
        font-weight: normal;
        font-size: 17px;
    }
    .wt_widget{
        padding-left:-100px;
    }
    .wt_widget .wt_widget_title_wrapper {
        display: flex;
    }
    .wt_widget .wt_buttons {
        display: flex;
    }
    .wt_widget_column_1 img {
        width: 60px;
        height: 60px;
    }
    .wt_widget_column_1{
        padding-top:18px;
    }
    .wt_widget_title_wrapper .wt_widget_column_2{
        align:top;
    }
    .wt_widget_column_2{
        font-size: 15px;
        text-align: top;
        padding-left:10px;
        width:100%;
        height:100px;
    }
    .wt_widget_column_3{
        ;
        text-align:left;
        vertical-align: text-top;
        position: relative;
        height:170px;
    }
    .wt_installed_button{
        padding-left:10px;
    }
    .wt_free_button{
        padding-left:10px;
    }
    .wt_free_btn_a{
    }
    .wt_get_premium_btn {
        text-align:center;
        padding: 6px 1px 0px 1px;
        height:25px;
        width:100%;
        background: linear-gradient(90.67deg, #2608DF -34.86%, #3284FF 115.74%);
        box-shadow: 0px 4px 13px rgb(46 80 242 / 39%);
        border-radius: 5px;
        display: inline-block;
        font-style: normal;
        font-size: 12px;
        line-height: 18px;
        color: #FFFFFF;
        text-decoration: none;
    }
    .wt_get_premium_btn:hover {
        box-shadow: 0px 3px 13px rgb(46 80 242 / 50%);
        text-decoration: none;
        transform: translateY(2px);
        transition: all .2s ease;
        color: #FFFFFF;
    }
    .wt_installed_btn{
        height:30px;
        width:109px;
        border-style: solid;
        border-color: #2A2EEA;
        border-radius: 5px;
        color: #2A2EEA;
    }
    .wt_free_btn{
        height:30px;
        width:109px;
        border-style: solid;
        border-color: #2A2EEA;
        border-radius: 5px;
        color: #2A2EEA;
        cursor: pointer;
    }
</style>
<div class="wt-pfd-tab-content" data-id="<?php echo esc_attr($target_id); ?>">
    <h3><span><?php esc_html_e(' Product additional fields for feed' ); ?> </span></h3>
    <form method="post" action="<?php echo esc_url($_SERVER["REQUEST_URI"]); ?>" id="wt_pf_settings_custom_fields_form" class="wt_pf_settings_custom_fields_form">			
        <?php
        // Set nonce:
        if (function_exists('wp_nonce_field')) {
            wp_nonce_field(WEBTOFFEE_PRODUCT_FEED_ID);
        }

        $product_custom_fields = array(
            'discard' => __('Exclude From Feed'),
            'unit_pricing_measure' => __('Unit Price Measure'),
            'brand' => __('Brand'),
            'unit_pricing_base_measure' => __('Unit Pricing Base Measure'),
            'gtin' => __('GTIN'),
            'energy_efficiency_class' => __('Energy Efficiency Class'),            
            'mpn' => __('MPN'),
            'min_energy_efficiency_class' => __('Min Energy Efficiency Class'),            
            'han' => __('HAN'),
            'max_energy_efficiency_class' => __('Max Energy Efficiency Class'),            
            'ean' => __('EAN'),
            'glpi_pickup_method' => __('Google Local Inventory Pickup Method'),            
            'condition' => __('Condition'),
            'glpi_pickup_sla' => __('Google Local Inventory Pickup SLA'),            
            'agegroup' => __('Age group'),
            '_wt_google_google_product_category' => __('Google Product category'),            
            'gender' => __('Gender'),
            '_wt_facebook_fb_product_category' => __('Facebook Product category'),            
            'size' => __('Size'),
            'custom_label_0' => __('Custom Label 0'),
            'color' => __('Color'),
            'custom_label_1' => __('Custom Label 1'),            
            'material' => __('Material'),
            'custom_label_2' => __('Custom Label 2'),            
            'pattern' => __('Pattern'),
            'custom_label_3' => __('Custom Label 3'),
            'availability_date' => __('Availability Date'),
            'custom_label_4' => __('Custom Label 4'),
        );

        $custom_filds_list = get_option('wt_pf_enabled_product_fields', array());
        $product_custom_fields_names = array_values($product_custom_fields);
        $product_custom_fields_keys = array_keys($product_custom_fields);
        ?>
        <table class="form-table wt-pfd-form-table-row">
            <tbody>
                <?php for ($i = 0; $i <= count($product_custom_fields); $i += 2) { ?>
                    <tr class="wt-pf-product-fields-row-tr">

                        <?php
                        for ($j = 0; $j < 2; $j++) {
                            if ( isset( $product_custom_fields_names[$i + $j] ) ) {
                                ?>
                                <td class="wt-pf-product-fields-row-td" width="30%" style="padding: 10px 75px 5px 10px;">
                                    <label> <?php echo esc_html( $product_custom_fields_names[$i + $j] ); ?> </label> 
                                    <div class="wt_form_checkbox_block" style="margin-top:2px; float: <?php echo (!is_rtl()) ? 'right' : 'left'; ?>;">
                                        <input class="wt_pf_checkbox_toggler wt_pf_toggler_blue" style="margin:0px !important;" type="checkbox" id="<?php echo esc_attr('_wt_feed_' . $product_custom_fields_keys[$i + $j]); ?>" name="<?php echo esc_attr('_wt_feed_' . $product_custom_fields_keys[$i + $j]); ?>" value="1" <?php echo ( ( isset($custom_filds_list[$product_custom_fields_keys[$i + $j]]) && ( 1 == absint($custom_filds_list[$product_custom_fields_keys[$i + $j]]) ) ) || empty( $custom_filds_list ) ) ? ' checked="checked"' : ''; ?>>
                                    </div>
                                </td>

                        <?php }
                    }; ?>             
                    </tr>
        <?php } ?>

            </tbody>
        </table>
        <?php
        $settings_button_title = __('Update settings');        
        ?>
        <div style="clear: both;"></div>
        <div class="wt-pfd-plugin-toolbar bottom">
            <div class="left">
            </div>
            <div class="right">
                <input type="submit" name="wt_iew_update_admin_settings_form" value="<?php esc_attr_e($settings_button_title); ?>" class="button button-primary" style="float:right;"/>
                <span class="spinner" style="margin-top:11px"></span>
            </div>
        </div>
    </form>

</div>
