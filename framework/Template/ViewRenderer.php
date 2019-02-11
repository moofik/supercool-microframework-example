<?php

namespace Moofik\Framework\Template;

class ViewRenderer
{
    /**
     * @param string $view
     * @param array $params
     * @return false|string
     */
    public function renderView(string $view, array $params = [])
    {
        ob_start();

        foreach ($params as $name => $value) {
            $$name = $value;
        };

        require $_SERVER['DOCUMENT_ROOT'] . '/../views/' . $view;

        return ob_get_clean();
    }
}
