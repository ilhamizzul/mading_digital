<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Company_management extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model', 'admin');
    }

    public function _upload_config()
    {
        $config['upload_path'] = './uploads/'.$this->session->userdata('company_name').'/company/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        
        $this->load->library('upload', $config);
    }

    private function _has_login_session()
    {
        if($this->session->has_userdata('logged_in')) {
            return TRUE;
        } else {
            $this->session->set_flashdata('failed', 'company login session has ended! Please login again');
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

    public function _is_owner()
    {
        if ($this->session->userdata('role') != 'owner') {
            redirect('Custom404');
        }
    }

    public function _company_validation()
    {
        $this->form_validation->set_rules('company_name', 'Company Name', 'required|min_length[5]|max_length[40]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[5]|max_length[35]');
        $this->form_validation->set_rules('address', 'Address', 'trim|required|min_length[5]|max_length[250]');
    }

    public function index()
    {
        $this->_has_login_session();
        $this->_verify_validity();
        $this->_is_owner();
        $data['title'] = $this->session->userdata('company_name').' - Company Setting';
        $data['main_view'] = 'cms/company/company_view';
        $data['count_users'] = $this->admin->count_all_users();
        $data['count_active_users'] = $this->admin->count_all_active_users();
        $data['data_company'] = $this->admin->get('tb_company', ['id_company' => $this->session->userdata('id_company')]);
        $data['JSON'] = 'cms/company/company_JSON';
        $this->load->view('cms/template/template_view', $data);
    }

    public function change_company_logo()
    {
        $this->_has_login_session();
        $this->_verify_validity();
        $this->_is_owner();
        $this->_upload_config();
        
        if ($this->upload->do_upload('company_logo')) {

            $data = array('company_logo' => $this->upload->data()['file_name']);

            if ($this->admin->update('tb_company', 'id_company', $this->session->userdata('id_company'), $data)) {
                unlink('./uploads/'.$this->session->userdata('company_name').'/company/'.$this->session->userdata('company_logo'));
                $this->session->set_userdata('company_logo', $this->upload->data()['file_name']);
                $this->session->set_flashdata('success', 'Update company logo success!');
                redirect('Company_management');
            } else {
                unlink('./uploads/'.$this->session->userdata('company_name').'/company/'.$this->input->post('company_logo'));
                $this->session->set_flashdata('failed', 'Update company logo failed!');
                redirect('Company_management');
            }
            
        } else {
            $this->session->set_flashdata('failed', $this->upload->display_errors());
            redirect('Company_management');
        }
    }

    public function update_company()
    {
        $this->_has_login_session();
        $this->_verify_validity();
        $this->_is_owner();
        $this->_company_validation();
        if ($this->form_validation->run() == TRUE) {
            $data = $this->input->post(null, TRUE);
            if ($this->admin->update('tb_company', 'id_company', $this->session->userdata('id_company'), $data)) {
                
                if ($this->input->post('company_name') != $this->session->userdata('company_name')) {
                    $oldDir = './uploads/'.$this->session->userdata('company_name');
                    $newDir = './uploads/'.$this->input->post('company_name');
                    rename($oldDir, $newDir);
                    $this->session->set_userdata('company_name', $this->input->post('company_name'));
                }

                $this->session->set_flashdata('success', 'Update company success!');
                redirect('Company_management');
            } else {
                $this->session->set_flashdata('failed', 'Update company failed!');
                redirect('Company_management');
            }
            
        } else {
            $this->session->set_flashdata('failed', $this->upload->display_errors());
            redirect('Company_management');
        }
        
    }

}

/* End of file Company_management.php */

?>