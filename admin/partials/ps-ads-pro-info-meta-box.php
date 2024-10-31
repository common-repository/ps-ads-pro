<?php
/**
 * The view for the plugin's ps-ads-pro meta box. The ps-ads-pro meta box is used for
 * entering additional ps-ads-pro information (version).
 *
 * @package    Ps_Ads_Pro
 * @subpackage Ps_Ads_Pro/admin/partials
 */
?>
<?php
    $post_id = isset( $_GET['post'] ) ? $_GET['post'] : 'post_id';
?>
<p>
  <label for="ps_ads_pro_info">
      <?php _e( 'Widget : Drag the AdRotate widget to the sidebar where you want to place the advert and select the advert or the group the advert is in.', $this->plugin_name ); ?>
  </label>
</p>

<p>
  <label for="ps_ads_pro_info">
      <?php _e( 'In a post or page : [ps_ads_pro ads="'.$post_id.'"]', $this->plugin_name ); ?>
  </label>
</p>

<p>
  <label for="ps_ads_pro_info">
      <?php 
          _e( 'Directly in a theme : ', $this->plugin_name );
          _( highlight_string('<?php echo ps_ads_pro('.$post_id.'); ?>') ); 
      ?>
  </label>
</p>
