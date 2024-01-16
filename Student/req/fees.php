<?php 
    if (isset($_POST['current_year']) &&
    isset($_POST['current_semester']) &&
    isset($_POST['payment_code'])) {
    
    include '../../DB_connection.php';
    include "../data/student.php";

    $current_year = $_POST['current_year'];
    $current_semester = $_POST['current_semester'];
    $payment_code = $_POST['payment_code'];
    $std_id = $_POST['std_id'];


    $data = 'current_year='.$current_year.'&current_semester='.$current_semester.'&payment_code='.$payment_code.'&std_id='.$std_id;

        $sql  = "INSERT INTO
                 fees(current_year, current_semester, payment_code,std_id)
                 VALUES(?,?,?,?)" ;
        $stmt = $conn->prepare($sql);
        $stmt->execute([$current_year, $current_semester, $payment_code,$std_id]);
        $sm = "Thank you!";
        header("Location: ../fees.php?success=$sm");
        exit;
    
  }else {
  	$em = "An error occurred";
    header("Location: ../fees.php?error=$em");
    exit;
  }

 
