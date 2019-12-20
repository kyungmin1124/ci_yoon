<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Write extends CI_Controller {
  function __construct() {
    parent::__construct();

    $this->load->model('board_list');
  }

  function add() {
    if (!$this->session->userdata('is_login') == true){
         $this->load->helper('url');
         redirect('/auth/login');
    }

    $this->load->view('head');
    $this->load->library('form_validation');
    $this->form_validation->set_rules('add_title','제목','required');
    $this->form_validation->set_rules('add_body','본문','required');

    if ($this->form_validation->run() === false)
    {
      $this->load->view('add');
    }
    else
    {
      $this->board_list->add($this->input->post('add_title'), $this->input->post('add_body'));
      $this->load->helper('url');
      redirect('/board');
    }
    $this->load->view('footer');
  }
}
?>
