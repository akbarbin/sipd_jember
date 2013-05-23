<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * MY_Admin use to add all function admin used by user
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */
class MY_Admin extends MY_App_controller { 
  
  public function __construct() {
    parent::__construct();
    
    /**
     * Check User login status
     */
    if(!self::$sessionLogin['login']){
      redirect('user/login');
    }
    
  }

}

?>