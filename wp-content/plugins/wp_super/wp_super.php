<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/*
 * Plugin Name:         WP Super
 * Plugin URI:          https://www.fiverr.com/shariq619
 * Description:         A simple plugin
 * Version:             1.0.0
 * Author:              Muhammad Shariq Ali
 * Author URI:          http://muhammadshariqali.com
 * License:             GPLv2 or later
 * Text Domain:         ws
 */

class WpSuper
{
	public $plugins_url = '';

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
		//add_action('wp_head', array($this, 'filter_header'));

		add_action( 'wp_enqueue_scripts', array($this, 'wp_super_scripts') );

		//footer hook
		add_action('wp_footer', array($this, 'filter_footer'));

		//init
		add_action('init', array($this, 'init'));

	}

	//init
	public function init()
	{
	    $this->plugins_url = untrailingslashit(plugins_url('', __FILE__));
	}

	// Plugin is activated
	public function activationHook()
	{
		//Input word "Super!" to the database
		if (! get_option('wp_Super')) {
			update_option('wp_Super', 'Super!');
		}
	}
	// Plugin is deactivated
	public function deactivationHook()
	{
		delete_option('wp_Super');
	}
	// Plugin is uninstalled
	public function uninstallHook()
	{
		delete_option('wp_Super');
	}
	// Put stylesheet on to the ≪head section≫
	public function wp_super_scripts()
	{
		wp_enqueue_style( 'super-link-css', $this->plugins_url.'/css/super_style.css', array());
		wp_enqueue_script('super-script',$this->plugins_url.'/js/my.js',array('jquery'),'', true);
	}

	// Echo "Super!" on to the footer section
	public function filter_footer()
	{
		$wp_super = get_option( 'wp_Super' );
		?>
		<div id="super"><?php echo $wp_super; ?></div>
		<?php
	}
}
$WpSuper = new WpSuper();