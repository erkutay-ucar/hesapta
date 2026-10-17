<?php

declare(strict_types=1);

header('Content-Type: text/html; charset=UTF-8');

$phpVersion = htmlspecialchars(PHP_VERSION, ENT_QUOTES, 'UTF-8');
$server = htmlspecialchars((string) ($_SERVER['SERVER_SOFTWARE'] ?? 'Apache'), ENT_QUOTES, 'UTF-8');

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
    <p>Uygulama sunucusu çalışıyor.</p>
    <ul>
        <li>PHP sürümü: {$phpVersion}</li>
        <li>Web sunucusu: {$server}</li>
    </ul>
</body>
</html>
HTML;
