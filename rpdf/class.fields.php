<?php

class cminusFieldsBuilder{

	public function getFeilds( $targetEntry ){

		if( empty($targetEntry) ){
			return array();
		}

		$entry = GFAPI::get_entry($targetEntry);

		/*
		* Static fields
		*/

		// Agent Details 
		$agentDetails = GF_Fields::get( "section" );
		$agentDetails->label   = "Agent Details";

		// Contact Name
		$contactName = GF_Fields::get( "name" );
		$contactName->label   = "Contact Name";

		// Contact Phone
		$contactPhone = GF_Fields::get( "phone" );
		$contactPhone->label   = "Contact Phone";
		$contactPhone->phoneFormat = "international";

		// Contact Email
		$contactEmail = GF_Fields::get( "email" );
		$contactEmail->label   = "Contact Email";

		// Company / Branch / Office
		$company = GF_Fields::get( "text" );
		$company->label   = "Company / Branch / Office";

		// Responses to Brief Criteria
		$responses = GF_Fields::get( "section" );
		$responses->label   = "Responses to Brief Criteria";

		// Address of property being put forward
		$addressOfProperty = GF_Fields::get( "address" );
		$addressOfProperty->label   = "Address of property being put forward";

		/*
		* Dynamic fields
		*/

		/* Do I want to explore ‘Activity Based Working’ (ABW) or other workplace strategies to suit flexible work styles? */
		switch ($entry[75]) {
			case 'Yes':
				$square_metres	=	$entry[76];
				break;
			
			case 'No':
				$square_metres	=	$entry[85];
				break;
		}

		$fieldFirst = GF_Fields::get( "number" );
		$fieldFirst->label   = "Our initial estimate for Office Space is for approximately ".$square_metres." m² .";
		$fieldFirst->numberFormat = "decimal_dot";

		// Missing $form_data['field']['6_name']



		/* Will my office space needs change over the lease term? */
		switch ($entry[10]) {
			case "Yes":
				$fieldThirdLabel = "We have an expectation that our space needs may grow as much as ".$entry[80]."% over the term of the lease and would prefer to be able to grow within the same building or if possible, even on the same floor.";
				break;
			
			case "No":
				$fieldThirdLabel = "We have an expectation that our space needs may reduce as much as ".$entry[80]."% over the term of the lease.";
				break;
		}
		$fieldThird = GF_Fields::get( "textarea" );
		$fieldThird->label   = $fieldThirdLabel;

		#
		$fieldFourth = GF_Fields::get( "date" );
		$fieldFourth->label   = "Our current lease is due to expire on ".$entry[87].". Enter when this property will be available:";
		$fieldFourth->dateType = "datepicker";
	
		#
		$fieldFifth = GF_Fields::get( "number" );
		$fieldFifth->label   = "We currently have an expected budget of between $ ".$entry[70]." and $ ".$entry[71]." per m². What is the rate for this property?";
		$fieldFifth->numberFormat = "currency";


		// Static fields
		$fields[] = $agentDetails;
		$fields[] = $contactName;
		$fields[] = $contactPhone;
		$fields[] = $contactEmail;
		$fields[] = $company;
		$fields[] = $responses;
		$fields[] = $addressOfProperty;

		// Dynamic fields
		$fields[] = $fieldFirst;
		//$fields[] = $field2;
		$fields[] = $fieldThird;
		$fields[] = $fieldFourth;
		$fields[] = $fieldFifth;





		//return $fields;

		echo "<pre>";

			print_r( $fields );

		echo "</pre>";


		die;

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
?>