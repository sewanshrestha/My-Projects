<?php

include ('mysql.class.php');
$conn = new connect();

        $con = new connect();
       
        //Insert process in the Items table
        $name = $_POST['name'];
        $type = $_POST['type'];
        $date = $_POST['date'];
        $remarks = $_POST['remarks'];

        $addItemSQL = "insert into log (NAME,DATE,TYPE,REMARKS) values ($name,'$date',$type,'$remarks')";
        $con->query($addItemSQL);
       
        $sqlupdate = "update dogs set ";
        if($type == 1){
            $sqlupdate .= " DHLLP_DATE = '$date'";
        }
        elseif($type == 2){
            $sqlupdate .= " VACCINE_DATE = '$date'";
        }
        elseif($type == 3){
            $sqlupdate .= " OTHER = '$date'";
        }
        elseif($type == 4){
            $sqlupdate .= " DEWORMING_DATE = '$date'";
        }
        elseif($type == 5){
            $sqlupdate .= " SPOT_ON_DATE = '$date'";
        }
        $sqlupdate .= " where ID = $name";
        $con->query($sqlupdate);
        header('Location: list.php'); 
        
    



        
            
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

