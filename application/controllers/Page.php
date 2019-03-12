<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Page extends MY_Controller {
	public function index()
	{
		$this->load->model("setting_model");
		$pageName=$this->input->get('name');
		$pageOption=array(
			"title"=>"Mehr Language Academy",
			"description"=>""
		);
		$data['pageOption']=$pageOption;
		$this->renderPage($pageName,$data);
	}
	// /**************
}
