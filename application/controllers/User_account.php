<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class User_account extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model', 'admin');
        $this->load->model('auth_model', 'auth');
    }

    private function _password_validation()
    {
        $this->form_validation->set_rules('old_password', 'Old Password', 'required');
        $this->form_validation->set_rules('new_password', 'New Password', 'required');
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
        $data['title'] = $this->session->userdata('company_name').'- Account Setting';
        $data['main_view'] = 'cms/account/account_view';
        $data['data_account'] = $this->admin->get('tb_user', ['id_user' => $this->session->userdata('id_user')]);
        $data['JSON'] = 'cms/account/account_JSON';
        $this->load->view('cms/template/template_view', $data);
    }

    public function change_password()
    {
        $this->_has_login_session();
        $this->_password_validation();

        if ($this->form_validation->run() == TRUE) {
            $data_user = $this->admin->get('tb_user', ['id_user' => $this->session->userdata('id_user')]);

            if (password_verify($this->input->post('old_password'), $data_user['password'])) {

                $new_password = array(
                    'password' => password_hash($this->input->post('new_password'), PASSWORD_DEFAULT) 
                );

                if ($this->admin->update('tb_user', 'id_user', $this->session->userdata('id_user'), $new_password)) {
                    $this->session->set_flashdata('success', 'Update password success!');
                    redirect('User_account');
                } else {
                    $this->session->set_flashdata('failed', 'Update password failed!');
                    redirect('User_account');
                }
            } else {
                $this->session->set_flashdata('failed', 'Incorrect password account!');
                redirect('User_account'); 
            }
            
        } else {
            $this->session->set_flashdata('failed', validation_errors());
            redirect('User_Account');
        }
        
    }

}

/* End of file User_account.php */

?>