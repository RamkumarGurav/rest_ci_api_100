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

    $response = $this->model->findAllByMultipleColumnNamesAndOrderByWithPagination("years");
    $baseUrl = base_url();
    $this->load->view('FinancialYear/index', ["response" => $response, "baseUrl" => $baseUrl]);
  }


  public function add_get()
  {
    $this->load->helper('form');

    if (isset ($_POST["createYear"])) {
      $this->load->library('form_validation');
      $this->form_validation->set_rules('start_year', 'Start Year', 'required|trim|exact_length[4]|is_natural');
      $this->form_validation->set_rules('end_year', 'End Year', 'required|trim|exact_length[4]|is_natural');
      $this->form_validation->set_rules('fiscal_year', 'Fiscal Year', 'required|trim|exact_length[7]|regex_match[/^\d{4}-\d{2}$/]');
      $body = $this->input->post();
      $data = [
        "start_year" => $body['start_year'],
        "end_year" => $body['end_year'],
        "fiscal_year" => $body['fiscal_year'],
        "status" => $body['status']
      ];



      if ($this->form_validation->run()) {

        $response = $this->model->createOne("years", $data);
        if ($response['status'] == true) {
          $this->session->set_flashdata('toast_type', 'alert-success');
          $this->session->set_flashdata('toast_message', 'Successfully created new Financial Year');
          redirect(base_url() . "admin/financial-years/listing");
        } else {
          echo "SOMETHING WENT WRONG! <br>";
        }
      } else {
        $this->load->view('FinancialYear/add', ["yearData" => null, "baseUrl" => base_url()]);
      }
    } else {
      $baseUrl = base_url();
      $this->load->view('FinancialYear/add', ["yearData" => null, "baseUrl" => $baseUrl]);
    }

  }

  public function add_post()
  {
    $this->load->helper('form');
    $this->load->library('form_validation');
    $this->form_validation->set_rules('start_year', 'Start Year', 'required|trim|exact_length[4]');
    $this->form_validation->set_rules('end_year', 'End Year', 'required|trim|exact_length[4]');
    $this->form_validation->set_rules('fiscal_year', 'Fiscal Year', 'required|trim|exact_length[7]');
    $body = $this->input->post();
    $data = [
      "start_year" => $body['start_year'],
      "end_year" => $body['end_year'],
      "fiscal_year" => $body['fiscal_year']
    ];

    if ($this->form_validation->run()) {

      $response = $this->model->createOne("years", $data);
      if ($response['status'] == true) {
        $this->redirect(base_url() . "admin/financial-years/listing");
      } else {
        echo "SOMETHING WENT WRONG! <br>";
      }
    } else {
      $this->load->view('FinancialYear/add', ["yearData" => null, "baseUrl" => base_url()]);
    }

  }

  public function update_get($id)
  {
    $yearResponse = $this->model->findOneByMultipleColumnNames("years", ["id" => $id]);
    $baseUrl = base_url();
    if ($yearResponse['status'] == true) {
      $this->load->view('FinancialYear/edit', ["yearData" => $yearResponse['data'], "baseUrl" => $baseUrl]);
    } else {
      echo "SOMETHING WENT WRONG! <br>";
    }
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