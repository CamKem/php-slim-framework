<?php

namespace App\Core;

class View
{

    /**
     * Render a view
     *
     * @param string $view
     * @param array $data
     * @return View
     */
    public static function render(string $view, array $data = [])
    {
        extract($data, \EXTR_SKIP);
        ob_start();
        require_once base_path(
            'views/'
            . str_replace('.', '/', $view)
            . '.view.php'
        );
        echo ob_get_clean();
    }

}