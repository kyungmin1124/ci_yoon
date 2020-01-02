<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Board_bak extends CI_Controller {
  function __construct() {
    parent::__construct();

    $this->load->model('board_list');
    $this->load->model('reply_model');
    $this->load->library('form_validation');
  }
  function index() {
    $bs = $this->board_list->gets();
    $this->load->view('head');
    $this->load->view('lists', array('bs'=>$bs));
    $this->load->view('footer');
  }
  public function get($id) {
    $this->load->view('head');
    $people = $this->board_list->get($id);
    $this->load->view('get2', array('people'=>$people));
    $this->load->view('footer');
  }
  function delete($id) {
    if (!$this->session->userdata('is_login') == TRUE) {
      $this->load->helper('url');
      redirect('index.php/auth/login');
    }
    $this->board_list->delete($id);
    $this->load->helper('url');
    redirect('index.php/board');
  }
  function update($id) {
    $this->board_list->update($id,$this->input->post('mod_title'),$this->input->post('mod_body'));
    $this->load->helper('url');
    redirect('index.php/board');
  }
  function _header(){
    $bs = $this->board_list->gets();
    $this->load->view('head');
    $this->load->view('board_list', array('bs'=>$bs));
  }
}
?>
