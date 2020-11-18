<?php

	function translate($phrase) {

		static $ar = array(
			
			// acciul
			'message' => 'مرحبا',
			'admin' => 'المدير' 

		);

		return $ar[$phrase];

	}