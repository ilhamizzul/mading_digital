<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model', 'admin');
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
        $data['data_count'] = array(
                                'active_carousel' => $this->admin->count_active_data('tb_carousel', ['id_company' => $this->session->userdata('id_company'), 'active' => 'true']),
                                'active_event' => $this->admin->count_active_data('tb_info', ['id_company' => $this->session->userdata('id_company'), 'active' => 'true', 'info_type' => 'event']), 
                                'active_news' => $this->admin->count_active_data('tb_info', ['id_company' => $this->session->userdata('id_company'), 'active' => 'true', 'info_type' => 'news']), 
                                'active_slogan' => $this->admin->count_active_data('tb_info', ['id_company' => $this->session->userdata('id_company'), 'active' => 'true', 'info_type' => 'slogan']) 
                            );
        $this->load->view('cms/template/template_view', $data);
    }

}

/* End of file Dashboard.php */

?>