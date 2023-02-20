<?php 
  /* 
   * App Core Class
   * Creates URL & loads core controller
   * URL FORMAT - /controller/methods/params
  */

  class Core { 
    protected $currentController = 'Pages';
    protected $currentMethod = 'Index';
    protected $params = [];

    public function __contstruct(){
        // $this->getUrl();

        $url = $this->getUrl();

        // Look in controllers for controller / first value
        if(file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
            // if exists, then set as controller
            $this->currentController = ucwords($url[0]);
            // Unset 0 Index
            unset($url[0]);
        }

        // Require the controller
        require_once '../app/controllers/' . $this->currentController . '.php';

        // Instantiate controller class
        $this->currentController = new $this->currentController;

    }

    public function getUrl(){
        // echo $_GET['url'];

        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            // split the url 
            $url = explode('/', $url);
            return $url;
        }
    }

  }