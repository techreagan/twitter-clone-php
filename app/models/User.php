<?php 

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
    $this->db->query('SELECT id, username, email, password FROM users WHERE username = :value or email = :value AND password = :password');
    $this->db->bind('value', $data['username']);
    $this->db->bind('password', $data['password']);
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
}