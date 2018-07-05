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

function cminusRPF() {
	return cminusRPF::instance();
}
add_action( 'plugins_loaded', 'cminusRPF' );

class cminusFieldsBuilder{

	public function getFeilds(){

		// HTML Field
		$htmlField = GF_Fields::get( 'html' );
		$htmlField->label   = 'HTML Block';
		$htmlField->content = "It is a long established fact that a reader will be distracted.";

		// Text Field
		$textField = GF_Fields::get( 'text' );
		$textField->label   = 'Enter a text';

		// Number Field
		$numberField = GF_Fields::get( 'number' );
		$numberField->label   = 'Enter a number';

		// Radio Field
		$radioField = GF_Fields::get( 'radio' );
		$radioField->label   = 'Select your choice';
		$radioField->choices = array(
							    array(
							        'text'          => 'First Choice',
							        'value'         => 'one',
							        'isSelected'    => false,
							        'price'         => '$5.00' //only populated if a product, product option or shipping field
							    ),
							    array(
							        'text'          => 'Second Choice',
							        'value'         => 'two',
							        'isSelected'    => false,
							        'price'         => ''
							    ),
							    array(
							        'text'          => 'Third Choice',
							        'value'         => 'three',
							        'isSelected'    => false,
							        'price'         => ''
							    )
							);

		// Checkbox Field
		$checkboxField = GF_Fields::get( 'checkbox' );
		$checkboxField->label   = 'Select your options';
		$checkboxField->choices = array(
						             array(
						               'text'       => 'First Choice',
						               'value'      => 'one',
						               'isSelected' => false,
						               'price'      => '$5.00' //only populated if a product option field
						             ),
						             array(
						               'text'       => 'Second Choice',
						               'value'      => 'two',
						               'isSelected' => false,
						               'price'      => ''
						             ),
						             array(
						               'text'       => 'Third Choice',
						               'value'      => 'three',
						               'isSelected' => false,
						               'price'      => ''
						             ),
						           );

		// Dropdown Field
		$dropdownField = GF_Fields::get( 'select' );
		$dropdownField->label   = 'Select your value';
		$dropdownField->choices = array(
						             array(
						               'text'       => 'First Choice',
						               'value'      => 'one',
						               'isSelected' => false,
						               'price'      => '$5.00' //only populated if a product, product option, shipping field
						             ),
						             array(
						               'text'       => 'Second Choice',
						               'value'      => 'two',
						               'isSelected' => true,
						               'price'      => ''
						             ),
						             array(
						               'text'       => 'Third Choice',
						               'value'      => 'three',
						               'isSelected' => false,
						               'price'      => ''
						             ),
						           );

		// Date Field
		$dateField = GF_Fields::get( 'date' );
		$dateField->label   = 'Enter date';
		$dateField->dateType = 'calendar';

		// Push feilds into an Array
		$fields[] = $htmlField;
		$fields[] = $textField;
		$fields[] = $numberField;
		$fields[] = $radioField;
		$fields[] = $checkboxField;
		$fields[] = $dropdownField;
		$fields[] = $dateField;

		return $fields;
	}

}


class cminusRPF{

	private static $_instance = null;

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

			if( empty( $fields->getFeilds() ) ){
				die();
			}

			foreach( $fields->getFeilds() as $key => $value ){
				$value->id = $key+1;
				$tempFields[] = $value;
			}

			echo "<pre>";

				print_r( $tempFields );

			echo "</pre>";

			die();

			$form = array(
						'title'       => 'Dynamic Form',
						'description' => 'Dynamic Form',
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

    		$formObj = array(
					'title'       => 'Dynamic Form',
					'description' => 'Dynamic Form',
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
