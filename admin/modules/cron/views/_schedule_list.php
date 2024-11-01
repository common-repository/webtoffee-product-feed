<?php
if (!defined('ABSPATH')) {
    exit;
}

if(isset($cron_list) && is_array($cron_list) && count($cron_list)>0)
{
	?>
<div class="cron_list_wrapper">
	<table class="wp-list-table widefat fixed striped cron_list_tb" style="margin-bottom:55px;">
	<thead>
		<tr>
			<th width="50"><?php esc_html_e("No.", 'webtoffee-product-feed'); ?></th>
			<th width="250"><?php esc_html_e("Feed name", 'webtoffee-product-feed'); ?></th>
			<th width="150"><?php esc_html_e("Channel", 'webtoffee-product-feed'); ?></th>			
			<th width="150">
				<?php esc_html_e("Status", 'webtoffee-product-feed'); ?>
			</th>
			<th><?php esc_html_e("Time", 'webtoffee-product-feed'); ?></th>			
			<th width="200"><?php esc_html_e("Actions", 'webtoffee-product-feed'); ?></th>
		</tr>
	</thead>
	<tbody>
	<?php
	$i=0;
	foreach($cron_list as $key =>$cron_item)
	{
                $feed_data = maybe_unserialize($cron_item['data']);
                $filename = isset( $feed_data['post_type_form_data']['wt_pf_export_catalog_name'] ) ? $feed_data['post_type_form_data']['wt_pf_export_catalog_name'] : '' ;
                if( ''=== $filename ){
                    $filename = isset( $feed_data['post_type_form_data']['item_filename'] ) ? $feed_data['post_type_form_data']['item_filename'] : '' ;
                }            
                $filetype = isset( $feed_data['advanced_form_data']['wt_pf_file_as'] ) ? $feed_data['advanced_form_data']['wt_pf_file_as'] : '';
                
		$i++;
                
                $item_type = ucfirst($cron_item['item_type']);
		?>
		<tr>
                    <td><?php echo absint( $i );?></td>
			<td><?php echo esc_html($filename.'.'.$filetype); ?></td>
			<td><?php echo esc_html($item_type); ?></td>		
			<td>
				<span class="wt_productfeed_badge" style="padding:5px;color:white;<?php echo (isset(self::$status_color_arr[$cron_item['status']]) ? 'background:'.self::$status_color_arr[$cron_item['status']] : ''); ?>">
					<?php
					echo (isset(self::$status_label_arr[$cron_item['status']]) ? self::$status_label_arr[$cron_item['status']] : __('Unknown'));
					?>
				</span>
				<?php
				/**
				* 	Show completed percentage if status is running
				*/
				if($cron_item['status']==self::$status_arr['running'] && $cron_item['history_id']>0)
				{
					$history_module_obj=Webtoffee_Product_Feed_Sync::load_modules('history');
					if(!is_null($history_module_obj))
					{
						$history_entry=$history_module_obj->get_history_entry_by_id($cron_item['history_id']);
						if($history_entry)
						{
							echo '<br />'.number_format((($history_entry['offset']/$history_entry['total'])*100), 2).'% '.__(' Done');
						}
					}
				}
				?>
			</td>
			<td>
				<?php
					if($cron_item['status']==self::$status_arr['finished'] || $cron_item['status']==self::$status_arr['disabled'])
					{
						if($cron_item['last_run']>0)
						{
							echo __('Last run: ').date_i18n('Y-m-d h:i:s A', $cron_item['last_run']).'<br />';
						}

						/**
						*	Finished, so waiting for next run
						*/
						if($cron_item['status']==self::$status_arr['finished'] && $cron_item['start_time']>0 && $cron_item['start_time']!=$cron_item['last_run'])
						{
							echo __('Next run: ').date_i18n('Y-m-d h:i:s A', $cron_item['start_time']).'<br />';
						}
					}

					if($cron_item['status']==self::$status_arr['running'] || $cron_item['status']==self::$status_arr['uploading'] || $cron_item['status']==self::$status_arr['downloading'])
					{
						if($cron_item['last_run']>0 && $cron_item['start_time']!=$cron_item['last_run'])
						{
							echo __('Last run: ').date_i18n('Y-m-d h:i:s A', $cron_item['last_run']).'<br />';
						}else
						{
							echo __('Started at: ').date_i18n('Y-m-d h:i:s A', $cron_item['start_time']).'<br />';
						}
					}

					if($cron_item['status']==self::$status_arr['not_started'] && $cron_item['start_time']>0)
					{
						echo __('Will start at: ').date_i18n('Y-m-d h:i:s A', $cron_item['start_time']).'<br />';
					}
				?>
			</td>			
			<td>
				<?php
				$page_id=(isset($_GET['page']) ? sanitize_text_field($_GET['page']) : '');

				/* status change section */
				$action_label=__('Disable');
				$action='disable';
				if($cron_item['status'] == self::$status_arr['disabled'])
				{
					$action='enable';
					$action_label=__('Enable');
				}
				$action_url=wp_nonce_url(admin_url('admin.php?page='.$page_id.'&wt_productfeed_change_schedule_status='.$action.'&wt_productfeed_cron_id='.$cron_item['id']), WEBTOFFEE_PRODUCT_FEED_ID);
				
				/* delete section */
				$delete_url=wp_nonce_url(admin_url('admin.php?page='.$page_id.'&wt_productfeed_delete_schedule=1&wt_productfeed_cron_id='.$cron_item['id']), WEBTOFFEE_PRODUCT_FEED_ID);				
                                
				?>
                                <a href="<?php echo esc_url( $action_url );?>"><?php echo esc_html_e( $action_label );?></a> | <a class="wt_productfeed_delete_cron" data-href="<?php echo esc_url( $delete_url );?>"><?php esc_html_e('Delete'); ?></a>
				<?php
				if($cron_item['schedule_type']=='server_cron')
				{
					$cron_url=$this->generate_cron_url($cron_item['id'], $cron_item['action_type'], $cron_item['item_type']);
				?>
					| <a class="wt_productfeed_cron_url" data-href="<?php echo esc_url( $cron_url );?>" title="<?php esc_html_e('Generate new cron URL.');?>"><?php esc_html_e('Cron URL');?></a>
				<?php	
				}
				?>
			</td>
		</tr>
		<?php	
	}
	?>
	</tbody>
	</table>
</div>

	<?php
}else
{
	?>
	<h4 style="margin-bottom:55px; text-align:center; background:#fff; padding:15px 0px;"><?php esc_html_e("No scheduled actions found."); ?></h4>
	<?php
}
?>