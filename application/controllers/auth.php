<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
  function __construct() {
    parent::__construct();
    }
<<<<<<< HEAD

  function logout() {
    $this->session->sess_destroy();
    $this->load->helper('url');
    redirect('/');
  }

=======
>>>>>>> 1186f238d84f76f8b7ea54ae9bcbbe0449bd8b12
  function login() {
    $this->load->view('head');
    $this->load->view('login');
    $this->load->view('footer');
    }
<<<<<<< HEAD
  function register() {
    $this->load->view('head');
    $this->load->library('form_validation');

    $this->form_validation->set_rules('email','이메일 주소','required|valid_email|is_unique[user.email]');
    $this->form_validation->set_rules('password','비밀번호','required|[a-z]|[0-9]|min_length[6]|max_length[20]');
    $this->form_validation->set_rules('re_password','비밀번호 확인','required|matches[password]');

    if ($this->form_validation->run() === false) {
      echo "이메일은 이메일 형식, 비밀번호는 영,숫자 혼합으로 작성해 주십시오";
      $this->load->view('register');
    } else {

      $hash = password_hash($this->input->post('password'), PASSWORD_BCRYPT);
      $this->load->model('user_model');

      $this->user_model->add(array(
        'email'=>$this->input->post('email'),
        'password'=>$hash
      ));

      $this->session->set_flashdata('message','가입 성공!');
      $this->load->helper('url');
      redirect('/auth/login');
      $this->session->flashdata('message');
    }

    $this->load->view('footer');
  }

  function authentication() {
    $this->load->model('user_model');
    $user = $this->user_model->getByEmail(array('email'=>$this->input->post('email')));
    if (
        $this->input->post('email') == $user->email &&
        password_verify($this->input->post('password'), $user->password)
    ) {
        $this->session->set_userdata(array('is_login'=>true, 'email'=>$user->email));
        $this->load->helper('url');
        redirect('/');
    } else {
        $this->session->set_flashdata('mess','Login_failure');
        $this->load->helper('url');
        redirect('/auth/login');
        $this->session->flashdata('mess');
    }
=======
  function authentication() {
    echo '성공';
>>>>>>> 1186f238d84f76f8b7ea54ae9bcbbe0449bd8b12
  }
}
?>
