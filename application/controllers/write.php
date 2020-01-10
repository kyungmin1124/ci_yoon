<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Write extends CI_Controller {
  function __construct() {
    parent::__construct();

    $this->load->model('board_list');
    $this->load->model('reply_model');
    $this->load->library('form_validation');
    $this->load->helper('url');
  }

  function add() {//로그인 후 게시물을 추가하는 기능
    if (!$this->session->userdata('is_login') == true){
         redirect('index.php/auth/login?returnURL='.rawurlencode(site_url('index.php/write/add')));
    }

    $this->load->view('head');
    $this->form_validation->set_rules('add_title','제목','required');
    $this->form_validation->set_rules('add_body','본문','required');

    if ($this->form_validation->run() === false)
    {
      $this->load->view('add');
    }
    else
    {
      $this->board_list->add($this->input->post('add_title'), $this->input->post('add_body'));
      redirect('index.php/board');
    }
    $this->load->view('footer');
  }

  function add_comment(){//댓글을 추가하는 기능 폼 유효성 검사
    $this->form_validation->set_rules('comment_name','이름','required');
    $this->form_validation->set_rules('comment_content','본문','required');

    if ($this->form_validation->run() === false)
    {
      $this->load->view('lists');
    }
    else
    {
      $result = $this->reply_model->add($this->input->post('comment_name'), $this->input->post('comment_content'),$this->input->post('comment_id'));
      $list = $this->reply_model->add_comment($result);
      echo json_encode($list);
    }
  }
  function update($id){//id값에 해당하는 데이터 수정
    if (!$this->session->userdata('is_login') == TRUE) {
      redirect('index.php/auth/login');
    }
    $this->load->view('head');
    $this->load->view('modify',array('id'=>$id));
    $this->load->view('footer');
  }
  function upload_receive_from_ck() {//파일 업로드 시 규격 검사 후 업로드

    $config['upload_path'] = './static/user';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size'] = '500';
    $config['max_width'] = '1200';
    $config['max_height'] = '900';
    $this->load->library('upload', $config);

    if (! $this->upload->do_upload("upload"))
    {
      echo "<script>alert('업로드 실패".$this->upload->display_errors('','')."')</script>";
    }
    else
    {
      $CKEditorFuncNum = $this->input->get('CKEditorFuncNum');
      $data =$this->upload->data();
      $filename = $data['file_name'];
      $url = '/static/user/'.$filename;
      echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction('".$CKEditorFuncNum."', '".$url."','전송성공')</script>";
    }
  }
}
?>
