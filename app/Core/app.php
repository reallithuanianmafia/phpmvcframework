<?php 

class App
{
    protected $controller="home";
    protected $method = "index";
    protected $params = [];
    public function __construct()
    {
        $url = $this->parseUrl();
        //print_r($url);
        if(isset($url[0]))
        {
            if(file_exists('../app/Controllers/'.$url[0].'.php'))
            {
                $this->controller = $url[0];
                unset($url[0]);
            }
        }
        

        // If Controller exists, it will require the given controller or home controller by default.

        require_once('../app/Controllers/'.$this->controller.'.php');
        
        $this->controller = new $this->controller;
        
        if(isset($url[1]))
        {
            if(method_exists($this->controller, $url[1]))
            {
                $this->method = $url[1];
                unset($url[1]);
            }
        }
        $this->params = $url ? array_values($url) : [];
        //print_r(array_values($url));
        call_user_func_array([$this->controller, $this->method], $this->params);
        }

    public function parseUrl()
    {
        if(isset($_GET['url']))
        {
            return $url = explode('/', $_GET['url']);
        }
    }
}