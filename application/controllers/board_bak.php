<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Board_bak extends CI_Controller {
  function __construct() {
    parent::__construct();

    $this->load->model('board_list');
    $this->load->model('reply_model');
    $this->load->library('form_validation');
  }
  function index() { //리스트 생성을 위한 데이터 가져오기
    $bs = $this->board_list->gets();
    $this->load->view('head');
    $this->load->view('lists', array('bs'=>$bs));
    $this->load->view('footer');
  }
  public function get($id) {//받아온 id값 데이터에 담긴 내용을 출력
    $this->load->view('head');
    $people = $this->board_list->get($id);
    $this->load->view('get2', array('people'=>$people));
    $this->load->view('footer');
  }
  function delete($id) {//id값에 해당하는 데이터 삭제
    if (!$this->session->userdata('is_login') == TRUE) {
      $this->load->helper('url');
      redirect('index.php/auth/login');
    }
    $this->board_list->delete($id);
    $this->load->helper('url');
    redirect('index.php/board');
  }
  function update($id) {//id값에 해당하는 데이터 수정
    $this->board_list->update($id,$this->input->post('mod_title'),$this->input->post('mod_body'));
    $this->load->helper('url');
    redirect('index.php/board');
  }
  function _header(){//한 화면에 나타내기 위한 헤드 편집
    $bs = $this->board_list->gets();
    $this->load->view('head');
    $this->load->view('board_list', array('bs'=>$bs));
  }
}
?>
