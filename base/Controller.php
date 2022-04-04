<?php

namespace app\base;

class Controller
{
    public string $layout = 'main';
    
    public function render($view, $params = [])
    {
        return Application::$app->view->renderView($view,$params);
    }

    public function setLayout($layout)
    {
        $this->layout = $layout;
    }

    #convert eloquent objects into array
    public static function objectToArray(&$object)
    {
        return json_decode(json_encode($object), true);
    }
}