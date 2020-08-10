<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class auth_model extends CI_Model {

    public function get_user_account($username)
    {
        return $this->db->get_where('tb_user', ['username' => $username])
                        ->row_array();
    }

    public function get_data_user($username, $password)
    {
        return $this->db->join('tb_company', 'tb_company.id_company = tb_user.id_company')
                        ->get_where('tb_user', ['username' => $username, 'password' => $password])
                        ->row_array();
    }

    public function get_data_admin($username)
    {
        return $this->db->get_where('tb_admin', ['username' => $username])
                        ->row_array();
    }

    public function get_color_pallete()
    {
        return $this->db->get_where('tb_client_coloring', ['active_color' => true, 'id_company' => $this->session->userdata('id_company')])
                        ->row_array();
    }

}

/* End of file auth_model.php */

?>