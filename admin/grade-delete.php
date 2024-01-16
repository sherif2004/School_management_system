<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])     &&
    isset($_GET['grade_id'])) {

  if ($_SESSION['role'] == 'Admin') {
     include "../DB_connection.php";
     include "data/grade.php";

     $id = $_GET['grade_id'];
     if (removeGrade($id, $conn)) {
     	$sm = "Successfully deleted!";
        header("Location: grade1.php?success=$sm");
        exit;
     }else {
        $em = "Unknown error occurred";
        header("Location: grade1.php?error=$em");
        exit;
     }


  }else {
    header("Location: grade1.php");
    exit;
  } 
}else {
	header("Location: grade1.php");
	exit;
} 