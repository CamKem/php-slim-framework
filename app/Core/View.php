<?php

namespace App\Core;

use RuntimeException;
use Throwable;

class View
{

    public function __construct(string $content = '')
    {
        echo $content;
    }

    public static function make(string $view, array $data = []): self
    {
        $data['view'] = $view;
        $data['title'] = $data['title'] ?? $data['heading'] ?? '';
        extract($data, \EXTR_SKIP);
        ob_start();
        try {
            require_once base_path(
                'views/'
                . str_replace('.', '/', $view)
                . '.view.php'
            );
        } catch (Throwable $e) {
            ob_end_clean();
            throw new RuntimeException(
                $e->getMessage(),
                $e->getCode(),
                $e
            );
        }
        $content = ob_get_clean();
        return new static($content);
    }
}