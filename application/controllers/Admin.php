<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends MY_Controller {
	public function index()
	{
		$pageOption=array(
			"title"=>"Admin Mehr Language Academy"
		);
		$this->load->model("setting_model");
		$data['pageLink']=$this->link['base']."admin?name=";
		$sectionRout="";
		$data['allType']=$this->setting_model->getType();
		$data['allItem']=$this->setting_model->getItem();
		$data['pageOption']=$pageOption;
		$this->render($sectionRout.'admin',$data);
	}
// ************************
private function loadEditItemPage($id,$data=array()){

			$this->load->model("setting_model");
	$item=array(
		"item_id"=>0,
		"item_name"=>"",
		"item_description"=>"",
		"item_value"=>"",
		"item_type"=>0,
		"item_activation"=>1,
		"item_deleted"=>0
	);

				$data['itemExist']=false;

			if(isset($id) && is_numeric($id)){
					$allItem=$this->setting_model->getItem($id);
					if($allItem){
					foreach ($allItem as $key => $value) {
									$item=array(
										"item_id"=>$value->item_id,
										"item_name"=>$value->item_name,
										"item_description"=>$value->item_description,
										"item_value"=>$value->item_value,
										"item_type"=>$value->item_type,
										"item_activation"=>$value->item_activation,
										"item_deleted"=>$value->item_deleted
									);

												$data['itemExist']=true;
							}
					}
				}
				$data['allType']=$this->setting_model->getType();
				$data['item']=$item;

				// getRelatedItem($relation_id=null,$base_id=null,$inc_id=null,$activation=null,$deleted=null)
				if($data['item']['item_id']>0){
				$data['parent']= $this->setting_model->getRelatedItem(null,null,$data['item']['item_id']);
				$data['child']= $this->setting_model->getRelatedItem(null,$data['item']['item_id']);
			}else{
					$data['parent']=array();
					$data['child']=array();
			}
				$data['link']=$this->link;
			$this->load->view($this->link['ajax']['routadmin'].'edititem',$data);

}

// ***************************
	public function ajaxEditItem(){
		$id=$this->input->post('id');
		$saveChange=$this->input->post('saveChange');
		$data=array();

		if(isset($saveChange) && $saveChange==true){
		$this->load->model("setting_model");
		$item_name=$this->input->post('item_name');
		$item_description=$this->input->post('item_description');
		$item_value=$this->input->post('item_value');
		$item_type=$this->input->post('item_type');
		$item_activation=$this->input->post('item_activation');
		$item_deleted=$this->input->post('item_deleted');
		$item=array(
			// "item_id"=>0,
			"item_name"=>$item_name,
			"item_description"=>$item_description,
			"item_value"=>$item_value,
			"item_type"=>$item_type,
			"item_activation"=>$item_activation,
			"item_deleted"=>$item_deleted
		);

		$changedRes=$this->setting_model->update('item',$item,array("item_id"=>$id));

			if(is_numeric($changedRes) && $changedRes > 0){
				$data['changedStatus']=true;
			}else{
				$data['changedStatus']=false;
			}
	}
		$this->loadEditItemPage($id,$data);
	}
// ************************
public function ajaxAddItem(){
	$this->load->model("setting_model");

	$data=array();
	$item_name=$this->input->post('item_name');
	$item_description=$this->input->post('item_description');
	$item_value=$this->input->post('item_value');
	$item_type=$this->input->post('item_type');
	$item_activation=$this->input->post('item_activation');
	$item_deleted=$this->input->post('item_deleted');
	$item=array(
		// "item_id"=>0,
		"item_name"=>$item_name,
		"item_description"=>$item_description,
		"item_value"=>$item_value,
		"item_type"=>$item_type,
		"item_activation"=>$item_activation,
		"item_deleted"=>$item_deleted
	);
		$addedId=$this->setting_model->add('item',$item);
		if(is_numeric($addedId) && $addedId > 0){
			$data['addedStatus']=true;
		}else{
			$data['addedStatus']=false;

		}
		$this->loadEditItemPage($addedId,$data);

}


}
