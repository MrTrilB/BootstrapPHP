<?php

declare(strict_types=1);

namespace BootstrapPHP;

final class Config
{
    public function __construct(
        private readonly string $version = '5.3.3',
        private readonly string $assetBaseUrl = 'https://cdn.jsdelivr.net/npm/bootstrap@{version}/dist',
        private readonly string $cssPath = 'css/bootstrap.min.css',
        private readonly string $jsPath = 'js/bootstrap.bundle.min.js',
        private readonly ?string $cssUrlOverride = null,
        private readonly ?string $jsUrlOverride = null,
        private readonly array $cssAttributes = [],
        private readonly array $jsAttributes = []
    ) {
    }

    public static function fromArray(array $config = []): self
    {
        return new self(
            version: (string) ($config['version'] ?? '5.3.3'),
            assetBaseUrl: (string) ($config['asset_base_url'] ?? 'https://cdn.jsdelivr.net/npm/bootstrap@{version}/dist'),
            cssPath: (string) ($config['css_path'] ?? 'css/bootstrap.min.css'),
            jsPath: (string) ($config['js_path'] ?? 'js/bootstrap.bundle.min.js'),
            cssUrlOverride: isset($config['css_url']) ? (string) $config['css_url'] : null,
            jsUrlOverride: isset($config['js_url']) ? (string) $config['js_url'] : null,
            cssAttributes: is_array($config['css_attributes'] ?? null) ? $config['css_attributes'] : [],
            jsAttributes: is_array($config['js_attributes'] ?? null) ? $config['js_attributes'] : []
        );
    }

    public function cssUrl(): string
    {
        return $this->cssUrlOverride ?? $this->buildAssetUrl($this->cssPath);
    }

    public function jsUrl(): string
    {
        return $this->jsUrlOverride ?? $this->buildAssetUrl($this->jsPath);
    }

    public function cssAttributes(): array
    {
        return $this->cssAttributes;
    }

    public function jsAttributes(): array
    {
        return $this->jsAttributes;
    }

    public function toArray(): array
    {
        return [
            'version' => $this->version,
            'asset_base_url' => $this->assetBaseUrl,
            'css_path' => $this->cssPath,
            'js_path' => $this->jsPath,
            'css_url' => $this->cssUrl(),
            'js_url' => $this->jsUrl(),
            'css_attributes' => $this->cssAttributes,
            'js_attributes' => $this->jsAttributes,
        ];
    }

    private function buildAssetUrl(string $path): string
    {
        $baseUrl = str_replace('{version}', $this->version, $this->assetBaseUrl);

        return rtrim($baseUrl, '/') . '/' . ltrim($path, '/');
    }
}
