<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * This is Main Controller .. All controller extended from this class
 * @author	Hamid Pourhashemi
 */
class Json {

public $CI;
    public function __construct(){
      $this->CI = & get_instance();
    }
    function getValue($name="",$data=array()){
      $json = json_decode($data, true);
      return $json[$name];
    }

// ****End of Class
}
