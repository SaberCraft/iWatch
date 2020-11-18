<?php

		// Error Reporting
		ini_set('display_errors', 'On');
		error_reporting(E_ALL);

		// Connect To Database
		include 'admin/connect.php';

		// Routes

		$tpl = 'includes/templates/'; 
		$lang = 'includes/languages/';
		$func = 'includes/functions/';
		$css = 'layout/css/';
		$js = 'layout/js/';
		

		// include the imprtent files
		include $func . 'functions.php';
		include $tpl . 'header.php';

