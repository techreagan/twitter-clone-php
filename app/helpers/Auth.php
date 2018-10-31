<?php

class Auth {

  public static function logIn($user) {
    session_regenerate_id();
    $_SESSION['user_id'] = $user->id;
    $_SESSION['user_name'] = $user->name;
    $_SESSION['last_login'] = time();
  
    return true;
  }
  
  public static function logOut() {
    unset($_SESSION['user_id']);
    unset($_SESSION['user_name']);
    unset($_SESSION['last_login']);
    session_destroy();
  
    return true;
  }
  
  public static function isLoggedIn() {
    return isset($_SESSION['user_id']);
  }
  
  public static function requireLogIn() {
    if(!self::isLoggedIn()) {
      redirect(url_for('/'));
    }
  }
}
