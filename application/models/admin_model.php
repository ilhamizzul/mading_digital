<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class admin_model extends CI_Model {

    public function insert($table, $data, $batch = false)
    {
        return $batch ? $this->db->insert_batch($table, $data) : $this->db->insert($table, $data);
    }

    public function get_all_users()
    {
        return $this->db->get_where('tb_user', ['id_company' => $this->session->userdata('id_company')])
                        ->result_array();
    }

    public function getMax($table, $field, $code = null)
    {
        $this->db->select_max($field);
        if ($kode != null) {
            $this->db->like($field, $code, 'after');
        }
        return $this->db->get($table)->row_array()[$field];
    }

}

/* End of file admin_model.php */

?>