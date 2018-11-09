<?php 

class Pages extends Controller {
  public function __construct() {
    if(Auth::isLoggedIn()) {
      redirect('tweets');
    }
  }

  public function index() {
    $data = [
      'title' => 'Twitter Clone'
    ];

    $this->view('pages/index', $data);
  }

  public function about() {
    $data = [
      'title' => 'About Us'
    ];

    $this->view('pages/about', $data);
  }
}