<?php

namespace app\base;
use app\base\Controller;
use app\models\User;

class Application
{
    public static string $ROOT_DIR;
    public static string $mailtrapUsername;
    public static string $mailtrapPassword;
    public static string $recaptcha_key;
    public static string $recaptcha_site_key;
    public string $layout = 'main';
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public ?User $user;
    public static Application $app;
    public static array $routeList;
    public ?Controller $controller = null;
    public View $view;

    public function __construct($rootPath, array $config, array $routeList, $mailtrapUsername, $mailtrapPassword, $recaptcha_key, $recaptcha_site_key)
    {   
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        self::$routeList = $routeList;
        self::$mailtrapUsername = $mailtrapUsername;
        self::$mailtrapPassword = $mailtrapPassword;
        self::$recaptcha_key = $recaptcha_key;
        self::$recaptcha_site_key = $recaptcha_site_key;
        $this->user = null;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);
        $this->view = new View();

    }

    public function run()
    {
       echo $this->router->resolve();
    }

    public function getController()
    {
        return $this->controller;
    }

    public function setController()
    {
        return $this->controller;
    }

    public function login($user)
    {
        $this->user = $user;
        $primaryKey = $user->id;
        $this->session->set('user', $primaryKey);
    }

    public function user()
    {
        return User::find($this->session->get('user'));
    }

    public function logout($user)
    {
        $this->session->remove('user');
        $this->user = null;
    }

    public function isGuest()
    {
        return is_null(Application::$app->user());
    }

}