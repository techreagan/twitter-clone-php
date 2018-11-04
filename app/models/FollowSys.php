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
    $this->db->query('SELECT id FROM following_sys WHERE follower_id = :follower_id AND following_id = :following_id');
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

  public function getTotalFollowing() {
    $this->db->query('SELECT id FROM following_sys WHERE follower_id = :user_id');
    $this->db->bind('user_id', $_SESSION['user_id']);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function getTotalFollower() {
    $this->db->query('SELECT id FROM following_sys WHERE following_id = :user_id');
    $this->db->bind('user_id', $_SESSION['user_id']);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function getTotalFollowingByUserName($username) {
    $this->db->query('SELECT users.id FROM following_sys 
                      JOIN users on following_sys.follower_id = users.id
                      WHERE users.username = :username 
    ');
    $this->db->bind('username', $username);
    $this->db->execute();

    return $this->db->rowCount();
  }

  public function getTotalFollowersByUserName($username) {
    $this->db->query('SELECT users.id FROM following_sys 
                      JOIN users on following_sys.following_id = users.id
                      WHERE users.username = :username
    ');
    $this->db->bind('username', $username);
    $this->db->execute();

    return $this->db->rowCount();
  }
  public function getFollowingByUserName($username) {
    $this->db->query('SELECT * FROM users 
                      JOIN following_sys on following_sys.follower_id = users.id
                      WHERE users.username = :username 
                      ORDER BY following_sys.id DESC
    ');
    $this->db->bind('username', $username);
    return $this->db->resultSet();
  }

  public function getFollow($id) {
    $this->db->query('SELECT * FROM users WHERE id = :id');
    $this->db->bind('id', $id);
    return $this->db->resultSet();
  }

  public function getFollowersByUserName($username) {
    $this->db->query('SELECT * FROM users 
                      JOIN following_sys on following_sys.following_id = users.id
                      WHERE users.username = :username
                      ORDER BY following_sys.id DESC
    ');
    $this->db->bind('username', $username);
    return $this->db->resultSet();
  }
}