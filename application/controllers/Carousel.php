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

    }

}

/* End of file Carousel.php */

?>