<?php

$fieldsArray = array(
				 '1' => array(
				   'label'  => 'Agent Details',
				   'type'   => 'section',
				  ),
				 '2' => array(
				   'label'  => 'Contact Name',
				   'type'   => 'name',
				  ),
				 '3' => array(
				   'label'  => 'Contact Phone',
				   'type'   => 'phone',
				   'phoneFormat' => 'international'
				  ),
				 '4' => array(
				   'label'  => 'Contact Email',
				   'type'   => 'email',
				  ),
				 '5' => array(
				   'label'  => 'Company / Branch / Office',
				   'type'   => 'text',
				  ),
				 '6' => array(
				   'label'  => 'Responses to Brief Criteria',
				   'type'   => 'section',
				  ),
				 '7' => array(
				   'label'  => 'Address of property being put forward',
				   'type'   => 'address',
				  ),







				);

 /*'2' => array(
   'label' => 'How are you ##param1## doing ##param2## ?',
   'paramCount' => 2,
   'type' => 'select',
   'option' => array(
         	'Yes'       => 'Yes',
         	'No'        => 'No',
   ),
   'value' => 'Yes'
  ),*/

/*$fields[] = $this->addQuestionInForm( 3 , array( 
									'replaceParam' => array( 
										'##param1##' => '5', 
										'##param2##' => '6'
									) ) );*/



class cminusFieldsBuilder{

	public function debug( $param ){
		echo "<pre>";
			print_r( $param );
		echo "</pre>";
		die;
	}


	public function addQuestionInForm( $index, $addionalParam = array() ){

		global $fieldsArray;
		$param = $fieldsArray[$index];
		$param = array_merge( $param, $addionalParam ); 

		// Default values
		$tempParam = array(
						'id'           => 1,
						'type'         => 'text',
						'label'        => 'Title',
						'size'         => 'medium',
						'value'        => ''
					);

		$param = array_merge( $tempParam, $param );
	
		// Get feild object
		$fieldObject = GF_Fields::create();

		// Adding field properties
		$fieldObject->type          =  $param['type'];
		$fieldObject->id            =  $index;

		// Only for dynamic label
		
		if( !empty( $param['replaceParam'] ) ){
			foreach( $param['replaceParam'] as $key => $value ){
				$search[]   = $key;
				$replace[]  = $value;
			}
			$label = str_replace( $search, $replace, $param['label']);
		}else{
			$label =  $param['label'];
		}

		$fieldObject->label         = $label;
		$fieldObject->size          =  $param['size'];
		$fieldObject->defaultValue  =  $param['value'];

		// Add additional params for different field types
		switch( $param['type'] ){

			case 'select':
				foreach( $param['option'] as $key => $value){
					$selected = ( $param['value'] == $key ) ? true : false;
					$options[] = array(
							        'text'          => $key,
							        'value'         => $value,
							        'isSelected'    => $selected
							    );
				}
				$fieldObject->choices = $options;
			break;

			case 'checkbox':	
				foreach( $param['option'] as $key => $value){
					// Selected values for checkbox
					$values = explode( ",", $param['value']);
					$selected = in_array( $key, $values ) ? true : false;
					$options[] = array(
							        'text'          => $key,
							        'value'         => $value,
							        'isSelected'    => $selected
							    );
				}
				$fieldObject->choices = $options;
			break;

			case 'radio':
				foreach( $param['option'] as $key => $value){
					$selected = ( $param['value'] == $key ) ? true : false;
					$options[] = array(
							        'text'          => $key,
							        'value'         => $value,
							        'isSelected'    => $selected
							    );
				}
				$fieldObject->choices = $options;
			break;

			case 'number':
				$fieldObject->numberFormat = $param['numberFormat'];
			break;

			case 'date':
				$fieldObject->dateType = $param['dateType'];
			break;

			case 'phone';
				$fieldObject->phoneFormat = $param['phoneFormat'];
			break;	
		}
		return $fieldObject;
	}

