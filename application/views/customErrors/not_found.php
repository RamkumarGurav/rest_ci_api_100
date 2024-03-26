<!-- application/views/errors/html/404.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>404 Not Found</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url() . "assets/plugins/fontawesome-free/css/all.min.css" ?>">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url() . "assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css" ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url() . "assets/dist/css/adminlte.min.css" ?>">
  <style>
    body {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background-color: #f8f9fa;
    }

    .error-container {
      text-align: center;
    }
  </style>
</head>

<body>
  <div class="error-container">
    <div class="d-flex justify-content-center align-items-center" id="main">
      <h1 class="mr-3 pr-3 align-top border-right inline-block align-content-center">404</h1>
      <div class="inline-block align-middle">
        <h2 class="font-weight-normal lead" id="desc">The page you requested was not found.</h2>
      </div>
    </div>
    <a href="<?php echo base_url(); ?>" class="btn btn-primary">HOME</a>
    <a href="javascript:window.history.go(-1);" class="btn btn-outline-primary ml-2">BACK</a>
  </div>
  <script src="<?= base_url() . "assets/plugins/jquery/jquery.min.js" ?>"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url() . "assets/plugins/bootstrap/js/bootstrap.bundle.min.js" ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() . "assets/dist/js/adminlte.min.js" ?>"></script>



</body>

</html>