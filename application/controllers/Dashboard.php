<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model', 'admin');
        $this->load->model('superadmin_model', 'superadmin');
        
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

    private function _count_income($monthly_count = false)
    {
        $month1;
        $month3;
        $year;
        if ($monthly_count) {
            $month1 = $this->superadmin->count_token(['token_type' => '1month', "DATE_FORMAT(tb_transaction_token.createdAt,'%Y-%m')" => date('Y-m')]);
            $month3 = $this->superadmin->count_token(['token_type' => '3months', "DATE_FORMAT(tb_transaction_token.createdAt,'%Y-%m')" => date('Y-m')]);
            $year = $this->superadmin->count_token(['token_type' => '1year', "DATE_FORMAT(tb_transaction_token.createdAt,'%Y-%m')" => date('Y-m')]);
        } else {
            $month1 = $this->superadmin->count_token(['token_type' => '1month']);
            $month3 = $this->superadmin->count_token(['token_type' => '3months']);
            $year = $this->superadmin->count_token(['token_type' => '1year']);
        }
        $sum = ($year * 1350000) + ($month3 * 450000) + ($month1 * 150000);
        return number_format($sum, 2, ',', '.');
    }

    private function chart_income()
    {
        $month1;
        $month3;
        $year;
        $sum;
        $array = [];
        for ($i=1; $i <= 12 ; $i++) { 
            $month1 = $this->superadmin->count_token(['token_type' => '1month', "MONTH(tb_transaction_token.createdAt)" => $i, "YEAR(tb_transaction_token.createdAt)" => date('Y')]);
            $month3 = $this->superadmin->count_token(['token_type' => '3months', "MONTH(tb_transaction_token.createdAt)" => $i, "YEAR(tb_transaction_token.createdAt)" => date('Y')]);
            $year = $this->superadmin->count_token(['token_type' => '1year', "MONTH(tb_transaction_token.createdAt)" => $i, "YEAR(tb_transaction_token.createdAt)" => date('Y')]);
            $sum = ($year * 1350000) + ($month3 * 450000) + ($month1 * 150000);
            array_push($array, $sum);
        }
        return array_values($array);
    }

    private function fill_chart_pie()
    {
        $data = array(
            $this->superadmin->count_token(['token_type' => '1month', "DATE_FORMAT(tb_transaction_token.createdAt,'%Y-%m')" => date('Y-m')]),
            $this->superadmin->count_token(['token_type' => '3months', "DATE_FORMAT(tb_transaction_token.createdAt,'%Y-%m')" => date('Y-m')]),
            $this->superadmin->count_token(['token_type' => '1year', "DATE_FORMAT(tb_transaction_token.createdAt,'%Y-%m')" => date('Y-m')])
        );
        return $data;
    }

    public function index()
    {
        if ($this->session->userdata('role') == 'superadmin') {
            $data['title'] = "Superadmin - Dashboard";
            $data['main_view'] = 'super_cms/dashboard/dashboard_view';
            $data['JSON'] = 'super_cms/dashboard/dashboard_JSON';
            $data['data_count'] = array(
                'pending_transaction'       => $this->admin->count_data('tb_token', ['active' => false, 'send_status' => false, 'order_status' => true]),
                'company_pending_approval'  => $this->admin->count_data('tb_company', ['activeStatus' => false, 'firstLogin' => true, 'onTrial' => true]),
                'monthly_income'            => $this->_count_income(true),
                'total_income'              => $this->_count_income()
            );
            $data_pie = array_values($this->fill_chart_pie());
            $data['chart_pie'] = json_encode($data_pie);
            $data_chart = array_values($this->chart_income());
            $data['chart_line'] = json_encode($data_chart);
            $this->load->view('super_cms/template/template_view', $data);
        } else {
            $data['title'] = $this->session->userdata('company_name')." - Dashboard";
            $data['main_view'] = 'cms/dashboard/dashboard_view';
            $data['JSON'] = 'cms/dashboard/dashboard_JSON';
            $data['data_count'] = array(
                                    'active_carousel' => $this->admin->count_data('tb_carousel', ['id_company' => $this->session->userdata('id_company'), 'active' => 'true']),
                                    'active_event' => $this->admin->count_data('tb_info', ['id_company' => $this->session->userdata('id_company'), 'active' => 'true', 'info_type' => 'event']), 
                                    'active_news' => $this->admin->count_data('tb_info', ['id_company' => $this->session->userdata('id_company'), 'active' => 'true', 'info_type' => 'news']), 
                                    'active_slogan' => $this->admin->count_data('tb_info', ['id_company' => $this->session->userdata('id_company'), 'active' => 'true', 'info_type' => 'slogan']) 
                                );
            $data['data_company'] = $this->admin->get('tb_company', ['id_company' => $this->session->userdata('id_company')]);
            $this->load->view('cms/template/template_view', $data);
        }
    }

}

/* End of file Dashboard.php */

?>