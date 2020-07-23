<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Carousel extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model', 'admin');
        
    }

    private function _has_login_session()
    {
        if($this->session->has_userdata('logged_in')) {
            return TRUE;
        } else {
            $this->session->set_flashdata('failed', 'Masa waktu login berakhir! Silahkan login kembali');
            redirect('Auth');
        }
    }
    
    public function index()
    {
        $this->_has_login_session();
        $data['title']          = $this->session->userdata('company_name'). ' - Data Carousel';
        $data['data_carousel']  = $this->admin->get('tb_carousel', null, ['id_company' => $this->session->userdata('id_company')]);
        $data['main_view']      = 'cms/carousel/carousel_view';
        $data['JSON']           = 'cms/carousel/carousel_JSON';
        $this->load->view('cms/template/template_view', $data);
    }

}

/* End of file Carousel.php */

?>