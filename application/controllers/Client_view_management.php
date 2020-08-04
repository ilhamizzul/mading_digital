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

    private function _generateId()
    {
        $code = 'COL-'.date('ymd');
        $last_code = $this->admin->getMax('tb_client_coloring', 'id_color', $code);
        $add_code = substr($last_code, -5);
        $add_code++;
        $number = str_pad($add_code, 5, '0', STR_PAD_LEFT);
        return $code . $number;
    }

    private function _pusher()
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
        $data['message'] = 'update_view_success';
        $pusher->trigger('my-channel', 'my-event', $data);
    }

    private function _validation()
    {
        $this->form_validation->set_rules('title', 'Title', 'required|max_length[25]');
        $this->form_validation->set_rules('bg_color1', 'Background Color 1', 'required');
        $this->form_validation->set_rules('bg_color2', 'Background Color 2', 'required');
        $this->form_validation->set_rules('bg_color3', 'Background Color 3', 'required');
        $this->form_validation->set_rules('nav_color', 'Navbar & Footer Color', 'required');
        $this->form_validation->set_rules('txt_color', 'Default Text Color', 'required');
        $this->form_validation->set_rules('txt_news_color', 'Text News Color', 'required');
    }

    private function _color_pallete()
    {
        $color = $this->admin->get('tb_client_coloring', ['id_company' => $this->session->userdata('id_company'), 'active_color' => true]);
        
        $this->session->set_userdata('bg_color1', $color['bg_color1']);
        $this->session->set_userdata('bg_color2', $color['bg_color2']);
        $this->session->set_userdata('bg_color3', $color['bg_color3']);
        $this->session->set_userdata('nav_color', $color['nav_color']);
        $this->session->set_userdata('txt_color', $color['txt_color']);
        $this->session->set_userdata('txt_news_color', $color['txt_news_color']);
        
        return;
    }

    public function index()
    {
        $this->_has_login_session();
        $this->_is_owner();
        $data['title'] = $this->session->userdata('company_name').' - Client View Management';
        $data['JSON'] = 'cms/content_management/content_management_JSON';
        $data['data_client_view'] = $this->admin->get('tb_content_grp', null, ['id_company' => $this->session->userdata('id_company')]);
        $data['main_view'] = 'cms/content_management/content_management_view';
        $this->load->view('cms/template/template_view', $data);
    }

    public function color()
    {
        $this->_has_login_session();
        $this->_is_owner();
        $data['title'] = $this->session->userdata('company_name').' - Client View Color Library';
        $data['JSON'] = 'cms/content_management/coloring_JSON';
        $data['data_color'] = $this->admin->get('tb_client_coloring', null, ['id_company' => $this->session->userdata('id_company')]);
        $data['main_view'] = 'cms/content_management/coloring_view';
        $this->load->view('cms/template/template_view', $data);
    }

    public function update_template()
    {
        $this->_has_login_session();
        $this->_is_owner();
        $data_input = $this->input->post(null, TRUE);
        
        foreach ($data_input as $description => $value) {
            $data_array = array(
                'active' => $value
            );
            $this->admin->update_template(['description' => $description, 'id_company' => $this->session->userdata('id_company')], $data_array);
        }
        $this->_pusher();
        $this->session->set_flashdata('success', 'Update client template success!');
        redirect('Client_view_management');
    }

    public function get_color_by_id($id)
    {
        echo json_encode($this->admin->get('tb_client_coloring', ['id_color' => $id]));
    }

    public function add_new_color()
    {
        $this->_has_login_session();
        $this->_is_owner();
        $this->_validation();

        if ($this->form_validation->run() == TRUE) {
            $data = array(
                'id_color' => $this->_generateId(), 
                'id_company' => $this->session->userdata('id_company'), 
                'title' => $this->input->post('title'),
                'bg_color1' => $this->input->post('bg_color1'),
                'bg_color2' => $this->input->post('bg_color2'),
                'bg_color3' => $this->input->post('bg_color3'),
                'nav_color' => $this->input->post('nav_color'),
                'txt_color' => $this->input->post('txt_color'),
                'txt_news_color' => $this->input->post('txt_news_color'),
                'active_color' => false
            );
            if ($this->admin->insert('tb_client_coloring', $data)) {
                $this->session->set_flashdata('success', 'Color Added Successfully!');
                redirect('Client_view_management/color');
            } else {
                $this->session->set_flashdata('failed', 'Color failed to add!');
                redirect('Client_view_management/color');
            }
            
        } else {
            $this->session->set_flashdata('failed', validation_errors());
            redirect('Client_view_management/color');
        }
        
    }

    public function edit_color($id)
    {
        $this->_has_login_session();
        $this->_is_owner();
        $this->_validation();

        if ($this->form_validation->run() == TRUE) {
            $data = $this->input->post(null, true);

            if ($this->admin->update('tb_client_coloring', 'id_color', $id, $data) == TRUE) {
                $this->session->set_flashdata('success', 'Color '.$id.' updated successfully!');
                redirect('Client_view_management/color');
            } else {
                $this->session->set_flashdata('failed', 'Color failed to update!');
                redirect('Client_view_management/color');
            }
            
        } else {
            $this->session->set_flashdata('failed', validation_errors());
            redirect('Client_view_management/color');
        }
        
    }

    public function delete_color($id)
    {
        $get_data = $this->admin->get('tb_client_coloring', ['id_color' => $id]);
        if ($det_data['active_color'] == false) {
            if ($this->admin->delete('tb_client_coloring', 'id_color', $id)) {
                $this->session->set_flashdata('success', 'Color '.$id.' deleted successfully!');
                redirect('Client_view_management/color');
            } else {
                $this->session->set_flashdata('failed', 'Color failed to delete!');
                redirect('Client_view_management/color');
            }
            
        } else {
            $this->session->set_flashdata('failed', 'You can not delete active data!');
            redirect('Client_view_management/color');
        }
        
    }

    public function toggle_color($id)
    {
        $this->_has_login_session();
        $this->_is_owner();
        $current_data_active = $this->admin->get('tb_client_coloring', ['id_company' => $this->session->userdata('id_company'), 'active_color' => true]);
        if ($this->admin->update('tb_client_coloring', 'id_color', $id, ['active_color' => true])) {
            if ($this->admin->update('tb_client_coloring', 'id_color', $current_data_active['id_color'], ['active_color' => false])) {
                $this->_color_pallete();
                $this->_pusher();
                $this->session->set_flashdata('success', 'Color used successfully!');
                redirect('Client_view_management/color');    
            }
        } else {
            $this->session->set_flashdata('failed', 'Color failed to use!');
            redirect('Client_view_management/color');
        }
        
    }

}

/* End of file Client_view_management.php */

?>