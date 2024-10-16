<?php
/**
 * Main Plugin Class
 *
 * Coordinates integration with WordPress
 */
class WP_Asciinema_Plugin {

	public function init() {
		add_filter('upload_mimes', array( __CLASS__, 'add_cast_mime_type'));
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_scripts_styles' ) );
		$this->register_shortcodes();
	}

	/**
	 * Registers the 'cast' mime type with the WP media library
	 *
	 * See: https://docs.asciinema.org/manual/asciicast/v2/
	 */
	public static function add_cast_mime_type($mimes) {
		$mimes['cast'] = 'application/json';
		return $mimes;
	}

	/**
	 * Enqueue scripts and styles needed by this plugin
	 */
	public static function enqueue_scripts_styles() {
		wp_register_script( 'asciinema', WP_Asciinema_Plugin::get_plugin_folder( 'url' ) . 'assets/vendor/asciinema-player.js', array(), 'v2.6.1', true );
		wp_register_style( 'asciinema', WP_Asciinema_Plugin::get_plugin_folder( 'url' ) . 'assets/vendor/asciinema-player.css', array(), 'v2.6.1' );
	}

	/**
	 * Registers shortcodes used by this plugin
	 */
	private function register_shortcodes() {
		if ( ! is_admin() ) {
			WP_Asciinema_Shortcode_Asciinema::register();
		}
	}

	/**
	 * Returns the plugin folder for the given type
	 *
	 * @param string $type url|path
	 *
	 * @return string Either the url or the path to this plugin's folder
	 */
	public static function get_plugin_folder( $type ) {
		$plugin_path = __DIR__;
		switch ( $type ) {
			case 'url' :
				return plugin_dir_url( $plugin_path );
				break;
			case 'path' :
			default:
				return plugin_dir_path( $plugin_path );
				break;
		}
	}
}
