<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://padamshankhadev.com
 * @since             1.0.0
 * @package           Ps_Ads_Pro
 *
 * @wordpress-plugin
 * Plugin Name:       PS Ads Pro
 * Plugin URI:        https://wordpress.org/plugins/ps-ads-pro
 * Description:       PS Ads Pro Plugin is used to managed the ads and banner in the wordpress sites.
 * Version:           1.0.0
 * Author:            Padam Shankhadev
 * Author URI:        https://padamshankhadev.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ps-ads-pro
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PS_ADS_PRO_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ps-ads-pro-activator.php
 */
function activate_ps_ads_pro() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ps-ads-pro-activator.php';
	Ps_Ads_Pro_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ps-ads-pro-deactivator.php
 */
function deactivate_ps_ads_pro() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ps-ads-pro-deactivator.php';
	Ps_Ads_Pro_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_ps_ads_pro' );
register_deactivation_hook( __FILE__, 'deactivate_ps_ads_pro' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ps-ads-pro.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ps_ads_pro() {

	$plugin = new Ps_Ads_Pro();
	$plugin->run();

}
run_ps_ads_pro();
