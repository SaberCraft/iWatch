<?php

		// Error Reporting
		ini_set('display_errors', 'On');
		error_reporting(E_ALL);

		include 'connect.php';

		// Routes

		$tpl = 'includes/templates/'; 
		$lang = 'includes/languages/';
		$func = 'includes/functions/';
		$css = 'layout/css/';
		$js = 'layout/js/';
		

		// include the imprtent files
		include $func . 'functions.php';
		include $lang . 'fr.php';
		include $tpl . 'header.php';

		// Include Navbar On All Pages Expect The One with $noNavbar Variable
		if (!isset($noNavbar)) { include $tpl . 'navbar.php'; }

