<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('auth_model', 'auth');
        $this->load->model('admin_model', 'admin');
        
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

    public function _is_company_active($company_active_status)
    {
        if ($company_active_status == TRUE) {
            return true;
        } else {
            return false;
        }
        
    }

    private function _is_user_active($user_active_status)
    {
        if ($user_active_status == 'true') {
            return TRUE;
        } else {
            return FALSE;
        }
        
    }

    private function _make_directory($data_user)
    {
        mkdir('./uploads/'.$data_user['company_name']);
        mkdir('./uploads/'.$data_user['company_name'].'/company');
        mkdir('./uploads/'.$data_user['company_name'].'/carousel');
        mkdir('./uploads/'.$data_user['company_name'].'/carousel/image');
        mkdir('./uploads/'.$data_user['company_name'].'/carousel/video');
        mkdir('./uploads/'.$data_user['company_name'].'/user');
        mkdir('./uploads/'.$data_user['company_name'].'/user/'.$data_user['username']);
        return;
    }

    private function _set_default_color($id_company)
    {
        $colorset = array(
            'id_color'          => $this->_generateIdColor(),
            'id_company'        => $id_company, 
            'title'             => 'Default',
            'bg_color1'         => '#023e8a',
            'bg_color2'         => '#0096c7',
            'bg_color3'         => '#48cae4',
            'nav_color'         => '#03045e',
            'txt_color'         => 'white',
            'txt_news_color'    => '#48cae4',
            'active_color'      => true
        );
        $this->admin->insert('tb_client_coloring', $colorset);
    }

    private function _generate_content_group($id)
    {
        $data = array(
            array(
                'id_company'    => $id, 
                'description'   => 'footer',
                'active'        => 'true'
            ),
            array(
                'id_company'    => $id, 
                'description'   => 'carousel',
                'active'        => 'true'
            ),
            array(
                'id_company'    => $id, 
                'description'   => 'schedule',
                'active'        => 'true'
            ),
            array(
                'id_company'    => $id, 
                'description'   => 'navigation_bar',
                'active'        => 'true'
            )
        );
        $this->admin->insert('tb_content_grp', $data, true);
        return;
    }

    private function _is_first_time_login($data_user)
    {
        if ($data_user['firstLogin']) {
            $dt2 = new DateTime("+1 month");
            $date = $dt2->format("Y-m-d");
            $this->admin->update('tb_company', 'id_company', $data_user['id_company'], ['firstLogin' => false, 'validity' => $date]);
            $this->_set_default_color($data_user['id_company']);
            $this->_generate_content_group($data_user['id_company']);
            $this->_make_directory($data_user);
            return $date;
        } else {
            $validity = $this->admin->get('tb_company', ['id_company' => $data_user['id_company']]);
            return $validity['validity'];
        }
    }

    private function _register_validation()
    {
        $this->form_validation->set_rules('company_name', 'Company Name', 'required|max_length[50]|is_unique[tb_company.company_name]');
        $this->form_validation->set_rules('company_email', 'Company Email', 'required|max_length[70]|is_unique[tb_company.email]');
        $this->form_validation->set_rules('user_name', 'Full Name', 'required|max_length[40]|is_unique[tb_user.user_name]');
        $this->form_validation->set_rules('username', 'Username', 'required|max_length[25]|is_unique[tb_user.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|max_length[25]');
        $this->form_validation->set_rules('owner_email', 'Owner Email', 'required|max_length[70]|is_unique[tb_user.email]');
    }


    private function _generateId()
    {
        $code = 'US-'.date('ymd');
        $last_code = $this->admin->getMax('tb_user', 'id_user', $code);
        $add_code = substr($last_code, -6);
        $add_code++;
        $number = str_pad($add_code, 6, '0', STR_PAD_LEFT);
        return $code . $number;
    }

    private function _generateIdColor()
    {
        $code = 'COL-'.date('ymd');
        $last_code = $this->admin->getMax('tb_client_coloring', 'id_color', $code);
        $add_code = substr($last_code, -5);
        $add_code++;
        $number = str_pad($add_code, 5, '0', STR_PAD_LEFT);
        return $code . $number;
    }

    private function _generateIdCompany($length = 40)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
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

                            $validity = $this->_is_first_time_login($data_user);
                            $data_user = array(
                                'logged_in'         => TRUE,
                                'id_user'           => $data_user['id_user'],
                                'nama_user'         => $data_user['user_name'],
                                'username'          => $data_user['username'],
                                'role'              => $data_user['role'],
                                'profile_picture'   => $data_user['profile_picture'],
                                'id_company'        => $data_user['id_company'],
                                'company_name'      => $data_user['company_name'],
                                'company_logo'      => $data_user['company_logo'],
                                'validity'          => $validity
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

    public function super_login()
    {
        $this->_has_login();
        
        $data['title'] = 'Superadmin Login';
        $this->load->view('super_cms/auth/login_view', $data);
    }

    public function login_send()
    {
        $this->_login_validation();
        $this->_has_login();

        if ($this->form_validation->run() == TRUE) {
            $input = $this->input->post(NULL, TRUE);
            $data_admin = $this->auth->get_data_admin($input['username']);
            if (password_verify($input['password'], $data_admin['password'])) {
                $data = array(
                    'logged_in'         => TRUE,
                    'fullname'          => $data_admin['user_name'],
                    'username'          => $data_admin['username'],
                    'profile_picture'   => $data_admin['profile_picture'],
                    'role'              => 'superadmin'
                );
                $this->session->set_userdata( $data );

                $this->session->set_flashdata('success', 'Welcome, '.$this->session->userdata('fullname'));
                redirect('Dashboard');
            } else {
                $this->session->set_flashdata('failed', 'Incorrect password account!');
                redirect('Auth');    
            }
        } else {
            $this->session->set_flashdata('failed', validation_errors());
            redirect('Auth/super_login');
        }
        
    }

    public function register()
    {
        $this->_has_login();

        $data['title'] = 'Register';
        $this->load->view('cms/auth/register_view', $data);
    }

    public function register_send()
    {
        $this->_has_login();
        $this->_register_validation();

        if ($this->form_validation->run() == TRUE) {
            $data = $this->input->post(NULL, TRUE);
            $id_company = $this->_generateIdCompany();
            $data_company = array(
                'id_company'    => $id_company,
                'company_name'  => $data['company_name'], 
                'email'         => $data['company_email'], 
                'activeStatus'  => false,
                'createdAt'     => date('Y-m-d H:i:s'),
                'firstLogin'    => true,
                'onTrial'       => true
            );

            if ($this->admin->insert('tb_company', $data_company) == TRUE) {
                $company = $this->admin->get('tb_company', ['company_name' => $data['company_name']]);
                $data_owner = array(
                    'id_user'       => $this->_generateId(),
                    'user_name'     => $data['user_name'], 
                    'username'      => $data['username'], 
                    'password'      => password_hash($data['password'], PASSWORD_DEFAULT), 
                    'email'         => $data['owner_email'],
                    'active'        => 'false',
                    'role'          => 'owner',
                    'id_company'    => $company['id_company'],
                    'createdAt'     => date('Y-m-d H:i:s')
                );
                if ($this->admin->insert('tb_user', $data_owner) == TRUE) {
                    redirect('Auth/register_success');
                } else {
                    $this->admin->delete('tb_company', 'id_company', $id_company);
                    $this->session->set_flashdata('failed', 'Create owner account failed!');
                    redirect('Auth/register');
                }
            } else {
                $this->session->set_flashdata('failed', 'Create company account failed!');
                redirect('Auth/register');
            }

        } else {
            $this->session->set_flashdata('failed', validation_errors());
            redirect('Auth/register');
        }
    }

    public function register_success()
    {
        $this->_has_login();

        $data['title'] = 'Registration Success';
        $this->load->view('cms/auth/register_success_view', $data);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('Auth','refresh');
    }

}

/* End of file Auth.php */

?>
