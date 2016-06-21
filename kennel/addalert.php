<?php

include ('mysql.class.php');
if($_GET['ac'] == 'a'){
        $con = new connect();
       
        //Insert process in the Items table
        $date = $_POST['date'];
        $remarks = $_POST['remarks'];

        $addItemSQL = "insert into alert (DATE,REMARKS,DONE) values ('$date','$remarks','N')";
        $con->query($addItemSQL);
}
else if($_GET['ac'] == 'e'){
     $con = new connect();
       
        //Insert process in the Items table
        $id = $_GET['id'];
        
        $addItemSQL = "update alert set DONE = 'Y' where ID = $id";
        $con->query($addItemSQL);
}
       
        header('Location: alertlist.php'); 
        
    



        
            
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

