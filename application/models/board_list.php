<?php
class Board_list extends CI_MODEL {
  function __construct() {
    parent::__construct();
  }
  public function gets() {
    return $this->db->query('SELECT * FROM board')->result();
  }
  public function get($post_id) {
    return $this->db->get_where('board', array('post_id' => $post_id))->row();
  }

  function add($title, $body) {
    $this->db->set('created', 'NOW()', false);
    $this->db->insert('board',array(
      'title'=>$title,
      'body'=>$body
    ));
    return $this->db->insert_id();
  }
  function delete($id) {
    $this->db->delete('board',array('post_id'=>$id));
  }
  function update($id,$title,$body) {
    $this->db->set('created', 'NOW()', false);
    $data = array(
      'post_id' => $id,
      'title' => $title,
      'body' => $body
    );
    $this->db->replace('board',$data);
  }
}
?>
