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
 * Text Domain: dm-book
 * / */

defined( 'ABSPATH' ) || die( 'No No No' );
$dm_wb_cpt_path     = plugin_dir_path( __FILE__ ) . 'class-dmwpbookcpt.php';
$dm_wb_metabox_path = plugin_dir_path( __FILE__ ) . 'class-dmwpbookcustommetabox.php';

require $dm_wb_cpt_path;
require $dm_wb_metabox_path;


if ( class_exists( 'DmWpBook' ) ) {
	global $dm_wp_book;
	$dm_wp_book = new DmWpBook();
}
// Stating that this is the activation function.
register_activation_hook( __FILE__, array( $dm_wp_book, 'activate' ) );

// Stating that this is the deactivation function.
register_deactivation_hook( __FILE__, array( $dm_wp_book, 'deactivate' ) );

/**
 * DmWpBook is a basic class for now.
 */
class DmWpBook {
	/**
	 * Construction to call procedures like add_action() to hook our plugin as we can not do that in class directly.
	 */
	public function __construct() {
		$this->register();
		// Hook: add_meta_boxes_<custom_post_typr>.
	}


	/************************************************
	 * Creation of custom post type.
	 ***********************************************/

	/**
	 * Function to register all the actions to WordPress hooks. //phpcs:ignore
	 *	//phpcs:ignore
	 *
	 * @return void
	 */
	public function register() {
		global $cpt,$meta;
		$cpt  = new DmWpBookCpt();
		$meta = new DmWpBookCustomMetabox();

		add_action( 'admin_enqueue_scripts', array( $this, 'custom_assets' ), 0 );
		add_action( 'init', array( $cpt, 'custom_post_type_book' ), 0 );
		add_action( 'init', array( $cpt, 'custom_taxonomy_book_category' ), 0 );
		add_action( 'init', array( $cpt, 'custom_taxonomy_book_tag' ), 0 );
		add_action( 'add_meta_boxes_book', array( $meta, 'custom_meta_box_book_meta' ), 0 );
		add_action( 'save_post', array( $meta, 'custom_meta_box_save' ), 5, 2 );
	}

	/************************************************
	 * Activation Deactivation.
	 ***********************************************/

	/**
	 * Function that works on activation of plugin
	 *
	 * @return void
	 */
	public function activate() {
		// Flush re wrte rules.
		flush_rewrite_rules();

	}

	/**
	 * Function that works on deactivation of a plugin
	 *
	 * @return void
	 */
	public function deactivate() {
		// Flush re wrte rules.
		flush_rewrite_rules();
	}


	/**************************************
	 * CSS and JS files are added
	 */
	public function custom_assets() {
		wp_enqueue_style( 'dm-wp-book-style-id', plugin_dir_url( __FILE__ ) . 'includes/dm-wp-book-stylesheet.css', null, '1.0.1' );
		wp_enqueue_script( 'dm-wp-book-script-id', plugin_dir_url( __FILE__ ) . 'includes/dm-wp-book-script.js', null, '1.0.0', true );
	}
}


