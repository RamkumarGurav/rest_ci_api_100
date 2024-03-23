<?php
defined('BASEPATH') or exit ('No direct script access allowed');

class AuthModel extends CI_Model
{


  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

  public function login($username, $password)
  {


    $this->db->where('email', $username);
    $this->db->where('password', $password);
    $q = $this->db->get('users');

    if ($q->num_rows() > 0) {
      return $q->row_array();
    } else {
      return false;
    }
  }


  public function logout()
  {

  }

}