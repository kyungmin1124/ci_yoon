<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fm extends CI_Controller {
  function __construct() {
    parent::__construct();

    $this->load->database();
    $this->load->model('fm_anyang');
  }

	public function index() {
    $this->load->view('introduce');
	}

  function add() {
    //데이터 등록
    //로그인 필요, 로그인 실패시 로그인 페이지로 리다이렉트
    if(!$this->session->userdata('is_login')==true) {
      $this->load->helper('url');
      redirect('indexp.php/auth/login');
    }
    $this->_heading();
    $this->load->library('form_validation');
    $this->form_validation->set_rules('ad_name','이름','required');
    $this->form_validation->set_rules('ad_body','설명','required');

    if ($this->form_validation->run() === false)
    {
      $this->load->view('add');
    }
    else
    {

      $anyang_id = $this->fm_anyang->add($this->input->post('ad_name'),$this->input->post('ad_image'), $this->input->post('ad_body'));
      $this->load->helper('url');
      redirect('index.php/fm2/get/'.$anyang_id);
    }
    $this->load->view('footer');
  }

  function upload_receive_from_ck() {//파일 업로드 설정
    $config['upload_path'] = '/static/user';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size'] = '500';
    $config['max_width'] = '1200';
    $config['max_height'] = '900';
    $this->load->library('upload', $config);

    if (! $this->upload->do_upload("user_up"))
    {
      echo "<script>alert('업로드 실패".$this->upload->display_errors('','')."')</script>";
    }
    else
    {
      $CKEditorFuncNum = $this->input->get('CKEditorFuncNum');
      $data =$this->upload->data();
      $filename = $data['filename'];
      $url = '/static/user/'.$filename;
      echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction('".$CKEditorFuncNum."', 1, '".$url."')</script>";
    }
  }

  function _heading() {
    $this->load->view('head');
  }
}
?>
