<?php

	function translate($phrase) {

		static $fr = array(
 
			// Titles
			'login' => 'Connexion',
			'default' => 'Défaut',

			// dashborad navbar links
			'users' => 'Utilisateurs..',
			'stats' => 'Satistiques',
			'logs' => 'logs',
			'marks' => 'Marques',
			'purchase' => 'Achats',
			'contact-us' => 'Contactez-nous',
			'search..' => 'chercher..',
			'items' => 'Articles',
			'comments' => 'Commentaires',
			'profile' => 'Profil',
			'settings' => 'Paramètres',
			'password' => 'Mot de passe',
			'credit card' => 'Carte de crédit',
			'notifications' => 'Notifications',
			'' => '',
			'logout' => 'Se déconnecter'

		);

		return $fr[$phrase];

	}

	 