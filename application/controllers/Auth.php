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

    public function _is_company_active($company_active_status)
    {
        if ($company_active_status == TRUE) {
            return true;
        } else {
            return false;
        }
        
    }

    public function _is_user_active($user_active_status)
    {
        if ($user_active_status == 'true') {
            return TRUE;
        } else {
            return FALSE;
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

    private function _color_pallete()
    {
        $color = $this->auth->get_color_pallete();
        
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
                    if ($this->_is_user_active($data_user['active'])) {
                        if ($this->_is_company_active($data_user['activeStatus'])) {
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

                            $this->_color_pallete();

                            $this->session->set_flashdata('success', 'Welcome, '.$this->session->userdata('nama_user'));
                            redirect('Dashboard');
                        } else {
                            $this->session->set_flashdata('failed', 'Company Account still not active, Please call superadmin for company activation!');
                            redirect('Auth');
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
