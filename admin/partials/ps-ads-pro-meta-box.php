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
  <label for="ps_ads_pro_tested">
      <?php _e( 'Ads Code', $this->plugin_name ); ?>
  </label>
</p>
<div class="ads-input-wrap">
  <textarea name="ads_content" id="ps_ads_pro_content" class="text" cols="30" rows="10"><?php echo esc_attr( $ads_meta['ads_content'] ); ?></textarea>
</div>
<p class="label">
  Basic Examples : 
  <em>
    <a href="#">&lt;a href="http://exmaple.com/"&gt;&lt;img src="%asset%" /&gt;&lt;/a&gt;
    </a>
  </em>
</p>
<p>
  <em>
    <a href="#">&lt;iframe src="%asset%" height="250" frameborder="0" style="border:none;"&gt;&lt;/iframe&gt;
    </a>
  </em>
</p>
