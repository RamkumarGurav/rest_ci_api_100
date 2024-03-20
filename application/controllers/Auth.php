<?php
defined('BASEPATH') or exit ('No direct script access allowed');
class Auth extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('AuthModel', "model");
  }

  public function index()
  {
    redirect('login');

  }


  public function login()
  {
    $this->load->helper('form');
    if (isset ($_POST['signin'])) {
      $this->login_validation();
    } else {
      $this->load->view("Auth/login");

    }
  }




  public function login_validation()
  {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required|trim');


    if ($this->form_validation->run()) {


      $email = $this->input->post('email');
      $password = $this->input->post('password');


      $userData = $this->model->login($email, $password);

      if (empty ($userData) || $userData['status'] != 1) {
        $this->session->set_flashdata("toastClass", "alert-danger");
        $this->session->set_flashdata("toastMsg", "Wrong Username or Password");
        $this->load->view("Auth/login");
      } else {
        $this->session->set_userdata("user", $userData);
        $this->session->set_flashdata("toastClass", "alert-success");
        $this->session->set_flashdata("toastMsg", "Successfully Logged in");
        redirect("/dashboard");
      }


    } else {

      $this->load->view("Auth/login");
    }

  }


  public function logout()
  {
    $this->session->sess_destroy();
    redirect("login");
  }






}