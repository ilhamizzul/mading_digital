<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Token extends CI_Controller {

    
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

    private function generateRandomString($length = 30) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    private function _is_superadmin()
    {
        if ($this->session->userdata('role') == 'superadmin') {
            return TRUE;
        }
        redirect('Custom_404');
    }

    private function _token_validation()
    {
        $this->form_validation->set_rules('count', 'Count', 'required');
        $this->form_validation->set_rules('token_type', 'token_type', 'required');
    }

    public function index()
    {
        $this->_has_login_session();
        $this->_is_superadmin();
        $data['title']          = 'Superadmin - Data Token';
        $data['data_token']     = $this->superadmin->get('tb_token', null, ['active' => false, 'send_status' => false]);
        $data['main_view']      = 'super_cms/token/token_view';
        $data['JSON']           = 'super_cms/token/token_JSON';
        $this->load->view('super_cms/template/template_view', $data);
    }

    public function add_new_token()
    {
        $this->_has_login_session();
        $this->_is_superadmin();
        $this->_token_validation();
        
        if ($this->form_validation->run() == TRUE) {
            $data_token = [];
            for ($i=0; $i < $this->input->post('count'); $i++) { 
                $data_array = array(
                    'token'         => $this->generateRandomString(),
                    'token_type'    => $this->input->post('token_type'),
                    'active'        => false,
                    'createdAt'     => date('Y-m-d H:i:s')
                );
                array_push($data_token, $data_array);
                $data_array = null;
            }
            if ($this->superadmin->insert('tb_token', $data_token, true)) {
                $this->session->set_flashdata('success', "Token successfully added!");
                redirect('Token');
            } else {
                $this->session->set_flashdata('failed', "Insert Token Error!");
                redirect('Token');
            }
        } else {
            $this->session->set_flashdata('failed', validation_errors());
                redirect('Token');
        }
        
    }

}

/* End of file Token.php */

?>