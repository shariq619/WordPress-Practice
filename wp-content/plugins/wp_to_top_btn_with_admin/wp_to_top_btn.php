<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/*
Plugin Name: WP To Top with Admin
Plugin URI: https://xxxxxx.com/totop
Description: This plugin will place "to top" button.
Author: Kazuki Yanamoto
Version: 1.0.0
License: GPLv2 or later
*/

class WpToTopBtn
{
	public $plugins_url = "";

    public function __construct()
    {
        // Plugin is activated
        if (function_exists('register_activation_hook')) {
            register_activation_hook(__FILE__, array($this, 'activationHook'));
        }
        //Plugin is deactivated
        if (function_exists('register_deactivation_hook')) {
            register_deactivation_hook(__FILE__, array($this, 'deactivationHook'));
        }
        //Plugin is deleted
        if (function_exists('register_uninstall_hook')) {
            register_uninstall_hook(__FILE__, 'uninstallHook');
        }
        //header hook
        add_action('wp_head', array($this, 'filter_header'));

       //footer hook
        add_filter('wp_footer', array($this, 'filter_footer'));

        //init
        add_action('init', array($this, 'init'));

		//admin page
        add_action('admin_menu', array($this, 'Wp_to_top_admin_menu'));

    }

     //init
     public function init()
     {
         $this->plugins_url = untrailingslashit(plugins_url('', __FILE__));
     }
	 //Include the admin page
     public function Wp_to_top_admin_menu()
     {
         add_options_page('WP To Top', 'WP To Top setting' , 'manage_options' , 'WP_To_Top_admin_menu',array($this, 'to_top_edit_setting'));
     }
	 //Link the admin page
	 public function to_top_edit_setting()
	 {
		 include(sprintf("%s/manage/admin.php", dirname(__FILE__)));
	 }



    // Plugin is activated
    public function activationHook()
    {
		//Input background color of the "To top button"
        if (! get_option('WP_to_top_color')) {
            update_option('WP_to_top_color', 'red');
        }
		//Input the speed of the "To top button"
        if (! get_option('WP_to_top_speed')) {
            update_option('WP_to_top_speed', 'slow');
        }
    }

    // Plugin is deactivated
    public function deactivationHook()
    {
		delete_option('WP_to_top_color');
		delete_option('WP_to_top_speed');
    }

    // Plugin is deleted
    public function uninstallHook()
    {
		delete_option('WP_to_top_color');
		delete_option('WP_to_top_speed');
    }

	// Put stylesheet on to the head section
	public function filter_header()
	{
		include(sprintf("%s/css/to_top_style.php", dirname(__FILE__)));

		// Put jquery on to the head section
		wp_enqueue_script( 'jquery' );
		include(sprintf("%s/js/to_top.php", dirname(__FILE__)));
	}

    // Echo "to top" button on to the footer section
    public function filter_footer()
    {
        ?>
            <div id="To_top_animate" class="To_top_btn"><a href="#" >▲</a></div>
        <?php
    }
}
$WpToTopBtn = new WpToTopBtn();
