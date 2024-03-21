<?php
defined('BASEPATH') or exit ('No direct script access allowed');
class GalleryController extends CI_Controller
{
  public function index()
  {
    $this->load->view('Dashboard/index');
  }
}