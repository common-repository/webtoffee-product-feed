<?php
if (!defined('ABSPATH')) {
    exit;
}
$checked=is_array($val) ? $val[1] : 0;
$val=(is_array($val) ? $val[0] : $val);
$is_static = false;
$static_map_value = '';
if(strpos($val, 'wt_static_map_vl:') !== false ){
	$is_static = true;
	$static_map_value = str_replace('wt_static_map_vl:', '', $val);
}

?>
<tr id="columns_<?php echo esc_html( $key );?>">
	<td>
	<div class="wt_pf_sort_handle"><span class="dashicons dashicons-move"></span></div>
	<input type="checkbox" name="columns_key[]" class="columns_key wt_pf_mapping_checkbox_sub" value="<?php echo esc_attr( $key );?>" <?php echo ($checked==1 ? 'checked' : ''); ?>></td>
	<td>
		<label class="wt_pf_mapping_column_label"><?php echo esc_html( $label );?></label>
	</td>
	<td>		
		<select name="columns_val[]" class="wc-enhanced-select columns_val">
                    
					<?php
                                        $wt_allowed_html_tags = apply_filters( 'wt_pf_mapping_allowed_html_option', array(
                                            'select' =>
                                            array(
                                                'autofocus' => true,
                                                'disabled' => true,
                                                'form' => true,
                                                'multiple' => true,
                                                'name' => true,
                                                'required' => true,
                                                'size' => true,
                                            ), 'optgroup' =>
                                            array(
                                                'disabled' => true,
                                                'label' => true,
                                            ),
                                            'option' =>
                                            array(
                                                'disabled' => true,
                                                'label' => true,
                                                'selected' => true,
                                                'value' => true,
                                            ),
                                        ) );
                                        echo wp_kses( $wc_prod_attributes, $wt_allowed_html_tags );
					?>
		</select>
	</td>
        <td>
		<input type="text" name="columns_static_val[]" value="<?php echo esc_attr($static_map_value);?>" <?php if(!$is_static){ echo 'style="display: none;"'; }?> class="columns_static_val">
	</td>
</tr>