	// Get dynamic form fields
	public function getFields( $targetEntry ){

		if( empty($targetEntry) ){
			return array();
		}

		//Get entry details
		$entry = GFAPI::get_entry($targetEntry);

		$fields = array();

		// Agent Details 
		$fields[] = $this->addQuestionInForm( 1 );

		// Contact Name
		$fields[] = $this->addQuestionInForm( 2 );

		// Contact Phone
		$fields[] = $this->addQuestionInForm( 3 );

		// Contact Email
		$fields[] = $this->addQuestionInForm( 4 );

		// Company / Branch / Office
		$fields[] = $this->addQuestionInForm( 5 );

		// Responses to Brief Criteria
		$fields[] = $this->addQuestionInForm( 6 );

		// Address of property being put forward
		$fields[] = $this->addQuestionInForm( 7 );


		//$this->debug($fields);

		return $fields;


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

		/* Our preference is for our office to be located in the: */
		foreach ($entry[92] as $item) {
			switch ($item) {
				case 'Alternate CBD':
					$locations .=	'<li>' . $entry[93] . '</li>';
				break;
				
				case 'Business Park':
					$locations .=	'<li>' . $entry[94] . '</li>';
				break;

				case 'Other':
					$locations .=	'<li>Other: ' . $entry[95] . '</li>';
				break;

				default:
					$locations .=	'<li>' . $item . '</li>';
				break;
			}
		}	
		$fieldSixth = GF_Fields::get( "radio" );
		$fieldSixth->label   = "Our new office is to be located within the city of Adelaide in any of the following preferred locations: ".$locations.". Is this property located here?";
		$fieldSixth->choices = array(
							    array(
							        'text'          => 'Yes',
							        'value'         => 'yes',
							        'isSelected'    => false
							    ),
							    array(
							        'text'          => 'No',
							        'value'         => 'no',
							        'isSelected'    => false
							    )
							);

		#
		$fieldSeventh = GF_Fields::get( "radio" );
		$fieldSeventh->label   = "Our preference is to be located within a short walk, or easy lite rail or sub-way access to businesses including:".implode(', ', (array) $entry[77]);
		$fieldSeventh->choices = array(
							    array(
							        'text'          => 'Yes',
							        'value'         => 'yes',
							        'isSelected'    => false,
							    ),
							    array(
							        'text'          => 'No',
							        'value'         => 'no',
							        'isSelected'    => false,
							    )
							);


		#
		if( $entry[100] == 'Australia' ){
			$fieldEightthLabel = "The office shall have a minimum rating of ".$entry[97]." as determined by the Property Council of Australia (PCA)";
		}else{
			$fieldEightthLabel = "The office shall have a minimum rating of ".$entry[98]." as determined by the Building Owners and Managers Association International (BOMA).";
		}

		$fieldEightth = GF_Fields::get( "radio" );
		$fieldEightth->label   = $fieldEightthLabel;
		$fieldEightth->choices = array(
							    array(
							        'text'          => 'Premium',
							        'value'         => 'Premium',
							        'isSelected'    => false,
							    ),
							    array(
							        'text'          => 'A',
							        'value'         => 'A',
							        'isSelected'    => false,
							    ),
							    array(
							        'text'          => 'B',
							        'value'         => 'B',
							        'isSelected'    => false,
							    ),
							    array(
							        'text'          => 'C',
							        'value'         => 'C',
							        'isSelected'    => false,
							    ),
							    array(
							        'text'          => 'D',
							        'value'         => 'D',
							        'isSelected'    => false,
							    )
							);

		/* Green Building */
		switch ($entry[57]) {
			case 'United Kingdom':
				$fieldNinethLabel	= "A minimum BREEAM performance rating of ".$entry[123]." is required.";
				break;

			case 'Singapore':
				$fieldNinethLabel	= "A minimum Green Mark performance rating of ".$entry[109]." is required.";
				break;
			
			default:
				$fieldNinethLabel	= "A minimum LEED performance rating of ".$entry[109]." is required.</p>";
				break;
		}

		/* Region & Energy Rating */
		switch ($entry[100]) {
			case 'Australia':
				$fieldNinethLabel	= "A minimum Greenstar performance rating of ".$entry[82]." is required.";
				$fieldTenthLabel	= "A minimum NABERS performance rating of ".$entry[81]." is required.";
			break;
			
			case 'North America':
			case 'South America':
				$fieldNinethLabel	= "We prefer that our new office is in an EnergyStar rated building";
				break;

			case 'Europe':
			case 'Africa':
				$fieldNinethLabel	= "A minimum Energy Performance Certificate (EPC) performance rating of ".$entry[111]." is required.";
			break;
		}

		#
		if ($entry[24] == 'Yes') {
			$fieldNineth = GF_Fields::get( "radio" );
			$fieldNineth->label   = $fieldNinethLabel;
			$fieldNineth->choices = array(
									    array(
									        'text'          => '5 star',
									        'value'         => '5 star',
									        'isSelected'    => false,
									    ),
									    array(
									        'text'          => '4 star',
									        'value'         => '4 star',
									        'isSelected'    => false,
									    ),
									    array(
									        'text'          => '3 star',
									        'value'         => '3 star',
									        'isSelected'    => false,
									    ),
									    array(
									        'text'          => '2 star',
									        'value'         => '2 Star',
									        'isSelected'    => false,
									    ),
									    array(
									        'text'          => '1 star',
									        'value'         => '1 star',
									        'isSelected'    => false,
									    )
									);
		}

		#
		if ($entry[110] == 'Yes') {
			$fieldTenth = GF_Fields::get( "radio" );
			$fieldTenth->label   = $fieldTenthLabel;
			$fieldTenth->choices = array(
										array(
									        'text'          => '6 star',
									        'value'         => '6 star',
									        'isSelected'    => false,
									    ),
									    array(
									        'text'          => '5 star',
									        'value'         => '5 star',
									        'isSelected'    => false,
									    ),
									    array(
									        'text'          => '4 star',
									        'value'         => '4 star',
									        'isSelected'    => false,
									    ),
									    array(
									        'text'          => '3 star',
									        'value'         => '3 star',
									        'isSelected'    => false,
									    ),
									    array(
									        'text'          => '2 star',
									        'value'         => '2 Star',
									        'isSelected'    => false,
									    ),
									    array(
									        'text'          => '1 star',
									        'value'         => '1 star',
									        'isSelected'    => false,
									    )
									);
		}

		#
		if($entry[110] == 'Yes'){
			$fieldEleventh = GF_Fields::get( "textarea" );
			$fieldEleventh->label   = "It is important to the business that our choice of building and our fit-out adequately reflects our brand in a way that it communicates
						to the market (both clients and future staff) who we are, what we do, what we stand for, how we approach the needs of our customers,
						the quality of our offering and how we treat our staff.";
		}

		#
		if ( $entry[26] == 'Yes' ){
			$conditionalText = "";
			if ( $entry[26] == 'Yes' ){
				$conditionalText .= "health, well-being and productivity";
			}
			if ( $entry[73] >= '3' ){
				$conditionalText .= ", creativity and collaboration";
			}
			
			$fieldTweleveth = GF_Fields::get( "textarea" );
			$fieldTweleveth->label = "The building engineering services and final office configuration needs to promote".$conditionalText."and any impediments to these outcomes must be noted specifically in response to the requirements outlined in this brief.";
		}

		#
		$fieldThirteenth = GF_Fields::get( "textarea" );
		$fieldThirteenth->label ="The building engineering services and final office configuration needs to promote health, well-being and productivity and any impediments to these outcomes must be noted specifically in response to the requirements outlined in this brief. Please note any impediments here, or in your responses to specific criteria.";

		#
		$fieldFourteenth = GF_Fields::get( "textarea" );
		$fieldFourteenth->label ="Full details and clarity regarding the limitations of electrical capacity and the distribution and access to equipment and workstation electrical loads across the full tenancy space, is required by the respondents to this brief. Enter details here.";

		#
		$fieldFifteenth = GF_Fields::get( "textarea" );
		$fieldFifteenth->label ="Limitations on the air-conditioning systems relating to heat load from any installed electrical appliances (also taking account of lighting, building and people loads) must also be advised. Enter details here.";

		#
		$fieldSixteenth = GF_Fields::get( "textarea" );
		$fieldSixteenth->label ="Respondents to note in their submissions the data carrying capacity and whether the building has an inbuilding coverage (IBC) system that will ensure that mobile, wireless data and GPS signals are not compromised due to the building’s structure or any limitations of the office space. Any special provisions that are offered that will enable our businesses future digital strategy should be articulated.";

		#
		if( $entry[124] == 'Yes'){
			$fieldSeventeenth = GF_Fields::get( "radio" );
			$fieldSeventeenth->label   = "Particular requirements relating to our digital strategy include:";
			$fieldSeventeenth->choices = array(
										array(
									        'text'          => 'Yes',
									        'value'         => 'Yes',
									        'isSelected'    => false,
									    ),
									    array(
									        'text'          => 'No',
									        'value'         => 'No',
									        'isSelected'    => false,
									    )
									);
		}

		#
		if ( $entry[72] >= '3' ){
			$fieldEightteenth = GF_Fields::get( "textarea" );
			$fieldEightteenth->label ="In relation to office configuration, it is ".$entry[72]." important for all staff to be co-located on the same floor but as a minimum all members of the same teams
						 need to be connected by no more than a single interconnected and open stairwell.";
		}

		#
		if ( $entry[73] >= '3' ){
			$fieldNineteenth = GF_Fields::get( "textarea" );
			$fieldNineteenth->label ="Staff common areas are to be configured to promote collaboration between the various sections within the business.";
		}

		#
		if ( $entry[86] >= '3' ){

			if ( $entry[4] == 'Yes' ) { 
				$conditionalText =' , although it is anticipated that the majority of office space shall be open floor'; 
			}

			$fieldTwentyth = GF_Fields::get( "textarea" );
			$fieldTwentyth->label ="A variety of different meeting rooms are envisaged".$conditionalText;
		}

		#
		if ( $entry[33] == 'Yes' ){
			$fieldTwentyFirst = GF_Fields::get( "textarea" );
			$fieldTwentyFirst->label ="Special security access requirements are to be provided for approximately ".$entry[101]."m² and ".$entry[102]." staff.
					Access to be via passcode/card only and monitored via surveillance cameras both internally and remotely.";
		}

		#
		if ( $entry[112] == 'Yes' ){
			$fieldTwentySecond = GF_Fields::get( "textarea" );
			$fieldTwentySecond->label ="Particular preference will be given to buildings which are able to demonstrate the highest levels of compliance with energy efficiency,
					IEQ, IAQ, individual comfort controls and Biophilia. Refer to the reputation section above for minimum energy rating required.
					Of each of those items we rate them in the following order of preference to our business:";
		}


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
		//$fields[] = $fieldSixth;
		//$fields[] = $fieldSeventh;
		//$fields[] = $fieldEightth;
		//$fields[] = $fieldNineth;
		//$fields[] = $fieldTenth;
		//$fields[] = $fieldEleventh;
		//$fields[] = $fieldTweleveth;
		//$fields[] = $fieldThirteenth;
		//$fields[] = $fieldFourteenth;
		//$fields[] = $fieldFifteenth;
		//$fields[] = $fieldSixteenth;
		//$fields[] = $fieldSeventeenth;
		//$fields[] = $fieldEightteenth;
		//$fields[] = $fieldNineteenth;
		//$fields[] = $fieldTwentyth;
		//$fields[] = $fieldTwentyFirst;
		//$fields[] = $fieldTwentySecond;


		return $fields;

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