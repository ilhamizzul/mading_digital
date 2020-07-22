<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class admin_model extends CI_Model {

    public function get_all_users()
    {
        return $this->db->get_where('tb_user', ['id_company' => $this->session->userdata('id_company')])
                        ->result_array();
    }

}

/* End of file admin_model.php */

?>