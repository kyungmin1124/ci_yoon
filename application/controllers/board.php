<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Board extends CI_Controller {
  function __construct() {
    parent::__construct();

    $this->load->model('board_list');
    $this->load->model('reply_model');
    $this->load->library('form_validation');
    $this->load->helper('url');
  }
  function index() {//리스트 생성을 위한 데이터 가져오기
    $bs = $this->board_list->gets();
    $this->load->view('head');
    $this->load->view('lists', array('bs'=>$bs));
    $this->load->view('footer');
  }

  public function get($post_id) {//받아온 id값 데이터에 담긴 내용을 출력
    $board = $this->board_list->get($post_id);
    $this->load->view('head');
    $this->load->view('get2', array('board'=>$board));
    $this->load->view('footer');
  }

  function delete($id) {//id값에 해당하는 데이터 삭제
    if (!$this->session->userdata('is_login') == TRUE) {
      redirect('index.php/auth/login');
    }
    $this->board_list->delete($id);
    redirect('index.php/board');
  }
  function update($id) {//id값에 해당하는 데이터 수정
    $this->board_list->update($id,$this->input->post('mod_title'),$this->input->post('mod_body'));
    redirect('index.php/board');
  }
  function _header(){//한 화면에 나타내기 위한 헤드 편집
    $bs = $this->board_list->gets();
    $this->load->view('head');
    $this->load->view('board_list', array('bs'=>$bs));
  }
}
?>
