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
<<<<<<< HEAD
  function add($name, $image, $body) {
    $this->db->set('created', 'NOW()', false);
    $this->db->insert('anyang',array(
      'name'=>$name,
      'image'=>$image,
=======
  function add($name, $body) {
    $this->db->set('created', 'NOW()', false);
    $this->db->insert('anyang',array(
      'name'=>$name,
>>>>>>> 1186f238d84f76f8b7ea54ae9bcbbe0449bd8b12
      'body'=>$body
    ));
    return $this->db->insert_id();
  }
}
?>
