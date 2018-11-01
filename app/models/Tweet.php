<?php 

class Tweet {
  public function __construct() {
    $this->db = new Database;
  }

  public function getAllTweets() {
    $this->db->query('SELECT * FROM tweets WHERE user_id = :user_id ORDER BY id DESC');
    $this->db->bind('user_id', $_SESSION['user_id']);
    $tweets = $this->db->resultSet();

    return $tweets;
  }

  public function postTweet($body) {
    $this->db->query('INSERT INTO tweets(user_id, body) VALUES(:user_id, :body)');
    $this->db->bind('user_id', $_SESSION['user_id']);
    $this->db->bind('body', $body);

    if($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
}