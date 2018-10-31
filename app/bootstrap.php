<?php 
// Load Config
require_once 'config/config.php';
// Load Helpers
require_once 'helpers/functions.php';
require_once 'helpers/auth.php';
require_once 'helpers/validation.php';

// Autoload Core Libraries
spl_autoload_register(function($className) {
  require_once 'libraries/'. $className .'.php';
});