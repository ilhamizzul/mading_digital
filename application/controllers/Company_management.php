<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Company_management extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model', 'admin');
    }

    public function _upload_config()
    {
        $config['upload_path'] = './uploads/'.$this->session->userdata('company_name').'/company/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        
        $this->load->library('upload', $config);
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

    public function _is_owner()
    {
        if ($this->session->userdata('role') != 'owner') {
            redirect('Dashboard');
        }
    }

    public function index()
    {
        $this->_has_login_session();
        $this->_is_owner();
        $data['title'] = $this->session->userdata('company_name').'- Company Setting';
        $data['main_view'] = 'cms/company/company_view';
        $data['data_company'] = $this->admin->get('tb_company', ['id_company' => $this->session->userdata('id_company')]);
        $data['JSON'] = 'cms/company/company_JSON';
        $this->load->view('cms/template/template_view', $data);
    }

}

/* End of file Company_management.php */

?>