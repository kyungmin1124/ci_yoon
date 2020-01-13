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
  function index() {//리스트 생성을 위한 데이터 가져오기
    $this->lists();
  }

  function lists(){
    $pageNum = ($_GET['page'])?$_GET['page']:1;//기본값 1인 페이지 값 받기
    $listNum = ($_GET['list'])?$_GET['list']:5;//글이 5개마다 페이징
    $limit = ($pageNum - 1) * $listNum;
    $page = $this->board_list->get_list($limit,$listNum);
    $pageBlock=5; //[1][2][3][4][5] 이런식의 블록
    $block = ceil($pageNum/$pageBlock); //현재 페이지는 몇번 블록?
    //db에서 가져온 총 개수
    $total_count_all = $this->board_list->get_list_row();
    $pageTotal=ceil($total_count_all/$listNum);//5개마다 페이지가 넘어가니 나누기, 올림 안하면 16개일때 4페이지 갱신이 안된다
    $blockTotal=ceil($pageTotal/$pageBlock);
    //블록을 어떤 기준으로 잡을 것인가
    $startBlock=(($block-1)*$pageBlock)+1; //[1] [6] [11] 블록의 시작점
    $endBlock=$startBlock+$pageBlock-1;//[5][10][15] 블록의 끝점
    //게시물 총 페이지
    //페이징 전 설정
    //5개 단위로 나눈 블록인데 [14] 이렇게 끝나면 [15]가 아닌 [14]로 표시
    ob_start();
    if($endBlock > $pageTotal) {
      $endBlock = $pageTotal;
    }
    if($pageNum <= 1)
    {
     echo '<b style="font-size:10px;text-align:center;">처음</b>';
     } else {
     echo '<b style="font-size:10px;text-align:center;"><a href="/index.php/board?page=&list='.$listNum.'">처음</a></b>';
     }
    if($block > 1)
    {
      $sub_prev = $pageNum-1;
      echo '<b style="font-size:10px;text-align:center;"><a href="/index.php/board?page='.$sub_prev.'&list='.$listNum.'">이전</a></b>';
    }
    if($block > $blockTotal)
    {
      $add_next = $pageNum+1;
     echo '<b style="font-size:10px;text-align:center;"><a href="/index.php/board?page='.$add_next.'&list='.$listNum.'">다음</a></b>';
    }
    if($pageNum >= $pageTotal)
    {
    echo '<b style="font-size:10px;text-align:center;">마지막</b>';
    } else {
    echo '<b style="font-size:10px;text-align:center;"><a href="/index.php/board?page='.$pageTotal.'&list='.$listNum.'">마지막</a></b>';
    }
    $clicks = ob_get_contents();
    ob_end_clean();
    $list_array = array('pageNum'=>$pageNum,'listNum'=>$listNum,'limit'=>$limit,'page'=>$page,'pageBlock'=>$pageBlock,'block'=>$block,'pageTotal'=>$pageTotal,'startBlock'=>$startBlock,'endBlock'=>$endBlock,'total_count_all'=>$total_count_all,'clicks'=>$clicks);
    $this->load->view('head');
    $this->load->view('lists', $list_array);
    $this->load->view('footer');
  }

  public function get($post_id) {//받아온 id값 데이터에 담긴 내용을 출력
    $board = $this->board_list->get($post_id);
    $this->load->view('head');
    $this->load->view('get2', array('board'=>$board));
    $this->load->view('footer');
  }

  function delete($id) {//id값에 해당하는 데이터 삭제
    if (!$this->session->userdata('is_login') == TRUE) {
      redirect('index.php/auth/login');
    }
    $this->board_list->delete($id);
    redirect('index.php/board?page=&list=');
  }
  function update($id) {//id값에 해당하는 데이터 수정
    $this->board_list->update($id,$this->input->post('mod_title'),$this->input->post('mod_body'));
    redirect('index.php/board?page=&list=');
  }
  function _header(){//한 화면에 나타내기 위한 헤드 편집
    $bs = $this->board_list->gets();
    $this->load->view('head');
    $this->load->view('board_list', array('bs'=>$bs));
  }
}
?>
