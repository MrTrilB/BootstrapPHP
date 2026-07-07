<?php

declare(strict_types=1);

use BootstrapPHP\Bootstrap;
use BootstrapPHP\Config;

if (!function_exists('bootstrapphp_config')) {
    function bootstrapphp_config(array $options = []): Config
    {
        return Bootstrap::config($options);
    }
}

if (!function_exists('bootstrapphp_css_tag')) {
    function bootstrapphp_css_tag(?Config $config = null, array $attributes = []): string
    {
        return Bootstrap::cssTag($config, $attributes);
    }
}

if (!function_exists('bootstrapphp_js_tag')) {
    function bootstrapphp_js_tag(?Config $config = null, array $attributes = []): string
    {
        return Bootstrap::jsTag($config, $attributes);
    }
}

if (!function_exists('bootstrapphp_assets')) {
    function bootstrapphp_assets(?Config $config = null, string $separator = PHP_EOL): string
    {
        return Bootstrap::assets($config, $separator);
    }
}

if (!function_exists('bootstrapphp_component')) {
    function bootstrapphp_component(string $tag, string $content = '', array $options = []): string
    {
        return Bootstrap::component($tag, $content, $options);
    }
}

if (!function_exists('bootstrapphp_alert')) {
    function bootstrapphp_alert(string $content, string $variant = 'primary', array $attributes = []): string
    {
        return Bootstrap::alert($content, $variant, $attributes);
    }
}

if (!function_exists('bootstrapphp_button')) {
    function bootstrapphp_button(string $content, string $variant = 'primary', array $attributes = []): string
    {
        return Bootstrap::button($content, $variant, $attributes);
    }
}

if (!function_exists('bootstrapphp_container')) {
    function bootstrapphp_container(string $content, bool $fluid = false, array $attributes = [], bool $escape = true): string
    {
        return Bootstrap::container($content, $fluid, $attributes, $escape);
    }
}
