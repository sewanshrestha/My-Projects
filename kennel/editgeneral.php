<?php
include ('mysql.class.php');
$conn = new connect();

$process = $_GET['pr'];
$id = $_POST['id'];

if($process == 'e'){
    $con = new connect();
       
        //Insert process in the Items table
        $remarks = $_POST['remarks'];
        $date = $_POST['date'];
        
        
        $id = $_POST['id'];
        
        $addItemSQL = "update general "
                .     "set REMARKS = '$remarks', "
                .         "DATE = '$date'"
                . "where ID = $id";
        $con->query($addItemSQL); 
         header('Location: generallist.php');  
}
else if($process == 'd'){
   $delete = "DELETE from general where ID =". $_GET['id'];
    $conn->query($delete);
     
 header('Location: generallist.php');  
}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
