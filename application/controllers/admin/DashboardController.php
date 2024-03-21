<?php
defined('BASEPATH') or exit ('No direct script access allowed');
class DashboardController extends CI_Controller
{
  public function index()
  {

    if (empty ($this->session->userdata('user'))) {
      redirect('login');
    } else {


      $this->load->view('Dashboard/index');
    }
  }


}