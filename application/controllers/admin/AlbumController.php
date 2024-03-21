<?php
defined('BASEPATH') or exit ('No direct script access allowed');
class AlbumController extends CI_Controller
{
  public function index()
  {
    $this->load->view('Dashboard/index');
  }
}