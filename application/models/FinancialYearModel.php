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

  public function findOneByColumnName($column, $columnValue)
  {
    $q = $this->db->where($column, $columnValue)->limit(1)->get('year');
    if ($q->num_rows() == 1) {
      return $q->row_array();
    } else {
      return false;
    }


  }


  public function updateOneByColumnName($column, $columnValue, $data)
  {
    $this->db->where($column, $columnValue);
    $q = $this->db->update('year', $data);
    if (!empty ($q)) {
      return $this->findOneByColumnName($column, $columnValue);
    } else {
      return false;
    }
  }



  public function updateMultipleByData($data)
  {
    $this->db->trans_start(); // Start transaction

    $q = $this->db->update_batch('year', $data, 'id');

    // Check if any updates failed
    if ($this->db->trans_status() === false) {
      $this->db->trans_rollback(); // Rollback transaction
      return false;
    } else {
      $this->db->trans_commit(); // Commit transaction

      return true;


    }
  }


  public function deleteOneByColumnName($column, $columnValue)
  {
    $this->db->where($column, $columnValue);
    $q = $this->db->delete('year');
    if (!empty ($q)) {
      return true;
    } else {
      return false;
    }
  }


  public function updateMultipleByDataX($data)
  {
    $this->db->trans_start(); // Start transaction
    {
      if (!empty ($data)) {
        $this->db->where_in('id', $data);
        $this->db->update("year", $data);
      }

      // Check if any updates failed
      if ($this->db->trans_status() === false) {
        $this->db->trans_rollback(); // Rollback transaction
        return false;
      } else {
        $this->db->trans_commit(); // Commit transaction
        return true;
      }
    }

  }
  public function deleteMultipleByData($data)
  {
    $this->db->trans_start(); // Start transaction
    {
      if (!empty ($data)) {
        $this->db->where_in('id', $data);
        $this->db->delete('year');
      }

      // Check if any updates failed
      if ($this->db->trans_status() === false) {
        $this->db->trans_rollback(); // Rollback transaction
        return false;
      } else {
        $this->db->trans_commit(); // Commit transaction
        return true;
      }
    }

  }








}