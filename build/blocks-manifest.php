<?php
// This file is generated. Do not modify it manually.
return array(
	'myheader' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'ucn/myheader',
		'version' => '0.1.0',
		'title' => 'My Header',
		'category' => 'widgets',
		'icon' => 'smiley',
		'description' => 'Example block scaffolded with Create Block tool.',
		'example' => array(
			
		),
		'supports' => array(
			'html' => false
		),
		'attributes' => array(
			'topMenuFull' => array(
				'type' => 'string',
				'default' => 'header-top-menu'
			),
			'topMenuMobile' => array(
				'type' => 'string',
				'default' => 'top-menu'
			),
			'mainMenu' => array(
				'type' => 'string',
				'default' => 'dropdown-bottom-menu'
			)
		),
		'textdomain' => 'myheader',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php',
		'viewScript' => 'file:./view.js'
	),
	'ucn-footer' => array(
		'$schema' => 'https://schemas.wp.org/trunk/block.json',
		'apiVersion' => 3,
		'name' => 'ucn/ucn-footer',
		'version' => '0.1.0',
		'title' => 'UCN Footer',
		'category' => 'widgets',
		'icon' => 'smiley',
		'description' => 'Footer of the website.',
		'example' => array(
			
		),
		'supports' => array(
			'html' => false
		),
		'attributes' => array(
			'menus' => array(
				'type' => 'array',
				'default' => array(
					array(
						'label' => 'Admissions',
						'themeLocation' => 'footer-admissions'
					),
					array(
						'label' => 'Community',
						'themeLocation' => 'footer-community'
					)
				)
			)
		),
		'textdomain' => 'ucn-footer',
		'editorScript' => 'file:./index.js',
		'editorStyle' => 'file:./index.css',
		'style' => 'file:./style-index.css',
		'render' => 'file:./render.php',
		'viewScript' => 'file:./view.js'
	)
);
