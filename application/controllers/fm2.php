<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fm2 extends CI_Controller {
  function __construct() {
    parent::__construct();

    $this->load->database();
    $this->load->model('fm_anyang');
  }
  public function index() {
    $this->load->view('head');
    $this->load->view('main');
    $this->load->view('footer');
	}
  public function get($id) {
    $this->_head();
    $person = $this->fm_anyang->get($id);
    $this->load->view('get', array('person'=>$person));
    $this->load->view('footer');
  }
  public function set() {
    $this->_head();
    $this->load->view('footer');
  }
  function _head(){
    $ps = $this->fm_anyang->gets();
    $this->load->view('head');
    $this->load->helper('url');
    $this->load->view('fm_list', array('ps'=>$ps));
  }
}
?>