<?php

namespace App\Core;

class View
{
    private $path = ROOT . '/resources/views/';

    public function render($templateName, array $data = [], $layoutName = 'layout/layout')
    {
        $data['content'] = $this->_render($templateName, $data);
        return $this->_render($layoutName, $data);
    }

    protected function _render($templateName, $data)
    {
        try {
            ob_start();
            extract($data);
            include $this->path . $templateName . '.php';
            $out = ob_get_clean();
        } catch (\Exception $e) {
            ob_end_clean();
            throw $e;
        }
        return $out;
    }
}