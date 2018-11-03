<?php 

class Tweet {
  public function __construct() {
    $this->db = new Database;
  }

  public function getAllTweets() {
    $this->db->query('SELECT
                      t.user_id,
                      t.body,
                      t.created_at,
                      t.id,
                      users.firstname,
                      users.lastname,
                      users.username
                      FROM
                          tweets as t
                      JOIN following_sys ON t.user_id = following_sys.following_id or t.user_id = :user_id 
                      join users on users.id = t.user_id 
                      ORDER BY t.id DESC
    ');
    $this->db->bind('user_id', $_SESSION['user_id']);
    $tweets = $this->db->resultSet();

    return $tweets;
  }

  public function getAllTweetsByUserSession() {
    $this->db->query('SELECT * FROM tweets 
                      JOIN users as user on user.id = tweets.user_id  
                      WHERE user.id = :user_id ORDER BY tweets.id DESC');
    $this->db->bind('user_id', $_SESSION['user_id']);
    $tweets = $this->db->resultSet();

    if($tweets) {
      return $tweets;
    } else {
      return false;
    }
  }

  public function getAllTweetsByUserName($username) {
    $this->db->query('SELECT * FROM tweets 
                      JOIN users as user on user.id = tweets.user_id  
                      WHERE username = :username ORDER BY tweets.id DESC');
    $this->db->bind('username', $username);
    $tweets = $this->db->resultSet();

    if($tweets) {
      return $tweets;
    } else {
      return false;
    }
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