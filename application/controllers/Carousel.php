<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Carousel extends CI_Controller {
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model', 'admin');
        date_default_timezone_set("Asia/Jakarta");
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

    private function _pusher()
    {
        require_once(APPPATH.'views/vendor/autoload.php');
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        $pusher = new Pusher\Pusher(
            '7ba272c3a6631b4ffaf9',
            'a20830d1c80edd41247d',
            '1045050',
            $options
        );
        $data['message'] = 'carousel_success';
        $pusher->trigger('my-channel', 'my-event', $data);
    }

    private function _validation()
    {
        $this->form_validation->set_rules('title', 'Title', 'min_length[5]|max_length[50]');
        $this->form_validation->set_rules('description', 'Description', 'min_length[5]|max_length[100]');
        $this->form_validation->set_rules('data_type', 'Data Type', 'required');
        $this->form_validation->set_rules('id_repeater', 'Repeater', 'required');
    }

    private function _verify_validity()
    {
        if ($this->session->userdata('validity') >= date('Y-m-d')) {
            return;
        } else {
            redirect('Page403');
        }
    }

    private function _path($data_type)
    {
        if ($data_type == 'image') {
            return './uploads/'.$this->session->userdata('company_name').'/carousel/image/';    
        } else {
            return './uploads/'.$this->session->userdata('company_name').'/carousel/video/';
        }
    }

    private function _upload_config($input)
    {
        $config['upload_path'] = $this->_path($input['data_type']);    
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
    
    public function index()
    {
        $this->_has_login_session();
        $this->_verify_validity();
        $data['title']          = $this->session->userdata('company_name'). ' - Data Carousel';
        $data['data_carousel']  = $this->admin->get_all_carousels();
        $data['main_view']      = 'cms/carousel/carousel_view';
        $data['data_repeater'] = $this->admin->get('tb_repeater');
        $data['JSON']           = 'cms/carousel/carousel_JSON';
        $this->load->view('cms/template/template_view', $data);
    }

    public function add_new_carousel()
    {
        $this->_has_login_session();
        $this->_verify_validity();
        $this->_validation();

        if ($this->form_validation->run() == TRUE) {

            $input = $this->input->post(NULL, TRUE);

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
                    'id_company'        => $this->session->userdata('id_company'),
                    'id_repeater'       => $this->input->post('id_repeater'),
                    'createdAt'         => date('Y-m-d H:i:s')
                );
                
                if ($this->admin->insert('tb_carousel', $data) == TRUE) {
                    $this->session->set_flashdata('success', 'New carousel has been added!');
                    redirect('Carousel');
                } else {
                    $this->session->set_flashdata('failed', 'New carousel failed to add! Try again');
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
        $this->_verify_validity();

        $data = $this->admin->get('tb_carousel', ['id_carousel' => $id]);
        if ($data['active'] == 'true') {
            $this->session->set_flashdata('failed', 'You can not delete active carousel!');
            redirect('Carousel');
        } else {
            $path = $this->_path($data['data_type']);
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

    public function edit_carousel($id)
    {
        $this->_has_login_session();
        $this->_verify_validity();
        $this->_validation();

        $get_data = $this->admin->get('tb_Carousel', ['id_carousel' => $id]);
        $input = $this->input->post(NULL, TRUE);
        
        if ($get_data['active'] == 'true') {
            $this->session->set_flashdata('failed', 'You can not edit active carousel!');
            redirect('Carousel');
        } else {
            if ($this->form_validation->run() == TRUE) {
    
                $this->_upload_config($input);
                if (! $this->upload->do_upload('data_carousel')) {
    
                    $data = array(
                        'title'             => $this->input->post('title'),
                        'description'       => $this->input->post('description'),
                        'id_repeater'       => $this->input->post('id_repeater')
                    );
    
                    if ($this->admin->update('tb_carousel', 'id_carousel', $id, $data)) {
                        $this->session->set_flashdata('success', 'Carousel successfully updated!');
                        redirect('Carousel');
                    } else {
                        $this->session->set_flashdata('failed', 'Carousel failed to update!');
                        redirect('Carousel');
                    }
    
                } else {
                    $path = $this->_path($input['data_type']);
                    unlink($path.$get_data['data_carousel']);
                    
                    $data = array(
                        'title'             => $this->input->post('title'),
                        'description'       => $this->input->post('description'),
                        'data_carousel'     => $this->upload->data()['file_name'],
                        'id_repeater'       => $this->input->post('id_repeater')
                    );

                    if ($this->admin->update('tb_carousel', 'id_carousel', $id, $data)) {
                        $this->_pusher();
                        $this->session->set_flashdata('success', 'Carousel successfully updated!');
                        redirect('Carousel');
                    } else {
                        $this->session->set_flashdata('failed', 'Carousel failed to update!');
                        redirect('Carousel');
                    }
                }
            } else {
                $this->session->set_flashdata('failed', validation_errors());
                redirect('Carousel');
            }
        }
        
    }

    public function toggle_carousel($id, $active_status)
    {
        $this->_has_login_session();
        $this->_verify_validity();
        if ($active_status == 'true') {
            $data = array('active' => 'false' );
        } else {
            $data = array('active' => 'true', 'activedAt' => date('Y-m-d H:i:s') );
        }

        if($this->admin->update('tb_carousel', 'id_carousel', $id, $data) == TRUE ){
            $this->_pusher();
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