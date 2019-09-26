<?php
/**
 * Just another plugin for books
 *
 * @package dm-wp-book
 * @author  Deep Manek
 */

/**
 * Class to generate custom post type Book
 */
class DmWpBookCpt {

	/**
	 * Function to register a post type.
	 *
	 * @return void
	 */
	public function custom_post_type_book() {

		$labels = array(
			'name'               => _x( 'Books', 'post type general name', 'dm-book' ),
			'singular_name'      => _x( 'Book', 'post type singular name', 'dm-book' ),
			'menu_name'          => _x( 'Books', 'admin menu', 'dm-book' ),
			'name_admin_bar'     => _x( 'Book', 'add new on admin bar', 'dm-book' ),
			'add_new'            => _x( 'Add New', 'book', 'dm-book' ),
			'add_new_item'       => __( 'Add New Book', 'dm-book' ),
			'new_item'           => __( 'New Book', 'dm-book' ),
			'edit_item'          => __( 'Edit Book', 'dm-book' ),
			'view_item'          => __( 'View Book', 'dm-book' ),
			'all_items'          => __( 'All Books', 'dm-book' ),
			'search_items'       => __( 'Search Books', 'dm-book' ),
			'parent_item_colon'  => __( 'Parent Books:', 'dm-book' ),
			'not_found'          => __( 'No books found.', 'dm-book' ),
			'not_found_in_trash' => __( 'No books found in Trash.', 'dm-book' ),
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Description.', 'dm-book' ),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'book' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'menu_icon'          => 'dashicons-book',
			'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
		);

		register_post_type(
			'book',
			$args
		);

	}
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

}
