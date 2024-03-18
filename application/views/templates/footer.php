<footer class="main-footer">
  <div class="float-right d-none d-sm-block"><b>Version</b> 3.2.0</div>
  <strong>Copyright &copy; 2014-2021
    <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
  All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->



<!-- jQuery -->
<script src="<?= base_url() . "assets/plugins/jquery/jquery.min.js" ?>
">
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url() . "assets/plugins/bootstrap/js/bootstrap.bundle.min.js" ?>
">
</script>
<!-- bs-custom-file-input -->
<script src="<?= base_url() . "assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js" ?>
">
</script>
<!-- AdminLTE App -->
<script src="<?= base_url() . "assets/dist/js/adminlte.min.js" ?>
">
</script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url() . "assets/dist/js/demo.js" ?>
">
</script>
<!-- Page specific script -->
<script>
$(function() {
  bsCustomFileInput.init();
});
</script>
<?php include ('toaster.php'); ?>
</body>

</html>