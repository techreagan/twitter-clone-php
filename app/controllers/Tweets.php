<?php 

class Tweets extends Controller {
  private $userModel;

  public function __construct() {
    $this->userModel = $this->model('User');
  }

  public function index() {
    $data = [
      'user' => $this->userModel->getUserById()
    ];

    $this->view('tweets/index', $data);
  }

}