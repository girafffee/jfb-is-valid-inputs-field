<?php


namespace Jet_FB_Is_Valid_Inputs;


class Plugin {
	/**
	 * Instance.
	 *
	 * Holds the plugin instance.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 * @var Plugin
	 */
	private static $instance = null;

	public $slug = 'jfb-is-valid-inputs';

	private function __construct() {
		if ( ! class_exists( '\Jet_Form_Builder\Blocks\Validation' ) ) {
			return;
		}

		HiddenFieldManager::register();
		ConditionalBlockManager::register();
		FrontendAssets::register();
	}

	public function get_version(): string {
		return JET_FB_IS_VALID_INPUTS_VERSION;
	}

	public function plugin_url( $path ): string {
		return JET_FB_IS_VALID_INPUTS_URL . $path;
	}

	public function plugin_dir( $path = '' ): string {
		return JET_FB_IS_VALID_INPUTS_PATH . $path;
	}

	/**
	 * Instance.
	 *
	 * Ensures only one instance of the plugin class is loaded or can be loaded.
	 *
	 * @return Plugin An instance of the class.
	 * @since 1.0.0
	 * @access public
	 * @static
	 *
	 */
	public static function instance(): Plugin {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
}