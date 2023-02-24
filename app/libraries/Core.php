<?php

class Core {
  protected $controller = "Pages";
  protected $method = "index";
  protected $parameters = [];

  public function __construct() {
    $url = $this->getUrl();

    if (isset($url) && file_exists("../app/controllers/" . ucfirst($url[0]) . ".php")) { 
      $this->controller = ucfirst(array_shift($url));
    }

    require_once("../app/controllers/" . $this->controller . ".php");

    $this->controller = new $this->controller;

    if (isset($url[0])) {
      if (method_exists($this->controller, $url[0])) {
        $this->method = array_shift($url);
      }
    }
    
    $this->parameters = !empty($url) ? array_values($url) : [];

    call_user_func_array([$this->controller, $this->method], $this->parameters);
  }

  
  public function getUrl() {
    // "url" superglobal key can be defined because of the rewrite rule in root directory .htaccess file
    if (isset($_GET["url"])) {
      $url = trim($_GET["url"]);
      $url = filter_var($url, FILTER_SANITIZE_URL);
      
      $urlParams = explode("/", $url);

      return $urlParams;
    }
  }
}
