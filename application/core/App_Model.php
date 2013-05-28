<?php
if (!defined('BASEPATH'))
  exit('No direct script access allowed');

/**
 * App Model use to add all behavior model
 * @author Mahendri Winata <mahen.0112@gmail.com>
 */

class App_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }
  
  private function __getDateInsertData(){
    return array(
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    );
  }
  
  private function __getDateUpdateData(){
    return array(
        'updated_at' => date('Y-m-d H:i:s')
    );
  }
  
  protected function setInsertData($insertData = array()){
    $return = array();
    foreach ($insertData as $key => $val){
      if(is_array($val)){
        $return[] = array_merge($val, $this->__getDateInsertData());
      }else{
        $return = array_merge($insertData, $this->__getDateInsertData());
        break;
      }
    }
    return $return;
  }
  
  protected function setUpdateData($updateData = array()){
    $return = array();
    foreach ($updateData as $key => $val){
      if(is_array($val)){
        $return[] = array_merge($val, $this->__getDateUpdateData());
      }else{
        $return = array_merge($updateData, $this->__getDateUpdateData());
        break;
      }
    }
    return $return;
  }
    
  protected function getOldDataArrayFormat($table = NULL, $id = NULL, $primary_key = 'id'){
    $data = $this->db->get_where($this->table, array($primary_key => $id))->result();
    return (array) $data[0];
  }
    
  protected function setHistoryAfterUpdate($oldData = array(), $table = NULL, $id = NULL, $primary_key = 'id'){
    $newData = $this->db->get_where($this->table, array($primary_key => $id))->result();
    
  }


}

?>