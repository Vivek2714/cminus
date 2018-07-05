<?php
/*
Plugin Name: RPF 
Plugin URI: 
Description: RPF
Author: Vivek B
Version: 1.0
Author URI: 
*/

if ( ! defined( 'ABSPATH' ) ) exit;

// Fields builder class
include_once("class.fields.php");

function cminusRPF() {
	return cminusRPF::instance();
}
add_action( 'plugins_loaded', 'cminusRPF' );

class cminusRPF{

	private static $_instance = null;

	# @formId in the below string is replaced by dynamic form id 
	public $formTitle = "Brief #formId Response Form";  

	public $formDescription = "example of auto generated form used to gather responses from real estate agents putting forward properties which meet the criteria of the previously generated brief";

	// @form id, where to set notification  
	public $targetFormId = 7;

	public static function instance() {
		if ( is_null( self::$_instance ) )
			self::$_instance = new self();
		return self::$_instance;
	} // End instance()

	public function __construct(){

		// Adding style and script
		add_action( 'wp_enqueue_scripts', array( $this, 'cminusScripts' ) );

		// Modify email notification
		add_filter( 
		  'gform_notification_'.$this->targetFormId, 
		  array( $this, 'set_email_notification' ),
		  10, 3 
		);

		if( isset( $_GET['form_creation'] ) ){

			$fields = new cminusFieldsBuilder();

			$tempFields = array();

			if( empty( $fields->getFeilds( 85 ) ) ){
				die();
			}

			// Adding field id
			foreach( $fields->getFeilds( 85 ) as $key => $value ){
				if( !empty($value) ){
					$value->id = $key+1;
					$tempFields[] = $value;
				}
			}


			//return $fields;

			echo "<pre>";

				print_r( $tempFields );

			echo "</pre>";


			die;

			// Creating form object
			$formId = 20;
			$formTitle = str_replace( 'formId', $formId , $this->formTitle);

			$form = array(
						'title'       => $formTitle,
						'description' => $this->formDescription,
						'fields'      => $tempFields
					);

			$result = GFAPI::add_form( $form );

			if( !empty($result->errors) ){
				die('error');
			}
		}
	}

	// Adding CSS & JS scripts
	public function cminusScripts() {
	    wp_enqueue_style( 'cminus-style', plugin_dir_url( __FILE__ ).'css/style.css' );
	    wp_enqueue_script( 'cminus-script', plugin_dir_url( __FILE__ ).'js/script.js', array(), time(), true );
	}
		
	// send notification to all email addresses with status current and form id 3
	public function set_email_notification( $notification, $form, $entry ) {
		
		// Create a New Office Brief form id
		$targetEntryId = $entry[2];

		if( empty( $targetEntryId ) ){
			return $notification;
		}

		$targetEntry = GFAPI::get_entry( $targetEntryId );

		$emails =$entry[1];

		$emailRecipients = unserialize( $emails );
		
	    // There is no concept of user notifications anymore, so
	    // we will need to target notifications based on other
	    // criteria, such as name
	    if ( $notification['name'] == 'User Notification' && !empty($emailRecipients) ) {

	    	$fields = new cminusFieldsBuilder();

			$tempFields = array();

			if( empty( $fields->getFeilds() ) ){
				return $notification;
			}

			foreach( $fields->getFeilds() as $key => $value ){
				$value->id = $key+1;
				$tempFields[] = $value;
			}

			$formTitle = str_replace( 'formId', $form['id'] , $this->formTitle);

			$form = array(
						'title'       => $formTitle,
						'description' => $this->formDescription,
						'fields'      => $tempFields
					);

			$result = GFAPI::add_form( $formObj );

			if( !empty($result->errors) ){
				return $notification;
			}
	 		
	 		$notification['message'] = get_the_permalink(578)."?fid=".$result;

	        // change the "bcc" email address
	        $notification['to'] = implode( ",", $emailRecipients );
	 
	    }
	    return $notification;
	}

}

?>
