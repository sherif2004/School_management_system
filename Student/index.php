<?php 
$update_Msg= "";
session_start();
if (isset($_SESSION['student_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Student') {
       include "../DB_connection.php";
       include "data/student.php";
       include "data/subject.php";
       include "data/grade.php";
       include "data/section.php";
       include "data/score.php";
       include "data/fees.php";


       $student_id = $_SESSION['student_id'];

       $student = getStudentById($student_id, $conn);
       $scores = getScoreById($student_id, $conn);
       $fees = getWhoPayed($conn);

 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Student - Information </title>
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

  <!-- ======= Header ======= -->
  <?php
    include "inc/header.php";
    ?>
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->

    <?php
    include "inc/sidebar.php";
    ?>

  <main id="main" class="main">
     <?php 
        if ($student != 0) {
     ?>
     
    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">
          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
              <img src="../img/student-<?=$student['gender']?>.png" alt="Profile" class="rounded-circle">
              <h2>@<?=$student['username']?></h2>
            </div>
          </div>
        </div>

        <div class="col-xl-8">
          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Grades</button>
                </li>

              </ul>

              <div class="tab-content pt-2">
                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">First Name</div>
                    <div class="col-lg-9 col-md-8"><?=$student['fname']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Last Name</div>
                    <div class="col-lg-9 col-md-8"><?=$student['lname']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Username</div>
                    <div class="col-lg-9 col-md-8"><?=$student['username']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8"><?=$student['address']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">DOB</div>
                    <div class="col-lg-9 col-md-8"><?=$student['date_of_birth']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?=$student['email_address']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Gender</div>
                    <div class="col-lg-9 col-md-8"><?=$student['gender']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">DOJ</div>
                    <div class="col-lg-9 col-md-8"><?=$student['date_of_joined']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Grades</div>
                    <div class="col-lg-9 col-md-8"><?php 
                      $grade = $student['grade'];
                      $g = getGradeById($grade, $conn);
                      echo $g['grade_code'].'-'.$g['grade'];
                  ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Sections</div>
                    <div class="col-lg-9 col-md-8"><?php 
                    $section = $student['section'];
                    $s = getSectioById($section, $conn);
                    echo $s['section'];
                  ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?=$student['parent_fname']?></div>
                  </div>
                  
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?=$student['parent_lname']?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?=$student['parent_phone_number']?></div>
                  </div>
                  <?php
        
        }else {
          header("Location: student.php");
          exit;
        }
        ?>
        <?php if (isset($_GET['perror'])) { ?>
            <div class="alert alert-danger" role="alert">
             <?=$_GET['perror']?>
            </div>
          <?php } ?>
          <?php if (isset($_GET['psuccess'])) { ?>
            <div class="alert alert-success" role="alert">
             <?=$_GET['psuccess']?>
            </div>
          <?php } ?>         
        <form method="post"
              action="req/student-change.php"
              id="change_password">
       <div class="mb-3">
            <div class="mb-3">
            <label class="form-label">Old password</label>
                <input type="password" 
                       class="form-control"
                       name="old_pass"> 
          </div>

            <label class="form-label">New password </label>
            <div class="input-group mb-3">
                <input type="text" 
                       class="form-control"
                       name="new_pass"
                       id="passInput">
                <button class="btn btn-secondary"
                        id="gBtn">
                        Random</button>
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label">Confirm new password  </label>
                <input type="text" 
                       class="form-control"
                       name="c_new_pass"
                       id="passInput2"> 
          </div>
          <button type="submit" 
              class="btn btn-primary">
              Change</button>
        </form>
      </div>
        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
        <?php 
        if ($scores != 0 && $fees) {
            $check = 0;
            foreach ($scores as $score) { 
              if($score['year'] == $check){
                $check = $score['year'];
                $csubject = getSubjectById($score['subject_id'], $conn);
          ?>
          <tr>
            <td><?=$csubject['subject_code']?></th>
            <td><?=$csubject['subject']?></th>
            <td>
              <?php 
                  $total = 0;
                  $outOf = 0;
                  $results = explode(',', trim($score['results']));
                  foreach ($results as $result) {
                    
                    $temp =  explode(' ', trim($result));
                     $total +=$temp[0]; 
                     $outOf +=$temp[1]; 
               ?>
              <small class="border p-1">
                <?=$temp[0]?> / <?=$temp[1]?>
              </small>&nbsp;
            <?php } ?>
            </th>
            <th><?=$total?> / <?=$outOf?></th>
            <th><?php 
                echo gradeCalc($total);
               ?></th>
            <th><?=$score['semester']?></th>
          </tr>
        <?php }else { 
          $check = $score['year'];

          $csubject = getSubjectById($score['subject_id'], $conn);
        ?>
         <div class="table-responsive " style="width: 90%; max-width: 700px;">
              <table class="table table-bordered mt-1 mb-5 n-table">
                 <caption style="caption-side:top">Year - <?=$score['year']?> </caption>
                <thead>
                  <tr>
                    <th scope="col">Course Code</th>
                    <th scope="col">Course Title</th>
                    <th scope="col">Results</th>
                    <th scope="col">Total</th>
                    <th scope="col">Grade</th>
                    <th scope="col">Semester</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
            <td><?=$csubject['subject_code']?></th>
            <td><?=$csubject['subject']?></th>
            <td>
              <?php 
                  $total = 0;
                  $outOf = 0;
                  $results = explode(',', trim($score['results']));
                  foreach ($results as $result) { 
                    $temp =  explode(' ', trim($result));
                    $total += $temp[0];
                    $outOf += $temp[1];
               ?>
              <small class="border p-1">
                <?=$temp[0]?> / <?=$temp[1]?>
              </small>&nbsp;
            <?php } ?>
            </th>
            <th><?=$total?> / <?=$outOf?></th>
            <th><?php 
                echo gradeCalc($total);
               ?></th>
            <th><?=$score['semester']?></th>
          </tr>
        <?php } if($score['year'] != $check){ ?>   
        </tbody>
      </table>
   </div><br/>  
  <?php  } } ?>
   <?php }else { ?>
     <div class="alert alert-info .w-450 m-5" 
                  role="alert">
                To see your grades please pay the school fees first !
     </div>
   <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>    
        $(document).ready(function(){
             $("#navLinks li:nth-child(1) a").addClass('active');
        });

        $(document).ready(function(){
             $("#navLinks li:nth-child(3) a").addClass('active');
        });

        function makePass(length) {
            var result           = '';
            var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for ( var i = 0; i < length; i++ ) {
              result += characters.charAt(Math.floor(Math.random() * 
         charactersLength));
           }
           var passInput = document.getElementById('passInput');
           var passInput2 = document.getElementById('passInput2');
           passInput.value = result;
           passInput2.value = result;
        }

        var gBtn = document.getElementById('gBtn');
        gBtn.addEventListener('click', function(e){
          e.preventDefault();
          makePass(4);
        });
    </script>

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