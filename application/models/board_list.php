<?php
class Board_list extends CI_MODEL {
  function __construct() {
    parent::__construct();
  }
  public function gets() {
    return $this->db->query('SELECT * FROM board')->result();
  }
  public function get($b_id) {
    return $this->db->get_where('board', array('id'=>$b_id))->row();

  }
  function add($title, $body) {
    $this->db->set('created', 'NOW()', false);
    $this->db->insert('board',array(
      'title'=>$title,
      'body'=>$body
    ));
    return $this->db->insert_id();
  }
}
?>
