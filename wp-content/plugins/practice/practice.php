<?php
/*
 * Plugin Name: Practice
 * Plugin URI: https://www.fiverr.com/shariq619
 * Description: Practice of all important wordpress code
 * Author: Muhammad Shariq Ali
 * Author URI: http://muhammadshariqali.com
 * Text Domain: practice
 */

define( 'PAGE_SLUG', 'my-options-page' );

class Practice {

	public $options;

	public function __construct() {
	    //delete_option('practice_plugin_options');
		$this->options = get_option( 'practice_plugin_options' );
		$this->register_settings_and_fields();
	}

	public function add_menu_page() {
		add_options_page(
			'My Options Page',
			'My Options Page',
			'administrator',
			'my-options-page',
			array( 'Practice', 'display_options_page' ) );
	}

	public function display_options_page() {
		?>
        <div class="wrap">
            <h1>My Options Page</h1>
            <form action="options.php" method="post" enctype="multipart/form-data">
				<?php settings_fields( 'practice_plugin_options' ); ?>
				<?php do_settings_sections( PAGE_SLUG ); ?>
                <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes"></p>
            </form>
        </div>
		<?php
	}

	public function register_settings_and_fields() {
		register_setting( 'practice_plugin_options', 'practice_plugin_options', array($this,'validate_setting_cb') );
		add_settings_section( 'practice_main_section', 'Main Settings', array($this,'practice_main_section_cb'), PAGE_SLUG );

		add_settings_field( 'practice_banner_heading', 'Banner Heading', array($this,'banner_field_cb'), PAGE_SLUG, 'practice_main_section' );
		add_settings_field( 'practice_banner_logo', 'Banner Logo', array($this,'banner_logo_cb'), PAGE_SLUG, 'practice_main_section' );
		add_settings_field( 'practice_banner_color', 'Banner Logo', array($this,'banner_color_cb'), PAGE_SLUG, 'practice_main_section' );
	}

	/*
	 * Form Inputs
	 */
	public function banner_field_cb() {

		echo "<input name='practice_plugin_options[practice_banner_heading]' type='text' value='{$this->options['practice_banner_heading']}' />";

	}

	public function banner_logo_cb() {
		echo "<input type='file' name='banner_logo_upload'  /><br/><br/>";
		if( isset($this->options['practice_banner_logo']) ){
		    echo "<img src='{$this->options['practice_banner_logo']}' width='525' height='351' />";
		}
	}
	public function banner_color_cb() {
		$colors  = array ('Red','Yellow','Blue');
		echo "<select name='practice_plugin_options[practice_banner_color]' >";
		    foreach($colors as $color){
		        $selected = (  $this->options['practice_banner_color'] === $color ) ? 'selected="selected"' : '';
		        echo "<option value='{$color}' {$selected}>{$color}</option>";
		    }
		echo "</select>";
	}

	public function practice_main_section_cb() {
		// optional
	}

	public function validate_setting_cb($plugin_options)
    {
		if( !empty($_FILES['banner_logo_upload']['tmp_name'])){
			$override = array('test_form' => false);
		    $file = wp_handle_upload($_FILES['banner_logo_upload'], $override);
			$plugin_options['practice_banner_logo'] = $file['url'];
		} else {
			$plugin_options['practice_banner_logo'] = $this->options['practice_banner_logo'];
		}
	    return $plugin_options;
	}

}


add_action( 'admin_menu', function () {
	Practice::add_menu_page();
} );

add_action( 'admin_init', function () {
	new Practice();
} );