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
      return $this->getUserByUserName($data['username']);
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

  public function searchForUser($user) {
    $this->db->query('SELECT id, firstname, lastname, username FROM users 
                      WHERE firstname LIKE :user OR lastname LIKE :user OR username LIKE :user
                    ');
    $this->db->bind('user', '%' . $user . '%');
    return $this->db->resultSet();
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

  public function getAllUser($number = 0) {
    if($number == 0) {
      $this->db->query('SELECT id, firstname, lastname, username FROM users WHERE id != :user_id');
    } else {
      $this->db->query('SELECT id, firstname, lastname, username FROM users WHERE id != :user_id LIMIT :number');
      $this->db->bind(':number', $number);
    }
    $this->db->bind('user_id', $_SESSION['user_id']);
    $users = $this->db->resultSet();

    return $users;
  }

  public function updateInfo($info) {
    $query = 'UPDATE users SET ';
    $count = 0;
    foreach($info as $key => $value) {
      $count++;
      $query .= $key .  ' = :' . $key . ($count == count($info) ? ' ' : ', ');
    }
    $query .= 'WHERE id = :id';
    
    $this->db->query($query);
    foreach($info as $key => $value) {
      $this->db->bind($key, $value);
    }
    $this->db->bind('id', $_SESSION['user_id']);
    if($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }

  public function updatePassword($password) {
    $password = password_hash($password, PASSWORD_DEFAULT);
    $this->db->query('UPDATE users SET password = :password WHERE id = :id LIMIT 1');
    $this->db->bind('password', $password);
    $this->db->bind('id', $_SESSION['user_id']);
    
    if($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
}