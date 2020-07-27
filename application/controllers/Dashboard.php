<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
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
        $data['title'] = $this->session->userdata('company_name')." - Dashboard";
        $data['main_view'] = 'cms/dashboard/dashboard_view';
        $data['JSON'] = 'cms/dashboard/dashboard_JSON';
        $this->load->view('cms/template/template_view', $data);
    }

}

/* End of file Dashboard.php */

?>