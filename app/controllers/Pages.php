<?php

class Pages extends Controller {
  private $postModel;

  public function __construct() {
     $this->postModel = $this->model("post");
  }

  public function index() {
    $this->view("startpage");
  }

  public function homepage() {
  
  }
}
