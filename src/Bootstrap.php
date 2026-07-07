<?php

declare(strict_types=1);

namespace BootstrapPHP;

use InvalidArgumentException;

final class Bootstrap
{
    public static function config(array $options = []): Config
    {
        return Config::fromArray($options);
    }

    public static function cssTag(?Config $config = null, array $attributes = []): string
    {
        $config ??= new Config();

        return self::component('link', '', [
            'attributes' => array_replace(
                [
                    'rel' => 'stylesheet',
                    'href' => $config->cssUrl(),
                ],
                $config->cssAttributes(),
                $attributes
            ),
            'void' => true,
        ]);
    }

    public static function jsTag(?Config $config = null, array $attributes = []): string
    {
        $config ??= new Config();

        return self::component('script', '', [
            'attributes' => array_replace(
                [
                    'src' => $config->jsUrl(),
                ],
                $config->jsAttributes(),
                $attributes
            ),
            'escape' => false,
        ]);
    }

    public static function assets(?Config $config = null, string $separator = PHP_EOL): string
    {
        return self::cssTag($config) . $separator . self::jsTag($config);
    }

    public static function component(string $tag, string $content = '', array $options = []): string
    {
        self::assertValidTag($tag);

        $attributes = is_array($options['attributes'] ?? null) ? $options['attributes'] : [];
        $classes = self::normalizeClasses($options['classes'] ?? []);

        if ($classes !== '') {
            $attributes['class'] = trim(($attributes['class'] ?? '') . ' ' . $classes);
        }

        $attributeString = self::renderAttributes($attributes);

        if ((bool) ($options['void'] ?? false)) {
            return sprintf('<%s%s>', $tag, $attributeString);
        }

        $body = (bool) ($options['escape'] ?? true)
            ? self::escape($content)
            : $content;

        return sprintf('<%s%s>%s</%s>', $tag, $attributeString, $body, $tag);
    }

    public static function alert(string $content, string $variant = 'primary', array $attributes = []): string
    {
        return self::component('div', $content, [
            'classes' => ['alert', 'alert-' . $variant],
            'attributes' => array_replace(['role' => 'alert'], $attributes),
        ]);
    }

    public static function button(string $content, string $variant = 'primary', array $attributes = []): string
    {
        return self::component('button', $content, [
            'classes' => ['btn', 'btn-' . $variant],
            'attributes' => array_replace(['type' => 'button'], $attributes),
        ]);
    }

    public static function container(string $content, bool $fluid = false, array $attributes = [], bool $escape = true): string
    {
        return self::component('div', $content, [
            'classes' => [$fluid ? 'container-fluid' : 'container'],
            'attributes' => $attributes,
            'escape' => $escape,
        ]);
    }

    private static function escape(string $value): string
    {
        return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    private static function renderAttributes(array $attributes): string
    {
        $rendered = [];

        foreach ($attributes as $name => $value) {
            if (!is_string($name) || !preg_match('/^[a-zA-Z_:][a-zA-Z0-9_:\\.-]*$/', $name)) {
                throw new InvalidArgumentException(sprintf('Invalid HTML attribute name "%s".', (string) $name));
            }

            if ($value === false || $value === null) {
                continue;
            }

            if ($value === true) {
                $rendered[] = $name;

                continue;
            }

            $rendered[] = sprintf('%s="%s"', $name, self::escape((string) $value));
        }

        return $rendered === [] ? '' : ' ' . implode(' ', $rendered);
    }

    private static function normalizeClasses(string|array $classes): string
    {
        if (is_array($classes)) {
            $classList = $classes;
        } else {
            $trimmedClasses = trim($classes);
            $classList = $trimmedClasses === ''
                ? []
                : (preg_split('/\s+/', $trimmedClasses) ?: []);
        }

        $classList = array_values(array_unique(array_filter(array_map('strval', $classList))));

        return implode(' ', $classList);
    }

    private static function assertValidTag(string $tag): void
    {
        if (!preg_match('/^[a-zA-Z][a-zA-Z0-9-]*$/', $tag)) {
            throw new InvalidArgumentException(sprintf('Invalid HTML tag "%s".', $tag));
        }
    }
}
