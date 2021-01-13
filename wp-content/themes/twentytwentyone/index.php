<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();

if ( have_posts() ) {

	$first_name     = 'using_variable';
	$last_name      = 'second_variable';
	$e_address       = 'janedoe@gmail.com';

	//echo do_shortcode('[get-cc-lists]');
	//echo do_shortcode('[cc first_name="'.$first_name.'" last_name="'.$last_name.'" email="'.$e_address.'"]');
	echo do_shortcode('[carousel]');

	// Load posts loop.
	while ( have_posts() ) {
		the_post();

		get_template_part( 'template-parts/content/content', get_theme_mod( 'display_excerpt_or_full_post', 'excerpt' ) );
	}

	// Previous/next page navigation.
	twenty_twenty_one_the_posts_navigation();

} else {

	// If no content, include the "No posts found" template.
	get_template_part( 'template-parts/content/content-none' );

}

get_footer();
