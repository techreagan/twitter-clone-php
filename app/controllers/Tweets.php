<?php 

class Tweets extends Controller {
  private $userModel;
  private $tweetModel;

  public function __construct() {
    $this->userModel = $this->model('User');
    $this->tweetModel = $this->model('Tweet');
  }

  public function index() {
    $data = [
      'user' => $this->userModel->getUserById(),
      'tweets' => $this->tweetModel->getAllTweets()
    ];

    $this->view('tweets/index', $data);
  }

}