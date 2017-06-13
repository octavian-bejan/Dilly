<?php
    session_start();
    //error_reporting(E_ERROR);
    class App
    {

        protected $controller = 'home';
        protected $method = 'index';
        protected $params = array();


        public function __construct($urlBase)
        {
            global $homeUrl;
            $homeUrl = $urlBase;

            $url = $this->parseUrl();
            global $root;
            $root = "";
            for($i=0; $i<count($url)-1; ++$i)
            {
                $root = $root . "../";
            }

            if(file_exists('../app/controllers/' . $url[0] . '.php'))
            {
                $this->controller = $url[0];
                unset($url[0]);
            }

            require_once('../app/controllers/' . $this->controller . '.php');

            $this->controller = new $this->controller;

            if(isset($url[1]))
            {
                if(method_exists($this->controller, $url[1]))
                {
                    $reflection = new ReflectionMethod($this->controller, $url[1]);
                    if ($reflection->isPublic())
                    {
                        $this->method = $url[1];
                        unset($url[1]);
                    }
                }
            }

            if($url)
            {
                $this->params = array_values($url);
            }
            call_user_func_array(array($this->controller, $this->method), $this->params);
        }

        public function parseUrl()
        {
            if(isset($_GET['url']))
            {
                return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
            }
        }

    }
?>
