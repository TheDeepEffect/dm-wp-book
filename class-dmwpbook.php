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

/**
 * DmWpBook is a basic class for now.
 */
class DmWpBook {

	/**
	 * Construction to call procedures like add_action() to hook our plugin as we can not do that in class directly.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'custom_post_type_book' ), 0 );
		add_action( 'init', array( $this, 'custom_taxonomy_book_category' ), 0 );
		add_action( 'init', array( $this, 'custom_taxonomy_book_tag' ), 1 );
	}


	/************************************************
	 * Creation of custom post type.
	 ***********************************************/

	/**
	 * Function to register a post type.
	 *
	 * @return void
	 */
	public function custom_post_type_book() {
		register_post_type(
			'book',
			array(
				'public'    => true,
				'label'     => 'Book',
				'menu_icon' => 'dashicons-book',
			)
		);

	}

	/************************************************
	 * Creation of custom taxanomies
	 ***********************************************/

	/**
	 * Method to create custom hierarchical  taxonomy named Book Category
	 *
	 * @return void
	 */
	public function custom_taxonomy_book_category() {
		$labels = array(
			'name'          => _x( 'Category', 'taxonomy general name', 'dm-book' ),
			'singular_name' => _x( 'Category', 'taxonomy singular name', 'dm-book' ),
			'search_items'  => __( 'Search Category', 'dm-book' ),
			'all_items'     => __( 'All Categories', 'dm-book' ),
			'edit_item'     => __( 'Edit Category', 'dm-book' ),
			'update_item'   => __( 'Update Category', 'dm-book' ),
			'add_new_item'  => __( 'Add Category', 'dm-book' ),
			'new_item_name' => __( 'Category Name', 'dm-book' ),
			'menu_name'     => __( 'Book Category', 'dm-book' ),
		);
		$args   = array(
			'labels'             => $labels,
			'description'        => __( 'Categories of books', 'dm-book' ),
			'hierarchical'       => true,
			'public'             => true,
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
	 * Method to create custom non-hierarchical  taxonomy named Book Tag
	 *
	 * @return void
	 */
	public function custom_taxonomy_book_tag() {
		$labels = array(
			'name'          => _x( 'Tag', 'taxonomy general name', 'dm-book' ),
			'singular_name' => _x( 'Tag', 'taxonomy singular name', 'dm-book' ),
			'search_items'  => __( 'Search Tag', 'dm-book' ),
			'all_items'     => __( 'All Tags', 'dm-book' ),
			'edit_item'     => __( 'Edit Tag', 'dm-book' ),
			'update_item'   => __( 'Update Tag', 'dm-book' ),
			'add_new_item'  => __( 'Add New Tag', 'dm-book' ),
			'new_item_name' => __( 'New Tag Name', 'dm-book' ),
			'menu_name'     => __( 'Book Tag', 'dm-book' ),
		);
		$args   = array(
			'labels'             => $labels,
			'description'        => __( 'Diffrent tags of book you might want to add.', 'dm-book' ),
			'hierarchical'       => false,
			'public'             => true,
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
	 * Activation Deactivation and Uninstallation
	 ***********************************************/

	/**
	 * Function that works on activation of plugin
	 *
	 * @return void
	 */
	public function activate() {

		// Generate a custom post type.
		$this->custom_post_type_book();
		$this->custom_taxonomy_book_category();
		$this->custom_taxonomy_book_tag();

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

// Stating that this is the activation method.
register_activation_hook( __FILE__, array( $dm_wp_book, 'activate' ) );

// Stating that this is the deactivation method.
register_deactivation_hook( __FILE__, array( $dm_wp_book, 'deactivate' ) );
