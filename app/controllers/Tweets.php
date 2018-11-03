<?php 

class Tweets extends Controller {
  private $userModel;
  private $tweetModel;

  public function __construct() {
    Auth::requireLogIn();
    $this->userModel = $this->model('User');
    $this->tweetModel = $this->model('Tweet');
    $this->followModel = $this->model('FollowSys');
  }

  public function index() {
    $data = [
      'user' => $this->userModel->getUserById(),
      'users' => $this->userModel->getAllUser(4),
      'total-tweets' => $this->tweetModel->getTotalTweets(),
      'total-following' => $this->followModel->getTotalFollowing(),
      'total-follower' => $this->followModel->getTotalFollower(),
      'follow' => $this->followModel
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
    if($this->tweetModel->getAllTweets()) {
      $data = [
        'user' => $this->userModel->getUserById(),
        'tweets' => $this->tweetModel->getAllTweets(),
        'user_tweets' => ''
      ];
    } else {
      $data = [
        'user' => $this->userModel->getUserById(),
        'tweets' => '',
        'user_tweets' => $this->tweetModel->getAllTweetsByUserSession()
      ];
    }

    $this->view('tweets/loadAllTweets', $data);
  }

  public function loadUserTweets($username) {
    
    $data = [
      'user' => $this->userModel->getUserById(),
      'tweets' => $this->tweetModel->getAllTweetsByUserName($username),
    ];

    $this->view('tweets/loadUserTweets', $data);
  }
}
