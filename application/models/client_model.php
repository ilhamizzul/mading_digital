<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class client_model extends CI_Model {

    public function get_active_data($table, $where)
    {
        $query_one_day = $this->db->select('*')->distinct()->from($table)
                                    ->where([
                                        'id_company' => $this->session->userdata('id_company'),
                                        'active' => 'true',
                                        'DATE_FORMAT(activedAt,"%Y-%m-%d")' => date('Y-m-d'),
                                        'id_repeater' => 'RE001'
                                    ])->where($where)->get_compiled_select();
        

        $query_every_day = $this->db->select('*')->distinct()->from($table)
                                    ->where([
                                        'id_company' => $this->session->userdata('id_company'),
                                        'active' => 'true',
                                        'id_repeater' => 'RE002'
                                    ])->where($where)->get_compiled_select();
        
        $query_every_week = $this->db->select('*')->distinct()->from($table)
                                    ->where([
                                        'id_company' => $this->session->userdata('id_company'),
                                        'active' => 'true',
                                        'DATE_FORMAT(activedAt,"%W")' => date('l'),
                                        'id_repeater' => 'RE003'
                                    ])->where($where)->get_compiled_select();

        $query_every_month = $this->db->select('*')->distinct()->from($table)
                                    ->where([
                                        'id_company' => $this->session->userdata('id_company'),
                                        'active' => 'true',
                                        'DATE_FORMAT(activedAt,"%d")' => date('d'),
                                        'id_repeater' => 'RE004'
                                    ])->where($where)->get_compiled_select();
                                    
        $query_every_year = $this->db->select('*')->distinct()->from($table)
                                    ->where([
                                        'id_company' => $this->session->userdata('id_company'),
                                        'active' => 'true',
                                        'DATE_FORMAT(activedAt,"%Y") <' => date('Y'),
                                        'DATE_FORMAT(activedAt,"%m-%d")' => date('m-d'),
                                        'id_repeater' => 'RE004'
                                    ])->where($where)->get_compiled_select();

        $query = $this->db->query($query_one_day." UNION ".$query_every_day." UNION ".$query_every_week." UNION ".$query_every_month." UNION ".$query_every_year);
        return $query->result_array();
    }

    public function get_content_group($content)
    {
        return $this->db->get_where('tb_content_grp', ['id_company' => $this->session->userdata('id_company'), 'description' => $content])->row_array();
    }

}

/* End of file client_model.php */

?>