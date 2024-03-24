<?php
defined('BASEPATH') or exit ('No direct script access allowed');
class ApiFinancialYearController extends CI_Controller
{


  public function __construct()
  {
    parent::__construct();
    $this->load->model('CommonModel', 'model');
  }

  public function findAllActive_get()
  {

    $response = $this->model->findAllByMultipleColumnNamesAndOrderByWithPagination("years", ["status" => "1"]);


    $this->output
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
      ->_display();
    exit;
  }
  public function findOneActive_get($id)
  {
    $response = $this->model->findOneByMultipleColumnNames("years", ["id" => $id, "status" => '1']);




    // if ($response['status'] == false) {
    //   $this->output->set_status_header(500);
    // }

    // if ($response['data'] == null) {
    //   $response['message'] = "Resource Not Found";
    //   $this->output->set_status_header(404);
    // }

    $this->output
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
      ->_display();
    exit;

  }



}