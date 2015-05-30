# Laravel.Fenom

[![Join the chat at https://gitter.im/fenom-template/Laravel.Fenom](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/fenom-template/Laravel.Fenom?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)
[![Join the chat at https://gitter.im/pafnuty/Laravel.Fenom](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/pafnuty/Laravel.Fenom?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

Fenom Template Engine for Laravel 5

Bringing [Fenom](https://github.com/fenom-template/fenom) to Laravel 5 using the new [Contracts Package](https://github.com/illuminate/contracts).

## Syntax 
Fenom — this is a very quick and easy template engine! With easy syntax.
- [English docs](https://github.com/fenom-template/fenom/blob/master/docs/en/readme.md)
- [Russian docs](https://github.com/fenom-template/fenom/blob/master/docs/ru/readme.md)

##Installation
- Add `"pafnuty/laravel-fenom": "dev-master"` to your `composer.json` file and run `composer update`.
- Add `'Pafnuty\Fenom\FenomViewServiceProvider'` to your `config/app.php` providers array, 
- Comment the `'Illuminate\View\ViewServiceProvider'` provider.
- Run `artisan vendor:publish` or `artisan vendor:publish --force`.

## Use
A simple controller with default settings:
```php
<?php namespace App\Http\Controllers;

class WelcomeController extends Controller {
    public function index() {
        return view('fenom/welcome.tpl', ['content' => 'Fenom template engine text']);
    }
}
```





