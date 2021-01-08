<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*
 * Plugin Name:             Simple Carousel
 * Plugin Uri:              https://fiverr.com/shariq619
 * Description:             A simple carousel wordpress plugin
 * Author:                  Muhammad Shariq Ali
 * Version:                 1.0.0
 * License:                 GPLv2 or later
 * Text-domain:             simple-carousel
 */

class Carousel {

	public $plugin_url      = "";
	public $content         = "";
	public $wp_to_top_speed = "";

	public function __construct() {
		// plugin url
		$this->plugin_url = untrailingslashit( plugins_url( '', __FILE__ ) );

		// carousel seed
		$this->wp_to_top_speed = get_option('WP_to_top_speed');

		// enqueue scripts
		add_action( 'wp_enqueue_scripts', array( $this, 'CarouselScripts' ) );

		// shortcode
		add_shortcode( 'carousel', array( $this, 'CarouselCb' ) );
	}

	public function CarouselScripts()
	{
		// css scripts
		wp_enqueue_style( 'carousel-css-style', $this->plugin_url . '/css/carousel.css' );
		wp_enqueue_style( 'carousel-css-responsive', $this->plugin_url . '/css/carousel.responsive.css' );


		$css = '.jcarousel-pagination a.visited{ background: #fff; color: #fff; opacity: 1; }';
		wp_add_inline_style('carousel-css-responsive', $css);

		// js scripts
		wp_enqueue_script( 'carousel-js-script', $this->plugin_url . '/js/jquery.carousel.min.js', array( 'jquery' ), '' );
		wp_enqueue_script( 'carousel-js-responsive', $this->plugin_url . '/js/carousel.responsive.js', array( 'jquery' ), '' );

		// pass data to js script using object with array
		wp_localize_script('carousel-js-responsive','carousel_api',array('animation'=>$this->wp_to_top_speed));
	}

	public function CarouselCb()
	{
		$this->content .= '<div class="wrapper entry-content">';
		$this->content .= '<div class="jcarousel-wrapper">';
		$this->content .= '<div class="jcarousel">';
		$this->content .= '<ul>';
		$this->content .= '<li><img src="' . plugins_url( 'images/img1.jpg', __FILE__ ) . '" alt="Image 1"></li>';
		$this->content .= '<li><img src="' . plugins_url( 'images/img2.jpg', __FILE__ ) . '" alt="Image 2"></li>';
		$this->content .= '<li><img src="' . plugins_url( 'images/img3.jpg', __FILE__ ) . '" alt="Image 3"></li>';
		$this->content .= '<li><img src="' . plugins_url( 'images/img4.jpg', __FILE__ ) . '" alt="Image 4"></li>';
		$this->content .= '<li><img src="' . plugins_url( 'images/img5.jpg', __FILE__ ) . '" alt="Image 5"></li>';
		$this->content .= '<li><img src="' . plugins_url( 'images/img6.jpg', __FILE__ ) . '" alt="Image 6"></li>';
		$this->content .= '</ul>';
		$this->content .= '</div>';
		$this->content .= '<a href="#" class="jcarousel-control-prev">&lsaquo;</a>';
		$this->content .= '<a href="#" class="jcarousel-control-next">&rsaquo;</a>';
		$this->content .= '<p class="jcarousel-pagination"></p>';
		$this->content .= '</div>';
		$this->content .= '</div>';

		return $this->content;
	}
}

$carousel = new Carousel();