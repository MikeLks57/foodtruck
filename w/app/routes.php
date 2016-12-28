<?php


	
	$w_routes = array(

		['GET', 		'/', 								'Default#home', 						'default_home'],
		['GET',			'/home',							'Default#home', 						'default_home_bis'],

		['GET',			'/menu',							'Default#displayMenu', 					'display_menu'],
		['GET|POST',	'/menu/category/[i:id]',			'Default#displayMenu', 					'display_menu_category'],
		['GET|POST',	'/add-product-supplement',			'Default#addProductSupplements', 		'add_product_supplement'],
		['GET|POST',	'/menu',							'Default#addOrder', 					'add_order'],
		['GET|POST',	'/menu/delete',							'Default#deleteProductSupplements', 	'delete_product_supplement'],		

		['GET|POST',	'/login',							'User#login', 							'user_login'],
		['GET',			'/logout',							'User#logout', 							'user_logout'],
		['GET|POST',	'/sign-in',							'User#signin', 							'user_signin'],
		['GET|POST',	'/user/password-recovery',			'User#passwordRecovery', 				'user_password_recovery'],
		['GET|POST',	'/user/reset-password/[:token]',	'User#resetPassword', 					'user_rest_password'],
		['GET|POST',	'/confirm-account/[:token]',		'User#confirm', 						'user_confirm_account'],
    ['GET',         '/admin-home',                      'Admin#home',               			'admin_home'],


		['GET',			'/slider',							'Default#slider',						'default_slider'],
		['GET',			'/map',								'Default#map',							'default_map'],

	['GET',			'/about',							'Default#about',			'default_about'],
	['GET|POST',	'/contact',							'User#contact',				'user_contact'],

);
