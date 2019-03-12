<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * This is Main Controller .. All controller extended from this class
 * @author	Hamid Pourhashemi
 */
class Menu {

private $CI;
    public function __construct(){
      $this->CI = & get_instance();
    }
    function getMenu($data,$whithchild=1){
      $this->CI->load->model('setting_model');
      $this->CI->load->library('session');
      $data['menuItem']=array();
      $itemCondition=array(
        "item_id"=>null,
        "item_name"=>null,
        "item_type"=>2,
        "item_value"=>null,
        "item_activation"=>1,
        "item_deleted"=>0
      );
        $items=$this->CI->setting_model->getItemByCondition($itemCondition);
        $c=0;
      foreach ($items as $key => $value) {
        $data['menuItem'][$c]['name']=$value->item_name;
        $data['menuItem'][$c]['desc']=$value->item_description;
        $data['menuItem'][$c]['value']=$value->item_value;
            if($whithchild==1){
                $data['menuItem'][$c]['submenu']=$this->getSubMenu($value->item_id);
              }else{
                  $data['menuItem'][$c]['submenu']=array();
              }
        $c++;
      }
      $this->CI->load->view('panel/topmenu',$data);
    }
    // **************
    function getSubMenu($item_id=0){
// getRelatedItem($relation_id=null,$base_id=null,$inc_id=null,$activation=null,$deleted=null)
      $items=$this->CI->setting_model->getRelatedItem(null,$item_id,null,1,0);
      $c=0;
      $menuItems=array();
          foreach ($items as $key => $value) {
            $menuItems[$c]['name']=$value->item_name;
            $menuItems[$c]['desc']=$value->item_description;
            $menuItems[$c]['value']=$value->item_value;
            $c++;
          }
          return $menuItems;
    }
    // ************


// ****End of Class
}
