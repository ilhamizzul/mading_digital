<?php 
    
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('client_model', 'client');
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
        $data['title'] = $this->session->userdata('company_name').' - Mading Digital';
        $data['content_group'] =  array(
            'schedule' => $this->client->get_content_group('schedule'),
            'carousel' => $this->client->get_content_group('carousel'),
            'footer' => $this->client->get_content_group('footer'),
            'navigation_bar' => $this->client->get_content_group('navigation_bar'),
        );
        $this->load->view('client/index', $data);
    }

    public function get_all_active_event()
    {
        echo json_encode($this->client->get_active_data('tb_info', ['due_date >=' => date('Y-m-d H:i:s'), 'info_type' => 'event']));
    }

    public function get_all_active_carousel()
    {
        echo json_encode($this->client->get_active_data('tb_carousel', ['id_company' => $this->session->userdata('id_company')]));
    }

    public function get_all_active_information()
    {
        echo json_encode($this->client->get_active_data('tb_info', ['due_date >=' => date('Y-m-d H:i:s'), 'info_type !=' => 'event']));
    }

}

/* End of file Home.php */
    
?>