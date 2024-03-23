<?php
defined('BASEPATH') or exit ('No direct script access allowed');
class FinancialYearController extends CI_Controller
{


  public function __construct()
  {
    parent::__construct();
    $this->load->model('CommonModel', 'model');
  }
  public function index()
  {

    $allYears = $this->model->findAllByMultipleColumnNamesAndOrderByWithPagination("years");
    $allYears = $this->model->findAllByMultipleColumnNamesAndOrderByWithPagination("years", ["status" => "1"]);
    $allYears = $this->model->findAllByMultipleColumnNamesAndOrderByWithPagination("years", ["status" => "1"], ["id" => "ASC"]);
    $allYears = $this->model->findAllByMultipleColumnNamesAndOrderByWithPagination("years", ["status" => "1"], ["id" => "ASC"], 1);
    $allYears = $this->model->findAllByMultipleColumnNamesAndOrderByWithPagination("years", null, ["id" => "ASC"]);
    $response = $this->model->findAllByMultipleColumnNamesAndOrderByWithPagination("years", null, null, 10);
    $baseUrl = base_url();
    // echo "<pre> <br>";
    // print_r($response);
    // exit;
    $this->load->view('FinancialYear/index', ["response" => $response, "baseUrl" => $baseUrl]);
  }

  public function getOneById($id)
  {
    $result = $this->model->findOneByMultipleColumnNames("years", ["id" => $id]);




    if (empty ($result)) {
      $response = ["status" => false, "message" => "Oops, Sorry! No Financial Years Found"];

      $this->output
        ->set_status_header(200)
        ->set_content_type('application/json', 'utf-8')
        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
        ->_display();
      exit;

    } else {

      $response = ["status" => true, "data" => $result];

      $this->output
        ->set_status_header(200)
        ->set_content_type('application/json', 'utf-8')
        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
        ->_display();
      exit;
    }


    exit;

  }


  public function activateX()
  {

    $ids = $this->input->post("ids");
    echo "<pre> <br>";
    print_r(json_encode($ids));
    exit;

    // var_dump($ids);
    foreach ($ids as $id) {
      $this->model->updateOneByColumnName('id', $id, ["status" => "1"]);
    }
    $_SESSION["toast_message"] = "Sucessfully Activated";
    $_SESSION["toast_type"] = "alert-success";
    exit();
  }

  public function activate()
  {

    $ids = $this->input->post("ids");

    $data = [];
    foreach ($ids as $id) {
      $data[] = ["id" => $id, "status" => 1];
    }

    echo "<pre> <br>";
    print_r($data);
    exit;


  }

  public function activate_multiple()
  {

    $ids = $this->input->post("ids");
    $data = [];
    foreach ($ids as $id) {
      $data[] = ["id" => $id, "status" => "1"];
    }




    $result = $this->model->updateMultipleByDataWithId("years", $data);
    if ($result) {
      $response = ["status" => true, "message" => "Successfully updated"];
    } else {
      $response = ["status" => false, "message" => "Failed to Update"];
    }



    // Sending JSON response back to the client
    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($response));

  }

  public function block()
  {
    $ids = $this->input->post("ids");
    echo "<pre> <br>";
    print_r(json_encode($ids));
    exit;
    foreach ($ids as $id) {
      $this->model->updateOneByColumnName('id', $id, ["status" => "0"]);
    }
    $_SESSION["toast_message"] = "Sucessfully Blocked";
    $_SESSION["toast_type"] = "alert-success";
    exit();
  }

  public function block_multiple()
  {
    $ids = $this->input->post("ids");
    $data = [];
    foreach ($ids as $id) {
      $data[] = ["id" => $id, "status" => "0"];
    }




    $result = $this->model->updateMultipleByDataWithId("years", $data);
    if ($result) {
      $response = ["status" => true, "message" => "Successfully updated"];
    } else {
      $response = ["status" => false, "message" => "Failed to Update"];
    }



    // Sending JSON response back to the client
    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($response));

  }
  public function delete_multiple()
  {
    $ids = $this->input->post("ids");

    $result = $this->model->deleteMultipleByIdsArray("years", $ids);

    if ($result) {
      $response = ["status" => true, "message" => "Successfully Deleted"];
    } else {
      $response = ["status" => false, "message" => "Failed to Delete"];
    }



    // Sending JSON response back to the client
    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($response));


  }
}