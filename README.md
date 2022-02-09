# Themes extension

Lib for manage project themes at Codificar

## Installation

Add in composer.json:

```php
"repositories": [
    {
        "type": "vcs",
        "url": "https://libs:ofImhksJ@git.codificar.com.br/laravel-libs/laravel-themes.git"
    }
]
```

```php
require:{
        "codificar/themes": "0.1.0",
}
```

```php
"autoload": {
    "psr-4": {
        "Codificar\\Themes\\": "vendor/codificar/themes/src/"
    },
}
```

Update project dependencies:

```shell
$ composer update
```

Register the service provider in `config/app.php`:

```php
'providers' => [
  /*
   * Package Service Providers...
   */
  Codificar\Themes\ThemeServiceProvider::class,
],
```


Publish public images:

```shell
$ php artisan vendor:publish --tag=laravel-themes --force
```


Run the migrations:

```shell
$ php artisan migrate
```