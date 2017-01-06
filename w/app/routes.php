<?php

	$w_routes = array(

		['GET', 		'/', 								'Default#home', 						'default_home'],
		['GET',			'/home',							'Default#home', 						'default_home_bis'],
		['GET',			'/slider',							'Default#slider',						'default_slider'],
		['GET',			'/map',								'Default#map',							'default_map'],
		['GET',			'/about',							'Default#about',						'default_about'],
		['GET',			'/menu',							'Default#displayMenu', 					'display_menu'],
		['POST',		'/menu',							'Default#addOrder', 					'add_order'],
		['GET|POST',	'/menu/category/[i:id]',			'Default#displayMenu', 					'display_menu_category'],
		['GET|POST',	'/add-product-supplement',			'Default#addProductSupplements', 		'add_product_supplement'],
		['GET|POST',	'/menu/delete',						'Default#deleteProductSupplements', 	'delete_product_supplement'],	
		['GET|POST',	'/menu/search',						'Default#searchProduct', 				'search_product'],
		['GET|POST',	'/menu/confirm',					'Default#confirmOrder', 				'confirm_order'],

		['GET|POST',	'/login',							'User#login', 							'user_login'],
		['GET',			'/logout',							'User#logout', 							'user_logout'],
		['GET|POST',	'/sign-in',							'User#signin', 							'user_signin'],
		['GET|POST',	'/user/password-recovery',			'User#passwordRecovery', 				'user_password_recovery'],
		['GET|POST',	'/user/reset-password/[:token]',	'User#resetPassword', 					'user_rest_password'],
		['GET|POST',	'/confirm-account/[:token]',		'User#confirm', 						'user_confirm_account'],

		['GET|POST',	'/contact',							'User#contact',							'user_contact'],
        ['GET|POST',    '/account',                         'User#account',                         'user_account'],

        ['GET',         '/admin-home',                      'Admin#home',                           'admin_home'],
        ['GET|POST',    '/admin-slider',                    'Admin#displaySlider',                  'admin_slider'],
        ['POST',        '/admin-slider/pics',               'Admin#getSliderPicsAjax',              'admin_slider_pics'],
        ['GET|POST',    '/admin-slider/add-pics',           'Admin#add',                            'admin_slider_add'],
        ['POST',        '/admin-slider/delete',             'Admin#deleteSliderPic',                'admin_slider_delete'],
        ['GET',         '/admin-slider/count',              'Admin#countPicsSlider',                'admin_slider_count'],
        ['GET|POST',	'/admin-about',						'Admin#aboutAdmin',			            'admin_about'],
        ['GET|POST',	'/admin-search',					'Admin#searchUsers', 				    'admin_search_user'],
        ['GET',			'/admin-role',						'Admin#role', 		                    'admin_display_role'],
        ['GET|POST',	'/admin-update-user',	            'Admin#updateUser', 		            'admin_update_role'],
        ['GET|POST',	'/admin-send-message',	            'Admin#sentSmsCommand', 		        'admin_send_message'],
        ['GET|POST',	'/order',	                    	'Admin#displayOrder', 		            'admin_order'],
		['GET|POST',	'/admin-delete-order',	            'Admin#deleteOrder', 		        	'admin_delete_order'],

);
