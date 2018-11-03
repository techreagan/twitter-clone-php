<?php 

class FollowSys {
  public function __construct() {
    $this->db = new Database;
  }

  public function follow($follower_id, $following_id) {
    $this->db->query('INSERT INTO following_sys(follower_id, following_id) VALUES(:follower_id, :following_id)');
    $this->db->bind('follower_id', $follower_id);
    $this->db->bind('following_id', $following_id);

    if($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function unfollow($follower_id, $following_id) {
    $this->db->query('DELETE FROM following_sys WHERE follower_id = :follower_id AND following_id = :following_id LIMIT 1');
    $this->db->bind('follower_id', $follower_id);
    $this->db->bind('following_id', $following_id);

    if($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function findFollow($follower_id, $following_id) {
    $this->db->query('SELECT * FROM following_sys WHERE follower_id = :follower_id AND following_id = :following_id');
    $this->db->bind('follower_id', $follower_id);
    $this->db->bind('following_id', $following_id);
    $user = $this->db->single();
    if($user) {
      return true;
    } else {
      return false;
    }
  }

  public function isFollow($follower_id, $following_id) {
    $this->db->query('SELECT * FROM following_sys WHERE follower_id = :follower_id AND following_id = :following_id');
    $this->db->bind('follower_id', $follower_id);
    $this->db->bind('following_id', $following_id);
    $user = $this->db->single();
    if($user) {
      return 'following';
    } else {
      // return 'unfollow';
    }
  }
}