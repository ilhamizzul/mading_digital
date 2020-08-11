<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {

    
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

    public function _is_superadmin()
    {
        if ($this->session->userdata('role') == 'superadmin') {
            return TRUE;
        }
        redirect('Custom_404');
    }

    private function _send_mail($data)
    {
        $config = array(
			'mailtype' => 'html',
			'protocol' => 'smtp', 
			'smtp_host' => 'ssl://smtp.googlemail.com', 
			'smtp_port' => 465, 
			'smtp_user' => 'ilhamizzul@gmail.com', 
            'smtp_pass' => 'ilhamizzul123',
            'charset'   => 'iso-8859-1'
		);
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('ilhamizzul@gmail.com', 'Ilham Izzul Hadyan');
        $this->email->to($data['email']);
        
        $this->email->subject('Thank you for waiting!');
        $this->email->message('
            <!DOCTYPE html>
                <html lang="en">

                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Mail</title>
                    <style>
                        @import url("https://fonts.googleapis.com/css?family=Montserrat");
                        * {
                            font-family: "Montserrat";
                        }
                        .container {
                            width: 800px;
                            
                        }
                        .header {
                            background-image: linear-gradient(to bottom right, #023e8a, #0077b6);
                            width: 100%;
                            padding: 10px;
                        }
                        .header > h2 {
                            font-weight: 700;
                            color:white;
                        }
                        .footer{
                            background-color: #023e8a;
                            padding: 10px;
                            width: 100%;
                        }
                        .footer > h4 {
                            font-weight: 600;
                            color:white;
                        }
                        .body {
                            height: 300px;
                        }
                        .body > h3 {
                            text-align: center;
                            padding: 75px 0px 25px 0px;
                        }
                        a {
                            padding: 15px;
                            border-radius: 5px;
                            border: 2.5px solid #023e8a;
                            color: white;
                            font-weight: 600;
                            text-decoration: none;
                        }
                    </style>
                </head>

                <body>
                    <div class="container">
                        <div class="row header">
                            <h2 class="">Thank you for registering!</h2>
                        </div>
                        <div class="body">
                            <h3 class="text-center">Thank you for submiting the registration form! <br> for the next step, please open verification page on the button below</h3>
                            <center><a href="'.base_url().'Verify/index/'.$data['id_company'].'">Verify Account</a></center>
                        </div>
                        <div class="row footer">
                            <h4 class="">Copyright &copy; Sistem Mading Digital 2020</h4>
                        </div>
                    </div>
                </body>

            </html>
        ');
        
        if($this->email->send()) {
            $this->session->set_flashdata('success', 'Email has been send successfully!');
            redirect('Company/company_approval');
        } else {
            $this->session->set_flashdata('failed', $this->email->print_debugger());
            redirect('Company/company_approval');
        }
        
        
    }

    public function index()
    {
        $this->_has_login_session();
        $this->_is_superadmin();
        $data['title']          = 'Superadmin - Data Company';
        $data['data_company']   = $this->superadmin->get_data_company(['validity >=' => date('Y-m-d'), 'activeStatus' => true]);
        $data['main_view']      = 'super_cms/data_company/company_view';
        $data['JSON']           = 'super_cms/data_company/company_JSON';
        $this->load->view('super_cms/template/template_view', $data);
    }

    public function company_approval()
    {
        $this->_has_login_session();
        $this->_is_superadmin();
        $data['title']          = 'Superadmin - Company Approval Waitlist';
        $data['data_company']   = $this->superadmin->get_data_company(['activeStatus' => false, 'validity >=' => '0000-00-00']);
        $data['main_view']      = 'super_cms/data_company/company_approval_view';
        $data['JSON']           = 'super_cms/data_company/company_JSON';
        $this->load->view('super_cms/template/template_view', $data);
    }

    public function get_company_by_id($id)
    {
        $this->_has_login_session();
        $this->_is_superadmin();
        echo json_encode($this->superadmin->get('tb_company', ['id_company' => $id]));
    }

    public function grant_access($id)
    {
        $this->_has_login_session();
        $this->_is_superadmin();
        $data_company = $this->superadmin->get('tb_company', ['id_company' => $id]);
        $this->_send_mail($data_company);
    }

}

/* End of file Company.php */

?>