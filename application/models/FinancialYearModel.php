<?php
defined('BASEPATH') or exit ('No direct script access allowed');

class FinancialYearModel extends CI_Model
{


  public function findAllActive()
  {
    $q = $this->db->where('status', 1)->order_by("id", "desc")->get("year");

    if ($q->num_rows() > 0) {
      return $q->result_array();
    } else {
      return false;
    }

  }

  public function findAll()
  {
    $q = $this->db->order_by('id', 'desc')->get('year');

    if ($q->num_rows() > 0) {
      return $q->result_array();
    } else {
      return false;
    }
  }

  public function findOneById($id)
  {
    $q = $this->db->where('id', $id)->limit(1)->get('year');
    if ($q->num_rows() == 1) {
      return $q->row_array();
    } else {
      return false;
    }


  }



}