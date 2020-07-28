<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class User_account extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model', 'admin');
    }
    

    public function index()
    {
        
    }

}

/* End of file User_account.php */

?>