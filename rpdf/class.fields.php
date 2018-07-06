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
				 '8' => array(
				   'label'  => 'Our initial estimate for Office Space is for approximately ##param1## m² .',
				   'type'   => 'number',
				   'numberFormat' => 'decimal_dot'
				  ),
				 '9' => array(
				   'label'  => 'We have decided to explore a flexible workplace strategy such as Activity Based Working (ABW) and the above area calculation reflects this.',
				   'type'   => 'textarea',
				  ),
				 '10' => array(
				   'label'  => array(
		   			  'yes' => 'We have an expectation that our space needs may grow as much as ##param1##% over the term of the lease and would prefer to be able to grow within the same building or if possible, even on the same floor.',
		   			  'no'  =>'We have an expectation that our space needs may reduce as much as ##param1##% over the term of the lease.'
		   			),
				   'type'   => 'textarea'
				  ),
				 '11' => array(
				   'label'  => 'Our current lease is due to expire on ##param1##. Enter when this property will be available:',
				   'type'   => 'date',
				   'dateType' => 'datepicker'
				  ),
				 '12' => array(
				   'label'  => 'We currently have an expected budget of between $##param1## and $##param2## per m². What is the rate for this property?',
				   'type'   => 'number',
				   'numberFormat' => 'currency'
				  ),
				 '13' => array(
				   'label'  => 'Our new office is to be located within the city of Adelaide in any of the following preferred locations: ##param1##. Is this property located here?',
				   'type'   => 'radio',
				   'option' => array(
		         	  'Yes'       => 'Yes',
		         	  'No'        => 'No',
				    )
				  ),
				 '14' => array(
				   'label'  => 'Our preference is to be located within a short walk, or easy lite rail or sub-way access to businesses including: ##param1##',
				   'type'   => 'radio',
				   'option' => array(
		         	  'Yes'       => 'Yes',
		         	  'No'        => 'No',
				    )
				  ),
				 '15' => array(
				   'label'  => array(
		   			  'australia' => 'The office shall have a minimum rating of ##param1## as determined by the Property Council of Australia (PCA).',
		   			  'other'  =>'The office shall have a minimum rating of ##param1## as determined by the Building Owners and Managers Association International (BOMA).'
		   			),
				   'type'   => 'radio',
				   'option' => array(
		         	  'Premium'   => 'Premium',
		         	  'A'         => 'A',
		         	  'B'         => 'A',
		         	  'C'         => 'A',
		         	  'D'         => 'D',
				    )
				  ),






				 '18' => array(
				   'label'  => 'It is important to the business that our choice of building  and our fit-out adequately reflects our brand in a way that it communicates to the market (both clients and future staff) who we are, what we do, what we stand for, how we approach the needs of our customers, the quality of our offering and how we treat our staff.',
				   'type'   => 'textarea'
				  ),
				 '19' => array(
				   'label'  => 'The building engineering services and final office configuration needs to promote ##param1## and any impediments to these outcomes must be noted specifically in response to the requirements outlined in this brief.',
				   'type'   => 'textarea'
				  ),
				'20' => array(
				   'label'  => 'The building engineering services and final office configuration needs to promote health, well-being and productivity and any impediments to these outcomes must be noted specifically in response to the requirements outlined in this brief. Please note any impediments here, or in your responses to specific criteria.',
				   'type'   => 'textarea'
				  ),
				'21' => array(
				   'label'  => 'Full details and clarity regarding the limitations of electrical capacity and the distribution and access to equipment and workstation electrical loads across the full tenancy space, is required by the respondents to this brief. Enter details here.',
				   'type'   => 'textarea'
				  ),
			 	'22' => array(
				   'label'  => 'Limitations on the air-conditioning systems relating to heat load from any installed electrical appliances (also taking account of lighting, building and people loads) must also be advised. Enter details here.',
				   'type'   => 'textarea'
				  ),
				'23' => array(
				   'label'  => 'Respondents to note in their submissions the data carrying capacity and whether the building has an inbuilding coverage (IBC) system that will ensure that mobile, wireless data and GPS signals are not compromised due to the building’s structure or any limitations of the office space. Any special provisions that are offered that will enable our businesses future digital strategy should be articulated.',
				   'type'   => 'textarea'
				  ),
				'24' => array(
				   'label'  => 'Particular requirements relating to our digital strategy include:',
				   'type'   => 'radio',
				   'option' => array(
		         	  'Yes'   => 'Yes',
		         	  'No'    => 'No',
				    )
				   ),
				'25' => array(
				   'label'  => 'In relation to office configuration, it is ##param1## important for all staff to be co-located on the same floor but as a minimum all members of the same teams need to be connected by no more than a single interconnected and open stairwell.',
				   'type'   => 'textarea'
				  ),
				'26' => array(
				   'label'  => 'Staff common areas are to be configured to promote collaboration between the various sections within the business.',
				   'type'   => 'textarea'
				  ),
				'27' => array(
				   'label'  => 'A variety of different meeting rooms are envisaged ##param1##.',
				   'type'   => 'textarea'
				  ),
				'28' => array(
				   'label'  => 'Special security access requirements are to be provided for approximately ##param1##m² and ##param2## staff. Access to be via passcode/card only and monitored via surveillance cameras both internally and remotely.',
				   'type'   => 'textarea'
				  ),
				'29' => array(
				   'label'  => 'Particular preference will be given to buildings which are able to demonstrate the highest levels of compliance with energy efficiency,	IEQ, IAQ, individual comfort controls and Biophilia. Refer to the reputation section above for minimum energy rating required. Of each of those items we rate them in the following order of preference to our business:',
				   'type'   => 'textarea'
				  ),
				);



