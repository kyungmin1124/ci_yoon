<?php
class Reply_model extends CI_MODEL {
  function __construct() {
    parent::__construct();
  }
  public function gets() {//게시물과 일치하는 댓글 정보를 가져와야 한다
    return $this->db->query('SELECT * FROM reply WHERE post_id in (SELECT post_id FROM board)')->result();
  }
  
  function add($name,$content,$comment_id) {
    $this->db->set('date', 'NOW()', false);
    $this->db->insert('reply',array(
      'name'=>$name,
      'content'=>$content,
      'post_id'=>$comment_id
    ));
    return $this->db->insert_id();
  }
}

?>
