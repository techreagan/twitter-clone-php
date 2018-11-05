<?php 

class Users extends Controller {
  private $userModel;
  private $tweetModel;

  public function __construct() {
    $this->userModel = $this->model('User');
    $this->tweetModel = $this->model('Tweet');
    $this->followModel = $this->model('FollowSys');
  }

  public function signup() {
    if(Auth::isLoggedIn()) {
      redirect('tweets');
    }

    if(is_post_request()) {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [
        'firstName' => trim($_POST['firstName']),
        'lastName' => trim($_POST['lastName']),
        'email' => trim($_POST['email']),
        'username' => trim($_POST['username']),
        'dob' => trim($_POST['dob']),
        'password' => trim($_POST['password']),
        'confirmPassword' => trim($_POST['confirmPassword']),
        'firstName_err' => '',
        'lastName_err' => '', 
        'email_err' => '',
        'username_err' => '',
        'dob_err' => '', 
        'password_err' => '',
        'confirmPassword_err' => ''
      ];

      if(Validation::isBlank($data['firstName'])) {
        $data['firstName_err'] = 'Please enter first name';
      } else if(!Validation::hasLength($data['firstName'], ['min' => '3'])) {
        $data['firstName_err'] = 'This must be at least three(3) characters long';
      } else if(!Validation::hasSymbolsAndNumbers($data['firstName'])) {
        $data['firstName_err'] = 'Invalid first name';
      }

      if(Validation::isBlank($data['lastName'])) {
        $data['lastName_err'] = 'Please enter last name';
      } else if(!Validation::hasLength($data['lastName'], ['min' => '3'])) {
        $data['lastName_err'] = 'This must be at least three(3) characters long';
      } else if(!Validation::hasSymbolsAndNumbers($data['lastName'])) {
        $data['lastName_err'] = 'Invalid first name';
      }

      if(Validation::isBlank($data['email'])) {
        $data['email_err'] = 'Please enter email';
      } else if(!Validation::hasValidEmailFormat($data['email'])) {
        $data['email_err'] = 'This is invalid';
      }

      if(Validation::isBlank($data['username'])) {
        $data['username_err'] = 'Please enter username';
      } else if(!Validation::hasLength($data['username'], ['min' => '3'])) {
        $data['username_err'] = 'This must be at least three(3) characters long';
      } else if(preg_match('/[-\W]/i', $data['username'])) {
        $data['username_err'] = 'Username can contain characters, numbers or underscore(_)';
      }

      if(Validation::isBlank($data['dob'])) {
        $data['username_err'] = 'Please enter date of birth';
      } 

      if(Validation::isBlank($data['password'])) {
        $data['password_err'] = 'Please enter password';
      } else if(!Validation::hasLength($data['password'], ['min' => '6'])) {
        $data['password_err'] = 'This must be at least six(6) characters long';
      } else if(Validation::hasUppercase($data['password'])) {
        $data['password_err'] = 'This must contain at least one uppercase letter';
      } else if(Validation::hasNumber($data['password'])) {
        $data['password_err'] = 'This must contain at least one number';
      }

      if(Validation::isBlank($data['confirmPassword'])) {
        $data['confirmPassword_err'] = 'Please enter password';
      } else if($data['confirmPassword'] !== $data['password']) {
        $data['confirmPassword_err'] = 'Password don\'t match';
      }

      if(empty($data['firstName_err']) && empty($data['lastName_err']) && empty($data['email_err']) && empty($data['username_err']) && empty($data['dob_err']) && empty($data['password_err']) && empty($data['confirmPassword_err'])) {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        
        $signup = $this->userModel->signup($data);
        if($signup) {
          Auth::logIn($signup);
          redirect('tweets');
        } else {  
          die('Something went wrong');
        }
      }

      $this->view('users/signup', $data);
    }
    $data = [
      'firstName' => '',
      'lastName' => '',
      'email' => '',
      'username' => '',
      'dob' => '',
      'password' => '',
      'confirmPassword' => '',
      'firstName_err' => '',
      'lastName_err' => '', 
      'email_err' => '',
      'username_err' => '',
      'dob_err' => '', 
      'password_err' => '',
      'confirmPassword_err' => ''
    ];

    $this->view('users/signup', $data);
  }

  public function login() {
    if(Auth::isLoggedIn()) {
      redirect('tweets');
    }

    if(is_post_request()) {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

      $data = [
        'username' => trim($_POST['username']),
        'password' => trim($_POST['password']),
        'username_err' => '', 
        'password_err' => '',
      ];

      if(Validation::isBlank($data['username'])) {
        $data['username_err'] = 'Please enter username';
      }

      if(Validation::isBlank($data['password'])) {
        $data['password_err'] = 'Please enter password';
      }

      if($this->userModel->findEmailOrUsername($data['username'])) {
        $data['username_err'] = 'Sorry we don\'t recognize you';
        $data['password_err'] = 'Please enter password';
      }

      if(empty($data['username_err']) && empty($data['password_err'])) {
        $login = $this->userModel->login($data);
        if($login) {
          Auth::logIn($login);
          redirect('tweets');
        } else {  
          $_SESSION['message'] = 'Email/username or password is invalid';
        }
      }

      $this->view('users/login', $data);
    }
    $data = [
      'username' => '',
      'password' => '',
      'username_err' => '', 
      'password_err' => '',
    ];

    $this->view('users/login', $data);
  }

  public function profile($username) {
    $data = [
      'user' => $this->userModel->getUserByUserName($username),
      'users' => $this->userModel->getAllUser(4),
      'tweets' => $this->tweetModel->getAllTweetsByUserName($username),
      'total-tweets' => $this->tweetModel->getTotalTweetsByUserName($username),
      'total-following' => $this->followModel->getTotalFollowingByUserName($username),
      'total-followers' => $this->followModel->getTotalFollowersByUserName($username),
      'follow' => $this->followModel,
      'likes' => $this->tweetModel, 
      'username' => $username
    ];
  
    $this->view('users/profile', $data);
  }

  public function following($username) {
    $data = [
      'user' => $this->userModel->getUserByUserName($username),
      'users' => $this->userModel->getAllUser(4),
      'tweets' => $this->tweetModel->getAllTweetsByUserName($username),
      'total-tweets' => $this->tweetModel->getTotalTweetsByUserName($username),
      'total-following' => $this->followModel->getTotalFollowingByUserName($username),
      'total-followers' => $this->followModel->getTotalFollowersByUserName($username),
      'following' => $this->followModel->getFollowingByUserName($username),
      'follow' => $this->followModel, 
      'username' => $username
    ];

    $this->view('users/following', $data);
  }

  public function followers($username) {
    $data = [
      'user' => $this->userModel->getUserByUserName($username),
      'users' => $this->userModel->getAllUser(4),
      'tweets' => $this->tweetModel->getAllTweetsByUserName($username),
      'total-tweets' => $this->tweetModel->getTotalTweetsByUserName($username),
      'total-following' => $this->followModel->getTotalFollowingByUserName($username),
      'total-followers' => $this->followModel->getTotalFollowersByUserName($username),
      'followers' => $this->followModel->getFollowersByUserName($username),
      'follow' => $this->followModel, 
      'username' => $username
    ];

    $this->view('users/followers', $data);
  }

  public function logout() {
    Auth::logOut();
    redirect('/');
  }

}