class cminusFieldsBuilder{

	public function debug( $param ){
		echo "<pre>";
			print_r( $param );
		echo "</pre>";
		die;
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

		#########
		/* Do I want to explore ‘Activity Based Working’ (ABW) or other workplace strategies to suit flexible work styles? */
		switch ($entry[75]) {
			case 'Yes':
				$square_metres	=	$entry[76];
				break;
			case 'No':
				$square_metres	=	$entry[85];
				break;
		}

		$param = [
          'replaceParam' => [$square_metres]
		];
		$fields[] = $this->addQuestionInForm( 8 ,$param);

		#########
		if ( $entry['6'] == 'Yes' ){
			$fields[] = $this->addQuestionInForm( 9 );
		}

		#########
		/* Will my office space needs change over the lease term? */
		switch ($entry[10]) {
			case "Yes":
					$labelChoice = 'yes';
				break;
			case "No":
					$labelChoice = 'no';
				break;
		}

		$param = [
          'label' => $labelChoice,
          'replaceParam' => [$entry[80]]
		];
		$fields[] = $this->addQuestionInForm( 10 ,$param);

		##########
		$param = [
          'replaceParam' => [$entry[87]]
		];
		$fields[] = $this->addQuestionInForm( 11 ,$param);
		
		#########
		$param = [
          'replaceParam' => [ $entry[70], $entry[71] ]
		];
		$fields[] = $this->addQuestionInForm( 12 ,$param);

		#########
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
		$param = [
          'replaceParam' => [$locations]
		];
		$fields[] = $this->addQuestionInForm( 13 ,$param);

		#########
		$param = [
          'replaceParam' => [implode(', ', (array) $entry[77])]
		];
		$fields[] = $this->addQuestionInForm( 14 ,$param);

		#########
		if( $entry[100] == 'Australia' ){
			$labelChoice = 'australia';
			$replacement = $entry[97];
		}else{
			$labelChoice = 'other';
			$replacement = $entry[98];
		}

		$param = [
		  'label' => $labelChoice,
          'replaceParam' => [$replacement]
		];
		$fields[] = $this->addQuestionInForm( 15 ,$param);

		#########

		#########

		#########
		if($entry[110] == 'Yes'){
			$fields[] = $this->addQuestionInForm( 18 );
		}

		#########
		if ( $entry[26] == 'Yes' ){

			$conditionalText = "";

			if ( $entry[26] == 'Yes' ){
				$conditionalText .= "health, well-being and productivity";
			}
			if ( $entry[73] >= '3' ){
				$conditionalText .= ", creativity and collaboration";
			}

			$param = [
	          'replaceParam' => [$conditionalText]
			];
			$fields[] = $this->addQuestionInForm( 19 ,$param);
		}

		#########
		$fields[] = $this->addQuestionInForm( 20 );

		#########
		$fields[] = $this->addQuestionInForm( 21 );

		#########
		$fields[] = $this->addQuestionInForm( 22 );

		#########
		$fields[] = $this->addQuestionInForm( 23 );

		#########
		if( $entry[124] == 'Yes'){
			$fields[] = $this->addQuestionInForm( 24 );
		}

		#########
		if ( $entry[72] >= '3' ){
			$param = [
	          'replaceParam' => [$entry[72]]
			];
			$fields[] = $this->addQuestionInForm( 25 ,$param);
		}

		#########
		if ( $entry[73] >= '3' ){
			$fields[] = $this->addQuestionInForm( 26 );
		}

		#########
		if ( $entry[86] >= '3' ){
			if ( $entry[4] == 'Yes' ) { 
				$conditionalText =' , although it is anticipated that the majority of office space shall be open floor'; 
			}
			$param = [
	          'replaceParam' => [$conditionalText]
			];
			$fields[] = $this->addQuestionInForm( 27, $param );
		}

		#########
		if ( $entry[33] == 'Yes' ){
			$param = [
	          'replaceParam' => [ $entry[101], $entry[102] ]
			];
			$fields[] = $this->addQuestionInForm( 28, $param );
		}

		#########
		if ( $entry[112] == 'Yes' ){
			$fields[] = $this->addQuestionInForm( 29 );
		}

		//$this->debug($fields);

		return $fields;

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

		



	}

	public function addQuestionInForm( $index, $addionalParam = array() ){

		global $fieldsArray;
		$param = $fieldsArray[$index];

		if( is_array( $param['label'] ) ){
			$addionalParam['label'] = $param['label'][$addionalParam['label']];
		}

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
				$search[]   = '##param'.($key+1).'##';
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

}
?>