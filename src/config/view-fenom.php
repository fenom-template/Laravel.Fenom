<?php

/*
|--------------------------------------------------------------------------
| Fenom configure
|--------------------------------------------------------------------------
|
| @author  Pavel Belousov pafnuty10@gmail.com
| @author  Max Kostjukevich support@maxicms.ru
| @license http://opensource.org/licenses/MIT MIT
|
 */

return [

	/*
	|--------------------------------------------------------------------------
	| Syntax controller call view template
	|--------------------------------------------------------------------------
	|
	| Setting the syntax to describe the connection template in the controller
	|
	| Default is: view('fenom/welcome.tpl');
	| If need blade style syntax — set 'blade' for view('fenom.welcome');
	|
	|
	| Available Settings: 'fenom', 'blade'
	|
	 */

	'controller_syntax' => env('FENOM_CONTROLLER_SYNTAX', 'fenom'),

	/*
	|--------------------------------------------------------------------------
	| File extention for template files
	|--------------------------------------------------------------------------
	|
	| It is necessary for blade syntax in the controller
	|
	 */

	'extension' => 'tpl',

	/*
	|--------------------------------------------------------------------------
	| View Storage Paths
	|--------------------------------------------------------------------------
	|
	| Description
	|
	 */

	'template_path' => base_path() . '/resources/views',

	/*
	|--------------------------------------------------------------------------
	| Compiled View Path
	|--------------------------------------------------------------------------
	|
	| This option determines where all the compiled Fenom templates will be
	| stored for your application. Typically, this is within the storage
	| directory. However, as usual, you are free to change this value.
	|
	 */
	'compile_path' => storage_path() . '/fenom/compile',

	/*
	|--------------------------------------------------------------------------
	| Cache Driver
	|--------------------------------------------------------------------------
	|
	| At this point, the template engine is tested only with file caching
	|
	 */

	'cache_driver' => env('FENOM_CACHE_DRIVER', 'file'),

	/*
	|--------------------------------------------------------------------------
	| Fenom options
	|--------------------------------------------------------------------------
	|
	| The parameters of a template
	| 
	| @see https://github.com/fenom-template/fenom/blob/master/docs/en/configuration.md
	| @see https://github.com/fenom-template/fenom/blob/master/docs/ru/configuration.md
	| 
	*/
	
	
	'options' => [
		'disable_methods'      => env('FENOM_DISABLE_METHODS'),	
		'disable_native_funcs' => env('FENOM_DISABLE_NATIVE_FUNCS'),	
		'auto_reload'          => env('FENOM_AUTO_RELOAD'),	
		'force_compile'        => env('FENOM_FORCE_COMPILE'),	
		'disable_cache'        => env('FENOM_DISABLE_CACHE'),	
		'force_include'        => env('FENOM_FORCE_INCLUDE'),	
		'auto_escape'          => env('FENOM_AUTO_ESCAPE'),	
		'force_verify'         => env('FENOM_FORCE_VERIFY'),	
		'disable_statics'      => env('FENOM_DISABLE_STATICS'),	
		'strip'                => env('FENOM_STRIP'),	
	],


];
