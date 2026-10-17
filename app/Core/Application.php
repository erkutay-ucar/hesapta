<?php

declare(strict_types=1);

namespace App\Core;

use RuntimeException;

final class Application
{
    private static ?self $instance = null;

    public function __construct(private readonly string $basePath)
    {
        self::$instance = $this;
    }

    public static function instance(): self
    {
        if (self::$instance === null) {
            throw new RuntimeException('Uygulama henüz başlatılmadı.');
        }

        return self::$instance;
    }

    public function basePath(string $path = ''): string
    {
        return $path === '' ? $this->basePath : $this->basePath . '/' . ltrim($path, '/');
    }

    public function run(): void
    {
        header('Content-Type: text/html; charset=UTF-8');

        $phpVersion = htmlspecialchars(PHP_VERSION, ENT_QUOTES, 'UTF-8');

        echo <<<HTML
        <!doctype html>
        <html lang="tr">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <title>Hesapta</title>
        </head>
        <body>
            <h1>Hesapta</h1>
            <p>Uygulama çekirdeği yüklendi. PHP sürümü: {$phpVersion}</p>
        </body>
        </html>
        HTML;
    }
}
