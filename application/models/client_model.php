<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class client_model extends CI_Model {

    public function get_active_data($table, $where = null)
    {
        return $this->db->limit(10)->get_where($table, $where)->result_array();
    }

    

}

/* End of file client_model.php */

?>