<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class User_management extends CI_Controller {

    
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

    private function _verify_validity()
    {
        if ($this->session->userdata('validity') >= date('Y-m-d')) {
            return;
        } else {
            redirect('Page403');
        }
    }

    private function _validation()
    {
        $this->form_validation->set_rules('user_name', 'User Name', 'required|min_length[5]|max_length[40]|is_unique[tb_user.user_name]');
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|max_length[25]|is_unique[tb_user.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|max_length[25]');
        $this->form_validation->set_rules('role', 'User Role', 'required');
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

    public function index()
    {
        $this->_has_login_session();
        $this->_verify_validity();
        $this->_is_owner();
        $data['title'] = $this->session->userdata('company_name').'- User Management';
        $data['main_view'] = 'cms/user/user_view';
        $data['data_users'] = $this->admin->get_all_users();
        $data['JSON'] = 'cms/user/user_JSON';
        $this->load->view('cms/template/template_view', $data);
    }

    public function add_new_user()
    {
        $this->_has_login_session();
        $this->_verify_validity();
        $this->_is_owner();
        $this->_validation();

        if ($this->form_validation->run() == TRUE) {

            $data = array(
                'id_user'       => $this->_generateId(),
                'user_name'     => $this->input->post('user_name'), 
                'username'      => $this->input->post('username'), 
                'password'      => password_hash($this->input->post('password'), PASSWORD_DEFAULT), 
                'role'          => $this->input->post('role'), 
                'active'        => 'false',
                'id_company'    => $this->session->userdata('id_company'),
                'createdAt'     => date('Y-m-d H:i:s')
            );

            if ($this->admin->insert('tb_user', $data) == TRUE) {
                mkdir('./uploads/'.$this->session->userdata('company_name').'/user/'.$this->input->post('username'));
                $this->session->set_flashdata('success', 'New user has been added!');
                redirect('User_management');
            } else {
                $this->session->set_flashdata('failed', 'New user failed to add! Try again');
                redirect('User_management');
            }
            
        } else {
            $this->session->set_flashdata('failed', validation_errors());
            redirect('User_management');
        }
        
    }

    public function get_user_by_id($id)
    {
        echo json_encode($this->admin->get('tb_user', ['id_user' => $id]));
    }

    public function toggle_user($id, $active_status)
    {
        $this->_has_login_session();
        $this->_verify_validity();
        $this->_is_owner();
        if ($active_status == 'true') {
            if ($id == $this->session->userdata('id_user')) {
                $this->session->set_flashdata('failed', 'You can not unactivate your own account!');
                return redirect('User_management');    
            }
            $data = array('active' => 'false' );
        } else {
            $data = array('active' => 'true' );
        }

        if($this->admin->update('tb_user', 'id_user', $id, $data) == TRUE ){
            $this->session->set_flashdata('success', 'Toggle user role sucess!');
            redirect('User_management');
        } else {
            $this->session->set_flashdata('failed', 'Toggle user role failed! Try again');
            redirect('User_management');
        }
        
    }

}

/* End of file User_management.php */

?>