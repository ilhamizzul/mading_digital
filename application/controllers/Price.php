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
            $token = $this->admin->get('tb_token', ['token_type' => $token_type, 'active' => false, 'send_status' => false, 'order_status' => false])['token'];
            $data_transaction = array(
                'id_transaction'    => $this->_generateId(30),
                'no_telp'           => $this->input->post('no_telp'),
                'email'             => $this->input->post('email'),
                'id_company'        => $this->session->userdata('id_company'),
                'token'             => $token,
                'createdAt'         => date('Y-m-d H:i:s')
            );
            if ($this->admin->insert('tb_transaction_token', $data_transaction)) {
                $this->admin->update('tb_token', 'token', $token, ['order_status' => true]);
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