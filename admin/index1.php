<?php
session_start();
include "../DB_connection.php";
if (isset($_SESSION['admin_id']) &&
isset($_SESSION['role'])) {

if ($_SESSION['role'] == 'Admin') {
    include "data/message.php";
    $messages = getAllMessages($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard</title>
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
    if ($messages != 0) {
    ?>
    <!-- End Sidebar-->

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index1.php">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>
        <!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-8">
                    <div class="row">


                        <!-- Student Card -->
                        <div class="col-xxl-4 col-xl-12">

                            <div class="card info-card customers-card">


                                <div class="card-body">
                                    <h5 class="card-title">Students </h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?php
                                                $sql = "SELECT count(student_id) as count FROM students";
                                                $result = $conn->query($sql);
                                                while ($row = $result->fetch()) :
                                                    ?>
                                                    <tr>
                                                        <td><?php echo ucwords($row['count']) ?></td>
                                                    </tr>
                                                <?php endwhile; ?></h6>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                        <!-- End Student Card -->

                        <!-- Teacher Card -->
                        <div class="col-xxl-4 col-xl-12">
                            <div class="card info-card customers-card">

                                <div class="card-body">
                                    <h5 class="card-title">Teacher </h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-people"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?php
                                                $sql = "SELECT count(teacher_id) as count FROM teachers";
                                                $result = $conn->query($sql);
                                                while ($row = $result->fetch()) :
                                                    ?>
                                                    <tr>
                                                        <td><?php echo ucwords($row['count']) ?></td>
                                                    </tr>
                                                <?php endwhile; ?></h6>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>
                        <!-- End Teacher Card -->
                        <!-- Teacher Card -->
                        <div class="col-xxl-4 col-xl-12">
                            <div class="card info-card customers-card">

                                <div class="card-body">
                                    <h5 class="card-title">Subject </h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-book-fill"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?php
                                                $sql = "SELECT count(subject_id) as count FROM subjects";
                                                $result = $conn->query($sql);
                                                while ($row = $result->fetch()) :
                                                    ?>
                                                    <tr>
                                                        <td><?php echo ucwords($row['count']) ?></td>
                                                    </tr>
                                                <?php endwhile; ?></h6>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>
                        <!-- End Teacher Card -->
                        <!-- Teacher Card -->
                        <div class="col-xxl-4 col-xl-12">
                            <div class="card info-card customers-card">

                                <div class="card-body">
                                    <h5 class="card-title">Section </h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-door-open-fill"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?php
                                                $sql = "SELECT count(section_id) as count FROM section";
                                                $result = $conn->query($sql);
                                                while ($row = $result->fetch()) :
                                                    ?>
                                                    <tr>
                                                        <td><?php echo ucwords($row['count']) ?></td>
                                                    </tr>
                                                <?php endwhile; ?></h6>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>
                        <!-- End Teacher Card -->
                        <!-- Teacher Card -->
                        <div class="col-xxl-4 col-xl-12">
                            <div class="card info-card customers-card">

                                <div class="card-body">
                                    <h5 class="card-title">Class </h5>

                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-door-open-fill"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6><?php
                                                $sql = "SELECT count(class_id) as count FROM class";
                                                $result = $conn->query($sql);
                                                while ($row = $result->fetch()) :
                                                    ?>
                                                    <tr>
                                                        <td><?php echo ucwords($row['count']) ?></td>
                                                    </tr>
                                                <?php endwhile; ?></h6>
                                        </div>
                                    </div>


                                </div>
                            </div>

                        </div>
                        <!-- End Teacher Card -->



                        <!-- Top Selling -->
                        <div class="col-12">
                            <div class="card top-selling overflow-auto">


                                <div class="container mt-5" style="width: 90%; max-width: 700px;">
                                    <h4 class="text-center p-3">Message</h4>
                                    <div class="accordion accordion-flush" id="accordionFlushExample_<?=$message['message_id']?>">
                                        <?php foreach ($messages as $message) { ?>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="flush-heading_<?=$message['message_id']?>">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse_<?=$message['message_id']?>" aria-expanded="false" aria-controls="flush-collapse_<?=$message['message_id']?>">
                                                        <i class="bi bi-person"> </i>     <?=$message['sender_full_name']?>

                                                    </button>
                                                </h2>
                                                <div id="flush-collapse_<?=$message['message_id']?>" class="accordion-collapse collapse" aria-labelledby="flush-heading_<?=$message['message_id']?>" data-bs-parent="#accordionFlushExample_<?=$message['message_id']?>">
                                                    <div class="accordion-body">

                                                        <?=$message['message']?>

                                                        <div class="d-flex mb-3">
                                                            <div class="p-2">Email: <b><?=$message['sender_email']?></b></div>
                                                            <div class="ms-auto p-2">Date: <?=$message['date_time']?></div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <?php }else{ ?>
                                        <div class="alert alert-info .w-450 m-5"
                                             role="alert">
                                            Empty!
                                        </div>
                                    <?php } ?>
                                </div>

                            </div>
                        </div>
                        <!-- End Top Selling -->

                    </div>
                </div>
                <!-- End Left side columns -->


            </div>
        </section>

    </main>
    <!-- End #main -->

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