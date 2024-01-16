<?php
session_start();
if (isset($_SESSION['admin_id']) &&
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {

        include "../DB_connection.php";
        include "data/grade.php";
        include "data/section.php";
        $grades = getAllGrades($conn);
        $sections = getAllSections($conn);


        $fname = '';
        $lname = '';
        $uname = '';
        $address = '';
        $email = '';
        $pfn = '';
        $pln = '';
        $ppn = '';


        if (isset($_GET['fname'])) $fname = $_GET['fname'];
        if (isset($_GET['lname'])) $lname = $_GET['lname'];
        if (isset($_GET['uname'])) $uname = $_GET['uname'];
        if (isset($_GET['address'])) $address = $_GET['address'];
        if (isset($_GET['email'])) $email = $_GET['email'];
        if (isset($_GET['pfn'])) $pfn = $_GET['pfn'];
        if (isset($_GET['pln'])) $pln = $_GET['pln'];
        if (isset($_GET['ppn'])) $ppn = $_GET['ppn'];
        ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Add Student Table
    </title>
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
            <h1>Students Tables</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index1.php">Home</a></li>
                    <li class="breadcrumb-item">Students</li>
                    <li class="breadcrumb-item active">Data</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">

                    <div class="card">

                            <!-- General Form Elements -->

                            <form method="post"
                                  action="req/student-add.php">
                                <h3>Add New Student</h3><hr>
                                <a href="student1.php"
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
                                    <label class="form-label">First name</label>
                                    <input type="text"
                                           class="form-control"
                                           value="<?=$fname?>"
                                           name="fname">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Last name</label>
                                    <input type="text"
                                           class="form-control"
                                           value="<?=$lname?>"
                                           name="lname">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Address</label>
                                    <input type="text"
                                           class="form-control"
                                           value="<?=$address?>"
                                           name="address">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email address</label>
                                    <input type="text"
                                           class="form-control"
                                           value="<?=$email?>"
                                           name="email_address">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Date of birth</label>
                                    <input type="date"
                                           class="form-control"
                                           name="date_of_birth">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Gender</label><br>
                                    <input type="radio"
                                           value="Male"
                                           checked
                                           name="gender"> Male
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio"
                                           value="Female"
                                           name="gender"> Female
                                </div><br><hr>
                                <div class="mb-3">
                                    <label class="form-label">Username</label>
                                    <input type="text"
                                           class="form-control"
                                           value="<?=$uname?>"
                                           name="username">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Password</label>
                                    <div class="input-group mb-3">
                                        <input type="text"
                                               class="form-control"
                                               name="pass"
                                               id="passInput">
                                        <button class="btn btn-secondary"
                                                id="gBtn">
                                            Random</button>
                                    </div>

                                </div><br><hr>
                                <div class="mb-3">
                                    <label class="form-label">Parent first name</label>
                                    <input type="text"
                                           class="form-control"
                                           value="<?=$pfn?>"
                                           name="parent_fname">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Parent last name</label>
                                    <input type="text"
                                           class="form-control"
                                           value="<?=$pln?>"
                                           name="parent_lname">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Parent phone number</label>
                                    <input type="text"
                                           class="form-control"
                                           value="<?=$ppn?>"
                                           name="parent_phone_number">
                                </div><br><hr>
                                <div class="mb-3">
                                    <label class="form-label">Grade</label>
                                    <div class="row row-cols-5">
                                        <?php foreach ($grades as $grade): ?>
                                            <div class="col">
                                                <input type="radio"
                                                       name="grade"
                                                       value="<?=$grade['grade_id']?>">
                                                <?=$grade['grade_code']?>-<?=$grade['grade']?>
                                            </div>
                                        <?php endforeach ?>

                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Section</label>
                                    <div class="row row-cols-5">
                                        <?php foreach ($sections as $section): ?>
                                            <div class="col">
                                                <input type="radio"
                                                       name="section"
                                                       value="<?=$section['section_id']?>">
                                                <?=$section['section']?>
                                            </div>
                                        <?php endforeach ?>

                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Register</button>
                            </form>
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
            passInput.value = result;
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