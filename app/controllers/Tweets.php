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
      'users' => $this->userModel->getAllUser(4)
    ];

    $this->view('tweets/index', $data);
  }

  public function postTweet() {
    sleep(2);
    if(is_ajax_request()) {
      $post = $this->tweetModel->postTweet($_POST['tweet']);
      if($post) {
        echo 'yes';
      } else {
        echo 'no';
      }
    } else {
      redirect('tweets');
    }
  }

  public function loadAllTweets() {
    $data = [
      'user' => $this->userModel->getUserById(),
      'tweets' => $this->tweetModel->getAllTweets()
    ];

    $this->view('tweets/loadAllTweets', $data);
  }
}