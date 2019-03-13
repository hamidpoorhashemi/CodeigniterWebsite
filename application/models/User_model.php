<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends MY_Model {

private $DBTables = array('pageOption' => "structure_page");

      function addUser($newUser){
        $tblname="user";
        $code=rand(11011,99999);
        $user=array(
          "user_name"=>$newUser['user_name'],
          "user_phone"=>$newUser['user_phone'],
          "user_phone_prefix"=>$newUser['user_phone_prefix'],
          "user_vcode"=>$newUser['user_vcode'],
          "user_password"=>$newUser['user_password']
        );
        $this->db->insert($tblname, $user);
        $employee_id = $this->db->insert_id();
        if(is_numeric($employee_id) && $employee_id>0){
          return $user;
        }else{
          return false;
        }
      }
        // //   **********************************************
        // function getUserByPhone($phone){
        //     $tblname="user";
        //     $this->db->select('*');
        //     $this->db->from($tblname . ' as BaseTbl');
        //     $this->db->where("BaseTbl.user_phone",$phone);
        //     $this->db->where("BaseTbl.user_deleted",0);
        //     $query = $this->db->get();
        //     $result = $query->result();
        //     return $result;
        // }
        // ***********
        //   **********************************************
        function getUserByPhoneAndPrefix($phone,$prefix){
            $tblname="user";
            $this->db->select('*');
            $this->db->from($tblname . ' as BaseTbl');
            $this->db->where("BaseTbl.user_phone",$phone);
            $this->db->where("BaseTbl.user_phone_prefix",$prefix);
            $this->db->where("BaseTbl.user_deleted",0);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        }


          //   **********************************************
          function getUserByPhoneAndPass($phone,$prefix,$pass){
              $tblname="user";
              $this->db->select('*');
              $this->db->from($tblname . ' as BaseTbl');
              $this->db->where("BaseTbl.user_phone",$phone);
              $this->db->where("BaseTbl.user_phone_prefix",$prefix);
              $this->db->where("BaseTbl.user_password",$pass);
              $this->db->where("BaseTbl.user_deleted",0);
              $query = $this->db->get();
              $result = $query->result();
              return $result;
          }
}
