<?php
session_start();
if (isset($_SESSION['admin_id']) &&
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
        include "../DB_connection.php";
        include "data/teacher.php";
        include "data/subject.php";
        include "data/grade.php";
        include "data/section.php";
        include "data/class.php";

        if(isset($_GET['teacher_id'])){

            $teacher_id = $_GET['teacher_id'];

            $teacher = getTeacherById($teacher_id,$conn);
            ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - NiceAdmin Bootstrap Template</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Nov 17 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <?php
    include "inc/header.php";
    if ($teacher != 0) {
    ?>
    <!-- End Header -->

    <!-- ======= Sidebar ======= -->
    <?php
    include "inc/sidebar.php";
    ?>
    <!-- End Sidebar-->

    <!-- End Page Title -->
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Teacher Tables</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index1.php">Home</a></li>
                    <li class="breadcrumb-item">Teacher</li>
                    <li class="breadcrumb-item active">Data</li>
                </ol>
            </nav>
        </div>

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                            <img src="../img/teacher-<?=$teacher['gender']?>.png" class="card-img-top" alt="...">
                            <h5 class="card-title text-center">@<?=$teacher['username']?></h5>
                            <div class="social-links mt-2">
                                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-xl-8">

                    <div class="card">
                        <div class="container mt-5">

                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">First name: <?=$teacher['fname']?></li>
                                    <li class="list-group-item">Last name: <?=$teacher['lname']?></li>
                                    <li class="list-group-item">Username: <?=$teacher['username']?></li>

                                    <li class="list-group-item">Employee number: <?=$teacher['employee_number']?></li>
                                    <li class="list-group-item">Address: <?=$teacher['address']?></li>
                                    <li class="list-group-item">Date of birth: <?=$teacher['date_of_birth']?></li>
                                    <li class="list-group-item">Phone number: <?=$teacher['phone_number']?></li>
                                    <li class="list-group-item">Qualification: <?=$teacher['qualification']?></li>
                                    <li class="list-group-item">Email address: <?=$teacher['email_address']?></li>
                                    <li class="list-group-item">Gender: <?=$teacher['gender']?></li>
                                    <li class="list-group-item">Date of joined: <?=$teacher['date_of_joined']?></li>

                                    <li class="list-group-item">Subject:
                                        <?php
                                        $s = '';
                                        $subjects = str_split(trim($teacher['subjects']));
                                        foreach ($subjects as $subject) {
                                            $s_temp = getSubjectById($subject, $conn);
                                            if ($s_temp != 0)
                                                $s .=$s_temp['subject_code'].', ';
                                        }
                                        echo $s;
                                        ?>
                                    </li>
                                    <li class="list-group-item">Class:
                                        <?php
                                        $c = '';
                                        $classes = str_split(trim($teacher['class']));

                                        foreach ($classes as $class_id) {
                                            $class = getClassById($class_id, $conn);

                                            $c_temp = getGradeById($class['grade'], $conn);
                                            $section = getSectioById($class['section'], $conn);
                                            if ($c_temp != 0)
                                                $c .=$c_temp['grade_code'].'-'.
                                                    $c_temp['grade'].$section['section'].', ';
                                        }
                                        echo $c;

                                        ?>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <?php
                        }else {
                            header("Location: teacher.php");
                            exit;
                        }
                        ?>

                                        <div class="text-center">
                                            <a href="teacher1.php"  type="submit" class="btn btn-primary">Go Back</a>
                                        </div>
                                    </form><!-- End settings Form -->

                                </div>

                            </div><!-- End Bordered Tabs -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
    <!-- End #main -->


    <!-- End Table with stripped rows -->
    <!-- ======= Footer ======= -->
    <?php
    include "inc/footer.php";
    ?>
    <!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.min.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>
        <?php

    }else {
        header("Location: teacher.php");
        exit;
    }

}else {
    header("Location: ../login.php");
    exit;
}
}else {
    header("Location: ../login.php");
    exit;
}

    ?>