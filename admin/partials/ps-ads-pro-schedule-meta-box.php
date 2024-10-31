<?php
/**
 * The view for the plugin's ps-ads-pro meta box. The ps-ads-pro meta box is used for
 * entering additional ps-ads-pro information (version).
 *
 * @package    Ps_Ads_Pro
 * @subpackage Ps_Ads_Pro/admin/partials
 */
?>
<p class="label">
  <label for="ps_ads_pro_start_date">
    <?php _e( 'Start Date', $this->plugin_name ); ?>
  </label>
</p>
<div class="ads-input-wrap">
    <input type="text" id="ps_ads_pro_start_date" class="text datepicker" name="ads_start_date" value="<?php echo esc_attr( $ads_meta['ads_start_date'] ); ?>" autocomplete="off">
</div>

<p class="label">
  <label for="ps_ads_pro_end_date">
      <?php _e( 'End Date', $this->plugin_name ); ?>
  </label>
</p>
<div class="ads-input-wrap">
  <input type="text" id="ps_ads_pro_end_date" class="text datepicker" name="ads_end_date" value="<?php echo esc_attr( $ads_meta['ads_end_date'] ); ?>" autocomplete="off">
</div>

<script type="text/javascript">
	jQuery(document).ready(function(){
		jQuery('.datepicker').datepicker({
			dateFormat : 'yy-mm-dd'
		});
	});
</script>
