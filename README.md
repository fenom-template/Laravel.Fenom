# Laravel.Fenom
Fenom Template Engine for Laravel 5
[![Join the chat at https://gitter.im/pafnuty/Laravel.Fenom](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/pafnuty/Laravel.Fenom?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

Bringing [Fenom](https://github.com/fenom-template/fenom) to Laravel 5 using the new [Contracts Package](https://github.com/illuminate/contracts).

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





