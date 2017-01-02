<?php

	
	$w_routes = array(

		['GET', 		'/', 								'Default#home', 			'default_home'],
		['GET',			'/home',							'Default#home', 			'default_home_bis'],

		['GET',			'/menu',							'Default#displayMenu', 		'display_menu'],
		['GET',			'/menu/category/[i:id]',			'Default#displayMenu', 		'display_menu_category'],


		['GET|POST',	'/login',							'User#login', 				'user_login'],
		['GET',			'/logout',							'User#logout', 				'user_logout'],
		['GET|POST',	'/sign-in',							'User#signin', 				'user_signin'],
		['GET|POST',	'/user/password-recovery',			'User#passwordRecovery', 	'user_password_recovery'],
		['GET|POST',	'/user/reset-password/[:token]',	'User#resetPassword', 		'user_reset_password'],
		['GET|POST',	'/confirm-account/[:token]',		'User#confirm', 			'user_confirm_account'],

        ['GET|POST',         '/admin-home',                      'Admin#home',               'admin_home'],
        ['GET|POST',    '/admin-slider',                    'Admin#displaySlider',      'admin_slider'],
        ['POST',        '/admin-slider/pics',               'Admin#getSliderPicsAjax',  'admin_slider_pics'],
        ['GET|POST',    '/admin-slider/add-pics',           'Admin#add',                'admin_slider_add'],
        ['POST',        '/admin-slider/delete',             'Admin#deleteSliderPic',    'admin_slider_delete'],
        ['GET',        '/admin-slider/count',             'Admin#countPicsSlider',    'admin_slider_count'],


		['GET',			'/slider',							'Default#slider',			'default_slider'],
		['GET',			'/map',								'Default#map',				'default_map'],
);

