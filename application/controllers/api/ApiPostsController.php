<?php

defined('BASEPATH') or exit ('No direct script access allowed');

require APPPATH . "libraries/RestController.php";
require APPPATH . "libraries/Format.php";
use chriskacerguis\RestServer\RestController;
use chriskacerguis\RestServer\Format;

class ApiPostsController extends RestController
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("PostModel", "model");
  }


  public function getAll_get()
  {

    $status = $this->input->get("status");

    $data = null;
    if ($status != null) {
      $data = $this->model->findAll("status", $status);

    } else {
      $data = $this->model->findAll();
    }

    if (!empty ($data)) {
      $this->response($data, RestController::HTTP_OK);

    } else {
      $this->response([
        "status" => false,
        "message" => "Resource Not Found"
      ], RestController::HTTP_NOT_FOUND);
    }


  }



  public function createOne_post()
  {
    $data = [
      "title" => $this->input->post('title'),
      "description" => $this->input->post('description')
    ];

    $result = $this->model->createOne($data);

    if (!empty ($result)) {
      $this->response([
        'status' => true,
        'message' => 'Successfully Created New Post',
        'data' => $result
      ], RestController::HTTP_OK);
    } else {
      $this->response([
        'status' => false,
        'message' => 'Failed to Create New Post'
      ], RestController::HTTP_BAD_REQUEST);
    }





  }


  public function getOneById_get($id)
  {

    $status = $this->input->get("status");

    $data = null;
    if ($status == '1') {

      $data = $this->model->findOneById($id, $status);
    } else {
      $data = $this->model->findOneById($id);

    }


    if (!empty ($data)) {
      $this->response($data, 200);
    } else {
      $this->response([
        'status' => false,
        'message' => 'Resource NOT Found'
      ], RestController::HTTP_NOT_FOUND);
    }


  }
}