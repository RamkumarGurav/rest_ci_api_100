<?php

if (isset ($_SESSION["user"])) {
  header("Location: {$baseUrl}admin/dashboard");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() . "assets/plugins/fontawesome-free/css/all.min.css" ?>">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url() . "assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css" ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() . "assets/dist/css/adminlte.min.css" ?>">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="index2.html"><b>Admin</b>LTE</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <?= form_open('auth', ['method' => 'post', 'class' => ' ']); ?>


        <div class="input-group mb-3">

          <input type="email" class="form-control" id="email" name="email" placeholder=" Email" required>
          <div class=" input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          <?= form_error('email') ?>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <?= form_error('password') ?>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" name="signin">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
        <?= form_close(); ?>

        <div class=" social-auth-links text-center mb-3">
          <p>- OR -</p>
          <a href="#" class="btn btn-block btn-primary">
            <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
          </a>
          <a href="#" class="btn btn-block btn-danger">
            <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
          </a>
        </div>
        <!-- /.social-auth-links -->

        <p class="mb-1">
          <a href="forgot-password.html">I forgot my password</a>
        </p>
        <p class="mb-0">
          <a href="register.html" class="text-center">Register a new membership</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->









  <!-- jQuery -->
  <script src="<?= base_url() . "assets/plugins/jquery/jquery.min.js" ?>"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url() . "assets/plugins/bootstrap/js/bootstrap.bundle.min.js" ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() . "assets/dist/js/adminlte.min.js" ?>"></script>


</body>

</html>