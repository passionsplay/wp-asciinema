<?php
/**
 * Main Plugin Class
 *
 * Coordinates integration with WordPress
 */
class WP_Asciinema_Plugin {

	public function init() {
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_scripts_styles' ) );
	}

	/**
	 * Enqueue scripts and styles needed by this plugin
	 */
	public static function enqueue_scripts_styles() {
		wp_enqueue_script( 'asciinema', WP_Asciinema_Plugin::get_plugin_folder( 'url' ) . 'assets/vendor/asciinema-player.js', array(), 'v2.4.1', true );
		wp_enqueue_style( 'asciinema', WP_Asciinema_Plugin::get_plugin_folder( 'url' ) . 'assets/vendor/asciinema-player.css', array(), 'v2.4.1' );

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

