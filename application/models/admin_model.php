<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class admin_model extends CI_Model {

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

    public function get_all_users()
    {
        return $this->db->get_where('tb_user', ['id_company' => $this->session->userdata('id_company')])
                        ->result_array();
    }

    public function get_all_events()
    {
        return $this->db->select('id_info, tb_info.description as info_description, tb_repeater.description as repeater, location, due_date, info_type, active, id_company')
                ->from('tb_info')
                ->join('tb_repeater', 'tb_repeater.id_repeater = tb_info.id_repeater')
                ->where('id_company', $this->session->userdata('id_company'))
                ->where('due_date >', date('Y-m-d H:i:s'))
                ->get()
                ->result_array();   
    }

    public function get_all_expired_events()
    {
        return $this->db->select('id_info, tb_info.description as info_description, tb_repeater.description as repeater, location, due_date, info_type, active, id_company')
                ->from('tb_info')
                ->join('tb_repeater', 'tb_repeater.id_repeater = tb_info.id_repeater')
                ->where('id_company', $this->session->userdata('id_company'))
                ->where('due_date <', date('Y-m-d H:i:s'))
                ->get()
                ->result_array();   
    }

    public function get_all_carousels()
    {
        return $this->db->select('id_carousel, tb_carousel.description as carousel_description, tb_repeater.description as repeater, title, data_type, data_carousel, active, id_company')
                ->from('tb_carousel')
                ->join('tb_repeater', 'tb_repeater.id_repeater = tb_carousel.id_repeater')
                ->where('id_company', $this->session->userdata('id_company'))
                ->get()
                ->result_array();   
    }

    public function getMax($table, $field, $code = null)
    {
        $this->db->select_max($field);
        if ($code != null) {
            $this->db->like($field, $code, 'after');
        }
        return $this->db->get($table)->row_array()[$field];
    }

    public function count_all_users()
    {
        return $this->db->where('id_company' , $this->session->userdata('id_company'))
                        ->count_all_results('tb_user');
    }

    public function count_all_active_users()
    {
        return $this->db->where(['id_company' => $this->session->userdata('id_company'), 'active' => 'true'])
                        ->count_all_results('tb_user');
    }

    public function count_active_data($tb, $where)
    {
        return $this->db->where($where)
                        ->count_all_results($tb);
    }

    public function update_template($where, $data)
    {
        return $this->db->where($where)
                        ->update('tb_content_grp', $data);
        
    }

}

/* End of file admin_model.php */

?>