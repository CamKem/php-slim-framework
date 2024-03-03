<?php

namespace App\Core\Http;

class Response {
    const NOT_FOUND = 404;
    const FORBIDDEN = 403;
    const UNAUTHORIZED = 401;
    const OK = 200;

    public static function status(int $code): bool|int
    {
        return http_response_code($code);
    }

    public static function json(array $data): void
    {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    public static function body(string $body): void
    {
        echo $body;
        exit;
    }

    public static function redirect(string $url): void
    {
        header('Location: ' . $url);
        exit;
    }
}