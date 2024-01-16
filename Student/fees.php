<?php 
session_start();
if (isset($_SESSION['student_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Student') {
       include "../DB_connection.php";
       include "data/student.php";

       $student_id = $_SESSION['student_id'];
       $student = getStudentById($student_id, $conn);

       $current_year = '';
       $current_semester = '';
       $payment_code = '';


       if (isset($_GET['current_year'])) $current_year = $_GET['current_year'];
       if (isset($_GET['current_semester'])) $current_semester = $_GET['current_semester'];
       if (isset($_GET['payment_code'])) $payment_code = $_GET['payment_code'];
       if (isset($_GET['std_id'])) $std_id = $_GET['std_id'];
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Payment</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: ORVBA
  * Updated: Mar 09 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<body>
<?php
    include "inc/header.php";
    ?>

    <?php
    include "inc/sidebar.php";
    ?>
  <main id="main" class="main">

  <form method="post"
              class="shadow p-3 mt-5 form-w" 
              action="req/fees.php">
        <h3>Payment Form</h3><hr>
        <?php if (isset($_GET['error'])) { ?>
          <div class="alert alert-danger" role="alert">
           <?=$_GET['error']?>
          </div>
        <?php } ?>
        <?php if (isset($_GET['success'])) { ?>
          <div class="alert alert-success" role="alert">
           <?=$_GET['success']?>
          </div>
        <?php } ?>
        <div class="mb-3">
          <label class="form-label">current_year</label>
          <input type="text" 
                 class="form-control"
                 name="current_year">
        </div>
        <div class="mb-3">
          <label class="form-label">current_semester</label>
          <input type="text" 
                 class="form-control"
                 name="current_semester">
        </div>
        <div class="mb-3">
          <label class="form-label">payment_code</label>
          <input type="text" 
                 class="form-control"
                 name="payment_code">
        </div>

        <div class="mb-3">
          <label class="form-label">L.E</label>
          <input type="text" 
                 class="form-control"
                 value= "<?php if($student['grade']== 1)
                  echo "15000";
                  elseif($student['grade']== 2)
                  echo "20000";
                  elseif($student['grade']== 3)
                  echo "25000";
                 ?> "
                 disabled
                 >
        </div>

        <div class="mb-3">
          <input type="hidden" 
                 class="form-control"
                 name="std_id"
                 value="<?php echo $_SESSION['student_id'] ?>"
                 >
        </div>
        
      <button type="submit" class="btn btn-primary">Pay</button>
     </form>        
 </div>
      </main>
 <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>	

</body>
</html>
<?php 
}else {
    header("Location: ../login.php");
    exit;
  } 
}else {
	header("Location: ../login.php");
	exit;
} 
?>