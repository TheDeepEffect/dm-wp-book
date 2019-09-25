<?php
/**
 * Just another plugin for books
 *
 * @package dm-wp-book
 * @author  Deep Manek
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die( 'Died because of uninstall dm-wp-book plugin!!' );
}

// Clear database stored data.
$books = get_post(
	array(
		'post_type'   => 'book',
		'numberposts' => -1,
	)
);

foreach ( $books as $book ) {
	wp_delete_post( $book->ID, true );
}
