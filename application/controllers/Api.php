<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Api extends MY_Controller {

function __construct(){

	parent::__construct();

	$this->load->model('User_model');
	$this->load->library('json');
	$this->load->library('usermanage');

}
	public function index()
	{
		// $jsonInt = $_POST;
		$jsonInt = file_get_contents("php://input");

// var_dump($postdata);
// return;
$jsonInt=trim($jsonInt,'"');
		$asArrt = explode( '|&&|', $jsonInt );
		if(is_array($asArrt)){
		foreach( $asArrt as $valt ){
			if(strpos($valt, "|$$|") !== false ){
			$tmpt = explode( '|$$|', $valt );
			$jsonIn[ $tmpt[0] ] = $tmpt[1];
		}
	}
}
// var_dump($jsonIn/);
		//
		if(isset($jsonIn['action'])  && isset($jsonIn['data']) && strlen($jsonIn['data']) > 5 && strpos($jsonIn['data'], "|&|") !== false && strpos($jsonIn['data'], ",") !== false){
			// $string = "business_type,cafe|business_type_plural,cafes|sample_tag,couch|business_name,couch cafe";
				$finalArray = array();
				$asArr = explode( '|&|', $jsonIn['data'] );
				foreach( $asArr as $val ){
					if(strpos($val, ",") !== false ){
				  $tmp = explode( ',', $val );
				  $finalArray[ $tmp[0] ] = $tmp[1];
				}
				}
		$actionData=$this->getActionData($jsonIn['action'],$finalArray);
	}else{
			if(isset($jsonIn['action'])){
				$actionData=$this->getActionData($jsonIn['action'],array());
			}else{
		echo $this->generateJson(array("res"=>false, "msg" =>"Data is Incorrect"));
	}
	}
	}
	// ***********
public function getActionData($action="",$data=array()){
			if($validateInputData=$this->validateInputApi($action,$data)){
			$res=$this->$action($data);
			echo $this->generateJson(array("res"=>$res['res'], "msg" =>$res['msg']));
		}else{
			echo $this->generateJson(array("res"=>false, "msg" =>"Actioan not found."));
		}
}
// *********
private function validateInputApi($action,$data){
	$action=strtolower($action);
	$actioansArray=array(
		"login"=>array(
			"input"=>array(
				"user_phone"=>"",
				"user_phone_prefix"=>"",
				"user_password"=>""
			)
		),
			"signup"=>array(
				"input"=>array(
					"user_name"=>"",
					"user_phone"=>"",
					"user_phone_prefix"=>"",
					"user_password"=>"",
					"user_password_confirm"=>""
				)
		),
			"sendvcode"=>array(
				"input"=>array(
				)
			),
				"active"=>array(
					"input"=>array(
						"activationcode"=>""
					)
				)

	);
	if(isset($action) && is_string($action) && array_key_exists($action,$actioansArray) && is_array($data)){

	foreach ($actioansArray[$action]['input'] as $key => $value) {
		if(!array_key_exists($key,$data)){
			echo $this->generateJson( array("res"=>false, "msg" =>$key . " Not found In your request."));
			return;
		}
	}
	return $actioansArray[$action];
}else {
		return array("res"=>false, "msg" =>$key . " Not found In your request.");
	}
}
	// ********
	public function login($data){
		$res= $this->usermanage->login($data);
		return $res;
	}
		// ********
		public function signup($data){
			$res= $this->usermanage->signup($data);
			return $res;
		}
			// ********
			public function sendvcode($data=array()){
				$res= $this->usermanage->sendVcode();
				return $res;
			}
			// ********
			public function active($data){
				$res= $this->usermanage->active($data);
				return $res;
			}
	// *********
	public function logout(){

	}
	// **********
	// **********
	public function forgetPassword(){

	}
	// *********
	public function checkUserSession(){

	}
	// **********
	function generateJson($data=array()){
		$res=json_encode($data);
		return $res;
	}

// ********* End of class
}
