# BootstrapPHP

A Composer-ready PHP library for adding Bootstrap assets, components, and configuration to any PHP project through classes and helper functions.

## Installation

```bash
composer require mrtrilb/bootstrap-php
```

## What it provides

- Bootstrap CSS and JavaScript tag generation
- Configurable Bootstrap asset URLs
- Reusable HTML component rendering with Bootstrap classes
- Convenience helpers for common components such as alerts, buttons, and containers
- Both class-based and function-based APIs

## Class-based usage

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use BootstrapPHP\Bootstrap;

echo Bootstrap::assets();

echo Bootstrap::alert('Saved successfully', 'success');

echo Bootstrap::button('Open modal', 'primary', [
    'data-bs-toggle' => 'modal',
    'data-bs-target' => '#exampleModal',
]);

echo Bootstrap::container(
    Bootstrap::component('div', 'Any Bootstrap component content', [
        'classes' => ['card', 'p-3', 'shadow-sm'],
    ]),
    false,
    [],
    false
);
```

## Function-based usage

```php
<?php

require __DIR__ . '/vendor/autoload.php';

$config = bootstrapphp_config([
    'version' => '5.3.3',
]);

echo bootstrapphp_css_tag($config);
echo bootstrapphp_js_tag($config);
echo bootstrapphp_alert('Profile updated', 'info');
echo bootstrapphp_button('Save', 'success');
```

## Custom configuration

You can point the package at a CDN, a local asset directory, or fully custom asset URLs:

```php
<?php

use BootstrapPHP\Bootstrap;

$config = Bootstrap::config([
    'asset_base_url' => '/assets/bootstrap',
    'css_path' => 'css/bootstrap.min.css',
    'js_path' => 'js/bootstrap.bundle.min.js',
]);

echo Bootstrap::assets($config);
```

## Generic component rendering

For components not covered by the convenience helpers, use the generic renderer:

```php
<?php

use BootstrapPHP\Bootstrap;

echo Bootstrap::component('div', 'Dismissible alert body', [
    'classes' => ['alert', 'alert-warning', 'alert-dismissible', 'fade', 'show'],
    'attributes' => [
        'role' => 'alert',
    ],
]);
```
