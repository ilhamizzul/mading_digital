<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model', 'auth');
    }

    private function _has_login()
    {
        if ($this->session->has_userdata('logged_in')) {
            redirect('dashboard');
        }
    }

    private function _login_validation()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
    }
    
    private function _user_exist($user_account)
    {
        if ($user_account != NULL) {
            return TRUE;
        }
        return FALSE;    
    }

    
    public function index()
    {
        $this->_has_login();
        $this->_login_validation();
        
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Login';
            $this->load->view('cms/auth/login_view', $data);
        } else {
            $input = $this->input->post(NULL, TRUE);

            $user_account = $this->auth->get_user_account($input['username']);
            if ($this->_user_exist($user_account)) {

                if (password_verify($input['password'], $user_account['password'])) {

                    $data_user = $this->auth->get_data_user($input['username'], $user_account['password']);
                    if ($data_user['active'] == 'true') {

                        if ($data_user['onLogin'] == true) {
                            $this->session->set_flashdata('failed', 'User Account have been used now!');
                            redirect('Auth');
                        } else {
                            $data_user = array(
                                'logged_in'         => TRUE,
                                'id_user'           => $data_user['id_user'],
                                'nama_user'         => $data_user['user_name'],
                                'username'          => $data_user['username'],
                                'role'              => $data_user['role'],
                                'profile_picture'   => $data_user['profile_picture'],
                                'id_company'        => $data_user['id_company'],
                                'company_name'      => $data_user['company_name'],
                                'company_logo'      => $data_user['company_logo']
                            );
                            
                            $this->session->set_userdata( $data_user );

                            $this->auth->toggleLoginStatus($this->session->userdata('id_user'), ['onLogin' => true]);

                            $this->session->set_flashdata('success', 'Welcome, '.$this->session->userdata('nama_user'));
                            redirect('Dashboard');
                        }

                    } else {
                        $this->session->set_flashdata('failed', 'User Account still not active, Please call admin for user activation!');
                        redirect('Auth');
                    }

                } else {
                    $this->session->set_flashdata('failed', 'Incorrect password account!');
                    redirect('Auth');    
                }

            } else {
                $this->session->set_flashdata('failed', 'Username account not found!');
                redirect('Auth');
            }
        }
        
    }

    public function logout()
    {
        $this->auth->toggleLoginStatus($this->session->userdata('id_user'), ['onLogin' => false]);
        $this->session->sess_destroy();
        redirect('Auth','refresh');
    }

}

/* End of file Auth.php */

?>
