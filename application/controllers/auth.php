<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
  function __construct() {
    parent::__construct();
    $this->load->helper('url');
    }


  function logout() {//로그아웃 처리
    $this->session->sess_destroy();
    redirect('/index.php/fm');
  }

  function login() {//기존 작업 페이지로 가기 위한 리다이렉션 작업
    $this->load->view('head');
    $this->load->view('login',array('returnURL'=>$this->input->get('returnURL')));
    $this->load->view('footer');
    }

  function register() {// 회원가입 폼 유효성 검사, 통과 시 가입 성공, 로그인 페이지 이동
    $this->load->view('head');
    $this->load->library('form_validation');

    $this->form_validation->set_rules('email','이메일 주소 유형 오류','required|valid_email|is_unique[user.email]');
    $this->form_validation->set_rules('password','비밀번호 입력 오류','required|min_length[6]|max_length[20]');
    $this->form_validation->set_rules('re_password','비밀번호 확인 오류','required|matches[password]');

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
      redirect('index.php/auth/login');
    }
    $this->load->view('footer');
  }

  function authentication() { //로그인 처리
    $this->load->model('user_model');
    $user = $this->user_model->getByEmail(array('email'=>$this->input->post('email')));
    if (
        $this->input->post('email') == $user->email &&
        password_verify($this->input->post('password'), $user->password)
    ) {//관리자 아이디(peo)로 로그인 시 fm2 기본 페이지로 이동
        if ($user->email == "peo@google.com")
        {
          $this->session->set_userdata(array("logged_in"=>true, 'email'=>"admin"));
          redirect('index.php/fm2');
        } else { //로그인 성공 시 바로 이전에 있던 페이지로 이동
          $this->session->set_userdata(array('is_login'=>true, 'email'=>$user->email));
          $this->session->set_flashdata('log_mes','환영합니다');
          $returnURL = $this->input->get('returnURL');
          log_message('info', $returnURL);
          redirect($returnURL ? $returnURL:'/');
        }
    } else {
        $this->session->set_flashdata('fail_mes','로그인에 실패했습니다');
        redirect('/index.php/auth/login');
    }
  }
  function pre_find() {
    $this->load->view('find');
  }
  function finder() { //이메일을 입력하면 해당 메일주소로 새로운 비밀번호 전송
    $this->load->model('user_model');
    $this->load->library('form_validation');
    $this->form_validation->set_rules('f_email','이메일','required|valid_email|callback_email_exists');

    if($this->form_validation->run() == false) {
      $this->load->view('find');
      echo "다시 전송하십시오";
    } else { //새로운 비밀번호 6자리 생성
      $newp = $this->_Generate(6);

      if(!function_exists("password_hash")) {
        $this->load->helper('password');
      }
      $hash = password_hash($newp, PASSWORD_BCRYPT);
      $email = $this->input->post('f_email', true);

      $result = $this->user_model->alter($hash,$email);

      if($result) { //비밀번호를 알려주는 메일, 구글사용, 임시 아이디(dbsrudals92)
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'smtp.gmail.com';
        $config['smtp_port'] = '465';
        $config['smtp_user'] = "xxx@google.com";
        $config['smtp_pass'] = "";

        $this->load->library('email',$config);
        $this->email->initialize(array('mailtype'=>'html'));
        $this->email->from('xxx@gmail.com','yoon');
        $this->email->to($email);
        $this->email->subject('신규 비밀번호 입니다.');
        $html = "<h3>변경된 번호는".$newp."</h3>";
        $this->email->message($html);
        if(!$this->email->send()) {
          $this->session->set_flashdata('em','전송 실패');
          redirect('index.php/auth/login');
          exit;
        } else {
          $this->session->set_flashdata('em','이메일을 확인해주세요');
          redirect('index.php/auth/login');
        }
      }
    }
  }
  function _Generate($length) { //난수 생성 - 숫자와 소문자만
    $characters="0123456789";
    $characters .="abcdefghijklmnopqrstuvwxyz";
    $string_generated="";
    $nmr_loops = $length;
    while($nmr_loops--){
      $string_generated .=$characters[mt_rand(0,strlen($characters)-1)];
    }
    return $string_generated;
  }

  function email_exists($email) {//입력한 이메일이 데이터에 있는가를 확인

    if($email) {
      $result = array();
      $sql = 'SELECT id FROM user WHERE email =?';
      $query = $this->db->query($sql, array('email'=>$email)); //뒤의 조건으로 데이터 재구성
      $result=@$query->row(); //오류가 나더라도 진행, 재구성된 쿼리의 행을 뽑아 변수에 저장

      if(!$result) {
        $this->form_validation->set_message('email_exists',"존재하지 않는 주소입니다.");
        return FALSE;
      } else {
        return TRUE;
      }
    } else {
      return FALSE;
    }
  }
}
?>
