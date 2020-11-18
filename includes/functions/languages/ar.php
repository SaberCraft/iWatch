<?php

	function translate($phrase) {

		static $ar = array(
			
			// Upper-bar
			'login' => 'تسجيل الدخول',
			'signup' => 'حساب جديد',
			'language' => 'اللغة',
			'arabic' => 'العربية',
			'french' => 'الفرنسية',
			'welcome' => 'مرحبا',


			// navbar links
			'marks' => 'العلامات',
			'purchase' => 'المشتريات',
			'contact-us' => 'إتصل بنا',
			'cart' => 'حقيبة التسوق',
			'help' => 'المساعدة',
			'search..' => 'إبحث..',
			'items' => 'العناصر',
			'comments' => 'التعليقات',
			'profile' => 'صفحتي',
			'settings' => 'إعدادات',
			'account settings' => 'إعدادت الحساب',
			'password' => 'كلمة السري',
			'credit card' => 'بطاقة ائتمان',
			'notifications' => 'الإشعارات',
			'' => '',
			'logout' => 'الخروج'

		);

		return $ar[$phrase];

	}