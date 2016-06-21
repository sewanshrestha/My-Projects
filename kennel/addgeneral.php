<?php

include ('mysql.class.php');
$conn = new connect();

        $con = new connect();
       
        //Insert process in the Items table
        $date = $_POST['date'];
        $remarks = $_POST['remarks'];

        $addItemSQL = "insert into general (DATE,REMARKS) values ('$date','$remarks')";
        $con->query($addItemSQL);
       
        
        header('Location: generallist.php'); 
        
    



        
            
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

