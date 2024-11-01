<?php
if (!defined('WPINC')) {
	die;
}
?>
<style type="text/css">
    table.fold-table-free-pro {
		width: 100%;
		border-collapse: collapse;
	}
	table.fold-table-free-pro .dashicons-yes-alt:before, table.fold-table-free-pro .dashicons-dismiss:before  {
		font-size: 30px;
	}
    table.fold-table-free-pro  th {
		border-bottom: 1px solid #ccc;
	}
    table.fold-table-free-pro  th,table.fold-table-free-pro  td {
		padding: 0.4em 1.4em;
		text-align: center;
	}
    table.fold-table-free-pro > tbody > tr.view td,table.fold-table-free-pro > tbody > tr.view th {
		cursor: pointer;
	}
    table.fold-table-free-pro > tbody > tr.view td.filter_actions{
		text-align: right;
		width: 50%;
	}
    table.fold-table-free-pro > tbody > tr.view:hover {
		background: #f4f4f4;
	}
    table.fold-table-free-pro > tbody > tr.view.open {
		border-color: #fff;
	}
    table.fold-table-free-pro > tbody > tr.fold.open {
		display: table-row;
	}
    table.fold-table-free-pro{
		border-collapse: collapse;
	}
    table.fold-table-free-pro td,table.fold-table-free-pro th {
		border-collapse: collapse;
		border: 1px solid #ccc;
	}
    table.fold-table-free-pro th:first-child, table.fold-table-free-pro td:first-child{
		background:#F8F9FA;
	}
    .pro_plugin_title span{
		background: #E8F3FF;
		color: #3171FB;
		border-radius: 50%;
		font-size: 18px;
		padding: 2px;
	}
    .pro_plugin_title b{
		color: #007FFF;
		font-size: 16px;
	}
    .free_pro_show_more,.free_pro_show_less{
		margin-right: 5px;
	}
</style>

