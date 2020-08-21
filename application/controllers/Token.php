<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Token extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('superadmin_model', 'superadmin');
        date_default_timezone_set("Asia/Jakarta");
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
        
        $this->email->subject('Thank you for purchasing!');
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
                        .body > h2 {
                            text-align: center;
                            margin: 50px 0px 25px 0px;
                            padding: 10px 5px;
                            border-radius: 8px;
                            background-color: #023e8a;
                            color: white;
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
                            <h2 class="">Thank you for Purchasing!</h2>
                        </div>
                        <div class="body">
                            <h3 class="text-center">Thank you for purchasing another package! <br> for the next step, please open input package token on your dashboard and copy token below to get another activation</h3>
                            <h2>'.$data['token'].'</h2>
                        </div>
                        <div class="row footer">
                            <h4 class="">Copyright &copy; Sistem Mading Digital 2020</h4>
                        </div>
                    </div>
                </body>

            </html>
        ');
        
        if($this->email->send()) {
            $this->superadmin->update('tb_token', 'token', $data['token'], ['send_status' => true]);
            $this->session->set_flashdata('success', 'Token request accepted successfully!');
            redirect('Token/transaction');
        } else {
            $this->session->set_flashdata('failed', $this->email->print_debugger());
            redirect('Token/transaction');
        }
        
        
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
        $data['data_token']     = $this->superadmin->get('tb_token', null, ['active' => false, 'order_status' => false, 'send_status' => false]);
        $data['main_view']      = 'super_cms/token/token_view';
        $data['JSON']           = 'super_cms/token/token_JSON';
        $this->load->view('super_cms/template/template_view', $data);
    }

    public function transaction()
    {
        $this->_has_login_session();
        $this->_is_superadmin();
        $data['title']          = 'Superadmin - Data Token Transaction';
        $data['data_request']     = $this->superadmin->get_token_transaction(['tb_token.active' => false, 'order_status' => true, 'send_status' => false]);
        $data['data_transaction']     = $this->superadmin->get_token_transaction(['order_status' => true, 'send_status' => true]);
        $data['main_view']      = 'super_cms/token/token_transaction_view';
        $data['JSON']           = 'super_cms/token/token_JSON';
        $this->load->view('super_cms/template/template_view', $data);
    }

    public function accept_request_token($id_transaction)
    {
        $this->_has_login_session();
        $this->_is_superadmin();
        $data_transaction = $this->superadmin->get('tb_transaction_token', ['id_transaction' => $id_transaction]);
        // print_r($data_transaction);
        $this->_send_mail($data_transaction);
    }

    public function get_token($token)
    {
        echo json_encode($this->superadmin->get('tb_token', $token));
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