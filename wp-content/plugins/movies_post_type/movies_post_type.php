<?php
if( ! defined('ABSPATH')  ) exit;
/*
 * Plugin Name: Movies Post Type
 * Plugin URI: https://www.fiverr.com/shariq619
 * Description: Custom Post Type
 * Author: Muhammad Shariq Ali
 * Author URI: http://muhammadshariqali.com
 * Text Domain: mpt
 */

class MPT_Custom_Post_Type {

	public function __construct() {
		$this->register_custom_post();
		$this->taxonomies();
		$this->metaboxes();
	}

	public function register_custom_post() {
		$labels = array(
			'name'                  => _x( 'Movies', 'Post type general name', 'mpt' ),
			'singular_name'         => _x( 'Movie', 'Post type singular name', 'mpt' ),
			'menu_name'             => _x( 'Movies', 'Admin Menu text', 'mpt' ),
			'name_admin_bar'        => _x( 'Movie', 'Add New on Toolbar', 'mpt' ),
			'add_new'               => __( 'Add New', 'mpt' ),
			'add_new_item'          => __( 'Add New Movie', 'mpt' ),
			'new_item'              => __( 'New Movie', 'mpt' ),
			'edit_item'             => __( 'Edit Movie', 'mpt' ),
			'view_item'             => __( 'View Movie', 'mpt' ),
			'all_items'             => __( 'All Movies', 'mpt' ),
			'search_items'          => __( 'Search Movies', 'mpt' ),
			'parent_item_colon'     => __( 'Parent Movies:', 'mpt' ),
			'not_found'             => __( 'No Movies found.', 'mpt' ),
			'not_found_in_trash'    => __( 'No Movies found in Trash.', 'mpt' ),
			'featured_image'        => _x( 'Movie Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'mpt' ),
			'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'mpt' ),
			'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'mpt' ),
			'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'mpt' ),
			'archives'              => _x( 'Movie archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'mpt' ),
			'insert_into_item'      => _x( 'Insert into movie', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'mpt' ),
			'uploaded_to_this_item' => _x( 'Uploaded to this movie', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'mpt' ),
			'filter_items_list'     => _x( 'Filter movies list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'mpt' ),
			'items_list_navigation' => _x( 'Movies list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'mpt' ),
			'items_list'            => _x( 'Movies list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'mpt' ),
		);
		$args   = array(
			'labels'             => $labels,
			'description'        => 'Movie custom post type.',
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'movies' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'menu_position'      => 5,
			'menu_icon'          => admin_url() . 'images/media-button-video.gif',
			'supports'           => array( 'title', 'excerpt', 'thumbnail' )
		);
		register_post_type( 'movie', $args );
	}

	public function taxonomies() {
		$taxonomies = array();

		$taxonomies['genre'] = array(
			'hierarchical' => true,
			'query_var'    => 'movie_genre',
			'rewrite'      => array( 'slug' => 'movies/genre' ),
			'labels'       => array(
				'name'                  => _x( 'Genre', 'Post type general name', 'mpt' ),
				'singular_name'         => _x( 'Genre', 'Post type singular name', 'mpt' ),
				'menu_name'             => _x( 'Genre', 'Admin Menu text', 'mpt' ),
				'name_admin_bar'        => _x( 'Genre', 'Add New on Toolbar', 'mpt' ),
				'add_new'               => __( 'Add New', 'mpt' ),
				'add_new_item'          => __( 'Add New Genre', 'mpt' ),
				'new_item'              => __( 'New Genre', 'mpt' ),
				'edit_item'             => __( 'Edit Genre', 'mpt' ),
				'view_item'             => __( 'View Genre', 'mpt' ),
				'all_items'             => __( 'All Genre', 'mpt' ),
				'search_items'          => __( 'Search Genre', 'mpt' ),
				'parent_item_colon'     => __( 'Parent Genre:', 'mpt' ),
				'not_found'             => __( 'No Genre found.', 'mpt' ),
				'not_found_in_trash'    => __( 'No Genre found in Trash.', 'mpt' ),
				'featured_image'        => _x( 'Genre Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'mpt' ),
				'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'mpt' ),
				'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'mpt' ),
				'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'mpt' ),
				'archives'              => _x( 'Genre archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'mpt' )
			)
		);

		$taxonomies['studio'] = array(
			'hierarchical' => true,
			'query_var'    => 'movie_studio',
			'rewrite'      => array( 'slug' => 'movies/studios' ),
			'labels'       => array(
				'name'                  => _x( 'Studio', 'Post type general name', 'mpt' ),
				'singular_name'         => _x( 'Studio', 'Post type singular name', 'mpt' ),
				'menu_name'             => _x( 'Studio', 'Admin Menu text', 'mpt' ),
				'name_admin_bar'        => _x( 'Studio', 'Add New on Toolbar', 'mpt' ),
				'add_new'               => __( 'Add New', 'mpt' ),
				'add_new_item'          => __( 'Add New Studio', 'mpt' ),
				'new_item'              => __( 'New Studio', 'mpt' ),
				'edit_item'             => __( 'Edit Studio', 'mpt' ),
				'view_item'             => __( 'View Studio', 'mpt' ),
				'all_items'             => __( 'All Studio', 'mpt' ),
				'search_items'          => __( 'Search Studio', 'mpt' ),
				'parent_item_colon'     => __( 'Parent Studio:', 'mpt' ),
				'not_found'             => __( 'No Studio found.', 'mpt' ),
				'not_found_in_trash'    => __( 'No Studio found in Trash.', 'mpt' ),
				'featured_image'        => _x( 'Studio Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'mpt' ),
				'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'mpt' ),
				'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'mpt' ),
				'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'mpt' ),
				'archives'              => _x( 'Studio archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'mpt' )
			)

		);

		$this->register_all_taxonomies( $taxonomies );
	}

	public function register_all_taxonomies( $taxonomies ) {
		foreach ( $taxonomies as $name => $arr ) {
			register_taxonomy( $name, array( 'movie' ), $arr );
		}
	}

	public function metaboxes() {
		add_action( 'add_meta_boxes', function () {
			add_meta_box( 'movie_length', 'Movie Length', 'movie_length', 'movie' );
		} );

		function movie_length( $post ) {
			$length = get_post_meta( $post->ID, 'movie_length', true );
			?>
            <p>
                <label for="movie_length">Length:</label>
                <input type="text" class="widefat" name="movie_length" value="<?php echo esc_attr( $length ); ?>">
            </p>
			<?php
		}

		add_action( 'save_post', function ( $id ) {
			if ( isset( $_POST['movie_length'] ) ) {
				update_post_meta( $id, 'movie_length', strip_tags( $_POST['movie_length'] ) );
			}
		} );
	}


}

add_action( 'init', function () {
	new MPT_Custom_Post_Type();
} );