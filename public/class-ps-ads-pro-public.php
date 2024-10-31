<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://padamshankhadev.com
 * @since      1.0.0
 *
 * @package    Ps_Ads_Pro
 * @subpackage Ps_Ads_Pro/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Ps_Ads_Pro
 * @subpackage Ps_Ads_Pro/public
 * @author     Padam Shankhadev <shankhadev123@gmail.com>
 */
class Ps_Ads_Pro_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ps_Ads_Pro_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ps_Ads_Pro_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ps-ads-pro-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ps_Ads_Pro_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ps_Ads_Pro_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ps-ads-pro-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register the new "products" post type to use for products that
	 * are available for purchase through the license manager.
	 */
	public function add_ads_post_type() {
	    register_post_type( 'ps_ads_pro',
	        array(
	            'labels' => array(
	                'name' => __( 'Ps Ads Pro', $this->plugin_name ),
	                'singular_name' => __( 'Ad', $this->plugin_name ),
	                'menu_name' => __( 'Ps Ads Pro', $this->plugin_name ),
	                'name_admin_bar' => __( 'Ps Ads Pro', $this->plugin_name ),
	                'add_new' => __( 'Add New', $this->plugin_name ),
	                'add_new_item' => __( 'Add New Ads', $this->plugin_name ),
	                'edit_item' => __( 'Edit Ads', $this->plugin_name ),
	                'new_item' => __( 'New Ads', $this->plugin_name ),
	                'view_item' => __( 'View Ads', $this->plugin_name ),
	                'search_item' => __( 'Search Ads', $this->plugin_name ),
	                'not_found' => __( 'No ads found', $this->plugin_name ),
	                'not_found_in_trash' => __( 'No ads found in trash', $this->plugin_name ),
	                'all_items' => __( 'All Ads', $this->plugin_name ),
	            ),
	            'show_in_menu' => 'ps_ads_pro',
	            'public' => true,
	            'has_archive' => true,
	            'supports' => array( 'title' ),
	            'rewrite' => array( 'slug' => 'ps_ads_pro' ),
	            'menu_icon' => 'dashicons-megaphone',
	        )
	    );
	}

	/**
	 * Generate the shortcode
	 */
	
	public function ps_ads_pro_shortcode( $atts ) {
		extract( shortcode_atts( array(
			'ads' => ''
		), $atts ) );

		$post = get_post( $ads );

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
