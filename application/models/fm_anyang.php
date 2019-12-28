<?php
class Fm_anyang extends CI_MODEL {
  function __construct() {
    parent::__construct();
  }
  public function gets() {
    return $this->db->query('SELECT * FROM anyang')->result();
  }
  public function get($fm_id) {
    return $this->db->get_where('anyang', array('id'=>$fm_id))->row();

  }
  function add($name, $image, $body) {
    $this->db->set('created', 'NOW()', false);
    $this->db->insert('anyang',array(
      'name'=>$name,
      'image'=>$image,
      'body'=>$body
    ));
    return $this->db->insert_id();
  }
}
?>
