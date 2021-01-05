<?php
/*
 * Plugin Name: Practice
 * Plugin URI: https://www.fiverr.com/shariq619
 * Description: Practice of all important wordpress code
 * Author: Muhammad Shariq Ali
 * Author URI: http://muhammadshariqali.com
 * Text Domain: practice
 */

define('OPTIONS_PAGE_NAME','my-options-page');

Class Practice {

    public function __construct()
    {
        $this->register_settings_and_fields();
    }

	public function add_menu_page()
    {
	    add_options_page(
		    'My Options Page',
		    'My Options Page',
		    'administrator',
		    'my-options-page',
            array('Practice','display_options_page'));
    }

	public function display_options_page()
    {
		?>
        <div class="wrap">
            <h1>My Options Page</h1>
            <form action="options.php" method="post" enctype="multipart/form-data">
                <?php settings_fields('practice_plugin_options'); ?>
                <?php do_settings_sections(OPTIONS_PAGE_NAME); ?>
            </form>
        </div>
		<?php
	}

	public function register_settings_and_fields()
    {
       register_setting('practice_plugin_options','practice_plugin_options');
       add_settings_section('practice_main_section','Main Settings',array($this,'practice_main_section_cb'),OPTIONS_PAGE_NAME);

       add_settings_field('practice_banner_heading','Banner Heading',array($this,'banner_field_cb'),OPTIONS_PAGE_NAME,'practice_main_section');
       add_settings_field('practice_banner_logo','Banner Logo',array($this,'banner_logo_cb'),OPTIONS_PAGE_NAME,'practice_main_section');
	}

	/*
	 * Form Inputs
	 */
	public function banner_field_cb(  )
    {
        echo '<input />';
    }

    public function banner_logo_cb(  )
    {
        echo '<input type="file" />';
    }

	public function practice_main_section_cb(  )
    {
        // optional
    }

}


add_action('admin_menu', function() {
	Practice::add_menu_page();
} );

add_action('admin_init', function(){
    new Practice();
});