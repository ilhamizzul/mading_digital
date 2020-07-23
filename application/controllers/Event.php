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

    private function _to_date($date)
    {
        $new_date = strtotime($date);
        return date('Y-m-d h:i:s', $new_date); 
    }

    private function _validation()
    {
        $this->form_validation->set_rules('description', 'Description', 'min_length[5]|max_length[50]');
        $this->form_validation->set_rules('location', 'location', 'min_length[5]|max_length[50]');
        $this->form_validation->set_rules('id_repeater', 'Repeater', 'required');
        $this->form_validation->set_rules('info_type', 'Info Type', 'required');
    }

    private function _generateId($info_type)
    {
        if ($info_type == "event") {
            $code = 'EV-'.date('ymd');    
        } elseif ($info_type == "slogan") {
            $code = 'SL-'.date('ymd');    
        } else {
            $code = 'NE-'.date('ymd');
        }
        $last_code = $this->admin->getMax('tb_info', 'id_info', $code);
        $add_code = substr($last_code, -6);
        $add_code++;
        $number = str_pad($add_code, 6, '0', STR_PAD_LEFT);
        return $code . $number;
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

    public function add_new_event()
    {
        $this->_has_login_session();
        $this->_validation();

        $input = $this->input->post(NULL, TRUE);
        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'id_info'       => $this->_generateId($input['info_type']),
                'description'   => $this->input->post('description'),
                'location'      => $this->input->post('location'),
                'due_date'      => $this->_to_date($this->input->post('due_date')),
                'id_repeater'   => $this->input->post('id_repeater'),
                'info_type'     => $this->input->post('info_type'),
                'active'        => 'false',
                'id_company'    => $this->session->userdata('id_company')
            );
            if ($this->admin->insert('tb_info', $data)) {
                $this->session->set_flashdata('success', 'Add new event success!');
                redirect('Event');
            } else {
                $this->session->set_flashdata('failed', 'Add new event failed!');
                redirect('Event');
            }
            
        } else {
            $this->session->set_flashdata('failed', validation_errors());
            redirect('Event');
        }
        
    }

}

/* End of file Event.php */

?>