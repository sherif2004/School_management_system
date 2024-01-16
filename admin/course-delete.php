<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])     &&
    isset($_GET['course_id'])) {

  if ($_SESSION['role'] == 'Admin') {
     include "../DB_connection.php";
     include "data/subject.php";

     $id = $_GET['course_id'];
     if (removeCourse($id, $conn)) {
     	$sm = "Successfully deleted!";
        header("Location: course1.php?success=$sm");
        exit;
     }else {
        $em = "Unknown error occurred";
        header("Location: course1.php?error=$em");
        exit;
     }


  }else {
    header("Location: course1.php");
    exit;
  } 
}else {
	header("Location: course1.php");
	exit;
} 