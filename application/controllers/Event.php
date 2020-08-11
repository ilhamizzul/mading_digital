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
            $this->session->set_flashdata('failed', 'User login session has ended! Please login again');
            redirect('Auth');
        }
    }

    private function _pusher($info_type)
    {
        require_once(APPPATH.'views/vendor/autoload.php');
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        $pusher = new Pusher\Pusher(
            '7ba272c3a6631b4ffaf9',
            'a20830d1c80edd41247d',
            '1045050',
            $options
        );
        if ($info_type == 'event') {
            $data['message'] = 'event_success';    
        } else {
            $data['message'] = 'info_success';
        }
        
        $pusher->trigger('my-channel', 'my-event', $data);
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

    public function outdate_event()
    {
        $this->_has_login_session();
        $data['title']      = $this->session->userdata('company_name').' - Outdate Data Event';
        $data['main_view']  = 'cms/event/outdate_event_view';
        $data['data_event'] = $this->admin->get_all_expired_events();
        $data['JSON']       = 'cms/event/outdate_event_JSON';
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
                'due_date'      => $this->_to_date($this->input->post('due_date')),
                'id_repeater'   => $this->input->post('id_repeater'),
                'info_type'     => $this->input->post('info_type'),
                'active'        => 'false',
                'id_company'    => $this->session->userdata('id_company'),
                'createdAt'     => date('Y-m-d H:i:s')
            );
            if ($this->input->post('info_type') != 'event') {
                $data['location'] = '-';
            } else {
                $data['location'] = $this->input->post('location');
            }

            if ($data['due_date'] > date('Y-m-d H:i:s')) {
                if ($this->admin->insert('tb_info', $data)) {
                    $this->session->set_flashdata('success', 'Add new '.$input['info_type'].' success!');
                    redirect('Event');
                } else {
                    $this->session->set_flashdata('failed', 'Add new '.$input['info_type'].' failed!');
                    redirect('Event');
                }
            } else {
                $this->session->set_flashdata('failed', "Please insert due date to a future date!");
                redirect('Event');
            }
            
        } else {
            $this->session->set_flashdata('failed', validation_errors());
            redirect('Event');
        }
        
    }

    public function get_event_by_id($id)
    {
        echo json_encode($this->admin->get('tb_info', ['id_info' => $id]));
    }

    public function toggle_event($id)
    {
        $get_data = $this->admin->get('tb_info', ['id_info' => $id]);
        if ($get_data['active'] == 'true') {
            $data = array('active' => 'false' );
        } else {
            $data = array('active' => 'true', 'activedAt' => date('Y-m-d H:i:s') );
        }
        // if data is pass due date (EXPIRED) and data active status is false
        if (($get_data['due_date'] < date('Y-m-d H:i:s')) && ($get_data['active'] == 'false')) {
            $this->session->set_flashdata('failed', 'You can not activate data where the data is pass due date!');
            redirect('Event');
        } else {
            if($this->admin->update('tb_info', 'id_info', $id, $data) == TRUE ){
                $this->_pusher($get_data['info_type']);
                $this->session->set_flashdata('success', 'Toggle data info sucess!');
                redirect('Event');
            } else {
                $this->session->set_flashdata('failed', 'Toggle data info failed! Try again');
                redirect('Event');
            }
        }
        
    }

    public function edit_event($id)
    {
        $this->_has_login_session();
        $this->_validation();

        $get_data = $this->admin->get('tb_info', ['id_info' => $id]);
        $input = $this->input->post(NULL, TRUE);
        
        if ($get_data['active'] == 'true') {
            $this->session->set_flashdata('failed', 'You can not edit active '.$get_data['info_type'].'!');
            redirect('Event');
        } else {
            if ($this->form_validation->run() == TRUE) {

                $data = array(
                    'description'   => $this->input->post('description'),
                    'location'      => $this->input->post('location'),
                    'due_date'      => $this->_to_date($this->input->post('due_date')),
                    'id_repeater'   => $this->input->post('id_repeater'),
                    'info_type'     => $this->input->post('info_type')
                );

                if ($data['due_date'] > date('Y-m-d H:i:s')) {
                    if ($this->admin->update('tb_info', 'id_info', $id, $data)) {
                        $this->session->set_flashdata('success', $get_data['info_type'].' successfully updated!');
                        redirect('Event');
                    } else {
                        $this->session->set_flashdata('failed', 'Failed to update '.$get_data['info_type'].'!');
                        redirect('Event');
                    }
                } else {
                    $this->session->set_flashdata('failed', "Please change due date to a future date!");
                    redirect('Event');
                }
                
            } else {
                $this->session->set_flashdata('failed', validation_errors());
                redirect('Event');
            }
        }
        
    }

    public function retrieve_event($id)
    {
        $this->_has_login_session();
        $this->form_validation->set_rules('due_date', 'Due Date', 'required');
        
        
        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'active' => false,
                'due_date' => $this->_to_date($this->input->post('due_date')) 
            );
            if ($data['due_date'] > date('Y-m-d H:i:s')) {
                if ($this->admin->update('tb_info', 'id_info', $id, $data)) {
                    $this->session->set_flashdata('success', 'Data successfully retrieved!');
                    redirect('Event');
                } else {
                    $this->session->set_flashdata('failed', 'Data failed to be retireved!');
                    redirect('Event/outdate_event');
                }
            } else {
                $this->session->set_flashdata('failed', "Please change due date to a future date!");
                redirect('Event/outdate_event');
            }
        } else {
            $this->session->set_flashdata('failed', validation_errors());
            redirect('Event/outdate_event');
        }
        
    }

    public function delete_event($id)
    {
        $this->_has_login_session();
        $data = $this->admin->get('tb_info', ['id_info' => $id]);

        if ($data['active'] == 'true') {
            $this->session->set_flashdata('failed', 'You can not edit active '.$data['info_type'].'!');
            redirect('Event');
        } else {
            if ($this->admin->delete('tb_info', 'id_info', $id)) {
                $this->session->set_flashdata('success', 'Delete '.$data['info_type'].' success!');
                redirect('Event');
            } else {
                $this->session->set_flashdata('failed', 'Delete '.$data['info_type'].' failed!');
                redirect('Event');
            }
            
        }
        
    }

}

/* End of file Event.php */

?>