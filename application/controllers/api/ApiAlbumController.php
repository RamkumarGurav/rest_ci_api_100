<?php
defined('BASEPATH') or exit ('No direct script access allowed');
class ApiAlbumController extends CI_Controller
{


  public function __construct()
  {
    parent::__construct();
    $this->load->model('CommonModel', 'model');
  }

  public function findAllActive_get()
  {


    if (!empty ($this->input->get("year_id"))) {

      $year_id = $this->input->get("year_id");
      $yearResponse = $this->model->findOneByMultipleColumnNames("aps_years", ["id" => $year_id, "status" => "1"]);

      if ($yearResponse['status'] == false) {
        $this->output
          ->set_content_type('application/json', 'utf-8')
          ->set_output(json_encode($yearResponse, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
          ->_display();
        exit;
      } else {
        $response = $this->model->findAllByMultipleColumnNamesAndOrderByWithPagination("albums", ["status" => "1", "year_id" => $year_id], ["position" => "DESC"]);


        $this->output
          ->set_content_type('application/json', 'utf-8')
          ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
          ->_display();
        exit;
      }
    } else {
      $response = $this->model->findAllByMultipleColumnNamesAndOrderByWithPagination("albums", ["status" => "1"], ["position" => "DESC"]);


      $this->output
        ->set_content_type('application/json', 'utf-8')
        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
        ->_display();
      exit;
    }


  }
  public function findOneActive_get($id)
  {
    $response = $this->model->findOneByMultipleColumnNames("aps_albums", ["id" => $id, "status" => '1']);






    $this->output
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
      ->_display();
    exit;

  }



}