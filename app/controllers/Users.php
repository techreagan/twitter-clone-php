<?php 

class Users extends Controller {
  private $userModel;
  private $tweetModel;

  public function __construct() {
    $this->userModel = $this->model('User');
    $this->tweetModel = $this->model('Tweet');
    $this->followModel = $this->model('FollowSys');
  }

  public function index() {
    if(Auth::isLoggedIn()) {
      redirect('tweets');
    } else {
      redirect('/');
    }
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
      } else if(!$this->userModel->findEmailOrUsername($data['email'])) {
        $data['email_err'] = 'Email already been used';
      }

      if(Validation::isBlank($data['username'])) {
        $data['username_err'] = 'Please enter username';
      } else if(!Validation::hasLength($data['username'], ['min' => '3'])) {
        $data['username_err'] = 'This must be at least three(3) characters long';
      } else if(preg_match('/[-\W]/i', $data['username'])) {
        $data['username_err'] = 'Username can contain characters, numbers or underscore(_)';
      } else if(!$this->userModel->findEmailOrUsername($data['username'])) {
        $data['username_err'] = 'Username already been used';
      }

      if(Validation::isBlank($data['dob'])) {
        $data['dob_err'] = 'Please enter date of birth';
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

  public function profile($username = '') {
    Auth::requireLogIn();
    if(empty($username)) {
      redirect('tweets/');
    }
    $data = [
      'user' => $this->userModel->getUserByUserName($username),
      'users' => $this->userModel->getAllUser(4),
      'getAllUsers' => $this->userModel->getAllUser(),
      'tweets' => $this->tweetModel->getAllTweetsByUserName($username),
      'total-tweets' => $this->tweetModel->getTotalTweetsByUserName($username),
      'total-following' => $this->followModel->getTotalFollowingByUserName($username),
      'total-follower' => $this->followModel->getTotalFollowersByUserName($username),
      'follow' => $this->followModel,
      'likes' => $this->tweetModel, 
      'username' => $username
    ];

    if(!$data['user']) {
      redirect('tweets/');
    }
  
    $this->view('users/profile', $data);
  }

  public function editprofile() {
    Auth::requireLogIn();
    if(isset($_POST['changePassword'])) { 
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $user = $this->userModel->getUserById();
      $data = [
        'firstName' => $user->firstname,
        'lastName' => $user->lastname,
        'email' => $user->email,
        'username' => $user->username,
        'bio' => $user->bio,
        'dob' => $user->dob,
        'currentPassword' => trim($_POST['currentPassword']),
        'password' => trim($_POST['password']),
        'confirmPassword' => trim($_POST['confirmPassword']),
        'total-following' => $this->followModel->getTotalFollowing(),
        'total-follower' => $this->followModel->getTotalFollower(),
        'firstName_err' => '',
        'lastName_err' => '', 
        'email_err' => '',
        'username_err' => '',
        'bio_err' => '',
        'dob_err' => '',
        'currentPassword_err' => '',
        'password_err' => '',
        'confirmPassword_err' => '',
        'user' => $this->userModel->getUserById()
      ];
      if(Validation::isBlank($data['currentPassword'])) {
        $data['currentPassword_err'] = 'Please enter current password';
      } else if(!password_verify($data['currentPassword'], $user->password)) {
        $data['currentPassword_err'] = 'Password doesn\'t match current password';
        $_SESSION['message'] = 'Failed to change password';
      } else {

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

        if(empty($data['currentPassword_err']) && empty($data['password_err']) && empty($data['confirmPassword_err'])) {
          $updatedPassword = $this->userModel->updatePassword($data['password']);
          if($updatedPassword) {
            $_SESSION['message'] = 'Password Updated Successfully';
          }
        }

      }
        
      $this->view('users/editprofile', $data);
    } 
      
  
      
    if(isset($_POST['update'])) {
      $user = $this->userModel->getUserById();
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      $data = [
        'firstName' => trim($_POST['firstName']),
        'lastName' => trim($_POST['lastName']),
        'email' => trim($_POST['email']),
        'username' => trim($_POST['username']),
        'bio' => trim($_POST['bio']),
        'dob' => trim($_POST['dob']),
        'total-following' => $this->followModel->getTotalFollowing(),
        'total-follower' => $this->followModel->getTotalFollower(),
        'firstName_err' => '',
        'lastName_err' => '', 
        'email_err' => '',
        'username_err' => '',
        'bio_err' => '',
        'dob_err' => '', 
        'currentPassword_err' => '',
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
        $data['lastName_err'] = 'Invalid last name';
      }

      if($user->email !== $data['email']) {
        if(Validation::isBlank($data['email'])) {
          $data['email_err'] = 'Please enter email';
        } else if(!Validation::hasValidEmailFormat($data['email'])) {
          $data['email_err'] = 'This is invalid';
        } else if(!$this->userModel->findEmailOrUsername($data['email'])) {
          $data['email_err'] = 'Email already been used';
        }
      }

      if($user->username !== $data['username']) {
        if(Validation::isBlank($data['username'])) {
          $data['username_err'] = 'Please enter username';
        } else if(!Validation::hasLength($data['username'], ['min' => '3'])) {
          $data['username_err'] = 'This must be at least three(3) characters long';
        } else if(preg_match('/[-\W]/i', $data['username'])) {
          $data['username_err'] = 'Username can contain characters, numbers or underscore(_)';
        } else if(!$this->userModel->findEmailOrUsername($data['username'])) {
          $data['username_err'] = 'Username already taken';
        } 
      }

      if($user->bio !== $data['bio']) {
        if(Validation::isBlank($data['bio'])) {
          $data['bio_err'] = 'Please enter bio';
        } else if(!Validation::hasLength($data['bio'], ['min' => '3'])) {
          $data['bio_err'] = 'This must be at least three(3) characters long';
        }
      }

      if(Validation::isBlank($data['dob'])) {
        $data['username_err'] = 'Please enter date of birth';
      } 


      if(empty($data['firstName_err']) && empty($data['lastName_err']) && empty($data['email_err']) && empty($data['username_err']) && empty($data['bio_err']) && empty($data['dob_err'])) {
        $updateInfo = [];
        if($data['firstName'] !== $user->firstname) {
          $updateInfo['firstname'] = $data['firstName'];
        }

        if($data['lastName'] !== $user->lastname) {
          $updateInfo['lastname'] = $data['lastName'];
        }

        if($data['email'] !== $user->email) {
          $updateInfo['email'] = $data['email'];
        }

        if($data['username'] !== $user->username) {
          $updateInfo['username'] = $data['username'];
        }

        if($data['bio'] !== $user->bio) {
          $updateInfo['bio'] = $data['bio'];
        }

        if($data['dob'] !== $user->dob) {
          $updateInfo['dob'] = $data['dob'];
        }

        // var_dump($updatedInfo);

        if(!empty($updateInfo)) {
          $updatedInfo = $this->userModel->updateInfo($updateInfo);
          if($updatedInfo) {
            $_SESSION['message'] = 'Personal Information Updated';
          } else {
            
          }
        }
      }
      $data['user'] = $this->userModel->getUserById();
      $this->view('users/editprofile', $data);
    } 

    $user = $this->userModel->getUserById();
    $data = [
      'user' => $this->userModel->getUserById(),
      'firstName' => $user->firstname,
      'lastName' => $user->lastname,
      'email' => $user->email,
      'username' => $user->username,
      'bio' => $user->bio,
      'dob' => $user->dob,
      'total-following' => $this->followModel->getTotalFollowing(),
      'total-follower' => $this->followModel->getTotalFollower(),
      'firstName_err' => '',
      'lastName_err' => '', 
      'email_err' => '',
      'username_err' => '',
      'bio_err' => '',
      'dob_err' => '', 
      'currentPassword_err' => '',
      'password_err' => '',
      'confirmPassword_err' => ''
    ];
    
    $this->view('users/editprofile', $data);
  }

  public function following($username) {
    Auth::requireLogIn();
    if(empty($username)) {
      redirect('tweets/');
    }

    $data = [
      'user' => $this->userModel->getUserByUserName($username),
      'users' => $this->userModel->getAllUser(4),
      'tweets' => $this->tweetModel->getAllTweetsByUserName($username),
      'total-tweets' => $this->tweetModel->getTotalTweetsByUserName($username),
      'total-following' => $this->followModel->getTotalFollowingByUserName($username),
      'total-follower' => $this->followModel->getTotalFollowersByUserName($username),
      'following' => $this->followModel->getFollowingByUserName($username),
      'follow' => $this->followModel, 
      'username' => $username
    ];

    if(!$data['user']) {
      redirect('tweets/');
    }

    $this->view('users/following', $data);
  }

  public function followers($username) {
    Auth::requireLogIn();
    if(empty($username)) {
      redirect('tweets/');
    }
    $data = [
      'user' => $this->userModel->getUserByUserName($username),
      'users' => $this->userModel->getAllUser(4),
      'tweets' => $this->tweetModel->getAllTweetsByUserName($username),
      'total-tweets' => $this->tweetModel->getTotalTweetsByUserName($username),
      'total-following' => $this->followModel->getTotalFollowingByUserName($username),
      'total-follower' => $this->followModel->getTotalFollowersByUserName($username),
      'followers' => $this->followModel->getFollowersByUserName($username),
      'follow' => $this->followModel, 
      'username' => $username
    ];

    if(!$data['user']) {
      redirect('tweets/');
    }

    $this->view('users/followers', $data);
  }

  public function search() {
    Auth::requireLogIn();
    if(isset($_GET['user']) && !empty($_GET['user'])) {
      $user = trim($_GET['user']);
      $data = [
        'user' => $this->userModel->getUserById(),
        'searchResults' => $this->userModel->searchForUser($user),
        'total-tweets' => $this->tweetModel->getTotalTweets(),
        'total-following' => $this->followModel->getTotalFollowing(),
        'total-follower' => $this->followModel->getTotalFollower(),
        'follow' => $this->followModel,
      ];
      
    } else {
     
      $data = [
        'user' => $this->userModel->getUserById(),
        'searchResults' => '',
        'total-tweets' => $this->tweetModel->getTotalTweets(),
        'total-following' => $this->followModel->getTotalFollowing(),
        'total-follower' => $this->followModel->getTotalFollower(),
        'follow' => $this->followModel,
      ];
    }
  
    $this->view('users/search', $data);
  }

  public function logout() {
    Auth::logOut();
    redirect('/');
  }

}