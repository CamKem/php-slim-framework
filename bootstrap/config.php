<?php

/**
 * Configuration file
 *
 * This file contains the configuration for the application.
 *
 * This is not for a package, it's for a new framework.
 */

function loadConfig(): array
{
    $envFilePath = __DIR__ . '/.env';
    if (!file_exists($envFilePath) || !is_readable($envFilePath)) {
        throw new Exception("Environment file not found or unreadable.");
    }

    $env = parse_ini_file($envFilePath);
    if ($env === false) {
        throw new Exception("Failed to parse the environment file.");
    }

    return [
        'app' => [
            'env' => $env['APP_ENV'] ?? 'development',
            'name' => $env['APP_NAME'] ?? 'Camwork',
            'url' => filter_var($env['APP_URL'] ?? 'http://camwork.test', FILTER_VALIDATE_URL),
        ],
        'database' => [
            'host' => $env['DB_HOST'] ?? 'localhost',
            'port' => $env['DB_PORT'] ?? '3306',
            'user' => $env['DB_USER'] ?? 'root',
            'password' => $env['DB_PASSWORD'] ?? '',
            'dbname' => $env['DB_NAME'] ?? strtolower(str_replace(' ', '_', $env['APP_NAME'] ?? 'camwork')),
            'charset' => $env['DB_CHARSET'] ?? 'utf8mb4',
        ],
    ];
}