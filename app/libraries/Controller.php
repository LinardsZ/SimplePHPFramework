<?php

class Controller {
  public function model($model) {
    require_once("../app/models/" . ucfirst($model) . ".php");
    
    return new $model();
  }

  public function view($view, $data = []) {
    if (file_exists("../app/views/" . $view . ".php")) {
      require_once("../app/views/" . $view . ".php");
    }
    else {
      // header("HTTP/1.1 404 Not Found", true, 404);
      // require_once("../app/views/errors/404.html");
    }
  }
}
