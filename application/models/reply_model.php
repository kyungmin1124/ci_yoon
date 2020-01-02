<?php
class Reply_model extends CI_MODEL {
  function __construct() {
    parent::__construct();
  }
  public function gets() {
    return $this->db->query('SELECT * FROM reply WHERE post_id in (SELECT post_id FROM board)')->result();
  }
  public function get($post_id) {
    return $this->db->get_where('reply', array('post_id' => $post_id))->row();
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