<div class="wt-pfd-tab-content" data-id="<?php echo esc_attr($target_id); ?>">
	<div>
	<div class="wt-feed-freevspro" style="width:70%;float: left;">
		<table class="wp-list-table fold-table-free-pro" style="line-height:20px;">
			<thead>
			<th style="width:40%;"><?php esc_html_e('Features', 'webtoffee-product-feed'); ?></th>
			<th style="width:30%;"><?php esc_html_e('Free', 'webtoffee-product-feed'); ?></th>
			<th style="width:30%;"><?php esc_html_e('Premium', 'webtoffee-product-feed'); ?></th>
			</thead>
			<tbody>
			<tbody>
				<tr>
					<td><?php esc_html_e('Unlimited products & feeds', 'webtoffee-product-feed'); ?></td>
					<td><span class="dashicons dashicons-yes-alt" style="color:#18c01d;margin-top: 3px;margin-bottom: 13px;"></span></td>
					<td><span class="dashicons dashicons-yes-alt" style="color:#18c01d;margin-top: 3px;margin-bottom: 13px;"></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e('Attribute mapping', 'webtoffee-product-feed'); ?></td>
					<td><span class="dashicons dashicons-yes-alt" style="color:#18c01d;margin-top: 3px;margin-bottom: 13px;"></span></td>
					<td><span class="dashicons dashicons-yes-alt" style="color:#18c01d;margin-top: 3px;margin-bottom: 13px;"></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e('Custom attribute support', 'webtoffee-product-feed'); ?></td>
					<td><span class="dashicons dashicons-yes-alt" style="color:#18c01d;margin-top: 3px;margin-bottom: 13px;"></span></td>
					<td><span class="dashicons dashicons-yes-alt" style="color:#18c01d;margin-top: 3px;margin-bottom: 13px;"></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e('Custom fields support', 'webtoffee-product-feed'); ?></td>
					<td><span class="dashicons dashicons-yes-alt" style="color:#18c01d;margin-top: 3px;margin-bottom: 13px;"></span></td>
					<td><span class="dashicons dashicons-yes-alt" style="color:#18c01d;margin-top: 3px;margin-bottom: 13px;"></span></td>					
				</tr>
				<tr>
					<td><?php esc_html_e('Product meta & Taxonomies support', 'webtoffee-product-feed'); ?></td>
					<td><span class="dashicons dashicons-yes-alt" style="color:#18c01d;margin-top: 3px;margin-bottom: 13px;"></span></td>
					<td><span class="dashicons dashicons-yes-alt" style="color:#18c01d;margin-top: 3px;margin-bottom: 13px;"></span></td>
				</tr>				
				<tr>
					<td><?php esc_html_e('Supports any WooCommerce product types', 'webtoffee-product-feed'); ?></td>
					<td><span class="dashicons dashicons-yes-alt" style="color:#18c01d;margin-top: 3px;margin-bottom: 13px;"></span></td>
					<td><span class="dashicons dashicons-yes-alt" style="color:#18c01d;margin-top: 3px;margin-bottom: 13px;"></span></td>					
				</tr>
				<tr>
					<td><?php esc_html_e('Multiple file type support', 'webtoffee-product-feed'); ?></td>
					<td><span class="dashicons dashicons-yes-alt" style="color:#18c01d;margin-top: 3px;margin-bottom: 13px;"></span></td>
					<td><span class="dashicons dashicons-yes-alt" style="color:#18c01d;margin-top: 3px;margin-bottom: 13px;"></span></td>					
				</tr>
				<tr>
					<td><?php esc_html_e('Add static value', 'webtoffee-product-feed'); ?></td>
					<td><span class="dashicons dashicons-yes-alt" style="color:#18c01d;margin-top: 3px;margin-bottom: 13px;"></span></td>
					<td><span class="dashicons dashicons-yes-alt" style="color:#18c01d;margin-top: 3px;margin-bottom: 13px;"></span></td>					
				</tr>
				<tr>
					<td><?php esc_html_e('Additional fields to products (GTIN, MPN, Material, etc)', 'webtoffee-product-feed'); ?></td>
					<td><span class="dashicons dashicons-yes-alt" style="color:#18c01d;margin-top: 3px;margin-bottom: 13px;"></span></td>
					<td><span class="dashicons dashicons-yes-alt" style="color:#18c01d;margin-top: 3px;margin-bottom: 13px;"></span></td>					
				</tr>
				<tr>
					<td><?php esc_html_e('Compatibility with SEO plugins', 'webtoffee-product-feed'); ?></td>
					<td><span class="dashicons dashicons-yes-alt" style="color:#18c01d;margin-top: 3px;margin-bottom: 13px;"></span></td>
					<td><span class="dashicons dashicons-yes-alt" style="color:#18c01d;margin-top: 3px;margin-bottom: 13px;"></span></td>					
				</tr>
				<tr>
					<td><?php esc_html_e('Facebook/Instagram catalog sync', 'webtoffee-product-feed'); ?></td>
					<td><span class="dashicons dashicons-yes-alt" style="color:#18c01d;margin-top: 3px;margin-bottom: 13px;"></span></td>
					<td><span class="dashicons dashicons-yes-alt" style="color:#18c01d;margin-top: 3px;margin-bottom: 13px;"></span></td>
				</tr>
				<tr>
					<td><?php esc_html_e('Auto-feed update', 'webtoffee-product-feed'); ?></td>
					<td><span class="dashicons dashicons-yes-alt" style="color:#18c01d;margin-top: 3px;margin-bottom: 13px;"></span></td>
					<td><span class="dashicons dashicons-yes-alt" style="color:#18c01d;margin-top: 3px;margin-bottom: 13px;"></span></td>					
				</tr>
				<tr>
					<td><?php esc_html_e('Dynamic price & feed update', 'webtoffee-product-feed'); ?></td>
					<td><span class="dashicons dashicons-dismiss" style="color:#ea1515;margin-top: 3px;margin-bottom: 13px;"></span></td>
					<td><span class="dashicons dashicons-yes-alt" style="color:#18c01d;margin-top: 3px;margin-bottom: 13px;"></span></td>					
				</tr>
				<tr>
					<td><?php esc_html_e('Choose from lowest priced/default variation', 'webtoffee-product-feed'); ?></td>
					<td><span class="dashicons dashicons-dismiss" style="color:#ea1515;margin-top: 3px;margin-bottom: 13px;"></span></td>
					<td><span class="dashicons dashicons-yes-alt" style="color:#18c01d;margin-top: 3px;margin-bottom: 13px;"></span></td>					
				</tr>
                                <tr>
					<td><?php esc_html_e('Custom template/feed support', 'webtoffee-product-feed'); ?></td>
					<td><span class="dashicons dashicons-dismiss" style="color:#ea1515;margin-top: 3px;margin-bottom: 13px;"></span></td>
					<td><span class="dashicons dashicons-yes-alt" style="color:#18c01d;margin-top: 3px;margin-bottom: 13px;"></span></td>					
				</tr>
                                <tr>
					<td><?php esc_html_e('Advanced product filters', 'webtoffee-product-feed'); ?></td>
					<td><span class="dashicons dashicons-dismiss" style="color:#ea1515;margin-top: 3px;margin-bottom: 13px;"></span></td>
					<td><span class="dashicons dashicons-yes-alt" style="color:#18c01d;margin-top: 3px;margin-bottom: 13px;"></span></td>					
				</tr>
                                <tr>
					<td><?php esc_html_e('WPML multi-lingual support ', 'webtoffee-product-feed'); ?></td>
					<td><span class="dashicons dashicons-dismiss" style="color:#ea1515;margin-top: 3px;margin-bottom: 13px;"></span></td>
					<td><span class="dashicons dashicons-yes-alt" style="color:#18c01d;margin-top: 3px;margin-bottom: 13px;"></span></td>					
				</tr>
                                <tr>
					<td><?php esc_html_e('Compatibility with Multicurrency plugins ', 'webtoffee-product-feed'); ?></td>
					<td><span class="dashicons dashicons-dismiss" style="color:#ea1515;margin-top: 3px;margin-bottom: 13px;"></span></td>
					<td><span class="dashicons dashicons-yes-alt" style="color:#18c01d;margin-top: 3px;margin-bottom: 13px;"></span></td>					
				</tr>                                  
                                <tr>
					<td><?php esc_html_e('Compatibility with Dokan Multivendor', 'webtoffee-product-feed'); ?></td>
					<td><span class="dashicons dashicons-dismiss" style="color:#ea1515;margin-top: 3px;margin-bottom: 13px;"></span></td>
					<td><span class="dashicons dashicons-yes-alt" style="color:#18c01d;margin-top: 3px;margin-bottom: 13px;"></span></td>					
				</tr>  
                                <tr>
					<td><?php esc_html_e('Compatibility with popular brand plugins', 'webtoffee-product-feed'); ?></td>
					<td><span class="dashicons dashicons-dismiss" style="color:#ea1515;margin-top: 3px;margin-bottom: 13px;"></span></td>
					<td><span class="dashicons dashicons-yes-alt" style="color:#18c01d;margin-top: 3px;margin-bottom: 13px;"></span></td>					
				</tr> 
                                <tr>
					<td><?php esc_html_e('Server cron support for feed auto refresh', 'webtoffee-product-feed'); ?></td>
					<td><span class="dashicons dashicons-dismiss" style="color:#ea1515;margin-top: 3px;margin-bottom: 13px;"></span></td>
					<td><span class="dashicons dashicons-yes-alt" style="color:#18c01d;margin-top: 3px;margin-bottom: 13px;"></span></td>					
				</tr> 
                                <tr>
					<td><?php esc_html_e('Leguide Feed', 'webtoffee-product-feed'); ?></td>
					<td><span class="dashicons dashicons-dismiss" style="color:#ea1515;margin-top: 3px;margin-bottom: 13px;"></span></td>
					<td><span class="dashicons dashicons-yes-alt" style="color:#18c01d;margin-top: 3px;margin-bottom: 13px;"></span></td>					
				</tr> 
                                <tr>
					<td><?php esc_html_e('Google product review feed', 'webtoffee-product-feed'); ?></td>
					<td><span class="dashicons dashicons-dismiss" style="color:#ea1515;margin-top: 3px;margin-bottom: 13px;"></span></td>
					<td><span class="dashicons dashicons-yes-alt" style="color:#18c01d;margin-top: 3px;margin-bottom: 13px;"></span></td>					
				</tr>                                 
			</tbody>
		</table>
	</div>
	<div class="wt-profeed-header" style="float:right;width:25%;">
		<div class="wt-profeed-name">
			<div style="float: left"><img src="<?php echo esc_url( WT_PRODUCT_FEED_PLUGIN_URL ); ?>assets/images/gopro/product-feed.svg" alt="featured img" width="36" height="36"></div>
			<div style="float: right">
				<h4 class="wt-profeed-name"><?php esc_html_e('WebToffee WooCommerce Product Feed & Sync Manager(Pro)', 'webtoffee-product-feed'); ?></h4>				
			</div>
		</div>
		<div class="wt-profeed-mainfeatures">
			<div class="wt-profeed-btn-wrapper">
				<a href="<?php echo esc_url("https://www.webtoffee.com/product/woocommerce-product-feed/?utm_source=woocommerce_product_feed&utm_medium=free_plugin_freevspro_sidebar_button&utm_campaign=WooCommerce_Product_Feed&utm_content=" . WEBTOFFEE_PRODUCT_FEED_SYNC_VERSION); ?>" class="wt-profeed-blue-btn" target="_blank"><?php esc_html_e('GET THE PLUGIN', 'webtoffee-product-feed'); ?> <span class="dashicons dashicons-arrow-right-alt"></span></a>
			</div> 
			<ul class="wt-profeed-moneyback-wrap">
				<li class="money-back"><?php esc_html_e('30 Day Money Back Guarantee', 'webtoffee-product-feed'); ?></li>
				<li class="support"><?php esc_html_e('Fast and Superior Support', 'webtoffee-product-feed'); ?></li>
			</ul>               
		</div>
	</div>
	</div>
	<div class="clearfix"></div>
	<div class="wt-profeed-header-bottom" style="height:250px; padding: 10px">
		<div class="wt-profeed-bottom-left" style="float:left;width:50%;margin-top: 30px;">
			<div class="wt-profeed-name-bottom">
				<div style="float: left"><img src="<?php echo esc_url( WT_PRODUCT_FEED_PLUGIN_URL ); ?>assets/images/gopro/product-feed.svg" alt="featured img" width="36" height="36"></div>
				<div style="float: right">
					<h4 class="wt-profeed-name-bottom"><?php esc_html_e('WebToffee WooCommerce Product Feed & Sync Manager(Pro)', 'webtoffee-product-feed'); ?></h4>				
				</div>
			</div>
			<div class="wt-profeed-mainfeatures-bottom">
				<ul class="wt-profeed-moneyback-wrap-bottom">
					<li class="money-back"><?php esc_html_e('30 Day Money Back Guarantee', 'webtoffee-product-feed'); ?></li>
					<li class="support"><?php esc_html_e('Fast and Superior Support', 'webtoffee-product-feed'); ?></li>
				</ul>  
				<div class="wt-profeed-btn-wrapper-bottom">
					<a href="<?php echo esc_url("https://www.webtoffee.com/product/woocommerce-product-feed/?utm_source=woocommerce_product_feed&utm_medium=free_plugin_freevspro_bottom&utm_campaign=WooCommerce_Product_Feed&utm_content=" . WEBTOFFEE_PRODUCT_FEED_SYNC_VERSION); ?>" class="wt-profeed-blue-btn-bottom" target="_blank"><?php esc_html_e('GET THE PLUGIN', 'webtoffee-product-feed'); ?> <span class="dashicons dashicons-arrow-right-alt"></span></a>
				</div> 				
			</div>
		</div>
		<div class="wt-profeed-bottom-right" style="float:right;">
			<div class="wt-profeed-bottom wt-profeed-gopro-cta wt-profeed-features">
				<div class="wt-feed-list-bottom-left" style="float:left;">
                                    <h3><?php esc_html_e('Upgrade to premium for the advanced features listed below:', 'webtoffee-product-feed'); ?></h3>							
					<ul class="ticked-list wt-profeed-allfeat">						
						
						<li><?php esc_html_e('Dynamic price & feed update', 'webtoffee-product-feed'); ?></li>
						<li><?php esc_html_e('Advanced product filters', 'webtoffee-product-feed'); ?></li>            
						<li><?php esc_html_e('Choose from lowest priced/default/all variations', 'webtoffee-product-feed'); ?></li>
						<li><?php esc_html_e('WPML multilanguage support', 'webtoffee-product-feed'); ?></li>
                                                <li><?php esc_html_e('Compatibility with popular brand plugins', 'webtoffee-product-feed'); ?></li>
						<li><?php esc_html_e('Compatibility with Multicurrency plugins', 'webtoffee-product-feed'); ?></li>
						<li><?php esc_html_e('Compatibility with Dokan Multivendor plugin', 'webtoffee-product-feed'); ?></li>
                                                <li><?php esc_html_e('Server cron support for feed auto refresh', 'webtoffee-product-feed'); ?></li>
                                                <li><?php esc_html_e('Leguide, Google product review feeds', 'webtoffee-product-feed'); ?></li>
					</ul> 
				</div>				
			</div>
		</div>
	</div>		
</div>