<?php


namespace Jet_FB_Is_Valid_Inputs;


use Jet_Form_Builder\Classes\Instance_Trait;

/**
 * @method static ConditionalBlockManager instance()
 *
 * Class ConditionalBlockManager
 * @package Jet_FB_Is_Valid_Inputs
 */
class ConditionalBlockManager {

	use Instance_Trait;

	public static function register() {
		add_filter(
			'jet-form-builder/conditional-block/operators',
			array( self::instance(), 'add_operator' )
		);
	}

	public function add_operator( $operators ): array {
		$operators[] = new class extends \Jet_Form_Builder\Blocks\Conditional_Block\Operators\Base_Operator {

			public function get_id(): string {
				return 'is_fields_valid';
			}

			public function get_title(): string {
				return __( 'Is all form fields valid', 'jfb-is-valid-inputs' );
			}

			public function is_supported(): bool {
				return false;
			}
		};

		return $operators;
	}

}