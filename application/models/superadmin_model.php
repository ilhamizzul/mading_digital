<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Superadmin_model extends CI_Model {

    public function get($table, $data = null, $where = null)
    {
        if ($data != null) {
            return $this->db->get_where($table, $data)->row_array();
        } else {
            return $this->db->get_where($table, $where)->result_array();
        }
    }

    public function insert($table, $data, $batch = false)
    {
        return $batch ? $this->db->insert_batch($table, $data) : $this->db->insert($table, $data);
    }

    public function update($table, $pk, $id, $data)
    {
        return $this->db->where($pk, $id)
                        ->update($table, $data);   
    }

    public function delete($table, $pk, $id)
    {
        return $this->db->delete($table, [$pk => $id]);
        
    }

    public function delete_company($array_id)
    {
        $this->db->where_in('id_company', $array_id);
        return $this->db->delete('tb_company');
    }

    public function get_data_company($where = null)
    {
        return $this->db->select('tb_company.id_company as id_company, tb_user.email as user_email, tb_company.email as company_email, validity, company_logo, company_name, user_name, tb_company.createdAt as create_time')
                        ->from('tb_company')
                        ->join('tb_user', 'tb_user.id_company = tb_company.id_company')
                        ->where('tb_user.role', 'owner')
                        ->where($where)
                        ->group_by('tb_company.id_company')
                        ->get()
                        ->result_array();
    }

    public function get_token_transaction($where)
    {
        return $this->db->select('id_transaction, company_name, no_telp, tb_transaction_token.email as email, tb_token.token as token, token_type, tb_transaction_token.createdAt as requestAt')
                        ->from('tb_company')
                        ->join('tb_transaction_token', 'tb_transaction_token.id_company = tb_company.id_company')
                        ->join('tb_token', 'tb_token.token = tb_transaction_token.token')
                        ->where($where)
                        ->get()
                        ->result_array();
    }

    public function verify_company($id)
    {
        return $this->db->select('tb_company.id_company as id_company, activeStatus, active, id_user')
                        ->from('tb_company')
                        ->join('tb_user', 'tb_user.id_company = tb_company.id_company')
                        ->where('tb_user.role', 'owner')
                        ->where('tb_company.id_company', $id)
                        ->get()
                        ->row_array();
    }

}

/* End of file Superadmin_model.php */

?>