<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://padamshankhadev.com
 * @since      1.0.0
 *
 * @package    Ps_Ads_Pro
 * @subpackage Ps_Ads_Pro/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ps_Ads_Pro
 * @subpackage Ps_Ads_Pro/admin
 * @author     Padam Shankhadev <shankhadev123@gmail.com>
 */
class Ps_Ads_Pro_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
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
		
		wp_register_style( 'jquery-ui', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css' );
    	wp_enqueue_style( 'jquery-ui' );
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ps-ads-pro-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

    	wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ps-ads-pro-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * A helper function for creating and rendering a nonce field.
	 *
	 * @param   $nonce_label  string  An internal (shorter) nonce name
	 */
	private function render_nonce_field( $nonce_label ) {
	    $nonce_field_name = $this->plugin_name . '_' . $nonce_label . '_nonce';
	    $nonce_name = $this->plugin_name . '_' . $nonce_label;
	 
	    wp_nonce_field( $nonce_name, $nonce_field_name );
	}

	/**
	 * A helper function for checking the ads meta box nonce.
	 *
	 * @param   $nonce_label string  An internal (shorter) nonce name
	 * @return  mixed   False if nonce is not OK. 1 or 2 if nonce is OK (@see wp_verify_nonce)
	 */
	private function is_nonce_ok( $nonce_label ) {
	    $nonce_field_name = $this->plugin_name . '_' . $nonce_label . '_nonce';
	    $nonce_name = $this->plugin_name . '_' . $nonce_label;
	 
	    if ( ! isset( $_POST[ $nonce_field_name ] ) ) {
	        return false;
	    }
	 
	    $nonce = $_POST[ $nonce_field_name ];
	 
	    return wp_verify_nonce( $nonce, $nonce_name );
	}

	/**
	 * Registers a meta box for entering ads information. The meta box is
	 * shown in the post editor for the "ads" post type.
	 *
	 * @param   $post   WP_Post The post object to apply the meta box to
	 */
	public function add_ps_ads_pro_meta_boxes( $post ) {
	    add_meta_box(
	        'ps-ads-pro-information-meta-box',
	        __( 'Ads Information', $this->plugin_name ),
	        array( $this, 'render_ps_ads_pro_information_meta_box' ),
	        'ps_ads_pro',
	        'normal'
	    );

	    add_meta_box(
	        'ps-ads-pro-scheduler-meta-box',
	        __( 'Schedule your advert', $this->plugin_name ),
	        array( $this, 'render_ps_ads_pro_schedule_meta_box' ),
	        'ps_ads_pro',
	        'side'
	    );

	    add_meta_box(
	        'ps-ads-pro-info-meta-box',
	        __( 'Usage', $this->plugin_name ),
	        array( $this, 'render_ps_ads_pro_info_meta_box' ),
	        'ps_ads_pro',
	        'normal'
	    );
	}

	/**
	 * Renders the ads information meta box for the given post (ps_ads_pro).
	 *
	 * @param $post     WP_Post     The WordPress post object being rendered.
	 */
	public function render_ps_ads_pro_information_meta_box( $post ) {
	    $ads_meta = get_post_meta( $post->ID, 'ps_ads_pro_meta', true );
	 
	    if ( ! is_array( $ads_meta ) ) {
	        $ads_meta = array(
	            'ads_content' => ''
	        );
	    }
	 
	    $this->render_nonce_field( 'ps_ads_pro_meta_box' );
	 
	    require( 'partials/ps-ads-pro-meta-box.php' );
	}

	/**
	 * Renders the ads schedule meta box for the given post (ps_ads_pro).
	 *
	 * @param $post     WP_Post     The WordPress post object being rendered.
	 */
	public function render_ps_ads_pro_schedule_meta_box( $post ) {
	    $ads_meta = get_post_meta( $post->ID, 'ps_ads_pro_meta', true );
	 
	    if ( ! is_array( $ads_meta ) ) {
	        $ads_meta = array(
	            'ads_start_date' => '',
	            'ads_end_date' => ''
	        );
	    }
	 
	    $this->render_nonce_field( 'ps_ads_pro_meta_box' );
	 
	    require( 'partials/ps-ads-pro-schedule-meta-box.php' );
	}

	/**
	 * Renders the ads info meta box for the given post (ps_ads_pro).
	 *
	 * @param $post     WP_Post     The WordPress post object being rendered.
	 */
	public function render_ps_ads_pro_info_meta_box( $post ) {
	 	require( 'partials/ps-ads-pro-info-meta-box.php' );
	}

	/**
	 * Saves the ads information meta box contents.
	 *
	 * @param $post_id  int     The id of the post being saved.
	 */
	public function save_ps_ads_pro_meta_box( $post_id ) {
		if ( ! $this->is_nonce_ok( 'ps_ads_pro_meta_box' ) ) {
	        return $post_id;
	    }
	 
	    // Ignore auto saves
	    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
	        return $post_id;
	    }
	 
	    // Check the user's permissions
	    if ( !current_user_can( 'edit_posts', $post_id ) ) {
	        return $post_id;
	    }
	 
	    // Read, sanitize, and store user input
	    $meta = get_post_meta( $post_id, 'ps_ads_pro_meta', true );
	    if ( $meta == '' ) {
	    	$meta = array();
	    }

	    $meta['ads_content'] = wp_specialchars_decode( $_POST['ads_content'], $quote_style = ENT_QUOTES );
	    $meta['ads_start_date'] = sanitize_text_field( $_POST['ads_start_date'] );
	    $meta['ads_end_date'] = sanitize_text_field( $_POST['ads_end_date'] );
	 
	    // Update the meta field
	    update_post_meta( $post_id, 'ps_ads_pro_meta', $meta );
	}

	/**
	 * Creates the settings items for entering license information (email + license key).
	 */
	public function add_plugin_menu() {
	    add_menu_page(
	        __( 'Ps Ads Pro', $this->plugin_name ),
	        __( 'Ps Ads Pro', $this->plugin_name ),
	        'edit_posts',
	        'ps_ads_pro',
	        NULL,
	        'dashicons-megaphone',
	        '26.1'
	    );
	 
	    add_submenu_page(
	        'ps_ads_pro',
	        __( 'Settings', $this->plugin_name ),
	        __( 'Settings', $this->plugin_name ),
	        'edit_posts',
	        'ps_ads_pro_settings',
	        array( $this, 'ps_ads_pro_settings_page' )
	    );
	}

	public function ps_ads_pro_settings_page() {
		echo 'This is setting page. Coming soon.';
	}

	/**
	 *  Start / End Date columns
	 */

	public function set_ps_ads_pro_start_end_columns( $columns ) {
		$date = $columns['date'];
  		unset( $columns['date'] );
  		$columns['shortcode'] = __( 'Shortcode', $this->plugin_name );
		$columns['start_date'] = __( 'Start Date', $this->plugin_name );
		$columns['end_date'] = __( 'End Date', $this->plugin_name );
		$columns['date'] = $date;

		return $columns;
	}

	/**
	 *  Start / End Date column data.
	 */

	public function custom_ps_ads_pro_column( $column, $post_id ) {
		$post_meta = get_post_meta( $post_id, 'ps_ads_pro_meta', false );

		switch ( $column ) {

		case 'shortcode' :
            $shortcode = '[ps_ads_pro ads="'.$post_id.'"] <a href="javascript:;" onclick="copyToClipboard(this)">Copy</a><span class="temp-text"></span>';
            _e( $shortcode, $this->plugin_name );
            break;

        case 'start_date' :
            $start_date = !empty( $post_meta[0]['ads_start_date'] ) ? $post_meta[0]['ads_start_date'] : 'N/A';
            _e( $start_date, $this->plugin_name );
            break;

        case 'end_date' :
            $end_date = !empty( $post_meta[0]['ads_end_date'] ) ? $post_meta[0]['ads_end_date'] : 'N/A';
            _e( $end_date, $this->plugin_name );
            break;

    	}
	}

	/**
	 *  Load widget class
	 */

	public function ps_ads_pro_load_widget() {
		register_widget( 'ps_ads_pro_widget' );
	}

}
