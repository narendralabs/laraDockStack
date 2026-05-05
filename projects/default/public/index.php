<?php

$checks = [
    'php' => PHP_VERSION,
    'pdo_mysql' => extension_loaded('pdo_mysql') ? 'loaded' : 'missing',
    'redis_target' => getenv('REDIS_HOST') ?: 'redis',
];

header('Content-Type: application/json');

echo json_encode([
    'name' => 'devstack',
    'status' => 'ok',
    'checks' => $checks,
], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
