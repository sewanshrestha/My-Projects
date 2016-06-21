<?php
    include ('mysql.class.php');
    $type = $_POST['type'];
    $date = $_POST['date'];
    $remarks = $_POST['remarks'];
foreach ($_POST['names'] as $name){
    $conn = new connect();

        $con = new connect();
       
        //Insert process in the Items table
       
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
   
}

        header('Location: list.php'); 
        
    
