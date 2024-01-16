<?php 
session_start();
if (isset($_SESSION['teacher_id']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Teacher') {
       include "../DB_connection.php";
       include "data/student.php";
       include "data/grade.php";
       include "data/class.php";
       include "data/section.php";
       include "data/setting.php";
       include "data/subject.php";
       include "data/teacher.php";
       include "data/student_score.php";

       if (!isset($_GET['student_id'])) {
           header("Location: students.php");
           exit;
       }
       $student_id = $_GET['student_id'];
       $student = getStudentById($student_id, $conn);
       $setting = getSetting($conn);
       $subjects = getSubjectByGrade($student['grade'], $conn);

       $teacher_id = $_SESSION['teacher_id'];
       $teacher = getTeacherById($teacher_id, $conn);

       $teacher_subjects = str_split(trim($teacher['subjects']));

       
      
       $ssubject_id = 0;
       if (isset($_POST['ssubject_id'])) {
           $ssubject_id = $_POST['ssubject_id'];

           $student_score = getScoreById($student_id, $teacher_id, $ssubject_id, $setting['current_semester'], $setting['current_year'], $conn); 
       }
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Teacher - grades</title>
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
  * Template URL: https://bootstrapmade.com/nice-ORVBA-bootstrap-ORVBA-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="../index.php" class="logo d-flex align-items-center">
          <img src="../assets/img/logo.png" alt="">
          <span class="d-none d-lg-block"><?=$setting['school_name']?></span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="../img/student-male.png"  alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2"><?=$teacher['username']?></span>
                </a>
                <!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6><?=$teacher['username']?></h6>
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="../logout.php">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </a>
                    </li>

                </ul>
                <!-- End Profile Dropdown Items -->
            </li>
        </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <?php
    include "inc/sidebar.php";
    ?>

  <main id="main" class="main">
  <?php 
        if ($student != 0 && $setting !=0 && $subjects !=0 && $teacher_subjects != 0) {
     ?>
     <div class="d-flex align-items-center flex-column"><br><br>
        <div class="login shadow p-3">
        <form method="post"
              action="">
            <div class="php-email-form">
                <ul class="list-group">
                    <li class="list-group-item"><b>ID: </b> <?php echo $student['student_id'] ?></li>
                  <li class="list-group-item"><b>First Name: </b> <?php echo $student['fname'] ?></li>
                  <li class="list-group-item"><b>Last Name: </b> <?php echo $student['lname'] ?></li>
                  <li class="list-group-item"><b>Garde: </b> 
                    <?php  $g = getGradeById($student['grade'], $conn); 
                        echo $g['grade_code'].'-'.$g['grade'];
                    ?>
                  </li>
                  <li class="list-group-item"><b>Section: </b> 
                    <?php  $s = getSectioById($student['section'], $conn); 
                        echo $s['section'];
                    ?>
                  </li>
                  <li class="list-group-item text-center"><b>Year: </b> <?php echo $setting['current_year']; ?> &nbsp;&nbsp;&nbsp;<b>Semester</b> <?php echo $setting['current_semester']; ?></li>
                </ul>
            </div>
            <br>
            <h5 class="text-center">Add Grade</h5>
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
           
         <label class="form-label">Subject / Course</label>
            <select class="form-control"
                    name="ssubject_id">
                    <?php foreach($subjects as $subject){ 
                        foreach($teacher_subjects as $teacher_subject){
                            if($subject['subject_id'] == $teacher_subject){ ?>
                    
                       <option <?php if($ssubject_id == $subject['subject_id']){echo "selected";} ?> 
                           value="<?php echo $subject['subject_id'] ?>">
                        <?php echo $subject['subject_code'] ?></option>
                    <?php }   }
                        } ?>
            </select><br>

            
            <button type="submit" class="btn btn-primary">Select</button><br><br>
        </form>
        <form method="post"
              action="req/save-score.php">
        <?php 
            
            if ($ssubject_id != 0) { 
              $counter = 0;
              if($student_score != 0){ ?>
                <input type="text" name="student_score_id"
            value="<?=$student_score['id']?>" hidden>
            <?php
            $scores = explode(',', trim($student_score['results']));

            foreach ($scores as $score) { 
                $temp =  explode(' ', trim($score));
                $counter++;
            ?>

            <div class="input-group mb-3">
                  <input type="number" min="0" max="100" class="form-control" value="<?=$temp[0]?>"name="score-<?php echo $counter; ?>">
                  <span class="input-group-text">/</span>
                  <input type="number" min="0" max="100" class="form-control" value="<?=$temp[1]?>"
                  name="aoutof-<?php echo $counter; ?>">
            </div>  
           <?php } } if($counter <  5){ 
               for ($i=++$counter; $i <= 5; $i++) { 
            ?>
            <div class="input-group mb-3">
                  <input type="text" class="form-control" value="xx" 
                  name="score-<?php echo $i; ?>">
                  <span class="input-group-text">/</span>
                  <input type="text" class="form-control" value="xx"
                  name="aoutof-<?php echo $i; ?>">
            </div>
            
                   
           <?php } } ?>

           <input type="text" name="student_id" value="<?=$student_id?>" hidden>
            <input type="text" name="subject_id" value="<?=$ssubject_id?>"hidden>
            <input type="text" name="current_semester" value="<?=$setting['current_semester']?>" hidden>
            <input type="text" name="current_year" value="<?=$setting['current_year']?>" hidden>
        
          <button type="submit" class="btn btn-primary">Save</button>
        </form>  
        <?php } ?> 
        </div>
        </div>
     <?php 
         }else{
            header("Location: students.php");
            exit;
         }
     ?>
        </div>
      </div>
    </div>
  </div>
</section>

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<?php
    include "inc/footer.php";
    ?><!-- End Footer --><!-- End Footer -->

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