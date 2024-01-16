<?php
session_start();
if (isset($_SESSION['admin_id']) &&
isset($_SESSION['role'])     &&
isset($_GET['teacher_id'])) {

if ($_SESSION['role'] == 'Admin') {

include "../DB_connection.php";
include "data/subject.php";
include "data/grade.php";
include "data/section.php";
include "data/class.php";
include "data/teacher.php";
$subjects = getAllSubjects($conn);
$classes  = getAllClasses($conn);


$teacher_id = $_GET['teacher_id'];
$teacher = getTeacherById($teacher_id, $conn);

if ($teacher == 0) {
    header("Location: teacher.php");
    exit;
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Edit Teachers Table</title>
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
            <h1>Teacher Tables</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index1.php">Home</a></li>
                    <li class="breadcrumb-item">Teacher</li>
                    <li class="breadcrumb-item active">Data</li>
                </ol>
            </nav>
        </div>
        <section class="section">
            <div class="row">

                <div class="card">


                <!-- General Form Elements -->
                        <form method="post"
                              action="req/teacher-edit.php">
                            <h3>Edit Teacher</h3><hr>
                            <a href="teacher1.php"
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
                                       value="<?=$teacher['fname']?>"
                                       name="fname">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Last name</label>
                                <input type="text"
                                       class="form-control"
                                       value="<?=$teacher['lname']?>"
                                       name="lname">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text"
                                       class="form-control"
                                       value="<?=$teacher['username']?>"
                                       name="username">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">address</label>
                                <input type="text"
                                       class="form-control"
                                       value="<?=$teacher['address']?>"
                                       name="address">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Employee number</label>
                                <input type="text"
                                       class="form-control"
                                       value="<?=$teacher['employee_number']?>"
                                       name="employee_number">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Date of birth</label>
                                <input type="date"
                                       class="form-control"
                                       value="<?=$teacher['date_of_birth']?>"
                                       name="date_of_birth">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Phone number</label>
                                <input type="text"
                                       class="form-control"
                                       value="<?=$teacher['phone_number']?>"
                                       name="phone_number">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Qualification</label>
                                <input type="text"
                                       class="form-control"
                                       value="<?=$teacher['qualification']?>"
                                       name="qualification">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Email address</label>
                                <input type="text"
                                       class="form-control"
                                       value="<?=$teacher['email_address']?>"
                                       name="email_address">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Gender</label><br>
                                <input type="radio"
                                       value="Male"
                                    <?php if($teacher['gender'] == 'Male') echo 'checked';  ?>
                                       name="gender"> Male
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <input type="radio"
                                       value="Female"
                                    <?php if($teacher['gender'] == 'Female') echo 'checked';  ?>
                                       name="gender"> Female
                            </div>
                            <input type="text"
                                   value="<?=$teacher['teacher_id']?>"
                                   name="teacher_id"
                                   hidden>

                            <div class="mb-3">
                                <label class="form-label">Subject</label>
                                <div class="row row-cols-5">
                                    <?php
                                    $subject_ids = str_split(trim($teacher['subjects']));
                                    foreach ($subjects as $subject){
                                        $checked =0;
                                        foreach ($subject_ids as $subject_id ) {
                                            if ($subject_id == $subject['subject_id']) {
                                                $checked =1;
                                            }
                                        }
                                        ?>
                                        <div class="col">
                                            <input type="checkbox"
                                                   name="subjects[]"
                                                <?php if($checked) echo "checked"; ?>
                                                   value="<?=$subject['subject_id']?>"
                                                   class="subject-checkbox">
                                            <?=$subject['subject']?>
                                        </div>
                                    <?php } ?>

                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Class</label>
                                <div class="row row-cols-5">
                                    <?php
                                    $class_ids = str_split(trim($teacher['class']));
                                    foreach ($classes as $class){
                                        $checked =0;
                                        foreach ($class_ids as $class_id ) {
                                            if ($class_id == $class['class_id']) {
                                                $checked =1;
                                            }
                                        }
                                        $grade = getGradeById($class['class_id'], $conn);
                                        ?>
                                        <div class="col">
                                            <input type="checkbox"
                                                   name="classes[]"
                                                <?php if($checked) echo "checked"; ?>
                                                   value="<?=$grade['grade_id']?>">
                                            <?=$grade['grade_code']?>-<?=$grade['grade']?>
                                        </div>
                                    <?php } ?>

                                </div>
                            </div>

                            <button type="submit"
                                    class="btn btn-primary">
                                Update</button>
                        </form>

                        <form method="post"
                              class="shadow p-3 my-5 form-w"
                              action="req/teacher-change.php"
                              id="change_password">
                            <h3>Change Password</h3><hr>
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

                            <div class="mb-3">
                                <div class="mb-3">
                                    <label class="form-label">Admin password</label>
                                    <input type="password"
                                           class="form-control"
                                           name="admin_pass">
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
                            <input type="text"
                                   value="<?=$teacher['teacher_id']?>"
                                   name="teacher_id"
                                   hidden>

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
                        <!-- End General Form Elements -->

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

    <script>
        var maxSubjects = 1;
        var selectedSubjects = 0;

        document.addEventListener('DOMContentLoaded', function () {
            var checkboxes = document.querySelectorAll('.subject-checkbox');

            checkboxes.forEach(function (checkbox) {
                checkbox.addEventListener('change', function () {
                    if (this.checked) {
                        if (selectedSubjects < maxSubjects) {
                            selectedSubjects++;
                        } else {
                            this.checked = false;
                        }
                    } else {
                        selectedSubjects--;
                    }
                });
            });
        });
    </script>
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