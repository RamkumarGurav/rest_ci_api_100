<?php
defined('BASEPATH') or exit ('No direct script access allowed');
class ApiGalleryController extends CI_Controller
{


  public function __construct()
  {
    parent::__construct();
    $this->load->model('CommonModel', 'model');
  }

  public function findAllActive_get()
  {


    if (!empty ($this->input->get("album_id"))) {

      $album_id = $this->input->get("album_id");
      $albumResponse = $this->model->findOneByMultipleColumnNames("albums", ["id" => $album_id, "status" => "1"]);

      if ($albumResponse['status'] == false) {
        $this->output
          ->set_content_type('application/json', 'utf-8')
          ->set_output(json_encode($albumResponse, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
          ->_display();
        exit;
      } else {
        $response = $this->model->findAllByMultipleColumnNamesAndOrderByWithPagination(
          "images",
          ["status" => "1", "album_id" => $album_id],
          ["position" => "DESC"]
        );


        $this->output
          ->set_content_type('application/json', 'utf-8')
          ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
          ->_display();
        exit;
      }
    } else {
      $response = $this->model->findAllByMultipleColumnNamesAndOrderByWithPagination("images", ["status" => "1"], ["position" => "DESC"]);


      $this->output
        ->set_content_type('application/json', 'utf-8')
        ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
        ->_display();
      exit;
    }


  }
  public function findOneActive_get($id)
  {
    $response = $this->model->findOneByMultipleColumnNames("images", ["id" => $id, "status" => '1']);






    $this->output
      ->set_content_type('application/json', 'utf-8')
      ->set_output(json_encode($response, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
      ->_display();
    exit;

  }



}