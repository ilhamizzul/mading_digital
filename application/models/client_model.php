<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class client_model extends CI_Model {

    public function get_active_data($table, $where = null, $limit)
    {
        return $this->db->limit($limit)->get_where($table, $where)->result_array();
    }

    public function get_active_info()
    {
        $query_one_day = $this->db->select('*')->distinct()->from('tb_info')
                                    ->where([
                                        'active' => 'true',
                                        'DATE_FORMAT(activedAt,\'Y-m-d\')' => date('Y-m-d'),
                                        'due_date >=' => date('Y-m-d H:i:s'),
                                        'id_repeater' => 'RE001'
                                    ])->get_compiled_select();
        

        $query_every_day = $this->db->select('*')->distinct()->from('tb_info')
                                    ->where([
                                        'active' => 'true',
                                        'due_date >=' => date('Y-m-d H:i:s'),
                                        'id_repeater' => 'RE002'
                                    ])->get_compiled_select();
        
        $query_every_week = $this->db->select('*')->distinct()->from('tb_info')
                                    ->where([
                                        'active' => 'true',
                                        'due_date >=' => date('Y-m-d H:i:s'),
                                        'DATE_FORMAT(activedAt,\'l\')' => date('l'),
                                        'id_repeater' => 'RE003'
                                    ])->get_compiled_select();
        $query_every_month = $this->db->select('*')->distinct()->from('tb_info')
                                    ->where([
                                        'active' => 'true',
                                        'due_date >=' => date('Y-m-d H:i:s'),
                                        'DATE_FORMAT(activedAt,\'d\')' => date('d'),
                                        'id_repeater' => 'RE004'
                                    ])->get_compiled_select();
        $query_every_year = $this->db->select('*')->distinct()->from('tb_info')
                                    ->where([
                                        'active' => 'true',
                                        'due_date >=' => date('Y-m-d H:i:s'),
                                        'DATE_FORMAT(activedAt,\'Y\') <' => date('Y'),
                                        'DATE_FORMAT(activedAt,\'m-d\')' => date('m-d'),
                                        'id_repeater' => 'RE004'
                                    ])->get_compiled_select();

        $query = $this->db->query($query_one_day." UNION ".$query_every_day." UNION ".$query_every_week." UNION ".$query_every_month." UNION ".$query_every_year);
        return $query->result_array();
    }

}

/* End of file client_model.php */

?>