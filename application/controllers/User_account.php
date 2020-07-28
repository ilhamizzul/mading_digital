<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class User_account extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model', 'admin');
        $this->load->model('auth_model', 'auth');
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
        $data['title'] = $this->session->userdata('company_name').'- Account Setting';
        $data['main_view'] = 'cms/account/account_view';
        $data['data_account'] = $this->admin->get('tb_user', ['id_user' => $this->session->userdata('id_user')]);
        $data['JSON'] = 'cms/account/account_JSON';
        $this->load->view('cms/template/template_view', $data);
    }

}

/* End of file User_account.php */

?>