<?php
class Reply_model extends CI_MODEL {
  function __construct() {
    parent::__construct();
  }
  function gets(){
    $query = $this->db->query('SELECT * FROM reply WHERE post_id in (SELECT post_id FROM board)');
    if($query->num_rows()>0){
      return $query->result();
    } else {
      return false;
    }
  }
  function add_comment($result){
    $query = $this->db->query('SELECT * FROM reply WHERE post_id ='.$result.'');
    if($query->num_rows()>0){
      return $query->result();
    } else {
      return false;
    }
  }
  function add($name,$content,$post_id){
    $this->db->set('date', 'NOW()', false);
    $this->db->insert('reply',array(
      'name'=>$name,
      'content'=>$content,
      'post_id'=>$post_id
    ));
    return $post_id;
  }
}
?>
