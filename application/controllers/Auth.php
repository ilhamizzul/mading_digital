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

    private function _user_exist($input)
    {
        if ($this->auth->check_user($input) > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
        
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
            if ($this->_user_exist($input)) {

                $data_user = $this->auth->get_data_user($input);
                if ($data_user != NULL) {

                    if ($data_user['active']) {

                        $data_user = array(
                            'logged_in'         => TRUE,
                            'id_user'           => $data_user['id_user'],
                            'nama_user'         => $data_user['user_name'],
                            'role'              => $data_user['role'],
                            'id_company'        => $data_user['id_company'],
                            'company_name'      => $data_user['company_name']
                        );
                        
                        $this->session->set_userdata( $data_user );

                        $this->session->set_flashdata('success', 'Selamat Datang, '.$this->session->userdata('nama_user'));
                        redirect('Dashboard');
                    } else {
                        $this->session->set_flashdata('failed', 'Akun User belum aktif, Silahkan hubungi Admin untuk aktivasi akun!');
                        redirect('Auth');
                    }
                }
                
            } else {
                $this->session->set_flashdata('failed', 'Username akun tidak ditemukan!');
                redirect('Auth');
            }
        }
        
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('Auth','refresh');
    }

}

/* End of file Auth.php */

?>
