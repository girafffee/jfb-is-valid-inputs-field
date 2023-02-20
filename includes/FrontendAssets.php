<?php


namespace Jet_FB_Is_Valid_Inputs;


use Jet_Form_Builder\Blocks\Types\Conditional_Block;
use Jet_Form_Builder\Classes\Instance_Trait;

class FrontendAssets {

	use Instance_Trait;

	public static function register() {
		add_action( 'wp_enqueue_scripts', array( self::instance(), 'register_scripts' ) );
	}

	public function register_scripts() {
		wp_register_script(
			Plugin::instance()->slug,
			Plugin::instance()->plugin_url( 'assets/js/frontend.js' ),
			array(
				Conditional_Block::HANDLE,
			),
			Plugin::instance()->get_version(),
			true
		);
	}

}