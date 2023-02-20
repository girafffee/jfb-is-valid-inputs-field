(
	function () {
		const {
			      addFilter,
			      addAction,
		      } = JetPlugins.hooks;

		const {
			      ConditionItem,
		      } = JetFormBuilderAbstract;

		const {
			      validateInputs,
		      } = JetFormBuilderFunctions;

		function ConditionIsValidInputs() {
			ConditionItem.call( this );

			this.isSupported = function ( options ) {
				return 'is_fields_valid' === options?.operator;
			};

			this.observe = function () {
				validateInputs( this.list.root.getInputs(), true ).
					then( () => {} ).
					catch( () => {} );

				for ( const input of this.iterateInputs() ) {
					input.watchValidity(
						() => this.list.onChangeRelated(),
					);
				}
			};

			this.isPassed = function () {
				for ( const input of this.iterateInputs() ) {
					if ( false !== input.reporting.validityState.current ) {
						continue;
					}
					return false;
				}

				return true;
			};
		}

		ConditionIsValidInputs.prototype = Object.create(
			ConditionItem.prototype,
		);

		ConditionIsValidInputs.prototype.iterateInputs = function* () {
			for ( const input of this.list.root.getInputs() ) {
				if ( !input.reporting.restrictions?.length ) {
					continue;
				}
				yield input;
			}
		};

		addFilter(
			'jet.fb.conditional.types',
			'jfb-is-valid-inputs/add-is-valid-operator',
			function ( types ) {
				types.push( ConditionIsValidInputs );

				return types;
			},
		);

		addAction(
			'jet.fb.conditional.block.runFunction',
			'jfb-is-valid-inputs/add-apply-value-func-type',
			/**
			 * @param functionName {String}
			 * @param result {Boolean}
			 * @param block {ConditionalBlock}
			 */
			function ( functionName, result, block ) {
				if (
					'apply_value' !== functionName ||
					!block.node.hasOwnProperty( 'jfbSync' )
				) {
					return;
				}
				/**
				 * @type {InputData}
				 */
				const input = block.node.jfbSync;

				input.value.current = Number( result );
			},
		);
	}
)();