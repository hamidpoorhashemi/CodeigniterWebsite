<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Setting_model extends MY_Model {

private $DBTables = array('pageOption' => "structure_page");

          //   **********************************************
          function getType($id=0){
              $tblname="type";
              $this->db->select('*');
              $this->db->from($tblname . ' as BaseTbl');
              if($id!=0)
              $this->db->where("BaseTbl.type_id",$id);
              $this->db->where("BaseTbl.type_activation",1);
              $this->db->where("BaseTbl.type_deleted",0);
              $query = $this->db->get();
              $result = $query->result();
              return $result;
          }
          //   **********************************************
          function getItem($id=null,$type=null,$activation=null,$deleted=null){
              $tblname="item";
              $this->db->select('*');
              $this->db->from($tblname . ' as BaseTbl');
              if($id!=null)
              $this->db->where("BaseTbl.item_id",$id);
              if($activation!=null)
              $this->db->where("BaseTbl.item_activation",$activation);
              if($deleted!=null)
              $this->db->where("BaseTbl.item_deleted",$deleted);
              $this->db->order_by("BaseTbl.item_priority","asc");

              $query = $this->db->get();
              $result = $query->result();
              return $result;
          }

          //   **********************************************
          function getItemByCondition($itemCondition=array()){
              $tblname="item";
              $this->db->select('*');
              $this->db->from($tblname . ' as BaseTbl');
              if(count($itemCondition)>0){
                      if($itemCondition['item_id']!=null)
                      $this->db->where("BaseTbl.item_id",$itemCondition['item_id']);
                      if($itemCondition['item_name']!=null)
                      $this->db->where("BaseTbl.item_name",$itemCondition['item_name']);
                      if($itemCondition['item_type']!=null)
                      $this->db->where("BaseTbl.item_type",$itemCondition['item_type']);
                      if($itemCondition['item_value']!=null)
                      $this->db->where("BaseTbl.item_value",$itemCondition['item_value']);
                      if($itemCondition['item_activation']!=null)
                      $this->db->where("BaseTbl.item_activation",$itemCondition['item_activation']);
                      if($itemCondition['item_deleted']!=null)
                      $this->db->where("BaseTbl.item_deleted",$itemCondition['item_deleted']);
                  }
                  $this->db->order_by("BaseTbl.item_priority","asc");

              $query = $this->db->get();
              $result = $query->result();
              return $result;
          }
          //   **********************************************
          function getRelatedItem($relation_id=null,$base_id=null,$inc_id=null,$activation=null,$deleted=null){
              $tblname="relation";
              $this->db->select('*');
              $this->db->from($tblname . ' as BaseTbl');
              if($base_id!=null){
              $this->db->join('item as item', 'BaseTbl.inc_id = item.item_id', 'right');

            }
              if($inc_id!=null){
              $this->db->join('item as item', 'BaseTbl.base_id = item.item_id', 'right');

            }
              if($relation_id!=null)
              $this->db->where("BaseTbl.relation_id",$relation_id);
              if($base_id!=null)
              $this->db->where("BaseTbl.base_id",$base_id);
              if($inc_id!=null)
              $this->db->where("BaseTbl.inc_id",$inc_id);
              if($activation!=null)
              $this->db->where("BaseTbl.relation_activation",$activation);
              if($deleted!=null)
              $this->db->where("BaseTbl.relation_deleted",$deleted);
              $this->db->order_by("item.item_priority","asc");
              $query = $this->db->get();
              $result = $query->result();
              return $result;
          }
          // **************************

}
