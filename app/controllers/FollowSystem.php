<?php 

class FollowSystem extends Controller {

  public function follow() {
    if(is_ajax_request()) {
      echo $_POST['followerId'] . ' ' . $_POST['followingId'];
    } else {
      redirect('tweets');
    }
  }

}