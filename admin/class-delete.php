<?php 
session_start();
if (isset($_SESSION['admin_id']) && 
    isset($_SESSION['role'])     &&
    isset($_GET['class_id'])) {

  if ($_SESSION['role'] == 'Admin') {
     include "../DB_connection.php";
     include "data/class.php";

     $id = $_GET['class_id'];
     if (removeClass($id, $conn)) {
     	$sm = "Successfully deleted!";
        header("Location: class1.php?success=$sm");
        exit;
     }else {
        $em = "Unknown error occurred";
        header("Location: class1.php?error=$em");
        exit;
     }


  }else {
    header("Location: class1.php");
    exit;
  } 
}else {
	header("Location: class1.php");
	exit;
} 