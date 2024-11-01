<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<style type="text/css">
.wt_productfeed_schedule_now{ width:600px; text-align:left; }
.wt_productfeed_schedule_now_box{ width:100%; padding:15px; box-sizing:border-box; }
.wt_productfeed_schedule_now_formrow{float:left; width:100%; margin-bottom:15px; padding-left:5px; box-sizing:border-box;}	
.wt_productfeed_schedule_now_interval_radio_block{float:left; width:100%; margin:0px; padding:0px; margin-top:2px; }		
.wt_productfeed_schedule_now_box label{ width:100%; float:left; text-align:left; font-weight:bold; }
.wt_productfeed_schedule_now_interval_radio_block label{width:auto; float:left; margin-right:10px; margin-bottom:5px; text-align:left; font-weight:normal; }	
.wt_productfeed_schedule_now_box select, .wt_productfeed_schedule_now_box input[type="text"]{ width:auto; text-align:left; }	
.wt_productfeed_schedule_now .wt_productfeed_popup_footer{ margin-top:10px; float:left; margin-bottom:20px; }
.wt_productfeed_schedule_type_desc{ margin-top:0px; padding-left:5px; margin-bottom:0px; }
.wt_productfeed_schedule_type_box_single{ float:left; margin-top:5px; margin-bottom:10px;}
.wt_productfeed_schedule_type_box_single label{ color:#666; }
.wt_productfeed_schedule_now_trigger_url, .wt_productfeed_schedule_day_block, .wt_productfeed_schedule_custom_interval_block, .wt_productfeed_schedule_starttime_block{ display:none; }
.wt_productfeed_schedule_now_interval_sub_block{ float:left; width:100%; margin-top:3px; }
.wt_productfeed_cron_current_time{float:right; width:auto;}
.wt_productfeed_cron_current_time span{ display:inline-block; width:85px; }
</style>
<div class="wt_productfeed_schedule_now wt_productfeed_popup">
	<div class="wt_productfeed_popup_hd">
		<span style="line-height:40px;" class="dashicons dashicons-clock"></span>
		<span class="wt_productfeed_popup_hd_label"><?php esc_html_e('Update Schedule');?></span>
		<div class="wt_productfeed_popup_close">X</div>
	</div>
	<div class="wt-pfd-tab-content wt_productfeed_cron_settings_page" style="display:block;">
	
		<div class="wt_productfeed_sub_tab_container">
		<div class="wt_productfeed_sub_tab_content" data-id="cron-time-details" style="display:block;">
	<div class="wt_productfeed_schedule_now_box">
		<div class="wt_productfeed_cron_current_time"><b><?php esc_html_e('Current server time:');?></b> <span>--:--:-- --</span><br/>
		
			<?php 
			$wt_time_zone = Webtoffee_Product_Feed_Sync_Common_Helper::get_advanced_settings('default_time_zone'); 
			?>
		
		</div>

		<label><?php esc_html_e('Schedule type');?></label>
		<div class="wt_productfeed_schedule_now_formrow">
                    <input type="hidden" name="requested_cron_edit_id" id="requested_cron_edit_id" value="<?php echo esc_attr( $requested_cron_edit_id ); ?>"/>
                    <input type="hidden" name="requested_cron_action_type" id="requested_cron_action_type" value="<?php echo esc_attr( $this->to_cron ); ?>"/>
			<div class="wt_productfeed_schedule_type_box_single" style="margin-bottom:0px;">
                            <label for="wt_productfeed_schedule_wordpress_cron"><input type="radio" name="wt_productfeed_schedule_type" id="wt_productfeed_schedule_wordpress_cron" value="wordpress_cron" <?php checked('wordpress_cron', $cron_data['schedule_type'], true); ?> > <?php esc_html_e('Wordpress Cron');?> </label>
				<p class="wt_productfeed_schedule_type_desc"><?php esc_html_e('This type of scheduler depends on the Wordpress for scheduling your job at the specified time. However this model is dependent on your website visitors. Upon a visit Wordpress cron will check to see if the time/date is later than the scheduled event/s, and if it is– it will fire those events.');?></p>
			</div>
			<div class="wt_productfeed_schedule_type_box_single">
				<label for="wt_productfeed_schedule_server_cron"><input type="radio" name="wt_productfeed_schedule_type" id="wt_productfeed_schedule_server_cron" value="server_cron" <?php checked('server_cron', $cron_data['schedule_type'], true); ?>> <?php esc_html_e('Server Cron');?> </label>
				<p class="wt_productfeed_schedule_type_desc">
					<?php esc_html_e('You can use this option if you have a separate system to trigger the scheduled events. This method will generate a unique URL which can be added to your system inorder to trigger the events. You may need to trigger the URL every minute depending on the volume of data to be processed.');?>					
				</p>
			</div>
		</div>

		<?php
		if($this->to_cron=='export')
		{
		?>
		<label><?php esc_html_e('File name');?></label>
		<div class="wt_productfeed_schedule_now_formrow">
			<input type="text" name="wt_productfeed_cron_file_name" value="<?php echo esc_attr( $cron_data['file_name'] ) ?>" /> <span class="wt_productfeed_cron_file_ext">.csv</span>
			<br />	
			<?php esc_html_e('Specify a filename for the exported file(the contents of this file will be overwritten for every export). If left blank the system generates a default name(a new filename is generated for every export).'); ?>	
		</div>
		<?php
		}
		?>

		<label><?php esc_html_e('Interval');?></label>
		<div class="wt_productfeed_schedule_now_formrow">			
			<div class="wt_productfeed_schedule_now_interval_radio_block">
				<label for="wt_productfeed_cron_interval_day"><input type="radio" id="wt_productfeed_cron_interval_day" name="wt_productfeed_cron_interval" value="day" <?php checked('day', $cron_data['interval'], true); ?>> <?php esc_html_e('Every day');?></label>
				<label for="wt_productfeed_cron_interval_week"><input type="radio" id="wt_productfeed_cron_interval_week" name="wt_productfeed_cron_interval" value="week" <?php checked('week', $cron_data['interval'], true); ?>> <?php esc_html_e('Every week');?></label>				 
				<label for="wt_productfeed_cron_interval_month"><input type="radio" id="wt_productfeed_cron_interval_month" name="wt_productfeed_cron_interval" value="month" <?php checked('month', $cron_data['interval'], true); ?>> <?php esc_html_e('Every month');?></label>
				<label for="wt_productfeed_cron_interval_custom"><input type="radio" id="wt_productfeed_cron_interval_custom" name="wt_productfeed_cron_interval" value="custom" <?php checked('custom', $cron_data['interval'], true); ?>> <?php esc_html_e('Custom');?></label>
			</div>
			<div class="wt_productfeed_schedule_now_interval_sub_block wt_productfeed_schedule_custom_interval_block">
				<label><?php esc_html_e('Custom interval');?></label>
				<input type="number" step="1" min="1" name="wt_productfeed_cron_interval_val" value="<?php echo esc_attr( $cron_data['custom_interval'] ); ?>" placeholder="<?php esc_html_e('Interval in minutes.');?>">
				<span class="wt-pfd_form_help" style="margin-top:3px;"><?php esc_html_e('Recommended: Minimum 2 hour(120 minutes)');?></span>
			</div>
			<div class="wt_productfeed_schedule_now_interval_sub_block wt_productfeed_schedule_day_block">
				<label><?php esc_html_e('Which day?');?></label>
				<div class="wt_productfeed_schedule_now_interval_radio_block">				
					<?php
					$days = array( 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
					foreach ($days as $day)
					{
						$day_vl=strtolower($day);
						$checked=($day_vl==$cron_data['day_vl'] ? ' checked="checked"' : '');
						?>
						<label for="wt_productfeed_cron_day_<?php echo esc_attr( $day_vl );?>"><input type="radio" value="<?php echo esc_attr( $day_vl );?>" id="wt_productfeed_cron_day_<?php echo esc_attr( $day_vl );?>" name="wt_productfeed_cron_day" <?php echo esc_attr( $checked );?>> <?php esc_html_e($day);?></label>
						<?php
					}
					?>
				</div>
			</div>
			<div class="wt_productfeed_schedule_now_interval_sub_block wt_productfeed_schedule_date_block">
				<label><?php esc_html_e('Day of the Month?');?></label>
				<select name="wt_productfeed_cron_interval_date">
					<?php                    
					$cron_interval_date = isset($cron_data['date_vl']) ? $cron_data['date_vl'] : '';
					for($i=1; $i<=28; $i++)
					{
						?>
                                    <option value="<?php echo absint($i);?>" <?php selected($i, $cron_interval_date, true); ?>><?php echo absint($i);?></option>
						<?php
					}
					?>
					<option value="last_day"><?php esc_html_e('Last day');?></option>
				</select>
			</div>
                    <?php
                    $start_time_str = $cron_data['start_time'];
                    $str_time_parts = explode('.', $start_time_str);
                    $hour = $str_time_parts[0];
                    $minute_ampm = $str_time_parts[1];
                    $minute_ampm_parts = explode(' ', $minute_ampm);
                    $minute = $minute_ampm_parts[0];
                    $ampm = $minute_ampm_parts[1];
                    
                    
                    ?>
			<div class="wt_productfeed_schedule_now_interval_sub_block wt_productfeed_schedule_starttime_block">
				<label><?php esc_html_e('Start time');?></label> 
                                <div style="float:left">
                                    <input  type="number" step="1" min="1" max="12" name="wt_productfeed_cron_start_val" value="<?php echo esc_attr( $hour ); ?>" />
                                    <span class="wt-pfd_form_help" style="display:block; margin-top: 1px">Hour</span>
                                </div>
                                <div style="float:left">
                                    <span class="wt_productfeed_cron_start_val_min">:</span><input type="number" step="1" min="0" max="59" name="wt_productfeed_cron_start_val_min" value="<?php echo esc_attr( $minute ); ?>" onchange="if(parseInt(this.value,10)<10)this.value='0'+this.value;" />
                                    <span class="wt-pfd_form_help" style="display:block;  margin-top: 1px">Minute</span>
                                </div>
                                <div style="float:left">
                                    <select name="wt_productfeed_cron_start_ampm_val">
                                    <?php
                                    $am_pm=array('AM', 'PM');
                                    foreach($am_pm as $apvl)
                                    {
                                            ?>
                                            <option  <?php selected($apvl, $ampm, true); ?>><?php echo esc_html( $apvl );?></option>
                                            <?php
                                    }
                                    ?>
                                    </select>
                                </div>
			</div>
		</div>

		<div class="wt_productfeed_schedule_now_trigger_url">
			<label><?php esc_html_e('Trigger URL');?></label>
			<div class="wt_productfeed_schedule_now_formrow" style="margin-bottom:0px;">
				<input type="text" name="wt_productfeed_cron_url" value="" />
				<p style="color:red; margin:0px;"><?php esc_html_e('Use the generated URL to run cron.'); ?></p>
				<!-- <p>Eg: */2 * * * * wget -O /dev/null url >/dev/null 2>&1  </p> -->
			</div>
		</div>
			</div>
			</div>	
		</div>
</div>
			
		<div class="wt_productfeed_popup_footer">
			<button type="button" name="" class="button-secondary wt_productfeed_popup_cancel">
				<?php esc_html_e('Cancel');?> 
			</button>
			<button type="button" name="" class="button-primary wt_productfeed_update_schedule" style="margin-right:20px;"><?php esc_html_e('Update Schedule');?></button>	
		</div>

</div>
