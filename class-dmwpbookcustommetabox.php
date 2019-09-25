<?php
/**
 * Just another plugin for books
 *
 * @package dm-wp-book
 * @author  Deep Manek
 */

/**
 * Class to create custom meta box.
 */
class DmWpBookCustomMetabox {
	/**
	 * Function to create custom meta box for books to add book Author,Price URL etc.
	 *
	 * @return void
	 */
	public function custom_meta_box_book_meta() {
		add_meta_box( 'dm - wp - book - meta - id', __( 'Book Metadata', 'dm - book' ), array( $this, 'custom_meta_box_render' ), 'book', 'advanced', 'high' );
	}

	/**
	 * Display function for custom book metabox
	 *
	 * @return void
	 */
	public function custom_meta_box_render() {
		// A.
		?>
			<div class="main">
				<div class="dm-wp-book-meta-div">
					<style scoped>
						.dm-wp-book-meta-div{
							display:grid;
							grid-template-columns: max-content 1fr;
							grid-row-gap: 0.1vw;
							grid-column-gap: 0.2vh;
						}
						.dm-wp-book-meta-fields{
							display: contents;
						}
					</style>
					<p class="dm-wp-book-meta-fields">
					<label for="dwm-wp-book-author">Author name :</label>
					<input type="text" name="dm-wp-book-aurhor" placeholder="Author Name..." />
					</p>
					<p class="dm-wp-book-meta-fields">
							<label for="dwm-wp-book-price">Price :</label>
							<input type="number" name="dm-wp-book-price" placeholder="Price" />
					</p>
					<p class="dm-wp-book-meta-fields">
							<label for="dwm-wp-book-publisher">Publisher :</label>
							<input type="text" name="dm-wp-book-publisher" placeholder="Publisher" />
					</p>
					<p class="dm-wp-book-meta-fields">
						<label for="dm-wp-book-year">Year :</label>
						<select id="dm-wp-book-year" name="dm-wp-book-year">
							<option value="-1" selected>Year</option>
						</select>
					</p>
					<p class="dm-wp-book-meta-fields">
						<label for="dm-wp-book-edition">Edition :</label>
						<input type="number"id="dm-wp-book-edition" name="dm-wp-book-edition" placeholder="edition" />
					</p>
					<p class="dm-wp-book-meta-fields">
						<label for="dm-wp-book-url">URL :</label>
						<input type="url"id="dm-wp-book-url" name="dm-wp-book-url" placeholder="URL" />
					</p>
				</div>
			</div>

		<?php
	}

	/**
	 * Saves the info from meta box.
	 *
	 * @param any $post_id  post_id to access the field values.
	 * @return void
	 */
	public function custom_meta_box_save( $post_id ) {

	}

}
