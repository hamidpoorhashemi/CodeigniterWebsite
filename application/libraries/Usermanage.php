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
        $phonePrefix  = $this->CI->session->userdata('user_phone_prefix');
        $phone  = $this->CI->session->userdata('user_phone');
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

// ***************

  public function getUserBySession(){
    $phonePrefix  = $this->CI->session->userdata('user_phone_prefix');
    $phone  = $this->CI->session->userdata('user_phone');
            $startAt  = $this->CI->session->userdata('startAt');
            $this->CI->load->model("user_model");

            $user=$this->CI->user_model->getUserByPhoneAndPrefix($phone,$phonePrefix);
return $user;
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
            $user=$this->CI->user_model->getUserByPhoneAndPass($data['user_phone'],$data['user_phone_prefix'],$pass);
            if(isset($user) && count($user)>0){

            		$the_session = array("user_phone" => $data['user_phone'], "user_phone_prefix"=>$data['user_phone_prefix'],"startAt" => time());
            		$this->CI->session->set_userdata($the_session);
                $res['res']="redirect";
                $res['msg']="Welcome";
                return $res;

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
            return array(
              "res"=>false,
              "msg"=>"You are Logined ."
            );;
          }
      	$res=array(
          "res"=>false,
          "msg"=>""
        );
          $loginValidation=$this->validationSignupData($data);
          if($loginValidation['res']==true){
            $phone=$data['user_phone_prefix'].$data['user_phone'];
            $pass=$data['user_password'];
            $vcode=$data['user_vcode']=rand(10000,99999);
            $this->CI->load->model("user_model");
            $this->CI->load->library("sms");

              $user=$this->CI->user_model->getUserByPhoneAndPrefix($data['user_phone'],$data['user_phone_prefix']);
              if(isset($user) && count($user)<=0){

                $newUserInfo=$this->CI->user_model->addUser($data);
              	if(!$newUserInfo){

                  $res['res']=false;
                  $res['msg']="Try again or request to help from support.";
              		}
              	$vCode=$newUserInfo['user_vcode'];
                $the_session = array("user_phone" => $data['user_phone'], "user_phone_prefix"=>$data['user_phone_prefix'],"startAt" => time());

                $this->CI->session->set_userdata($the_session);
                $res['res']="redirect";
                $res['msg']="Welcome";
                return $res;
              	if($resSMS>=2008){

              	}else{
                  $res['res']=true;
                  $res['msg']="Check your phone messages and if you dont get message Login and Request activation code.";
              	}



              }else{
                $res['res']=false;
                $res['msg']="Account with this phone number exist. if you forgot your password Use forgot password page to get your password.";
              }

          }else{

            return $loginValidation;
          }

            return $res;
      	}
        // *********
  public function validationLoginData($data=array()){
    return array(
      "res"=>true,
      "msg"=>"valid."
    );
  }
  // *********
public function validationSignupData($data=array()){
  $res=$this->checkPasswordConfirmation($data);
  if($res['res']==true){


return array(
"res"=>true,
"msg"=>"cc"
);
}else{
  return  $res;
}
}
// **************
private function checkPasswordConfirmation($data=array()){
  if(!array_key_exists("user_phone",$data) || strlen($data["user_phone"])<4 ){
      return array(
      "res"=>false,
      "msg"=>"Enter Phone number correctly."
      );
    }
  if(array_key_exists("user_password",$data) && array_key_exists("user_password_confirm",$data) &&
 strlen($data["user_password"])>3 && strlen($data["user_password_confirm"]) >3 ){
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
    "msg"=>"Enter Password and confirmation with more than 3 character."
    );
  }
  return array(
  "res"=>false,
  "msg"=>"Input is wrong."
  );
}
// ***************


}
