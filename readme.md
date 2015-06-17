# Transform PHP Vars to JavaScript

[![Build Status](https://travis-ci.org/laracasts/PHP-Vars-To-Js-Transformer.png?branch=master)](https://travis-ci.org/laracasts/PHP-Vars-To-Js-Transformer)

Often, you'll find yourself in situations, where you want to pass some server-side string/array/collection/whatever
to your JavaScript. Traditionally, this can be a bit of a pain - especially as your app grows.

This package simplifies the process drastically.

## Installation

Begin by installing this package through Composer.

```js
{
    "require": {
		"laracasts/utilities": "1.0.1"
	}
}
```

> If you use Laravel 4: instead `~1.0.1`

### Laravel Users

If you are a Laravel user, there is a service provider you can make use of to automatically prepare the bindings and such.

```php

// app/config/app.php

'aliases' => [
    '...',
    'JavaScript'        =>  'Laracasts\Utilities\JavaScript\Facades\JavaScript'
];
```

```php

// app/config/local/app.php

'providers' => [
    '...',
    ''Laracasts\Utilities\UtilitiesServiceProvider''
];
```

When this provider is booted, you'll gain access to a helpful `JavaScript` facade, which you may use in your controllers.

```php
public function index()
{
    JavaScript::put([
        'foo' => 'bar',
        'user' => User::first(),
        'age' => 29
    ]);

    return View::make('hello');
}
```

Using the code above, you'll now be able to access `foo`, `user`, and `age` from your JavaScript.

```js
console.log(foo); // bar
console.log(user); // User Obj
console.log(age); // 29
```

### Defaults

If using Laravel, there are only two configuration options that you'll need to worry about. First, publish the default configuration.

```bash
php artisan config:publish laracasts/utilities
```

This will add a new configuration file to: `config/javascript.php`.

```php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | View to Bind JavaScript Vars To
    |--------------------------------------------------------------------------
    |
    | Set this value to the name of the view (or partial) that
    | you want to prepend all JavaScript variables to.
    |
    */
    'bind_js_vars_to_this_view' => 'footer',

    /*
    |--------------------------------------------------------------------------
    | JavaScript Namespace
    |--------------------------------------------------------------------------
    |
    | By default, we'll add variables to the global window object. However,
    | it's recommended that you change this to some namespace - anything.
    | That way, you can access vars, like "SomeNamespace.someVariable."
    |
    */
    'js_namespace' => 'window'

];
```

#### bind_js_vars_to_this_view

You need to update this file to specify which view you want your new JavaScript variables to be prepended to. Typically, your footer is a good place for this.

If you include something like a `layouts/partials/footer` partial, where you store your footer and script references, then make the `bind_js_vars_to_this_view` key equal to that path. Behind the scenes, the Laravel implementation of this package will listen for when that view is composed, and essentially paste the JS variables within it.

#### js_namespace

By default, all JavaScript vars will be nested under the global `window` object. You'll likely want to change this. Update the
`js_namespace` key with the name of your desired JavaScript namespace. It can be anything. Just remember: if you change this setting (which you should),
then you'll access all JavaScript variables, like so:

```js
MyNewNamespace.varName
```

## License

[View the license](https://github.com/laracasts/PHP-Vars-To-Js-Transformer/blob/master/LICENSE) for this repo.
