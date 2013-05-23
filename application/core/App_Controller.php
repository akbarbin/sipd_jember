<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * App Controller use to add all function used by any user
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */
class App_Controller extends CI_Controller { 
  
  public static $sessionLogin;
  
  public function __construct() {
    parent::__construct();
    
    self::$sessionLogin = $this->session->all_userdata();
  }
    
}

?>