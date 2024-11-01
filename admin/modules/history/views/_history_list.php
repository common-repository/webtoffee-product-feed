<?php
if ( ! defined( 'WPINC' ) ) {
    die;
}
?>
<div class="wt_pf_history_page">
	<h2 class="wt_pf_page_hd"><?php esc_html_e('Product Feed'); ?>
	<span class="wt-webtoffee-icon" style="float: <?php echo (!is_rtl()) ? 'right' : 'left'; ?>;">
		<span style="font-size:14px;"><?php esc_html_e('Developed by'); ?></span>
    <a target="_blank" href="https://www.webtoffee.com">
        <img src="<?php echo esc_url( WT_PRODUCT_FEED_PLUGIN_URL.'/assets/images/webtoffee-logo_small.png' );?>" style="max-width:100px;">
    </a>
</span>
	</h2>
		
	<hr>
	<h2 class="wp-heading-inline"><?php esc_html_e('Manage feeds');?></h2>
	<div class="wt_pf_bulk_action_box">
		<select class="wt_pf_bulk_action wt_pf_select">
			<option value=""><?php esc_html_e('Bulk Actions', 'webtoffee-product-feed'); ?></option>
			<option value="delete"><?php esc_html_e('Delete', 'webtoffee-product-feed'); ?></option>
		</select>
		<button class="button button-primary wt_pf_bulk_action_btn" type="button" style="float:left;"><?php esc_html_e('Apply', 'webtoffee-product-feed'); ?></button>
	</div>
	<?php
	echo self::gen_pagination_html($total_records, $this->max_records, $offset, 'admin.php', $pagination_url_params);
	?>
	<?php
	if(isset($history_list) && is_array($history_list) && count($history_list)>0)
	{

		?>
		<table class="wp-list-table widefat fixed striped history_list_tb">
		<thead>
			<tr>
                            	<th width="55">
					<input type="checkbox" name="" class="wt_pf_history_checkbox_main">
					<?php esc_html_e('No', 'webtoffee-product-feed'); ?>
				</th>
				<th><?php esc_html_e("Name"); ?></th>
				<th width="90px;"><?php esc_html_e("Catalog type"); ?></th>
				<th width="60px;"><?php esc_html_e("File type"); ?></th>				
				<th><?php esc_html_e("URL"); ?></th>				
				<th width="65px;"><?php esc_html_e("Products"); ?></th>				
				<th width="110px;"><?php esc_html_e("Refresh interval"); ?></th>					
				<th><?php esc_html_e("Last updated"); ?></th>
				<th><?php esc_html_e("Actions"); ?></th>
			</tr>
		</thead>
		<tbody>
		<?php
		$i=$offset;

		foreach($history_list as $key =>$history_item)
		{
			
			$i++;
			?>
			<tr>
                            	<th style="vertical-align:top;"><input type="checkbox" value="<?php echo absint( $history_item['id'] );?>" name="history_id[]" class="wt_pf_history_checkbox_sub">
					<?php echo absint($i);?></td>
				<?php $form_data=maybe_unserialize($history_item['data']); ?>
				<td><?php echo esc_html( pathinfo($history_item['file_name'], PATHINFO_FILENAME) ); ?></td>
                                <?php                                 
                                $catalog_type = isset( $form_data['post_type_form_data']['item_type'] ) ? $form_data['post_type_form_data']['item_type'] : '';
                                if('' === $catalog_type ){
                                    $catalog_type = isset( $form_data['post_type_form_data']['wt_pf_export_catalog_name'] ) ? esc_html( $form_data['post_type_form_data']['wt_pf_export_catalog_name'] ) : '';
                                }
                                ?>
				<td><?php echo isset( $catalog_type ) ? esc_html( $catalog_type ) : ''; ?></td>
				<td><?php echo esc_html( strtoupper(pathinfo($history_item['file_name'], PATHINFO_EXTENSION)) ); ?></td>
				<td>
					<?php echo esc_url( content_url().'/uploads/webtoffee_product_feed/'.($history_item['file_name']) ); ?><br/>
					<button data-uri = "<?php echo esc_url( content_url().'/uploads/webtoffee_product_feed/'.($history_item['file_name']) ); ?>" class="button button-primary wt_pf_copy"><?php esc_html_e( 'Copy URL' ) ; ?></button>
				</td>				
				<td><?php echo absint( $history_item['total'] ); ?></td>
				<td><?php echo isset( $form_data['post_type_form_data']['item_gen_interval'] ) ? esc_html( $form_data['post_type_form_data']['item_gen_interval'] ) : ''; ?></td>
				<td><?php echo esc_html( date_i18n('Y-m-d h:i:s A', $history_item['updated_at']) ); ?></td>
				<td>					
					<a class="wt_pf_delete_history wt_manage_feed_icons" data-href="<?php echo str_replace('_history_id_', $history_item['id'], $delete_url);?>"><img src="<?php echo esc_url( WT_PRODUCT_FEED_PLUGIN_URL.'/assets/images/wt_fi_trash.svg' );?>" alt="<?php esc_html_e('Delete'); ?>" title="<?php esc_html_e('Delete'); ?>"/></a>
					<?php
					$action_type=$history_item['template_type'];
					if($form_data && is_array($form_data))
					{
						$to_process=(isset($form_data['post_type_form_data']) && isset($form_data['post_type_form_data']['item_type']) ? $form_data['post_type_form_data']['item_type'] : '');
						if($to_process!="")
						{
							if(Webtoffee_Product_Feed_Sync_Admin::module_exists($action_type))
							{
								$action_module_id=Webtoffee_Product_Feed_Sync::get_module_id($action_type);
								$url=admin_url('admin.php?page='.$action_module_id.'&wt_pf_rerun='.$history_item['id']);
								?>
								   <a class="wt_manage_feed_icons" href="<?php echo esc_url( $url );?>" target="_blank"><img src="<?php echo esc_url( WT_PRODUCT_FEED_PLUGIN_URL.'/assets/images/wt_fi_edit.svg' );?>" alt="<?php esc_html_e('Edit'); ?>" title="<?php esc_html_e('Edit'); ?>"/></a>
								<?php
							}
						}
					}

                                        if($action_type=='export' && Webtoffee_Product_Feed_Sync_Admin::module_exists($action_type))
					{
                                            $export_download_url=wp_nonce_url(admin_url('admin.php?wt_pf_export_download=true&file='.$history_item['file_name']), WEBTOFFEE_PRODUCT_FEED_ID);
						?>
                                                          <a class="wt_manage_feed_icons wt_pf_export_download_btn" target="_blank" href="<?php echo esc_url( $export_download_url );?>"><img src="<?php echo esc_url( WT_PRODUCT_FEED_PLUGIN_URL.'/assets/images/wt_fi_download.svg' );?>" alt="<?php esc_html_e('Download'); ?>" title="<?php esc_html_e('Download'); ?>"/></a>
						<?php
					}                                        
					?>
                                        <?php if( isset($form_data['post_type_form_data']['item_gen_interval']) && 'manual' !== $form_data['post_type_form_data']['item_gen_interval'] ) { ?>
                                            <a class="wt_manage_feed_icons wt_pf_export_refresh_btn" href="javascript:void(0);" data-cron_id="<?php echo absint( $history_item['id'] ); ?>"><img src="<?php echo esc_url( WT_PRODUCT_FEED_PLUGIN_URL.'/assets/images/wt_fi_refresh.svg' );?>" alt="<?php esc_html_e('Refresh'); ?>" title="<?php esc_html_e('Refresh'); ?>"/></a>
                                        <?php } ?>
                                        <a class="wt_pf_export_duplicate_btn wt_manage_feed_icons" href="javascript:void(0);" data-cron_id="<?php echo esc_attr( $history_item['id'] ); ?>"><img src="<?php echo esc_url( WT_PRODUCT_FEED_PLUGIN_URL.'/assets/images/wt_fi_duplicate.svg' );?>" alt="<?php esc_html_e('Duplicate'); ?>" title="<?php esc_html_e('Duplicate'); ?>"/></a>    
				</td>
			</tr>
			<?php	
		}
		?>
		</tbody>
		</table>
		<?php
		echo self::gen_pagination_html($total_records, $this->max_records, $offset, 'admin.php', $pagination_url_params);
	}else
	{
		?>
		<h4 class="wt_pf_history_no_records"><?php esc_html_e("No records found."); ?></h4>
		<?php
	}
	?>
</div>