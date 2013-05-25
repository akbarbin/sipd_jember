<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * Admin Controller use to add all function admin used by user
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */
class Admin_Controller extends App_Controller { 
  
  public function __construct() {
    parent::__construct();
    
    /**
     * @author Mahendri Winata <mahen.0112@gmail.com>
     * 
     * Description :
     * Check User login status
     */
    if(self::$sessionLogin[md5('login')] != md5(TRUE)){
      redirect('user/login');
    }
    
  }

}

?>