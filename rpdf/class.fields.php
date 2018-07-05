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
		$fields[] = $fieldSixth;
		$fields[] = $fieldSeventh;
		$fields[] = $fieldEightth;
		$fields[] = $fieldNineth;
		$fields[] = $fieldTenth;
		$fields[] = $fieldEleventh;
		$fields[] = $fieldTweleveth;
		$fields[] = $fieldThirteenth;
		$fields[] = $fieldFourteenth;
		$fields[] = $fieldFifteenth;
		$fields[] = $fieldSixteenth;
		$fields[] = $fieldSeventeenth;
		$fields[] = $fieldEightteenth;
		$fields[] = $fieldNineteenth;
		$fields[] = $fieldTwentyth;



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