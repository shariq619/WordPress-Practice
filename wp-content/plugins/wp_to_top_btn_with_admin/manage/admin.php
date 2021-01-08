<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/***
 * Admin page
***/
?>
<div class="wrap"><br/>
	<h1>WP To Top <font size="2">v1.0.0</font></h1>
<?php
	 /***
	   * Save button is clicked
	 ***/
 	 $Totop_save = @$_POST['Totop_save'];
     $Totop_save = wp_kses($Totop_save, array());

     if ( isset( $Totop_save )){

        //nonce check
        if ( isset( $_POST['_wpnonce'] ) && $_POST['_wpnonce'] ) {
             if ( check_admin_referer( 'WPtotop_plugin', '_wpnonce' ) ) {
                 //POST variables
                 $WP_to_top_speed = ( @$_POST['WP_to_top_speed'] == 'fast' )? 'fast' : 'slow';
                     //Register to the database
                     update_option('WP_to_top_speed', $WP_to_top_speed);

                 $WP_to_top_color = ( @$_POST['WP_to_top_color'] == 'blue' )? 'blue' : 'red';
                     //Register to the database
                     update_option('WP_to_top_color', $WP_to_top_color);
             }
        }
     }
     /***
 	 * Receiving the data
 	***/
 	//Registered data
 	$WP_to_top_speed = get_option('WP_to_top_speed');
 	$WP_to_top_color = get_option('WP_to_top_color');
?>

     <form method="post" id="wp_to_top_form" action="">
 		<?php wp_nonce_field( 'WPtotop_plugin', '_wpnonce' ); ?>

	<table class="form-table">
        <tr valign="top">
            <th width="50" scope="row">To Top Scroll Speed</th>
            <td>
            <input type="radio" name="WP_to_top_speed" value="fast" <?php if($WP_to_top_speed == "fast") echo('checked'); ?> />
            Fast<br /><br />
            <input type="radio" name="WP_to_top_speed" value="slow" <?php if($WP_to_top_speed == "slow") echo('checked'); ?> />
            Slow<br />
            </td>
        </tr>

        <tr valign="top">
            <th width="50" scope="row">To Top Button Color</th>
            <td>
            <input type="radio" name="WP_to_top_color" value="blue" <?php if($WP_to_top_color == "blue") echo('checked'); ?> />
            Blue<br /><br />
            <input type="radio" name="WP_to_top_color" value="red" <?php if($WP_to_top_color == "red") echo('checked'); ?> />
            Red<br />
            </td>
        </tr>

        <tr>
            <th width="50" scope="row">Save this setting</th>
            <td>
            <input type="submit" name="Totop_save" value="Save" /><br />
            </td>
        </tr>

    </table>
    </form>