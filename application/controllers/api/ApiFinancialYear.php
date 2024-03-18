<?php

defined('BASEPATH') or exit ('No direct script access allowed');

require APPPATH . "libraries/RestController.php";
require APPPATH . "libraries/Format.php";
use chriskacerguis\RestServer\RestController;
use chriskacerguis\RestServer\Format;

class ApiFinancialYear extends RestController
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model("FinancialYearModel", "model");
  }
  public function getAllActive_get()
  {

    $data = $this->model->findAllActive();
    $this->response($data, 200);

  }
}