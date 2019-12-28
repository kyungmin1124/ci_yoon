<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
  function __construct() {
    parent::__construct();
    }


  function logout() {
    $this->session->sess_destroy();
    redirect('/index.php/fm');
  }

  function login() {
    $this->load->view('head');
    $this->load->view('login',array('returnURL'=>$this->input->get('returnURL')));
    $this->load->view('footer');
    }

  function register() {
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

  function authentication() {
    $this->load->model('user_model');
    $user = $this->user_model->getByEmail(array('email'=>$this->input->post('email')));
    if (
        $this->input->post('email') == $user->email &&
        password_verify($this->input->post('password'), $user->password)
    ) {
        if ($user->email == "peo@google.com")
        {
          $this->session->set_userdata(array("logged_in"=>true, 'email'=>"admin"));
          redirect('index.php/fm2');
        } else {
          $this->session->set_userdata(array('is_login'=>true, 'email'=>$user->email));
          $returnURL = $this->input->get('returnURL');
          log_message('info', $returnURL);
          redirect($returnURL ? $returnURL:'/');
        }
    } else {
        $this->session->sess_destroy();
        redirect('/index.php/auth/login');
        echo '로그인 실패';
    }
  }
  function pre_find() {
    $this->load->view('find');
  }
  function finder() {
    $this->load->model('user_model');
    $this->load->library('form_validation');
    $this->form_validation->set_rules('f_email','이메일','required|valid_email|callback_email_exists');

    if($this->form_validation->run() == false) {
      $this->load->view('find');
      echo "다시 전송하십시오";
    } else {
      $newp = $this->_Generate(6);

      if(!function_exists("password_hash")) {
        $this->load->helper('password');
      }
      $hash = password_hash($newp, PASSWORD_BCRYPT);
      $email = $this->input->post('f_email', true);

      $result = $this->user_model->alter($hash,$email);

      if($result) {
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'smtp.gmail.com';
        $config['smtp_port'] = '465';
        $config['smtp_user'] = "dbsrudals92@gmail.com";
        $config['smtp_pass'] = "a5857457a";

        $this->load->library('email',$config);
        $this->email->initialize(array('mailtype'=>'html'));
        $this->email->from('dbsrudals92@gmail.com','yoon');
        $this->email->to($email);
        $this->email->subject('신규 비밀번호 입니다.');
        $html = "<h3>변경된 번호는".$newp."</h3>";
        $this->email->message($html);
        if(!$this->email->send()) {
          echo "<script>alert(\"전송 실패\");</script>";
          exit;
        } else {
          redirect('index.php/auth/login');
        }
      }
    }
  }
  function _Generate($length) {
    $characters="0123456789";
    $characters .="abcdefghijklmnopqrstuvwxyz";
    $string_generated="";
    $nmr_loops = $length;
    while($nmr_loops--){
      $string_generated .=$characters[mt_rand(0,strlen($characters)-1)];
    }
    return $string_generated;
  }
  function email_exists($email) {

    if($email) {
      $result = array();
      $sql = 'SELECT id FROM user WHERE email =?';
      $query = $this->db->query($sql, array('email'=>$email));
      $result=@$query->row();

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
