<?php
if (!defined('ABSPATH')) {
    exit;
}
$checked=is_array($val) ? $val[1] : 0;
$val=(is_array($val) ? $val[0] : $val);
?>
<tr id="columns_<?php echo esc_attr( $key );?>">
	<td>
	<div class="wt_pf_sort_handle"><span class="dashicons dashicons-move"></span></div>
	<input type="checkbox" name="columns_key[]" class="columns_key wt_pf_mapping_checkbox_sub" value="<?php echo esc_attr( $key );?>" <?php echo ($checked==1 ? 'checked' : ''); ?>></td>
	<td>
		<label class="wt_pf_mapping_column_label"><?php echo esc_html( $label );?></label>
	</td>
	<td>		
		<select name="columns_val[]" class="columns_val">
					<?php
					echo esc_html( $wc_prod_attributes );
					?>
		</select>
	</td>
</tr>