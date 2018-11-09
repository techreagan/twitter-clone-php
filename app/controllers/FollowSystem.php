<?php 

class FollowSystem extends Controller {
  private $followSystem;

  public function __construct() {
    Auth::requireLogIn();
    $this->followSystem = $this->model('FollowSys');
  }

  public function follow() {
    if(is_ajax_request()) {
      $follower_id = trim($_POST['followerId']);
      $following_id = trim($_POST['followingId']);

      if(!$this->followSystem->findFollow($follower_id, $following_id)) {
        $follower = $this->followSystem->follow($follower_id, $following_id);
        if($follower) {
          echo 'follow';
        }
      } else {
        $unfollow = $this->followSystem->unfollow($follower_id, $following_id);
        if($unfollow) {
          echo 'unfollow';
        }
      }
      
    } else {
      redirect('tweets');
    }
  }

}