<?php

$w_routes = array(
	['GET',			'/',								'Default#home',				'default_home'],
	['GET',			'home',								'Default#home',				'default_home_bis'],
	['GET',			'/menu',							'Default#displayMenu',		'display_menu'],
	['GET|POST', 	'/login',							'User#login',				'user_login'],
	['GET',			'/logout',							'User#logout', 				'user_logout'],
	['GET|POST', 	'/sign-in',							'User#signin',				'user_signin'],
	['GET|POST', 	'/user/password-recovery',			'User#passwordRecovery',	'user_password_recovery'],
	['GET|POST', 	'/user/reset-password/[:token]',	'User#resetPassword',		'user_reset_password'],
	['GET|POST', 	'/confirm-account/[:token]',		'User#confirm',				'user_confirm_account'],
	['GET',			'/slider',							'Default#slider',			'default_slider'],
	['GET',			'/map',								'Default#map',				'default_map'],
	['GET',			'/about',							'Default#about',			'default_about'],
);
