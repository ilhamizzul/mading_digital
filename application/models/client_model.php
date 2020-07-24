<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class client_model extends CI_Model {

    public function get($table, $data = null, $where = null)
    {
        if ($data != null) {
            return $this->db->get_where($table, $data)->row_array();
        } else {
            return $this->db->limit(10)->get_where($table, $where)->result_array();
        }
    }
    

}

/* End of file client_model.php */

?>