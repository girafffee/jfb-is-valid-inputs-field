<?php


namespace Jet_FB_Is_Valid_Inputs;


use Jet_Form_Builder\Blocks\Render\Base;
use Jet_Form_Builder\Classes\Instance_Trait;

/**
 * @method static HiddenFieldManager instance()
 *
 * Class HiddenFieldManager
 * @package Jet_FB_Is_Valid_Inputs
 */
class HiddenFieldManager {

	use Instance_Trait;

	public static function register() {
		add_filter(
			'jet-form-builder/editor/hidden-field/config',
			array( self::instance(), 'modify_config' )
		);

		add_filter(
			'jet-form-builder/fields/hidden-field/value-cb',
			array( self::instance(), 'modify_value_cb' ),
			10, 2
		);

		add_filter(
			'jet-form-builder/render/hidden-field',
			array( self::instance(), 'on_render' ),
			10, 2
		);
	}

	public function modify_config( array $config ): array {
		$config['sources'][] = array(
			'value' => 'is_fields_valid',
			'label' => __( 'Is all form fields valid', 'jfb-is-valid-inputs' ),
		);

		return $config;
	}

	public function modify_value_cb( $value, $field_value ) {
		return 'is_fields_valid' === $field_value ? function () {
			return 'is_fields_valid';
		} : $value;
	}

	public function on_render( array $attrs, Base $block ): array {
		if ( 'is_fields_valid' !== $attrs['field_value'] ) {
			return $attrs;
		}

		wp_enqueue_script( Plugin::instance()->slug );

		$block->add_attribute(
			'data-jfb-conditional',
			\Jet_Form_Builder\Classes\Tools::esc_attr(
				array(
					array(
						'operator' => 'is_fields_valid'
					)
				)
			)
		);
		$block->add_attribute(
			'data-jfb-func',
			'apply_value'
		);

		$attrs['field_value'] = 0;

		return $attrs;
	}

}