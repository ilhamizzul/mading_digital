<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        
    }

    public function index()
    {
        $data['title'] = $this->session->userdata('company_name')." - Dashboard";
        $data['main_view'] = 'cms/dashboard/dashboard_view';
        $this->load->view('cms/template/template_view', $data);
    }

}

/* End of file Dashboard.php */

?>