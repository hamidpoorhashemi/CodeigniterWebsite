<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends MY_Controller {
	public function index()
	{
		header("Location:".$this->link['pageLink']."home");
die();
		$pageOption=array(
			"title"=>"Mehr Language Academy"
		);
		// $this->load->model("setting_model");
		// $data['pageLink']=$this->link['base']."page?name=";
		$sectionRout="";
		// $data['topMenu']=$this->setting_model->getPageClientForMenu();
		$data['pageOption']=$pageOption;
		$this->render($sectionRout.'home',$data);
	}
}
