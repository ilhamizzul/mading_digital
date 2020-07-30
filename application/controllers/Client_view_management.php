<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Client_view_management extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model', 'admin');
    }

    public function _is_owner()
    {
        if ($this->session->userdata('role') != 'owner') {
            redirect('Custom404');
        }
    }

    private function _has_login_session()
    {
        if($this->session->has_userdata('logged_in')) {
            return TRUE;
        } else {
            $this->session->set_flashdata('failed', 'User login session has ended! Please login again');
            redirect('Auth');
        }
    }

    public function index()
    {
        $this->_has_login_session();
        $this->_is_owner();
    }

}

/* End of file Client_view_management.php */

?>