<?php
session_start();
if (isset($_SESSION['admin_id']) &&
    isset($_SESSION['role'])     &&
    isset($_GET['class_id'])) {

    if ($_SESSION['role'] == 'Admin') {

        include "../DB_connection.php";
        include "data/class.php";
        include "data/grade.php";
        include "data/section.php";

        $class = getClassById($_GET['class_id'], $conn);
        $grades = getAllGrades($conn);
        $sections = getAllSections($conn);


        if ($class == 0) {
            header("Location: class.php");
            exit;
        }


        ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Edit Class</title>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
            <h1>classes Tables</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">classes</li>
                    <li class="breadcrumb-item active">Data</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">

                <div class="card">


                <!-- General Form Elements -->
                    <div class="container mt-5">

                        <form method="post"
                              action="req/class-edit.php">
                            <h3>Edit Class</h3><hr>
                            <a href="class1.php"
                               class="btn btn-dark">Go Back</a>
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
                                <label class="form-label">Grade</label>
                                <select name="grade"
                                        class="form-control" >
                                    <?php foreach ($grades as $grade) {
                                        $selected = 0;
                                        if ($grade['grade_id'] == $class['grade'] ) {
                                            $selected = 1;
                                        }
                                        ?>

                                        <option  value="<?=$grade['grade_id']?>"
                                            <?php if ($selected) echo "selected"; ?> >
                                            <?=$grade['grade_code'].'-'.$grade['grade']?>
                                        </option>
                                    <?php } ?>

                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Section</label>
                                <select name="section"
                                        class="form-control" >
                                    <?php foreach ($sections as $section) {
                                        $selected = 0;
                                        if ($section['section_id'] == $class['section'] ) {
                                            $selected = 1;
                                        }
                                        ?>
                                        <option value="<?=$section['section_id']?>" <?php if ($selected) echo "selected"; ?> >
                                            <?=$section['section']?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <input type="text"
                                   class="form-control"
                                   value="<?=$class['class_id']?>"
                                   name="class_id"
                                   hidden>

                            <button type="submit"
                                    class="btn btn-primary">
                                Update</button>
                        </form>

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#navLinks li:nth-child(2) a").addClass('active');
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
    header("Location: teacher.php");
    exit;
}
}else {
    header("Location: teacher.php");
    exit;
}

?>