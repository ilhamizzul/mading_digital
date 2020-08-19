<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Page403 extends CI_Controller {

    public function index()
    {
        $this->output->set_status_header('403');
        $this->load->view('403_view');
    }

}

/* End of file Page403.php */

?>