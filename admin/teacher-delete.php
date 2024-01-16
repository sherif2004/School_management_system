<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])     &&
    isset($_GET['teacher_id'])) {

  if ($_SESSION['role'] == 'Admin') {
     include "../DB_connection.php";
     include "data/teacher.php";

     $id = $_GET['teacher_id'];
     if (removeTeacher($id, $conn)) {
     	$sm = "Successfully deleted!";
        header("Location: teacher1.php?success=$sm");
        exit;
     }else {
        $em = "Unknown error occurred";
        header("Location: teacher1.php?error=$em");
        exit;
     }


  }else {
    header("Location: teacher1.php");
    exit;
  } 
}else {
	header("Location: teacher1.php");
	exit;
} 