<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * This is Main Controller .. All controller extended from this class
 * @author	Hamid Pourhashemi
 */

class Usermanage {

  public $CI;
      public function __construct(){
        $this->CI = & get_instance();
      }
    public function checkLogin(){
      $this->CI->load->library('session');
      if ($this->CI->session->userdata('phone') !== FALSE && $this->CI->session->userdata('startAt') !== FALSE) {
                $phone  = $this->CI->session->userdata('phone');
                $startAt  = $this->CI->session->userdata('startAt');
                if($startAt<time()-86400){
                  return false;
                }else{
                  return true;
                }
      } else {
                return false;
      }

    }


        // ******************


    	public function login($data=array())
    	{
        if($this->checkLogin()){
          return true;
        }
    	$res=array(
        "res"=>false,
        "msg"=>""
      );
    		$this->CI->load->model("user_model");
        $loginValidation=$this->validationLoginData($data);
        if($loginValidation['res']){
          $phone=$data['user_phone_prefix'].$data['user_phone'];
          $pass=$data['user_password'];
            $user=$this->CI->user_model->getUserByPhoneAndPass($phone,$pass);
            if(isset($user) && count($user)>0){

            		$the_session = array("phone" => $phone, "startAt" => time());
            		$this->CI->session->set_userdata($the_session);
                $res['res']=true;
                $res['msg']="Welcome";
            }else{
              $res['res']=false;
              $res['msg']="Please enter phone number or password correctly.";
            }

        }

          return $res;
    	}
      // *********

          // ******************


      	public function signup($data=array())
      	{
          if($this->checkLogin()){
            return true;
          }
      	$res=array(
          "res"=>false,
          "msg"=>""
        );
      		$this->CI->load->model("user_model");
          $loginValidation=$this->validationSignupData($data);
          if($loginValidation['res']){
            $phone=$data['user_phone_prefix'].$data['user_phone'];
            $pass=$data['user_password'];
              $user=$this->CI->user_model->getUserByPhoneAndPass($phone,$pass);
              if(isset($user) && count($user)<=0){

              		$the_session = array("phone" => $phone, "startAt" => time());
              		$this->CI->session->set_userdata($the_session);
                  $res['res']=true;
                  $res['msg']="Welcome";
              }else{
                $res['res']=false;
                $res['msg']="Account with this phone number exist. if you forgot your password Use forgot password page to get your password.";
              }

          }

            return $res;
      	}
        // *********
  public function validationLoginData($data=array()){
    return array(
      "res"=>true,
      "msg"=>""
    );
  }
  // *********
public function validationSignupData($data=array()){
  if($res=$this->checkPasswordConfirmation($data)){


return array(
"res"=>true,
"msg"=>""
);
}else{
  return  $res;
}
}
// **************
private function checkPasswordConfirmation($data=array()){

  if(array_key_exists("user_password",$data) && array_key_exists("user_password_confirm",$data) &&
 strlen($data["user_password"])>5 && strlen($data["user_password_confirm"]) >5  ){
if($data["user_password"]==$data["user_password_confirm"]){
    return array(
    "res"=>true,
    "msg"=>""
    );
  }else{
    return array(
    "res"=>false,
    "msg"=>"Confirmation password must be the same of your password."
    );
  }
  }else{
    return array(
    "res"=>false,
    "msg"=>"Enter Password and confirmation with more than 5 character."
    );
  }
}

}
