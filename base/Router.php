<?php

namespace app\base;

require __DIR__.'/../base/Database.php';

use app\models\User;
use app\base\Request;

class Router
{
    public Request $request;
    public Response $response;
    protected array $routes = [];

    public function __construct(Request $request , Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function getCallback()
    {
        $method = $this->request->method();
        $url = $this->request->getPath();
        $url = trim($url, '/');

        // Get all routes with the method
        $routeList = Application::$routeList;
        $routeParams = false;
        
        foreach ($routeList as $r => $callback) {
            $r = trim($r, '/');
            $routeNames = [];

            if(!$r)
            {
                continue;
            }
            
            if(preg_match_all('/\{(\w+)(:[^}]+)?}/', $r, $matches))
            {
                $routeNames = $matches[1];
            }

            $routeRegex = "@^" . preg_replace_callback('/\{\w+(:([^}]+))?}/', fn($m)=>isset($m[2]) ? "({$m[2]})" : '(\w+)',$r) . "$@";

            if (preg_match_all($routeRegex, $url, $valueMatches))
            {
                $values = [];
                for ($i=1; $i < count($valueMatches) ; $i++ )
                {  
                    $values[] = $valueMatches[$i][0];
                }
                $routeParams = array_combine($routeNames,$values);
                $this->request->setRouteParams($routeParams);

                return $callback;
            }

        }
       return false;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->method();
        $callback = $this->routes[$method][$path] ?? false;

        if (!$callback)
        {
            $callback = $this->getCallback();

            if ($callback === false)
            {
                $this->response->setStatusCode(404);
                $user = User::find($_SESSION['user']);
                return Application::$app->view->renderOnlyView("_404", $user);
            }
            else{
                Application::$app->controller = new $callback[0]();
                $callback[0] = Application::$app->controller;
            }
            
        }

        #if callback is just a string
        if(is_string($callback))
        {
            return Application::$app->view->renderView($callback);
        }

        #if callback is an array and the first value is a class we create the instance of the class
        if(is_array($callback))
        {
           Application::$app->controller = new $callback[0]();
           $callback[0] = Application::$app->controller;
        }
        
        return call_user_func($callback, $this->request);
    }
}