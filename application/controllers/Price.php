<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Price extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model', 'admin');
        date_default_timezone_set("Asia/Jakarta");
    }

    private function _generateId($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    private function _purchase_validation()
    {
        $this->form_validation->set_rules('no_telp', 'Phone Number', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
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

    private function _send_mail($data)
    {
        $config = array(
			'mailtype' => 'html',
			'protocol' => 'smtp', 
			'smtp_host' => 'ssl://smtp.googlemail.com', 
			'smtp_port' => 465, 
			'smtp_user' => '', 
            'smtp_pass' => '',
            'charset'   => 'iso-8859-1'
		);
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('', 'Ilham Izzul Hadyan');
        $this->email->to($data['data_company']['email']);
        
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
                            <h2>'.$data['data_token']['token'].'</h2>
                        </div>
                        <div class="row footer">
                            <h4 class="">Copyright &copy; Sistem Mading Digital 2020</h4>
                        </div>
                    </div>
                </body>

            </html>
        ');
        
        if($this->email->send()) {
            $this->admin->update('tb_token', 'token', $data['data_token']['token'], ['send_status' => true]);
            $this->session->set_flashdata('success', 'Package purchased successfully! your package token will available on your company email');
            redirect('Price');
        } else {
            $this->session->set_flashdata('failed', $this->email->print_debugger());
            redirect('Price');
        }
        
        
    }

    public function index()
    {
        $this->_has_login_session();
        $data['title']      = $this->session->userdata('company_name').' - Pricing';
        $data['main_view']  = 'cms/pricing/price_view';
        $data['JSON']       = 'cms/pricing/price_JSON';
        $this->load->view('cms/template/template_view', $data);
    }

    public function redeem()
    {
        $this->_has_login_session();
        $data['title']      = $this->session->userdata('company_name').' - Redeem Token';
        $data['main_view']  = 'cms/pricing/redeem_token_view';
        $data['JSON']       = 'cms/pricing/price_JSON';
        $this->load->view('cms/template/template_view', $data);
    }

    public function purchase_token($token_type)
    {
        $this->_has_login_session();
        $this->_purchase_validation();
        if ($this->form_validation->run() == TRUE) {
            $data_transaction = array(
                'id_transaction'    => $this->_generateId(30),
                'no_telp'           => $this->input->post('no_telp'),
                'email'             => $this->input->post('email'),
                'id_company'        => $this->session->userdata('id_company'),
                'token'             => $this->admin->get('tb_token', ['token_type' => $token_type, 'active' => false, 'send_status' => false])['token'],
                'createdAt'         => date('Y-m-d H:i:s')
            );
            if ($this->admin->insert('tb_transaction_token', $data_transaction)) {
                $this->session->set_flashdata('success', 'Request purchase token succeed! Please wait for vendor approval!');
                redirect('Price');
            } else {
                $this->session->set_flashdata('failed', 'Purchase token failed!');
                redirect('Price');
            }
        } else {
            $this->session->set_flashdata('failed', validation_errors());
            redirect('Price');
        }
    }

    public function redeem_token()
    {
        $this->_has_login_session();
        $data_token = $this->admin->get('tb_token', ['token' => $this->input->post('token')]);
        if ($data_token != null) {
            if ($data_token['active'] == false) {
                switch ($data_token['token_type']) {
                    case '1month':
                        $new_validity = date('Y-m-d', strtotime("+1 month", strtotime($this->session->userdata('validity'))));
                        break;
                    case '3months':
                        $new_validity = date('Y-m-d', strtotime("+3 months", strtotime($this->session->userdata('validity'))));
                        break;
                    case '1year':
                        $new_validity = date('Y-m-d', strtotime("+12 months", strtotime($this->session->userdata('validity'))));
                        break;
                }
                $this->admin->update('tb_token', 'token', $data_token['token'], ['active' => true]);
                if ($this->session->userdata('onTrial') == true) {
                    $this->admin->update('tb_company', 'id_company', $this->session->userdata('id_company'), ['onTrial' => false, 'validity' => $new_validity]);
                } else {
                    $this->admin->update('tb_company', 'id_company', $this->session->userdata('id_company'), ['validity' => $new_validity]);
                }
                $this->session->set_userdata('validity', $new_validity);
                $this->session->set_userdata('onTrial', false);
                $this->session->set_flashdata('success', 'Token successfully redeemed!');
                redirect('Price/redeem');
            } else {
                $this->session->set_flashdata('failed', 'Token has been used!');
                redirect('Price/redeem');
            }
        } else {
            $this->session->set_flashdata('failed', 'Invalid Package Token!');
            redirect('Price/redeem');
        }
        
    }

}

/* End of file Price.php */

?>