<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fm extends CI_Controller {
  function __construct() {
    parent::__construct();

<<<<<<< HEAD
=======
    $this->load->database();
>>>>>>> 1186f238d84f76f8b7ea54ae9bcbbe0449bd8b12
    $this->load->model('fm_anyang');
  }

	public function index() {
    $this->load->view('introduce');
	}
<<<<<<< HEAD

  function add2() {
    if (!$this->session->userdata('is_login')){
         $this->load->helper('url');
         redirect('/auth/login');
    }

    $this->_heading();
    $this->load->library('form_validation');
    $this->form_validation->set_rules('ad_name','이름','required');
    $this->form_validation->set_rules('ad_body','설명','required');
=======
  function add() {
    //데이터 등록
    //로그인 필요, 로그인 실패시 로그인 페이지로 리다이렉트
    if(true) {
      $this->load->helper('url');
      redirect('/auth/login');
    }
    $this->_heading();
    $this->load->library('form_validation');
    $this->form_validation->set_rules('name','이름','required');
    $this->form_validation->set_rules('body','설명','required');
>>>>>>> 1186f238d84f76f8b7ea54ae9bcbbe0449bd8b12
    if ($this->form_validation->run() == FALSE)
    {
      $this->load->view('add');
    }
    else
    {
<<<<<<< HEAD
      $anyang_id = $this->fm_anyang->add($this->input->post('ad_name'),$this->input->post('ad_image'), $this->input->post('ad_body'));
=======
      $anyang_id = $this->fm_anyang->add($this->input->post('name'), $this->input->post('body'));
>>>>>>> 1186f238d84f76f8b7ea54ae9bcbbe0449bd8b12
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
<<<<<<< HEAD
    $this->load->view('head');
=======
    var_dump($this->session->userdata('session_test'));
    $this->session->set_userdata('session_test','egoing');
    $this->load->view('head');

>>>>>>> 1186f238d84f76f8b7ea54ae9bcbbe0449bd8b12
  }
}
?>
