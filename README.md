# Laravel.Fenom
[![Join the chat at https://gitter.im/pafnuty/Laravel.Fenom](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/fenom-template/Laravel.Fenom?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

Fenom Template Engine for Laravel 5

Bringing [Fenom](https://github.com/fenom-template/fenom) to Laravel 5 using the new [Contracts Package](https://github.com/illuminate/contracts).

##Installation

In the require key of composer.json file add the following
```
"pafnuty/laravel-fenom": "dev-master"
```

Run the Composer update command
```
$ composer update
```

Run command
```
$ php artisan clear-compiled
```
    
In your **config/app.php** add `'Pafnuty\Fenom\FenomViewServiceProvider',` to the end of the `providers` array **and comment** the `'Illuminate\View\ViewServiceProvider'` provider. 
Like this:

```php
'providers' => [
    ...
    'Illuminate\Validation\ValidationServiceProvider',
    //'Illuminate\View\ViewServiceProvider',
    ...
    'Pafnuty\Fenom\FenomViewServiceProvider',
]
```

Run the `artisan vendor:publish` command
```
$ php artisan vendor:publish --provider="Pafnuty\Fenom\FenomViewServiceProvider"
```
Will be published with the default views and the configuration file.


## Configuration

Config file available in the folder `config/view-fenom.php`.
Views by default have a structure similar to the structure of the blade for easier transition to new template engine in a new project. 


## Use
If you use the setting `'controller_syntax' => 'blade'`, changes to the controllers do not need to make.

If setting `'controller_syntax' => 'fenom'` calling view in controller will be like this:
```php
public function index() {
    return view('myfolder/welcome.tpl');
}
```


## Syntax 
Fenom — this is a very quick and easy template engine! With easy syntax, similar to Smarty Template Engine.

## Control Structures

### If Statements
```smarty
{if $records|length === 1)
    I have one record!
{elseif $records| length > 1}
    I have multiple records!
{else}
    I don't have any records!
{/if}
```

###  Loops
```smarty
{for ($i = 0 to = 10)
    The current value is {$i}
{forelse}
    No values
{/for}

{foreach $list as $key => $value}
    {$key}: {$value}
{foreachelse}
    Empty
{/foreach}
```

###  Including Sub-Views
```
{include 'auth/errors.tpl' foo='bar'}
or
{insert 'auth/errors.tpl'}
```

###  Overwriting Sections
```
{* in app.tpl: *}
{block 'content'} text {/block}

{* in home.tpl: *}
{extends 'app.tpl'}
{block 'content'} home-text {/block}

{* in browser: *}
home-text
```

### Comments 
```
{* This comment will not be in the rendered HTML  *}
```

### Errors
```
{set $errors = $.errors}
    
{if $errors->any()}  
    {foreach $errors->all() as $error} 
        {$error}
    {/foreach}
{/if}
```

### App
```
{set $App = $.app}
    
{$App::someMethodName()}
```

More usage examples can be found on the Fenom documentation pages
- [English docs](https://github.com/fenom-template/fenom/blob/master/docs/en/readme.md)
- [Russian docs](https://github.com/fenom-template/fenom/blob/master/docs/ru/readme.md)







