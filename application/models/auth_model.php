<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class auth_model extends CI_Model {

    public function check_user($input)
    {
        return $this->db->get_where('tb_user', ['username' => $input['username'], 'password' => $input['password']])
                        ->num_rows();
        
    }

    public function get_data_user($input)
    {
        return $this->db->join('tb_company', 'tb_company.id_company = tb_user.id_company')
                        ->get_where('tb_user', ['username' => $input['username'], 'password' => $input['password']])
                        ->row_array();
    }

}

/* End of file auth_model.php */

?>