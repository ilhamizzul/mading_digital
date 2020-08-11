<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('superadmin_model', 'superadmin');
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
        $data['title']          = 'Superadmin - Data Company';
        $data['data_company']   = $this->superadmin->get_data_company(['validity >=' => date('Y-m-d'), 'activeStatus' => true]);
        $data['main_view']      = 'super_cms/data_company/company_view';
        $data['JSON']           = 'super_cms/data_company/company_JSON';
        $this->load->view('super_cms/template/template_view', $data);
    }

    public function company_approval()
    {
        $this->_has_login_session();
        $data['title']          = 'Superadmin - Company Approval Waitlist';
        $data['data_company']   = $this->superadmin->get_data_company(['activeStatus' => false, 'validity >=' => '0000-00-00']);
        $data['main_view']      = 'super_cms/data_company/company_approval_view';
        $data['JSON']           = 'super_cms/data_company/company_JSON';
        $this->load->view('super_cms/template/template_view', $data);
    }

}

/* End of file Company.php */

?>