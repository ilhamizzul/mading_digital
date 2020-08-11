<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Verify extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('superadmin_model', 'superadmin');
    }
    

    public function index($id)
    {
        $data_company = $this->superadmin->verify_company($id);
        if ($data_company['activeStatus'] == false && $data_company['active'] == 'false') {
            $this->superadmin->update('tb_company', 'id_company', $data_company['id_company'], ['activeStatus' => 1]);
            $this->superadmin->update('tb_user', 'id_user', $data_company['id_user'], ['active' => 'true']);
        }
        $data['title'] = 'Mading Digital - Congratulations!';
        $this->load->view('super_cms/verify/verify_view', $data);
    }

}

/* End of file Verify.php */

?>