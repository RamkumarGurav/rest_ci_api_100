<?php
defined('BASEPATH') or exit ('No direct script access allowed');
class FinancialYearController extends CI_Controller
{


  public function __construct()
  {
    parent::__construct();
    $this->load->model('FinancialYearModel', 'model');
  }
  public function index()
  {

    $allYears = $this->model->findAll();
    // echo "<pre> <br>";
    // print_r(json_encode($allYears));
    // exit;
    $this->load->view('FinancialYear/index', ["allYears" => $allYears]);
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



}