<?php 

class Tweet {
  public function __construct() {
    $this->db = new Database;
  }

  public function getAllTweets() {
    $this->db->query('SELECT * FROM tweets WHERE user_id = :user_id');
    $this->db->bind('user_id', $_SESSION['user_id']);
    $tweets = $this->db->resultSet();

    return $tweets;
  }
}