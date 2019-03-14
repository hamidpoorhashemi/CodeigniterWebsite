<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * This is Main Controller .. All controller extended from this class
 * @author	Hamid Pourhashemi
 */
class Pager {

private $CI;
    public function __construct(){
      $this->CI = & get_instance();
    }
    function load($pageName,$data){
      $this->CI->load->model('setting_model');
        $dataPage=array(
          "item_id"=>0,
          "item_name"=>"",
          "item_description"=>"",
          "item_need_login"=>0,
          "inc"=>array()

        );


        $itemCondition=array(
          "item_id"=>null,
          "item_name"=>null,
          "item_type"=>1,
          "item_value"=>$pageName,
          "item_activation"=>1,
          "item_deleted"=>0
        );
          $pageItemRow=$this->CI->setting_model->getItemByCondition($itemCondition);

          foreach ($pageItemRow as $keyPage => $valuePage) {
            $dataPage['item_id']=$valuePage->item_id;
            $dataPage['item_name']=$valuePage->item_name;
            $dataPage['item_description']=$valuePage->item_description;
            $dataPage['item_need_login']=$valuePage->item_need_login;

          }

      $dataPage['inc']=$this->getIncs($dataPage['item_id']);


return $dataPage;

    }
    // **************
    function getIncs($item_id=0){
      if($item_id!=0){
      $items=$this->CI->setting_model->getRelatedItem(null,$item_id,null,1,0);
      $c=0;
      $incItems=array();
          foreach ($items as $key => $value) {
            $incItems[$c]['name']=$value->item_name;
            $incItems[$c]['desc']=$value->item_description;
            $incItems[$c]['value']=$value->item_value;
            $c++;
          }
          return $incItems;
        }else{
          return array();
        }
    }
    // ************


// ****End of Class
}
