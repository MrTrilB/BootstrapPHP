<?php

declare(strict_types=1);

namespace BootstrapPHP\Includes;

final class AssetUrlBuilder
{
    public static function build(string $version, string $assetBaseUrl, string $path): string
    {
        $baseUrl = rtrim(str_replace('{version}', $version, $assetBaseUrl), '/');
        $assetPath = ltrim($path, '/');

        if ($baseUrl === '' && $assetPath === '') {
            return '';
        }

        if ($baseUrl === '') {
            return $assetPath;
        }

        if ($assetPath === '') {
            return $baseUrl;
        }

        return $baseUrl . '/' . $assetPath;
    }

    public static function css(string $version, string $assetBaseUrl, string $variant = 'bootstrap', bool $rtl = false, bool $minified = true): string
    {
        $name = match (strtolower($variant)) {
            '', 'bootstrap' => 'bootstrap',
            'grid' => 'bootstrap-grid',
            'reboot' => 'bootstrap-reboot',
            'utilities' => 'bootstrap-utilities',
            default => $variant,
        };

        $path = sprintf('css/%s%s%s.css', $name, $rtl ? '.rtl' : '', $minified ? '.min' : '');

        return self::build($version, $assetBaseUrl, $path);
    }

    public static function js(string $version, string $assetBaseUrl, string $variant = 'bundle', bool $minified = true): string
    {
        $name = match (strtolower($variant)) {
            '', 'bootstrap' => 'bootstrap',
            'bundle' => 'bootstrap.bundle',
            'esm' => 'bootstrap.esm',
            default => $variant,
        };

        $path = sprintf('js/%s%s.js', $name, $minified ? '.min' : '');

        return self::build($version, $assetBaseUrl, $path);
    }
}
