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
  function index() {
    $bs = $this->board_list->gets();
    $this->load->view('head');
    $this->load->view('lists', array('bs'=>$bs));
    $this->load->view('footer');
  }

  public function get($post_id) {
    $board = $this->board_list->get($post_id);
    $reply = $this->reply_model->gets();
    $this->load->view('head');
    $this->load->view('get2', array('board'=>$board, 'reply'=>$reply));
    $this->load->view('footer');
  }
  function comment_add() {
    $this->load->view('head');
    $this->form_validation->set_rules('comment_name','댓이름','required');
    $this->form_validation->set_rules('comment_content','댓본문','required');

    if ($this->form_validation->run() === false)
    {
      echo "전부 입력해야 합니다";
    }
    else
    {
      $this->reply_model->add($this->input->post('add_title'), $this->input->post('add_body'));
      $this->load->helper('url');
      redirect('index.php/board');
    }
    $this->load->view('footer');
  }

  function delete($id) {
    if (!$this->session->userdata('is_login') == TRUE) {
      redirect('index.php/auth/login');
    }
    $this->board_list->delete($id);
    redirect('index.php/board');
  }
  function update($id) {
    $this->board_list->update($id,$this->input->post('mod_title'),$this->input->post('mod_body'));
    redirect('index.php/board');
  }
  function _header(){
    $bs = $this->board_list->gets();
    $this->load->view('head');
    $this->load->view('board_list', array('bs'=>$bs));
  }
}
?>
