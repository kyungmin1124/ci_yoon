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
  public function get($id) {//id값에 담긴 데이터 출력
    $this->_head();
    $person = $this->fm_anyang->get($id);
    $this->load->view('get', array('person'=>$person));
    $this->load->view('footer');
  }
  public function set() {//리스트 형성 화면
    $this->_head();
    $this->load->view('footer');
  }
  function _head(){//한 화면에 나타내기 위한 헤드 설정
    $ps = $this->fm_anyang->gets();
    $this->load->view('head');
    $this->load->helper('url');
    $this->load->view('fm_list', array('ps'=>$ps));
  }
}
?>
