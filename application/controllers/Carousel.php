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

    private function _validation()
    {
        $this->form_validation->set_rules('title', 'Title', 'min_length[5]|max_length[50]');
        $this->form_validation->set_rules('description', 'Description', 'min_length[5]|max_length[100]');
        $this->form_validation->set_rules('data_type', 'Data Type', 'required');
    }

    public function _upload_config($input)
    {
        if ($input['data_type'] == 'image') {
            $config['upload_path'] = './uploads/'.$this->session->userdata('company_name').'/carousel/image/';    
        } else {
            $config['upload_path'] = './uploads/'.$this->session->userdata('company_name').'/carousel/video/';
        }
        
        $config['allowed_types'] = 'jpeg|jpg|png|mp4';
        
        $this->load->library('upload', $config);
    }

    private function _generateId($data_type)
    {
        if ($data_type == "image") {
            $code = 'CA-I-'.date('ymd');    
        } else {
            $code = 'CA-V-'.date('ymd');
        }
        $last_code = $this->admin->getMax('tb_carousel', 'id_carousel', $code);
        $add_code = substr($last_code, -4);
        $add_code++;
        $number = str_pad($add_code, 4, '0', STR_PAD_LEFT);
        return $code . $number;
    }

    public function _verify_format($input)
    {
        $format = substr($input['data_carousel'], -3);
        if (($format == 'jpg' || $format == 'png' || $format == 'peg') && $input['data_type'] == 'image') {
            return true;
        } elseif (($format == 'mp4') && $input['data_type'] == 'video') {
            return true;
        } else {
            return false;
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

    public function add_new_carousel()
    {
        $this->_has_login_session();
        $this->_validation();

        if ($this->form_validation->run() == TRUE) {

            $input = $this->input->post(NULL, TRUE);

            if ($this->_verify_format($input)) {

                $this->_upload_config($input);
                
                if ( ! $this->upload->do_upload('data_carousel')){
                    $this->session->set_flashdata('failed', $this->upload->display_errors());
                    redirect('Carousel');
                }
    
                $data = array(
                    'id_carousel'       => $this->_generateId($input['data_type']),
                    'title'             => $this->input->post('title'),
                    'description'       => $this->input->post('description'),
                    'data_type'         => $this->input->post('data_type'),
                    'data_carousel'     => $this->upload->data()['file_name'],
                    'active'            => 'false',
                    'id_company'        => $this->session->userdata('id_company')
                    
                );
                
                if ($this->admin->insert('tb_carousel', $data) == TRUE) {
                    $this->session->set_flashdata('success', 'New carousel has been added!');
                    redirect('Carousel');
                } else {
                    $this->session->set_flashdata('failed', 'New carousel failed to add! Try again');
                    redirect('Carousel');
                }

            } else {
                $this->session->set_flashdata('failed', 'Data Type and file type not compatible!');
                redirect('Carousel');
            }
            
        } else {
            $this->session->set_flashdata('failed', validation_errors());
            redirect('Carousel');
        }
        
    }

    public function get_carousel_by_id($id)
    {
        echo json_encode($this->admin->get('tb_carousel', ['id_carousel' => $id]));
    }

    public function delete_carousel($id)
    {
        $this->_has_login_session();

        $data = $this->admin->get('tb_carousel', ['id_carousel' => $id]);
        if ($data['active'] == 'true') {
            $this->session->set_flashdata('failed', 'You can not delete active carousel!');
            redirect('Carousel');
        } else {
            if ($data['data_type'] == 'image') {
                $path = './uploads/'.$this->session->userdata('company_name').'/carousel/image/';
            } else {
                $path = './uploads/'.$this->session->userdata('company_name').'/carousel/video/';
            }

            if (!unlink($path.$data['data_carousel'])) {
                $this->session->set_flashdata('failed', 'Can not delete due error!');
                redirect('Carousel');
            } else {
                if ($this->admin->delete('tb_carousel', 'id_carousel', $id)) {
                    $this->session->set_flashdata('success', 'Delete carousel success!');
                    redirect('Carousel');
                } else {
                    $this->session->set_flashdata('failed', 'Delete carousel failed!');
                    redirect('Carousel');
                }
                
            }
        }
        
    }

    public function toggle_carousel($id, $active_status)
    {
        if ($active_status == 'true') {
            $data = array('active' => 'false' );
        } else {
            $data = array('active' => 'true' );
        }

        if($this->admin->update('tb_carousel', 'id_carousel', $id, $data) == TRUE ){
            $this->session->set_flashdata('success', 'Toggle data carousel sucess!');
            redirect('Carousel');
        } else {
            $this->session->set_flashdata('failed', 'Toggle data carousel failed! Try again');
            redirect('Carousel');
        }
    }

}

/* End of file Carousel.php */

?>