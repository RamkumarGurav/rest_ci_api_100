<!-- // ===============>SESSION-TOASTER <=============== -->
<?php if (isset ($_SESSION["toast_message"])): ?>
  <?php
  function getIcon($type)
  {
    $icon = '';
    if ($type == "alert-success") {
      $icon = '<i class="fa-solid fa-circle-check fa-2x mr-2"></i>';
    } elseif ($type == "alert-danger") {
      $icon = '<i class="fa-solid fa-triangle-exclamation fa-2x mr-2"></i>';
    } elseif ($type == 'alert-warning') {
      $icon = '<i class="fa-solid fa-circle-exclamation fa-2x mr-2"></i>';
    } else {
      $icon = '<i class="fa-solid fa-bolt fa-2x mr-2"></i>';
    }
    return $icon;
  }
  ?>
  <div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px;">
    <div id="customToast"
      class="d-none alert  <?= $_SESSION["toast_type"] ? $_SESSION["toast_type"] : "alert-primary" ?> 
    alert-dismissible position-fixed d-flex align-items-center bottom-0 right-0 align-items-center border-0 zindex-tooltip"
      style="position: fixed; top: 10px; right: 10px; z-index: 2000;" role="alert" aria-live="assertive"
      aria-atomic="true" data-autohide="false">
      <?= getIcon($_SESSION['toast_type']) ?>
      <span>
        <?= $_SESSION["toast_message"] ?>
      </span>


      <button id="customToastClose" type="button" class="close text-dark font-weight-bolder"
        data-dismiss="alert">×</button>


    </div>
  </div>
  <?php
  $_SESSION["toast_message"] = null;
  $_SESSION["toast_type"] = null;
?>
<?php endif; ?>
<!-- // ===============> END <=============== -->


<!-- // ===============>FE-TOASTER <=============== -->

<div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px;">
  <div id="customToastFE" style="position: fixed; top: 10px; right: 10px; z-index: 2000;"></div>
</div>

<!-- // ===============> END <=============== -->

<!-- //--------------------------------------------------} -->

<script>
  // ===============>FE-TOASTER <===============
  var toastContainer = $("#customToastFE");

  function showToast(type, message) {

    if (type == "alert-success") {
      icon = `<i class="fa-solid fa-circle-check fa-2x mr-2" ></i>`;
    } else if (type == "alert-danger") {
      icon = `<i class="fa-solid fa-triangle-exclamation  fa-2x mr-2"></i>`;

    } else if (type == 'alert-warning') {
      icon = `<i class="fa-solid fa-circle-exclamation fa-2x mr-2"></i>`;
    } else {

      icon = `<i class="fa-solid fa-bolt fa-2x mr-2"></i>`;
    }

    var toastHTML = `<div class="toast alert ${type} d-flex align-items-center  alert-dismissible" role="alert"  data-autohide="false"> ${icon}
 <span>${message}</span>
                    <button type="button" class="close" data-dismiss="toast">&times;</button>
                </div>`;
    var toastElement = $(toastHTML);
    toastContainer.append(toastElement);
    toastElement.toast('show');

    // Show the toast with sliding animation from right to left
    // toastElement.animate({ right: '0' }, 500);

    // Hide the toast after 2 seconds with sliding animation from left to right
    setTimeout(function () {
      // toastElement.animate({ right: '-100%' }, 500, function () {
      $(this).remove(); // Remove the toast element after animation
      // });
    }, 2000);
  }

  // Function to hide the toast
  // function hideToast() {
  //   toastElement.toast('hide'); // Hide the toast
  // }

  // ===============> END <===============


  // ===============> USING SESSION <===============
  $(function () {


    // Get the toast element
    var toastElement = $("#customToast");
    // Add "hide" class to the toast after 2 seconds
    setTimeout(function () {
      toastElement.removeClass("d-none");
    }, 700);
    setTimeout(function () {
      $('#customToastClose').alert("close");

    }, 3000);



  });


</script>