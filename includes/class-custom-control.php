<?php
/**
 * Elementor emoji one area control.
 *
 * A control for displaying a textarea with the ability to add emojis.
 *
 * @since 1.0.0
 */
class VSP_Custom_Control extends \Elementor\Base_Data_Control {

	public $vehicleidcontrol = 'vehicle-id';

	const vehicleidcontrol = 'vehicleidcontrol';


	/**
	 * Get api custom control type.
	 *
	 * Retrieve the control type, in this case `vehicleidcontrol`.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Control type.
	 */
	public function get_type() {
		return 'vehicleidcontrol';
	}


	/* Get Custom Contol uid */
	public function get_control_uid( $input_type = 'default') {
		return 'elementor-control-' . $vehicleidcontrol . '-123';
	}

	/**
	 * Get custom control one area control default settings.
	 *
	 * Retrieve the default settings of the custon control one area control. Used to return
	 * the default settings while initializing the custon control one area control.
	 *
	 * @since 1.0.0
	 * @access protected
	 *
	 * @return array Control default settings.
	 */
	protected function get_default_settings() {
		return [
			'label_block' => true,
			'rows' => 1,
			// 'emojionearea_options' => [],
		];
	}

	/**
	 * Render Custom Control one area control output in the editor.
	 *
	 * Used to generate the control HTML in the editor using Underscore JS
	 * template. The variables for the class are available using `data` JS
	 * object.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function content_template() {
		$control_uid = $this->get_control_uid();
		?>
		<div class="elementor-control-field">
			<label for="<?php echo esc_attr( $control_uid ); ?>" class="elementor-control-title">{{{ data.label }}}</label>
			<div class="elementor-control-input-wrapper">
				<textarea id="<?php echo esc_attr( $control_uid ); ?>" class="elementor-control-tag-area" rows="{{ data.rows }}" data-setting="{{ data.name }}" placeholder="{{ data.placeholder }}" value="{{data.value}}"></textarea>
			</div>
		</div>
		<# if ( data.description ) { #>
		<div class="elementor-control-field-description">{{{ data.description }}}</div>
		<# } #>
		<?php
	}

}