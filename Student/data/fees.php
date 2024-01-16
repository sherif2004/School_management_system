<?php  

function getWhoPayed($conn){
    $student_id = $_SESSION['student_id'];
   $sql = "SELECT * FROM fees WHERE std_id = $student_id";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   if ($stmt->rowCount() >= 1) {
     $fees = $stmt->fetchAll();
     return $fees;
   }else {
    return 0;
   }
}

