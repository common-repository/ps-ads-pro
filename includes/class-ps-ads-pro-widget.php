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
 * The core widget class.
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


class ps_ads_pro_widget extends WP_Widget {

	public function __construct() {

		parent::__construct( 'ps_ads_pro_widget', __( 'Ps Ads Pro Widget', 'ps-ads-pro' ), array( 'description' => __( 'Ps Ads Pro Widget', 'ps-ads-pro' ), ) 
		);
	}

	/**
	 * Creating widget front-end
	 */

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		echo $args['before_widget'];
		/*if ( ! empty( $title ) )
		echo $args['before_title'] . $title . $args['after_title'];*/
		echo do_shortcode( $instance['title'] );
		echo $args['after_widget'];
	}

	/**
	 * Widget Backend
	 */
	
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		} else {
			$title = __( 'New ads shortcode', 'ps-ads-pro' );
		}
	// Widget admin form
	?>
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Ads shortcode: [ps_ads_pro ads="1"]' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
	</p>
	<?php 
	}
	     
	// Updating widget replacing old instances with new

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}
}