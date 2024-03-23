<?php
defined('BASEPATH') or exit ('No direct script access allowed');
class CommonController extends CI_Controller
{


  public function __construct()
  {
    parent::__construct();

  }
  public function index()
  {

    $allYears = $this->model->findAll();
    $baseUrl = base_url();
    // $this->load->view('FinancialYear/index', ["allYears" => $allYears, "baseUrl" => $baseUrl]);
  }

  public function getAllActive()
  {


    $fys = $this->model->findAllActive();

    echo "<pre> <br>";
    print_r(json_encode($fys));
    exit;
  }

  public function getAll()
  {
    $fys = $this->model->findAll()();

    echo "<pre> <br>";
    print_r(json_encode($fys));
    exit;
  }

  public function getOneById($id)
  {
    $fy = $this->model->findOneById($id);


    if (empty ($fy)) {
      $data = ["status" => 1, "data" => $fy];
      $jsonData = json_encode($data);
      echo $jsonData;
      exit;
    } else {


    }

    echo "<pre> <br>";
    print_r(json_encode($fy));
    exit;

  }


  public function activate()
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

  public function activate_multiple()
  {

    $ids = $this->input->post("ids");
    $data = [];
    foreach ($ids as $id) {
      $data[] = ["id" => $id, "status" => "1"];
    }




    $result = $this->model->updateMultipleByData($data);
    if ($result) {
      $response = ["status" => true];
    } else {
      $response = ["status" => false];
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




    $result = $this->model->updateMultipleByData($data);
    if ($result) {
      $response = ["status" => true];
    } else {
      $response = ["status" => false];
    }



    // Sending JSON response back to the client
    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($response));

  }
  public function delete_multiple()
  {
    $ids = $this->input->post("ids");
    $data = [];
    foreach ($ids as $id) {
      $data[] = ["id" => $id];
    }

    $result = $this->model->deleteMultipleByData($data);

    if ($result) {
      $response = ["status" => true];
    } else {
      $response = ["status" => false];
    }



    // Sending JSON response back to the client
    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($response));


  }
}