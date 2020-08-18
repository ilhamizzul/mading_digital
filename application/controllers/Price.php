<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Price extends CI_Controller {

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

}

/* End of file Price.php */

?>