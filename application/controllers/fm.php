<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fm extends CI_Controller {
  function __construct() {
    parent::__construct();

    $this->load->model('fm_anyang');
  }

	public function index() {
    $this->load->view('introduce');
	}

  function add2() {
    if (!$this->session->userdata('is_login')){
         $this->load->helper('url');
         redirect('/auth/login');
    }

    $this->_heading();
    $this->load->library('form_validation');
    $this->form_validation->set_rules('ad_name','이름','required');
    $this->form_validation->set_rules('ad_body','설명','required');
    if ($this->form_validation->run() == FALSE)
    {
      $this->load->view('add');
    }
    else
    {
      $anyang_id = $this->fm_anyang->add($this->input->post('ad_name'),$this->input->post('ad_image'), $this->input->post('ad_body'));
      $this->load->helper('url');
      redirect('/fm2/get/'.$anyang_id);
      echo "success";
    }
    $this->load->view('footer');
  }

  function up_receive() {
    $config['upload_path'] = './static/user';
    $config['allowed_types'] = 'jpg';
    $config['max_size'] = '500';
    $config['max_width'] = '1200';
    $config['max_height'] = '900';
    $this->load->library('upload', $config);

    if (! $this->upload->do_upload("user_up"))
    {
      echo $this->upload->display_errors();
    }
    else
    {
      $data = array('upload_data' => $this->upload->data());
      echo '성공';
      var_dump($data);
    }
  }

  function up_form() {
    $this->_heading();
    $this->load->view('up_form');
    $this->load->view('footer');
  }
  function _heading() {
    $this->load->view('head');
  }
}
?>
