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

}

/* End of file Client_view_management.php */

?>