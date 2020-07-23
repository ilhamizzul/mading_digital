<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {

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
            $this->session->set_flashdata('failed', 'Masa waktu login berakhir! Silahkan login kembali');
            redirect('Auth');
        }
    }

    public function index()
    {
        $this->_has_login_session();
        $data['title']      = $this->session->userdata('company_name').' - Data Event';
        $data['data_event'] = $this->admin->get_all_events();
        $data['data_repeater'] = $this->admin->get('tb_repeater');
        $data['main_view']  = 'cms/event/event_view';
        $data['JSON']       = 'cms/event/event_JSON';
        $this->load->view('cms/template/template_view', $data);
    }

}

/* End of file Event.php */

?>