<?php
defined('BASEPATH') or exit ('No direct script access allowed');

class CommonModel extends CI_Model
{


  /* ==========================================================================
          COMMON METHODS
     ========================================================================== */

  public function findAllByMultipleColumnNamesAndOrderByWithPagination($tableName, $columnsArray = null, $orderByArr = ["id" => "desc"], $limit = null, $pageNumber = 1)
  {


    if ($columnsArray == null) {
      if ($orderByArr == null) {
        $this->db->order_by("id", "desc");
      } else {
        foreach ($orderByArr as $orderBy => $order) {
          $this->db->order_by($orderBy, $order);
        }
      }
    } else {
      // Apply conditions based on the provided column names and values
      foreach ($columnsArray as $columnName => $columnValue) {
        $this->db->where($columnName, $columnValue);
      }
      if ($orderByArr == null) {
        $this->db->order_by("id", "desc");
      } else {
        foreach ($orderByArr as $orderBy => $order) {
          $this->db->order_by($orderBy, $order);
        }
      }
    }

    // Apply pagination
    if ($limit !== null and $pageNumber > 0) {
      $offset = $limit * ($pageNumber - 1);
      $this->db->limit($limit, $offset);
    }

    $q = $this->db->get($tableName);

    // if ($q->num_rows() > 0) {
    //   return $q->result_array();
    // } else {
    //   return false;
    // }

    // Check if there was an error in the query execution
    $error = $this->db->error();
    if (!empty ($error['code'])) {
      // An error occurred
      $error_message = $error['message'];
      // Log or handle the error as needed
      $this->output->set_status_header(500);
      return ["status" => false, "message" => $error_message];
    } else {
      $this->output->set_status_header(200);
      // No error, return the result array even if it's empty
      return ["status" => true, "data" => $q->result_array()];
    }

  }


  public function findOneByColumnName($tableName, $column, $columnValue)
  {
    $q = $this->db->where($column, $columnValue)->limit(1)->get($tableName);
    if ($q->num_rows() == 1) {
      return $q->row_array();
    } else {
      return false;
    }


  }

  public function findOneByMultipleColumnNames($tableName, $columnsArray)
  {
    // Apply conditions based on the provided column names and values
    foreach ($columnsArray as $columnName => $columnValue) {
      $this->db->where($columnName, $columnValue);
    }

    // Limit the result to one row
    $this->db->limit(1);

    // Execute the query
    $q = $this->db->get($tableName);

    // // Check if a single row is found
    // if ($q->num_rows() == 1) {
    //   return $q->row_array(); // Return the result as an associative array
    // } else {
    //   return false; // Return false if no rows or multiple rows are found
    // }

    // Check if there was an error in the query execution
    $error = $this->db->error();
    if (!empty ($error['code'])) {
      // An error occurred
      $error_message = $error['message'];
      // Log or handle the error as needed
      $this->output->set_status_header(500);
      return ["status" => false, "message" => $error_message];
    } else {

      $result = $q->row_array();

      if (empty ($result)) {
        $this->output->set_status_header(404);
        return ["status" => false, "message" => "Resource Not Found"];
      } else {
        $this->output->set_status_header(200);
        return ["status" => true, "data" => $q->row_array()];
      }

    }
  }


  public function updateOneByColumnName($tableName, $column, $columnValue, $data)
  {
    $this->db->where($column, $columnValue);
    $q = $this->db->update($tableName, $data);
    if (!empty ($q)) {
      return $this->findOneByColumnName($column, $columnValue);
    } else {
      return false;
    }
  }

  public function updateOneByMultipleColumnName($tableName, $columnsArray, $data)
  {

    // Apply conditions based on the provided column names and values
    foreach ($columnsArray as $columnName => $columnValue) {
      $this->db->where($columnName, $columnValue);
    }

    $q = $this->db->update($tableName, $data);
    if (!empty ($q)) {
      return true;
    } else {
      return false;
    }
  }


  public function updateMultipleByDataWithId($tableName, $dataWithId)
  {
    $this->db->trans_start(); // Start transaction

    $q = $this->db->update_batch($tableName, $dataWithId, 'id');

    // Check if any updates failed
    if ($this->db->trans_status() === false) {
      $this->db->trans_rollback(); // Rollback transaction
      return false;
    } else {
      $this->db->trans_commit(); // Commit transaction

      return true;


    }
  }


  public function deleteOneByColumnName($tableName, $column, $columnValue)
  {
    $this->db->where($column, $columnValue);
    $q = $this->db->delete($tableName);
    if (!empty ($q)) {
      return true;
    } else {
      return false;
    }
  }

  public function deleteOneByMultipleColumnNames($tableName, $columnsArray)
  {
    // Apply conditions based on the provided column names and values
    foreach ($columnsArray as $columnName => $columnValue) {
      $this->db->where($columnName, $columnValue);
    }
    $q = $this->db->delete($tableName);
    if (!empty ($q)) {
      return true;
    } else {
      return false;
    }
  }


  public function deleteMultipleByIdsArray($tableName, $idsArray)
  {
    $this->db->trans_start(); // Start transaction
    {
      if (!empty ($idsArray)) {
        $this->db->where_in('id', $idsArray);
        $this->db->delete($tableName);
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
  /* xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx */



  /* =======================================================================
          SPECIFIC METHODS
     ======================================================================= */

  public function findAllActive($tableName, $orderBy = 'id', $order = 'desc')
  {
    $q = $this->db->where('status', 1)->order_by($orderBy, $order)->get($tableName);

    if ($q->num_rows() > 0) {
      return $q->result_array();
    } else {
      return false;
    }

  }

  public function findAll($tableName, $status = null, $orderBy = 'id', $order = 'desc')
  {
    $q = null;
    if ($status == null) {
      $q = $this->db->order_by($orderBy, $order)->get($tableName);
    } else {
      $q = $this->db->where("status", $status)->order_by($orderBy, $order)->get($tableName);
    }

    if ($q->num_rows() > 0) {
      return $q->result_array();
    } else {
      return false;
    }
  }


  public function findAllOrderBy($tableName, $orderBy = 'id', $order = 'desc')
  {
    $q = $this->db->order_by($orderBy, $order)->get($tableName);

    if ($q->num_rows() > 0) {
      return $q->result_array();
    } else {
      return false;
    }
  }


  public function findOneById($tableName, $id)
  {
    $q = $this->db->where('id', $id)->limit(1)->get($tableName);
    if ($q->num_rows() == 1) {
      return $q->row_array();
    } else {
      return false;
    }


  }
  /* xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx */

}