<?php
/**
 * Handles functionality relating to the 'asciinema' shortcode
 */
class WP_Asciinema_Shortcode_Asciinema {

	/**
	 * Register the shortcode with WordPress
	 */
	public static function register() {
		add_shortcode( 'asciinema', array( __CLASS__, 'render' ) );
	}

	/**
	 * Renders the shortcode
	 *
	 * @param array $atts The array of shortcode attributes.
	 */
	public static function render( $atts ) {

		$asciicast_url = WP_Asciinema_Plugin::get_asciicast_folder( 'url' );

		$defaults = apply_filters( 'wp_asciinema_player_defaults', array(
			'src'      => '',
			'theme'    => 'asciinema',
			'rows'     => 24,
			'cols'     => 80,
			'speed'    => 1,
			'loop'     => false,
			'autoplay' => false,
		) );

		$a = shortcode_atts( $defaults, $atts );

		$video_url = $a['src'];

        wp_enqueue_script( 'asciinema');
        wp_enqueue_style( 'asciinema');		
		
		ob_start(); ?>

		<asciinema-player
			src="<?php echo esc_attr( $video_url ); ?>"
			theme="<?php echo esc_attr( $a['theme'] ); ?>"
			rows="<?php echo esc_attr( $a['rows'] ); ?>"
			cols="<?php echo esc_attr( $a['cols'] ); ?>"
			speed="<?php echo esc_attr( $a['speed'] ); ?>"
			<?php echo ( $a['loop'] ) ? 'loop' : ''; ?>
			<?php echo ( $a['autoplay'] ) ? 'autoplay' : ''; ?>
			></asciinema-player>

		<?php
		return ob_get_clean();
	}

}

