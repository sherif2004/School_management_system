<?php
session_start();
if (isset($_SESSION['admin_id']) &&
isset($_SESSION['role'])) {

if ($_SESSION['role'] == 'Admin') {
include "../DB_connection.php";
include "data/teacher.php";
include "data/subject.php";
include "data/grade.php";
include "data/class.php";
include "data/section.php";
$teachers = getAllTeachers($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Teachers Table</title>
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
        <!-- End Page Title -->
        <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger mt-3 n-table"
                 role="alert">
                <?=$_GET['error']?>
            </div>
        <?php } ?>

        <?php if (isset($_GET['success'])) { ?>
            <div class="alert alert-info mt-3 n-table"
                 role="alert">
                <?=$_GET['success']?>
            </div>
        <?php } ?>
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Teachers Tables: </h5>

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <a href="teacher-add1.php"
                                   class="btn btn-dark">Add New Teacher</a>
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">ID</th>
                                        <th scope="col">First Name</th>
                                        <th scope="col">Last Name</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Class</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if ($teachers != 0) {
                                $i = 0; foreach ($teachers as $teacher ) {
                                    $i++;  ?>
                                    <tr>
                                        <th scope="row"><?=$i?></th>
                                        <td><?=$teacher['teacher_id']?></td>
                                        <td><a href="teacher-view1.php?teacher_id=<?=$teacher['teacher_id']?>">
                                                <?=$teacher['fname']?></a></td>
                                        <td><?=$teacher['lname']?></td>
                                        <td><?=$teacher['username']?></td>
                                        <td>
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
                                        </td>
                                        <td>
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
                                        </td>
                                        <td>
                                            <a href="teacher-edit1.php?teacher_id=<?=$teacher['teacher_id']?>"
                                               class="btn btn-warning">Edit</a>
                                            <a href="teacher-delete.php?teacher_id=<?=$teacher['teacher_id']?>"
                                               class="btn btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                <?php }} ?>
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>
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

</html><?php

}else {
    header("Location: ../login.php");
    exit;
}
}else {
    header("Location: ../login.php");
    exit;
}

?>