<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Board extends CI_Controller {
  function __construct() {
    parent::__construct();

    $this->load->model('board_list');
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
  function _header(){
    $bs = $this->board_list->gets();
    $this->load->view('head');
    $this->load->helper('url');
    $this->load->view('board_list', array('bs'=>$bs));
  }
}
?>
