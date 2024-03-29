<?php

// session_start();
if (!isset ($_SESSION["user"])) {
  header("Location: {$baseUrl}admin");
  exit();
}



$this->load->view("templates/header");
$this->load->view("templates/leftnav");



?>

<!-- <style>
  .toast {
    position: relative;
    transform: translateX(100%);
    transition: transform 0.5s ease-in-out;
  }

  .toast.show-toast {
    transform: translateX(0);
  }
</style> -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <!-- <h1>Add Financial Year</h1> -->
        </div>
        <div class="col-sm-12">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Financial Year</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">


        <div class="col-sm-12">
          <!-- general form elements disabled -->
          <div class="card card-warning">
            <div class="card-header">
              <h3 class="card-title">
                Add Financial Year
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">





              <!-- <form action="" method="post"> -->
              <?= form_open("admin/FinancialYearController/update/{$yearData['id']}", ['method' => 'post', 'class' => ' ', "id" => "yearUpdateForm"]); ?>

              <!-- <input class="none" style="display:none;" name="id" value="<?= $yearData['id'] ?>" /> -->
              <div class="row">


                <div class="col-sm-12">
                  <!-- text input -->



                  <div class="form-group">
                    <label>Start Year</label>
                    <input type="text" class="form-control" name="start_year" id="start_year"
                      value="<?= set_value('start_year', isset ($yearData['start_year']) ? $yearData['start_year'] : '') ?>"
                      required placeholder=" Enter Start Year...">
                  </div>
                  <?= form_error('start_year') ?>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <!-- text input -->
                  <div class="form-group">
                    <label>End Year</label>
                    <input type="text" class="form-control" name="end_year" id="end_year"
                      value="<?= set_value('end_year', isset ($yearData['end_year']) ? $yearData['end_year'] : '') ?>"
                      required placeholder="Enter End Year...">
                  </div>
                  <?= form_error('end_year') ?>
                </div>
              </div>



              <div class="row">

                <div class="col-sm-12">
                  <!-- text input -->
                  <div class="form-group">
                    <label>Fiscal Year</label>
                    <input type="text" class="form-control" name="fiscal_year" id="fiscal_year"
                      value="<?= set_value('fiscal_year', isset ($yearData['fiscal_year']) ? $yearData['fiscal_year'] : '') ?>"
                      required placeholder="Fiscal Year.." readonly>
                  </div>
                  <?= form_error('fiscal_year') ?>
                </div>
              </div>



              <div class="row">

                <div class="col-sm-12">
                  <!-- radio -->
                  <label class="form-check-label">Select Status</label>
                  <div class="form-group  ">
                    <div class="form-check mr-5">
                      <input class="form-check-input" type="radio" name="status" required value="1"
                        <?= set_radio('status', '1', $yearData['status'] == "1") ?> />
                      <label class=" form-check-label">Active</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="status" required value="0"
                        <?= set_radio('status', '0', $yearData['status'] == "0") ?> />
                      <label class="form-check-label">Block</label>
                    </div>

                  </div>
                  <?= form_error('status') ?>
                </div>
              </div>
              <button type="submit" class="btn btn-primary" name="updateYear">Submit</button>
              <?= form_close(); ?>
              <!-- </form> -->
            </div>
            <!-- /.card-body -->
          </div>

        </div>
        <!--/.col (right) -->

      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- jQuery -->





<?php
$this->load->view("templates/footer");
?>

<script>
  $(function () {
    // Function to calculate fiscal year
    function calculateFiscalYear(startYear, endYear) {
      // Extracting last two digits of start and end years
      let startYearLastTwoDigits = startYear.toString().substr(0, 4);
      let endYearLastTwoDigits = endYear.toString().substr(2, 2);

      // Constructing fiscal year string
      let fiscalYear = startYearLastTwoDigits + '-' + endYearLastTwoDigits;

      // Returning fiscal year
      return fiscalYear;
    }

    // Function to update fiscal year field
    function updateFiscalYear() {
      // Getting start year and end year values with trimmed values
      let startYear = $('#start_year').val().trim();
      let endYear = $('#end_year').val().trim();

      // Checking if start year and end year are not empty
      if (startYear !== '' && endYear !== '') {
        // Calculating fiscal year
        let fiscalYear = calculateFiscalYear(startYear, endYear);

        // Setting fiscal year value to the input field
        $('#fiscal_year').val(fiscalYear);
      }
    }

    // Calling updateFiscalYear function on input change for start year and end year fields
    $('#start_year, #end_year').on('input', function () {
      updateFiscalYear();
    });

    // Calling updateFiscalYear function on page load
    updateFiscalYear();





  });





</script>

<script>
  $(document).ready(function () {


    // Function to trim input values
    function trimInputs() {
      $('input[type="text"]').each(function () {
        $(this).val($(this).val().trim());
      });
    }

    // Function to check if there are any changes in the form
    function hasChanges() {
      var oldData = <?= json_encode($yearData) ?>; // Assuming $yearData is PHP array containing old data
      delete oldData.id;
      delete oldData.added_on;
      delete oldData.updated_on;

      var formData = $('#yearUpdateForm').serializeArray();
      var newData = {};
      // Convert serialized form data to object
      $.each(formData, function (_, item) {
        newData[item.name] = item.value.trim();
      });



      // Compare oldData and newData
      return JSON.stringify(oldData) !== JSON.stringify(newData);
    }

    // Submit form only if there are changes
    $('#yearUpdateForm').on('submit', function (e) {
      trimInputs(); // Trim inputs before submission
      console.log(hasChanges())
      if (!hasChanges()) {
        e.preventDefault(); // Prevent form submission
        // ===============> showToast is from toaster.php file <===============
        showToast("alert-warning", "Nothing new to Submit");
        // ===============> end <===============

      }
    });
  });
</script>