<?php

	function translate($phrase) {

		static $fr = array(
 
			// Upper-bar
			'login' => 's\'identifier',
			'signup' => 's\'inscrire',
			'language' => 'Langue',
			'arabic' => 'arabe',
			'french' => 'Français',
			'welcome' => 'Bienvenue',

			// dashborad navbar links
			'marks' => 'Marques',
			'purchase' => 'Achats',
			'contact-us' => 'Contactez-nous',
			'cart' => 'Panier',
			'help' => 'Aide',
			'search..' => 'Chercher..',
			'items' => 'Articles',
			'comments' => 'Commentaires',
			'profile' => 'Profil',
			'settings' => 'Paramètres',
			'account settings' => 'Paramètres du compte',
			'password' => 'Mot de passe',
			'credit card' => 'Carte de crédit',
			'notifications' => 'Notifications',
			'' => '',
			'logout' => 'Se déconnecter'

		);

		return $fr[$phrase];

	}