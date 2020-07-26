<?php 
    
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('client_model', 'client');
    }
    

    public function index()
    {
        $data['title'] = $this->session->userdata('company_name').' - Mading Digital';
        $this->load->view('client/index', $data);
    }

    public function get_all_active_event()
    {
        echo json_encode($this->client->get_active_data('tb_info', ['id_company' => $this->session->userdata('id_company'), 'active' => 'true', 'info_type' => 'event'], 10));
    }

    public function get_all_active_carousel()
    {
        echo json_encode($this->client->get_active_data('tb_carousel', ['id_company' => $this->session->userdata('id_company'), 'active' => 'true'], 10));
    }

    public function get_all_active_information()
    {
        echo json_encode($this->client->get_active_data('tb_info', ['id_company' => $this->session->userdata('id_company'), 'active' => 'true', 'info_type !=' => 'event'], 10));
    }

}

/* End of file Home.php */
    
?>