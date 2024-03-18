<?php

defined('BASEPATH') or exit ('No direct script access allowed');

require APPPATH . "libraries/RestController.php";
require APPPATH . "libraries/Format.php";
use chriskacerguis\RestServer\RestController;
use chriskacerguis\RestServer\Format;

class ApiDemoController extends RestController
{
  public function index_get()
  {
    echo "Hi I am Restful";
  }
}