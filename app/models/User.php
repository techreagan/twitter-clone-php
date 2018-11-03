<?php 
// Auth::logOut();
class User {
  public function __construct() {
    $this->db = new Database;
  }

  public function signup($data) {
    $this->db->query('INSERT INTO users(firstname, lastname, email, username, dob, password) VALUES(
                      :firstname, :lastname, :email, :username, :dob, :password)');
    $this->db->bind('firstname', $data['firstName']);
    $this->db->bind('lastname', $data['lastName']);
    $this->db->bind('email', $data['email']);
    $this->db->bind('username', $data['username']);
    $this->db->bind('dob', $data['dob']);
    $this->db->bind('password', $data['password']);

    if($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function login($data) {
    $this->db->query('SELECT id, username, email, password FROM users WHERE username = :value or email = :value');
    $this->db->bind('value', $data['username']);
    $user = $this->db->single();

    if(password_verify($data['password'], $user->password)) {
      return $user;
    } else {
      return false;
    }
  }

  public function findEmailOrUsername($value) {
    $this->db->query('SELECT username, email FROM users WHERE username = :value or email = :value');
    $this->db->bind('value', $value);
    $user = $this->db->single();

    if(empty($this->db->rowCount())) {
      return true;
    } else {
      return false;
    }
  }

  public function getUserById() {
    $this->db->query('SELECT * FROM users WHERE id = :id');
    $this->db->bind('id', $_SESSION['user_id']);
    $user = $this->db->single();

    if($user) {
      return $user;
    } else {
      return false;
    }
  }

  public function getUserByUserName($username) {
    $this->db->query('SELECT * FROM users WHERE username = :username');
    $this->db->bind('username', $username);
    $user = $this->db->single();

    if($user) {
      return $user;
    } else {
      return false;
    }
  }

  public function getAllUser($number) {
    $this->db->query('SELECT id, firstname, lastname, username FROM users WHERE id != :user_id LIMIT :number');
    $this->db->bind(':number', $number);
    $this->db->bind('user_id', $_SESSION['user_id']);
    $users = $this->db->resultSet();

    return $users;
  }
}