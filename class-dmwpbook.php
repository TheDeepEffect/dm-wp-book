<?php
/**
 * Just another plugin for books
 *
 * @package dm-wp-book
 * @author  Deep Manek
 */

/** Plugin Name: WP Book
 * Plugin URI:https://github.com/TheDeepEffect/dm-wp-book
 * Description: A plugin for adding books to your posts.
 * Version:     1.0.0
 * Author:      Deep Manek
 * / */

defined( 'ABSPATH' ) || die( 'No No No' );

/**
 * DmWpBook is a basic class for now.
 */
class DmWpBook {

	/**
	 * Construction to call procedures like add_action() to hook our plugin as we can not do that in class directly.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'custom_post_type' ) );
	}

	/**
	 * Function to register a post type.
	 *
	 * @return void
	 */
	public function custom_post_type() {
		register_post_type(
			'book',
			array(
				'public' => 'true',
				'label'  => 'Books',
			)
		);

	}

	/**
	 * Function that works on activation of plugin (generate a custom post type, flush re wrte rules)
	 *
	 * @return void
	 */
	public function activate() {

	}

	/**
	 * Function that works on deactivation of a plugin (flush rewrite rules)
	 *
	 * @return void
	 */
	public function deactivate(){}

	/**
	 * Function on uninstallation of a plugin. (delete custom post type all data of plugin from DB)
	 *
	 * @return void
	 */
	public function uninstall() {

	}


}
if ( class_exists( 'DmWpBook' ) ) {
	$dm_wp_book = new DmWpBook();
}

// Activation.
register_activation_hook( __FILE__, array( $dm_wp_book, 'activate' ) );

// Deactivation.
register_deactivation_hook( __FILE__, array( $dm_wp_book, 'deactivate' ) );
