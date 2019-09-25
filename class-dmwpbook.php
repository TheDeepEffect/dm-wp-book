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
$dm_wb_cpt_path = plugin_dir_path( __FILE__ ) . 'class-dmwpbookcpt.php';
require $dm_wb_cpt_path;

global $cpt_obj;
$cpt_obj = new DmWpBookCpt();
/**
 * DmWpBook is a basic class for now.
 */
class DmWpBook {
	/**
	 * Construction to call procedures like add_action() to hook our plugin as we can not do that in class directly.
	 *
	 * @param DmWpBookCpt $cpt_obj  instance of a class to access methods.
	 */
	public function __construct( $cpt_obj ) {
		add_action( 'init', array( $cpt_obj, 'custom_post_type_book' ), 0 );
		add_action( 'init', array( $cpt_obj, 'custom_taxonomy_book_category' ), 0 );
		add_action( 'init', array( $cpt_obj, 'custom_taxonomy_book_tag' ), 0 );
		add_action( 'wp_enqueue_scripts', array( $this, 'custom_assets' ), 0 );

		// Hook: add_meta_boxes_<custom_post_typr>.
		add_action( 'add_meta_boxes_book', array( $this, 'custom_meta_box_book_meta' ), 0 );
	}


	/************************************************
	 * Creation of custom post type.
	 ***********************************************/


	/************************************************
	 * Creation of custom taxanomies
	 ***********************************************/

	/**
	 * Function to create custom hierarchical  taxonomy named Book Category
	 *
	 * @return void
	 */
	public function custom_taxonomy_book_category() {
		$labels = array(
			'name'          => _x( 'Category', 'taxonomy general name', 'dm - book' ),
			'singular_name' => _x( 'Category', 'taxonomy singular name', 'dm - book' ),
			'search_items'  => __( 'Search Category', 'dm - book' ),
			'all_items'     => __( 'All Categories', 'dm - book' ),
			'edit_item'     => __( 'Edit Category', 'dm - book' ),
			'view_item'     => __( 'View Category', 'dm - book' ),
			'all_items'     => __( 'All Categories', 'dm - book' ),
			'search_items'  => __( 'Search Categories', 'dm - book' ),
			'update_item'   => __( 'Update Category', 'dm - book' ),
			'add_new_item'  => __( 'Add Category', 'dm - book' ),
			'new_item_name' => __( 'Category Name', 'dm - book' ),
			'menu_name'     => __( 'Book Category', 'dm - book' ),
		);
		$args   = array(
			'labels'             => $labels,
			'description'        => __( 'Categories of books', 'dm - book' ),
			'hierarchical'       => true,
			'public '            => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => true,
			'show_tagcloud'      => true,
			'show_in_quick_edit' => true,
			'show_admin_column'  => true,
		);
		register_taxonomy( 'book_category', array( 'book' ), $args );

	}

	/**
	 * Function to create custom non-hierarchical  taxonomy named Book Tag
	 *
	 * @return void
	 */
	public function custom_taxonomy_book_tag() {
		$labels = array(
			'name'          => _x( 'Tag', 'taxonomy general name', 'dm - book' ),
			'singular_name' => _x( 'Tag', 'taxonomy singular name', 'dm - book' ),
			'search_items'  => __( 'Search Tag', 'dm - book' ),
			'all_items'     => __( 'All Tags', 'dm - book' ),
			'edit_item'     => __( 'Edit Tag', 'dm - book' ),
			'update_item'   => __( 'Update Tag', 'dm - book' ),
			'add_new_item'  => __( 'Add new Tag', 'dm() - book' ),
			'new_item_name' => __( 'new Tag Name', 'dm() - book' ),
			'menu_name'     => __( 'Book Tag', 'dm - book' ),
		);
		$args   = array(
			'labels'             => $labels,
			'description'        => __( 'Diffrent tags of book you might want to add . ', 'dm - book' ),
			'hierarchical'       => false,
			'public '            => true,
			'publicly_queryable' => false,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => true,
			'show_tagcloud'      => true,
			'show_in_quick_edit' => true,
			'show_admin_column'  => true,
		);
		register_taxonomy( 'book_tag', array( 'book' ), $args );

	}

	/************************************************
	 * Creation of Custom Meta Box for books.
	 ***********************************************/



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
		wp_enqueue_style( 'dm - wp - book - style - id', plugin_dir_url( __FILE__ ) . 'includes / dm - wp - book - stylesheet . css', null, '1.0.0' );

	}

}

if ( class_exists( 'DmWpBook' ) ) {
	global $dm_wp_book;
	$dm_wp_book = new DmWpBook( $cpt_obj );
}
// Stating that this is the activation function.
register_activation_hook( __FILE__, array( $dm_wp_book, 'activate' ) );

// Stating that this is the deactivation function.
register_deactivation_hook( __FILE__, array( $dm_wp_book, 'deactivate' ) );



