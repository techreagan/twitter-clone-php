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
      'getAllUsers' => $this->userModel->getAllUser(),
      'total-tweets' => $this->tweetModel->getTotalTweets(),
      'total-following' => $this->followModel->getTotalFollowing(),
      'total-follower' => $this->followModel->getTotalFollower(),
      'follow' => $this->followModel,
    ];

    $this->view('tweets/index', $data);
  }

  public function postTweet() {
    
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
        'user_tweets' => '',
        'likes' => $this->tweetModel
      ];
    } else {
      $data = [
        'user' => $this->userModel->getUserById(),
        'tweets' => '',
        'user_tweets' => $this->tweetModel->getAllTweetsByUserSession(),
        'likes' => $this->tweetModel
      ];
    }

    $this->view('tweets/loadAllTweets', $data);
  }

  public function loadUserTweets($username) {
    
    $data = [
      'user' => $this->userModel->getUserById(),
      'tweets' => $this->tweetModel->getAllTweetsByUserName($username),
      'likes' => $this->tweetModel
    ];

    $this->view('tweets/loadUserTweets', $data);
  }

  public function likeTweet() {
    if(is_ajax_request()) {
      $user_id = trim($_POST['userId']);
      $tweet_id = trim($_POST['tweetId']);
      $results = [];
      
      if(!$this->tweetModel->islike($user_id, $tweet_id)) {
        $like = $this->tweetModel->like($user_id, $tweet_id);
        $likeNumber = $this->tweetModel->getTotalLikes($tweet_id);

        if($like) {
          $results = [
            'like' => 'yes',
            'like_number' => $likeNumber
          ];
        }
      } else {
        $unlike = $this->tweetModel->unlike($user_id, $tweet_id);
        $likeNumber = $this->tweetModel->getTotalLikes($tweet_id);

        if($unlike) {
          $results = [
            'like' => 'no',
            'like_number' => $likeNumber
          ];
        }
      }


      echo json_encode($results);
      
    } else {
      // echo 'hello';
      redirect('tweets');
    }
  }

  public function deleteTweet() {
    if(is_ajax_request()) {
      $tweet_id = trim($_POST['tweetId']);
      // echo $tweet_id;
      $delete = $this->tweetModel->deleteTweet($tweet_id);

      if($delete) {
        echo 'deleted';
      } 
    }
  }
}
