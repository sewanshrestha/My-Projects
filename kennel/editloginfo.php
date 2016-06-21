<?php
include ('mysql.class.php');
$conn = new connect();
$typeaction = $_GET['logtype'];
if($typeaction == 'edit'){
    
        //Insert process in the Items table
        $id = $_GET['id'];
        $type = $_GET['type'];
        $date = $_GET['date'];
        $remarks = $_GET['remarks'];
        $dogid = $_GET['dogid'];
        $updateItemSQL = "update log set DATE = '$date',TYPE = $type,REMARKS = '$remarks' where ID = $id";
        $conn->query($updateItemSQL);
        $updatedogtable = "update dogs set ";
        
        if($type == 1){
            $sql = "select DHLLP_DATE from dogs where ID = $dogid";
            $conn->query($sql);
            while($hn = $conn->query_fetch(1)){
                $datechk = $hn['DHLLP_DATE'];
            }
            $updatedogtable .= "DHLLP_DATE = ";
        }
        elseif($type == 2){
             $sql = "select VACCINE_DATE from dogs where ID = $dogid";
              while($hn = $conn->query_fetch(1)){
                $datechk = $hn['VACCINE_DATE'];
            }
            $updatedogtable .= "VACCINE_DATE = ";
        }
        elseif($type == 3){
             $sql = "select OTHER from dogs where ID = $dogid";
             while($hn = $conn->query_fetch(1)){
                $datechk = $hn['OTHER'];
            }
            $updatedogtable .= "OTHER = ";
        } 
        elseif($type == 4){
             $sql = "select DEWORMING_DATE from dogs where ID = $dogid";
             while($hn = $conn->query_fetch(1)){
                $datechk = $hn['DEWORMING_DATE'];
            }
            $updatedogtable .= "DEWORMING_DATE = ";
        } 
        elseif($type == 5){
             $sql = "select SPOT_ON_DATE from dogs where ID = $dogid";
             while($hn = $conn->query_fetch(1)){
                $datechk = $hn['SPOT_ON_DATE'];
            }
            $updatedogtable .= "SPOT_ON_DATE = ";
        }
        $updatedogtable .= "'$date' WHERE ID = $dogid";
        $conn->query($updatedogtable);
        
       header('Location: viewlog.php?id='.$dogid);
}
else if ($typeaction == 'del'){
        $id = $_GET['id'];
        $dogid = $_GET['dogid'];
        $updateItemSQL = "delete from log where ID = $id";
        $conn->query($updateItemSQL);
        header('Location: viewlog.php?id='.$dogid);

}
?>
