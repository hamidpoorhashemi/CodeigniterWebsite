<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * This is Main Controller .. All controller extended from this class
 * @author	Hamid Pourhashemi
 */

class MY_Model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();

    }

    function add($table,$data){
      $this->db->insert($table, $data);
      $insertId = $this->db->insert_id();
      if(is_numeric($insertId) && $insertId>0){
        return $insertId;
      }else{
        return false;
      }
    }
    // *****************
    function update($tableName,$updateData,$codition){
        foreach ($codition as $key => $value) {
          $this->db->where($key,$value);
        }
        $this->db->update($tableName, $updateData);
      return  $this->db->affected_rows();
    }
    // ***************

    public function select_all($tblname = '') {
        if ($tblname == '' || !$this->db->table_exists($tblname))
            return false;
        $this->db->select('*');
        $this->db->from($tblname . ' as BaseTbl');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    function select_all_with_join($base_tbl, $array_table_list, $where_array_query) {
        return false;
        if ($tblname == '' || !$this->db->table_exists($tblname))
            return false;
        $this->db->select('*');
        $this->db->from($tblname . ' as BaseTbl');
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function table_list($like = '') {
        if ($like != '') {
            $tables = $this->db->query("SHOW TABLES FROM `admin_aecv2` LIKE '%" . $like . "%' ")->result_array();
            return $tables;
        }
        $tables = $this->db->list_tables();
        return $tables;
    }

    /*     * ******* for employee ************ */

    public function select_all_employee_rows() {
        $this->db->select('*');
        $this->db->from('employee as BaseTbl');
        $this->db->join('employee_information as info', 'info.id_employee = BaseTbl.id_employee', 'right');
        $this->db->where('BaseTbl.deleted', 0);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }


    public function select_employee_row_by_id($id) {
        $this->db->select('*');
        $this->db->from('employee as BaseTbl');
        $this->db->join('employee_information as info', 'info.id_employee = BaseTbl.id_employee', 'right');
        $this->db->where('BaseTbl.deleted', 0);
        $this->db->where('BaseTbl.id_employee', $id);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    public function select_account_by_employee_id($id) {
        $this->db->select('*');
        $this->db->from('employee_account as BaseTbl');
//        $this->db->join('employee_information as info', 'info.id_employee = BaseTbl.id_employee', 'right');
        $this->db->where('BaseTbl.deleted', 0);
        $this->db->where('BaseTbl.id_employee', $id);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }
    public function get_employee_work_info($employee_rows = false) {
        if ($employee_rows == false)
            return false;

        $employee_work_rows = array();
        foreach ($employee_rows as $emp) {


            $this->db->select('*');
            $this->db->from('employee_project as BaseTbl');
            $this->db->order_by("start_work_date", "desc");

            $this->db->join('item_employer as employer', 'employer.id_employer = BaseTbl.company_id', 'right');
            $this->db->join('item_vendor as vendor', 'vendor.vendor_id = BaseTbl.vendor_id', 'right');
            $this->db->join('item_project as project', 'project.pvi_id = BaseTbl.project_id', 'right');
            $this->db->join('item_position as position', 'position.position_id = BaseTbl.position_id', 'right');

            $this->db->where('BaseTbl.id_employee', $emp->id_employee);

            $this->db->limit(1, 0);

            $query = $this->db->get();
            $res = $query->result();
            if (is_array($res))
                $employee_work_rows = array_merge($employee_work_rows, $res);
        }
        return $employee_work_rows;
    }

//    *********************************** Account ***********************
      public function select_account_row_by_employee_id($id) {
        $this->db->select('*');
        $this->db->from('employee_account as BaseTbl');
        $this->db->where('BaseTbl.deleted', 0);
        $this->db->where('BaseTbl.id_employee', $id);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }



    // *************************************
        public function select_all_employee_have_account() {
            $this->db->select('*');
            $this->db->from('employee_account as BaseTbl');
            $this->db->join('employee as empl', 'empl.id_employee = BaseTbl.id_employee', 'right');
            $this->db->join('employee_information as info', 'info.id_employee = BaseTbl.id_employee', 'right');
            $this->db->where('BaseTbl.deleted', 0);
            $query = $this->db->get();
            $result = $query->result();
            return $result;
        }

        // ******************************

              public function select_access_rows() {
                $this->db->select('*');
                $this->db->from('item_access as BaseTbl');
                $this->db->where('BaseTbl.deleted', 0);
                $query = $this->db->get();
                $result = $query->result();
                return $result;
            }

            // ******************************

                  public function select_account_type_rows() {
                    $this->db->select('*');
                    $this->db->from('item_account_type as BaseTbl');
                    $this->db->where('BaseTbl.item_account_type_deleted', 0);
                    $query = $this->db->get();
                    $result = $query->result();
                    return $result;
                }


                            // ******************************

                                  public function select_item_company() {
                                    $this->db->select('*');
                                    $this->db->from('item_company as BaseTbl');
                                    $this->db->where('BaseTbl.coi_deleted', 0);
                                    $query = $this->db->get();
                                    $result = $query->result();
                                    return $result;
                                }

                                // **********************************
    public function create_account($data_account) {
        $this->db->insert('employee_account', $data_account);

        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    public function set_access_account($account_id, $access_list) {
        $this->db->where('id_account', $account_id);
        $this->db->delete('employee_account_type_access');

        foreach ($access_list as $access) {
            $data_access = array(
                "id_account" => $account_id,
                "id_access" => $access,
                "deleted" => 0
            );
            $this->db->insert('employee_account_type_access', $data_access);
        }
    }

}
