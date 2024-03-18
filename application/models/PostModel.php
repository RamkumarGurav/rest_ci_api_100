<?php
defined('BASEPATH') or exit ('No direct script access allowed');

class PostModel extends CI_Model
{

  public function findAll($column = null, $columnValue = null)
  {
    $q = null;
    if ($column == null or $columnValue == null) {
      $q = $this->db->order_by('id', 'desc')->get('test_posts');
    } else {
      $q = $this->db->where("{$column}", $columnValue)->order_by('id', 'desc')->get('test_posts');
    }
    if ($q->num_rows() > 0) {
      return $q->result_array();
    } else {
      return false;
    }
  }




  public function findOneById($id, $status = null)
  {
    $q = null;
    if ($status == null) {

      $q = $this->db->where('id', $id)->limit(1)->get('test_posts');

    } else {
      $q = $this->db->where(['id' => $id, "status" => $status])->limit(1)->get('test_posts');
    }

    if ($q->num_rows() == 1) {
      return $q->row_array();
    } else {
      return false;
    }


  }
  // public function findActiveOneById($id)
  // {
  //   $q = $this->db->where('id', $id,"status","1")->limit(1)->get('test_posts');
  //   if ($q->num_rows() == 1) {
  //     return $q->row_array();
  //   } else {
  //     return false;
  //   }


  // }

  public function createOne($data)
  {


    $q = $this->db->insert('test_posts', $data);
    if (!empty ($q)) {
      return $this->findOneById($this->db->insert_id());
    } else {
      return false;
    }
  }



}