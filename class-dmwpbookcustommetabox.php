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
		add_meta_box( 'dm-wp-book-meta-id', __( 'Book Metadata', 'dm-book' ), array( $this, 'custom_meta_box_render' ), 'book', 'advanced', 'high' );
	}

	/**
	 * Display function for custom book metabox
	 *
	 * @return void
	 */
	public function custom_meta_box_render() {
		wp_nonce_field( basename( __FILE__ ), 'dm_wp_metabox_nonoce', true, true );
		?>
			<div class="main">
				<div class="dm_wp_book_meta_div">
					<p class="dm_wp_book_meta_fields">
					<label for="dm_wp_book_author">Author name :</label>
					<input 
						type="text" 
						name="dm_wp_book_author" 
						placeholder="Author Name..."
						value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'dm_wp_book_author', true ) ); ?>"
					/>
					</p>
					<p class="dm_wp_book_meta_fields">
							<label for="dm_wp_book_price">Price :</label>
							<input 
								type="number"
								min="0"
								step="0.01"
								name="dm_wp_book_price" 
								placeholder="Price"
								value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'dm_wp_book_price', true ) ); ?>"
							/>
					</p>
					<p class="dm_wp_book_meta_fields">
							<label for="dm_wp_book_publisher">Publisher :</label>
							<input 
								type="text"
								name="dm_wp_book_publisher"
								placeholder="Publisher"
								value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'dm_wp_book_publisher', true ) ); ?>"
							/>
					</p>
					<p class="dm_wp_book_meta_fields">
						<label for="dm_wp_book_year">Year :</label>
						<select id="dm_wp_book_year" name="dm_wp_book_year">
							<option value="-1" selected>
								<?php
								if ( get_post_meta( get_the_ID(), 'dm_wp_book_year', true ) == '-1' ) {
									echo 'Year';
								} else {
									echo esc_attr( get_post_meta( get_the_ID(), 'dm_wp_book_year', true ) );}
								?>
							</option>
						</select>
					</p>
					<p class="dm_wp_book_meta_fields">
						<label for="dm_wp_book_edition">Edition :</label>
						<input 
							type="text" 
							id="dm_wp_book_edition" 
							name="dm_wp_book_edition" 
							placeholder="edition"
							value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'dm_wp_book_edition', true ) ); ?>"
						/>
					</p>
					<p class="dm_wp_book_meta_fields">
						<label for="dm_wp_book_url">URL :</label>
						<input 
							type="url"
							id="dm_wp_book_url" 
							name="dm_wp_book_url" 
							placeholder="URL"
							value="<?php echo esc_attr( get_post_meta( get_the_ID(), 'dm_wp_book_url', true ) ); ?>"
						/>
					</p>
				</div>
			</div>

		<?php
	}

	/**
	 * Saves the info from meta box.
	 *
	 * @param integer $post_id  post_id to access the posts.
	 * @param post    $post post.
	 * @return mixed
	 */
	public function custom_meta_box_save( $post_id, $post ) {

		// Verification of nonce.
		if ( ( ! isset( $_POST['dm_wp_metabox_nonoce'] ) ) || ( ! wp_verify_nonce( $_POST['dm_wp_metabox_nonoce'], basename( __FILE__ ) ) ) ) { //phpcs:ignore
			echo 'error error error error error errror error';
			return $post_id;	// phpcs:ignore
		}

		// Verification of post slug.
		$post_slug = 'book';
		if ( $post_slug !== $post->post_type ) {
			return;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		if ( wp_is_post_revision( $post_id ) ) {
			return;
		}

		$fields = array(
			'dm_wp_book_author',
			'dm_wp_book_price',
			'dm_wp_book_publisher',
			'dm_wp_book_year',
			'dm_wp_book_edition',
			'dm_wp_book_url',
		);

		/************************************
		* Saving values to db.
		*/
		foreach ( $fields as $field ) {
			if ( isset( $_POST[ $field ] ) ) {
				update_post_meta( $post_id, $field, sanitize_text_field( wp_unslash( $_POST[ $field ] ) ) );
			}
		}

	}

}
