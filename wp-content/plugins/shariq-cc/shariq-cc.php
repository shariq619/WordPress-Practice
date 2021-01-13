<?php
if( ! defined('ABSPATH')  ) exit;
/*
 * Plugin Name: ShariQ Constant Contact Plugin
 * Plugin URI: https://www.fiverr.com/shariq619
 * Description: Add a contact shortcode
 * Author: Muhammad Shariq Ali
 * Author URI: https://www.fiverr.com/shariq619
 * Text Domain: practice
 */

require_once 'src/Ctct/autoload.php';
require_once 'vendor/autoload.php';

use Ctct\ConstantContact;
use Ctct\Components\Contacts\Contact;
use Ctct\Exceptions\CtctException;

// Enter your Constant Contact APIKEY and ACCESS_TOKEN
define("APIKEY", "rusb7h58kj68275b323pbhbt");
define("ACCESS_TOKEN", "8886e5df-6752-4e04-8745-52904ac6fff6");

class ShariQCC {

	public function __construct()
	{
		add_shortcode('cc',array($this,'cc_cb'));
		add_shortcode('get-cc-lists',array($this,'get_cc_lists'));
	}

	public function cc_cb($atts)
	{
		$atts = shortcode_atts( array(
			'first_name'    => 'John_'.rand(10,100),
			'last_name'     => 'Doe_'.rand(10,100),
			'email'         => 'Default_email_'.rand(10,100).'@gmail.com',
		), $atts, 'cc' );

		$cc = new ConstantContact(APIKEY);

		try {
			$first_name = $atts['first_name'];
			$last_name  = $atts['last_name'];
			$email 		= $atts['email'];

			// check to see if a contact with the email address already exists in the account
			$response = $cc->contactService->getContacts(ACCESS_TOKEN, array("email" => $email));

			// create a new contact if one does not exist
			if (empty($response->results)) {
				$contact = new Contact();
				$contact->addEmail($email);
				$contact->addList('1602803785');
				$contact->first_name = $first_name;
				$contact->last_name = $last_name;
				$returnContact = $cc->contactService->addContact(ACCESS_TOKEN, $contact);
			}
		} catch (CtctException $ex) {
			return print_r($ex->getErrors(),true);
			wp_die();
		}
	}

	public function get_cc_lists(  )
	{
		$cc = new ConstantContact(APIKEY);
		// attempt to fetch lists in the account, catching any exceptions and printing the errors to screen
		try {
			$lists = $cc->listService->getLists(ACCESS_TOKEN);
			foreach($lists as $list){
				echo $list->id.' - '.$list->name.'<br/>';
			}
		} catch (CtctException $ex) {
			foreach ($ex->getErrors() as $error) {
				print_r($error);
			}
			if (!isset($lists)) {
				$lists = null;
			}
		}

	}

}

$ShariQCC = new ShariQCC();