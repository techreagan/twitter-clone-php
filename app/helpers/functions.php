<?php 

function url_for($script) {
  if($script[0] != '/') {
    $script = '/' . $script;
  }

  return URLROOT . $script;
}

function h($string) {
  return htmlspecialchars($string);
}

function u($url) {
  return urlencode($url);
}

function raw_u($url) {
  return rawurlencode($url);
}

function redirect($url) {
  header('Location: ' . url_for($url));
  exit;
}

function is_post_request() {
  return $_SERVER['REQUEST_METHOD'] === 'POST';
}

function is_get_request() {
  return $_SERVER['REQUEST_METHOD'] === 'GET';
}

function is_ajax_request() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest';
}

function get_and_clear_message() {
  if((isset($_SESSION['message'])) && ($_SESSION['message'] !== '')) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
    return $message;
  }
}

// Flash message helper 
// EXAMPLE - flash('register_success', 'You are now registered', 'alert alert-danger');
// DISPLAY IN VIEW - echo flash('register _success)
function flash($name = '', $message = '', $class = 'alert alert-success') {
  if(!empty($name)) {
    if(!empty($message) && empty($_SESSION[$name])) {
      if(!empty($_SESSION[$name])) {
        unset($_SESSION[$name]);
      }

      if(!empty($_SESSION[$name . '_class'])) {
        unset($_SESSION[$name . '_class']);
      }
     
      $_SESSION[$name] = $message;
      $_SESSION[$name . '_class'] = $class;
    } elseif(empty($message) && !empty($_SESSION[$name])) {
      $class = !empty($_SESSION[$name . '_class']) ? $_SESSION[$name . '_class'] : '';
      echo '<div class="'. $class .'" id="msg-flash">'. $_SESSION[$name] .'</div>';
      unset($_SESSION[$name]);
      unset($_SESSION[$name . '_class']);
    }
  }
}

function get_random_string() {
  return bin2hex(openssl_random_pseudo_bytes(32));
}

function time_elapsed_string($datetime, $full = false) {
  $now = new DateTime;
  $ago = new DateTime($datetime);
  $diff = $now->diff($ago);

  $diff->w = floor($diff->d / 7);
  $diff->d -= $diff->w * 7;

  $string = array(
      'y' => 'year',
      'm' => 'month',
      'w' => 'week',
      'd' => 'day',
      'h' => 'hour',
      'i' => 'minute',
      's' => 'second',
  );
  foreach ($string as $k => &$v) {
      if ($diff->$k) {
          $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
      } else {
          unset($string[$k]);
      }
  }
}