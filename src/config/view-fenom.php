<?php

	/**
	 * Fenom configure
	 *
	 * @author  Pavel Belousov pafnuty10@gmail.com
	 * @author  Max Kostjukevich support@maxicms.ru
	 * @license http://opensource.org/licenses/MIT MIT
	 */

	return [

		// file extension
		'extension'     => 'tpl',

		// path info
		'template_path' => base_path() . '/resources/views',
		'compile_path'  => storage_path() . '/fenom/compile',

		// options fenom compiler
		'options' => []
		/*
		'options'       => [
			// disable calling methods of objects in templates.
			'disable_methods'      => false,
			// disable calling native function in templates, except allowed.
			'disable_native_funcs' => false,
			// reload template if source will be changed
			'auto_reload'          => false,
			// recompile template every time when the template renders
			'force_compile'        => false,
			// disable compile cache
			'disable_cache'        => false,
			// paste template body instead of include-tag
			'force_include'        => false,
			// html-escape each variables outputs
			'auto_escape'          => false,
			// check existence every used variable
			'force_verify'         => false,
			// remove space-characters before and after tags
			'<!--'                 => true,
			// disable calling static methods in templates.
			'disable_statics'      => false,
			// strip all whitespaces in templates.
			'strip'                => true
		],
		*/

	];
