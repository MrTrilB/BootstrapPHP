# BootstrapPHP

A Composer-ready PHP library for adding Bootstrap assets, components, and configuration to any PHP project through classes and helper functions.

Bootstrap assets are included locally under `src/Assets/dist`, so the default helpers generate local paths instead of relying on a CDN.

## Installation

```bash
composer require trilbdev/bootstrapphp
```

## What it provides

- Bootstrap CSS and JavaScript tag generation
- Local Bootstrap assets included under `src/Assets/dist`
- Configurable Bootstrap asset URLs
- Reusable HTML component rendering with Bootstrap classes
- Convenience helpers for common components such as alerts, buttons, containers, and accordions
- Class-based API with per-element helper classes

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

echo Bootstrap::accordion([
    [
        'title' => 'Accordion Item #1',
        'content' => '<strong>This is the first item.</strong>',
        'opened' => true,
    ],
    [
        'title' => 'Accordion Item #2',
        'content' => 'This is the second item.',
    ],
]);
```

## URL helpers

You can access Bootstrap asset URLs directly:

```php
<?php

use BootstrapPHP\Bootstrap;

$config = Bootstrap::config([ 'version' => '5.3.8' ]);

$cssUrl = Bootstrap::cssUrl($config);
$jsUrl = Bootstrap::jsUrl($config);
$customUrl = Bootstrap::assetUrl('css/bootstrap.min.css', $config);
```

## Custom configuration

You can point the package at a local asset directory or fully custom asset URLs:

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
