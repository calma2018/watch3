<?php
/**
 * Customizer - Muitiple Checkbox Control
 *
 * @package Welcart
 * @subpackage Welcart mode
 * @since 1.0.0
 */

/**
 * Multiple checkbox customize control class.
 * URL: http://wpsites.org/multiple-checkbox-customizer-control-10868/
 */
class vogusih_checkbox_multiple extends WP_Customize_Control {

	/**
	 * The type of customize control being rendered.
	 *
	 * @var string
	 */
	public $type = 'checkbox-multiple';

	/**
	 * Enqueue scripts/styles.
	 *
	 * @return void
	 */
	public function enqueue() {
		wp_enqueue_script( 'vogusih-customize-controls', trailingslashit( get_template_directory_uri() ) . 'assets/js/admin/custom-control.js', array( 'jquery' ), null, true );
	}

	/**
	 * Displays the control content.
	 *
	 * @return void
	 */
	public function render_content() {

		if ( empty( $this->choices ) ) {
			return;
		} ?>

		<?php if ( ! empty( $this->label ) ) : ?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php endif; ?>

		<?php if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
		<?php endif; ?>

		<?php $multi_values = ! is_array( $this->value() ) ? explode( ',', $this->value() ) : $this->value(); ?>

		<ul class="customize-control-checkbox-multiple">
			<?php foreach ( $this->choices as $value => $label ) : ?>

				<li>
					<label>
						<input type="checkbox" value="<?php echo esc_attr( $value ); ?>" <?php checked( in_array( $value, $multi_values, true ) ); ?> /> 
						<?php echo esc_html( $label ); ?>
					</label>
				</li>

			<?php endforeach; ?>
		</ul>

		<input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', $multi_values ) ); ?>" />
		<?php
	}
}
