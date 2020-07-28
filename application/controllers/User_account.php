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

    public function _profile_validation()
    {
        $this->form_validation->set_rules('user_name', 'Full Name', 'required|min_length[5]|max_length[40]');
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|max_length[25]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|max_length[35]');
        $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[5]|max_length[250]');
    }

    public function _upload_config()
    {
        $config['upload_path'] = './uploads/'.$this->session->userdata('company_name').'/user/'.$this->session->userdata('username');
        $config['allowed_types'] = 'jpg|png|jpeg';
        
        $this->load->library('upload', $config);
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

    public function change_profile_picture()
    {
        $this->_has_login_session();
        $this->_upload_config();
        
        if ($this->upload->do_upload('profile_picture')) {

            $data = array('profile_picture' => $this->upload->data()['file_name']);

            if ($this->admin->update('tb_user', 'id_user', $this->session->userdata('id_user'), $data)) {
                unlink('./uploads/'.$this->session->userdata('company_name').'/user/'.$this->session->userdata('username').'/'.$this->session->userdata('profile_picture'));
                $this->session->set_userdata('profile_picture', $this->upload->data()['file_name']);
                $this->session->set_flashdata('success', 'Update profile picture success!');
                redirect('User_Account');
            } else {
                unlink('./uploads/'.$this->session->userdata('company_name').'/user/'.$this->session->userdata('username').'/'.$this->input->post('profile_picture'));
                $this->session->set_flashdata('failed', 'Update profile picture failed!');
                redirect('User_Account');
            }
            
        } else {
            $this->session->set_flashdata('failed', $this->upload->display_errors());
            redirect('User_Account');
        }
    }

    public function update_profile()
    {
        $this->_has_login_session();
        $this->_profile_validation();
        $get_data = $this->admin->get('tb_user', ['id_user' => $this->session->userdata('id_user')]);
        if ($this->form_validation->run() == TRUE) {
            $data = $this->input->post(null, TRUE);
            if ($this->admin->update('tb_user', 'id_user', $this->session->userdata('id_user'), $data)) {
                if ($this->input->post('username') != $this->session->userdata('username')) {
                    $oldDir = './uploads/'.$this->session->userdata('company_name').'/user/'.$this->session->userdata('username').'/';
                    $newDir = './uploads/'.$this->session->userdata('company_name').'/user/'.$this->input->post('username').'/';
                    rename($oldDir, $newDir);
                    $this->session->set_userdata('username', $this->input->post('username'));
                }
                if ($this->input->post('user_name') != $this->session->userdata('nama_user')) {
                    $this->session->set_userdata('nama_user', $this->input->post('user_name'));
                }

                $this->session->set_flashdata('success', 'Update profile success!');
                redirect('User_Account');
            } else {
                $this->session->set_flashdata('failed', 'Update profile failed!');
                redirect('User_Account');
            }
            
        } else {
            $this->session->set_flashdata('failed', $this->upload->display_errors());
            redirect('User_Account');
        }
        
    }

}

/* End of file User_account.php */

?>