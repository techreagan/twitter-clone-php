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
}