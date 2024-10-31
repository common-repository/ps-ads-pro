<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://padamshankhadev.com
 * @since      1.0.0
 *
 * @package    Ps_Ads_Pro
 * @subpackage Ps_Ads_Pro/includes
 */

/**
 * The core plugin helper.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Ps_Ads_Pro
 * @subpackage Ps_Ads_Pro/includes
 * @author     Padam Shankhadev <shankhadev123@gmail.com>
 */

if( !function_exists( 'ps_ads_pro' ) ) {

	function ps_ads_pro( $ads_id = null ) {
		$post = get_post( $ads_id );

		if( isset( $post ) ) {
			$ads_meta = get_post_meta( $post->ID, 'ps_ads_pro_meta', false );
			if( count( $ads_meta ) ) {
				if( !empty( $ads_meta[0]['ads_start_date']) && !empty($ads_meta[0]['ads_end_date']) ) {
					if( date('Y-m-d') >= $ads_meta[0]['ads_start_date'] && date('Y-m-d') <= $ads_meta[0]['ads_start_date']) {
						return $ads_meta[0]['ads_content'];
					} else {
						return;
					}
				} else {
					return $ads_meta[0]['ads_content'];
				}	
			} else {
				return;
			}
		} else {
			return;
		}
	}

}