<?php
/**
 * Plugin Name: JetFormBuilder Is Valid Inputs field
 * Description: A lightweight addon to control the validity of all inputs in form
 * Version:     1.0.0
 * Author:      Crocoblock
 * Author URI:  https://crocoblock.com/
 * Text Domain: jfb-is-valid-inputs
 * License:     GPL-3.0+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die();
}

define( 'JET_FB_IS_VALID_INPUTS_VERSION', '1.0.0' );

define( 'JET_FB_IS_VALID_INPUTS__FILE__', __FILE__ );
define( 'JET_FB_IS_VALID_INPUTS_PLUGIN_BASE', plugin_basename( __FILE__ ) );
define( 'JET_FB_IS_VALID_INPUTS_PATH', plugin_dir_path( __FILE__ ) );
define( 'JET_FB_IS_VALID_INPUTS_URL', plugins_url( '/', __FILE__ ) );

require JET_FB_IS_VALID_INPUTS_PATH . 'vendor/autoload.php';

add_action( 'plugins_loaded', function () {

	if ( ! version_compare( PHP_VERSION, '7.0.0', '>=' ) ) {
		add_action( 'admin_notices', function () {
			$class   = 'notice notice-error';
			$message = __(
				'<b>Error:</b> <b>JetFormBuilder Is Valid Inputs field</b> plugin requires a PHP version ">= 7.0"',
				'jfb-is-valid-inputs'
			);
			printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), wp_kses_post( $message ) );
		} );

		return;
	}

	\Jet_FB_Is_Valid_Inputs\Plugin::instance();
}, 100 );

