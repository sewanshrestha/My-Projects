   <html>-->
      <head>-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="calendar.css" />

<title>Kennel Info Page</title>

<script type="text/javascript" src="jquery.js"></script>

<script src='calendar.js' type="text/javascript"></script>

<style type="text/css">
body {
	background-color: white;
}
table {
    border-collapse: collapse;
}
table, td{
    border: 1px solid black;
}
th{
    border: 2px solid black;
}
</style>
<!--        </head>-->
<body>
            <?php 
    include ('header.php');
	?> 

            <br>
<a HREF="javascript:history.go(-1)">Go Back</a>
<br>
<a href="logpage.php">Add Log</a>
<?php 
    include ('mysql.class.php');
    $conn = new connect();
    $id = $_GET['id'];
    
    $getquery = "SELECT * FROM dogs where ID =".$id;
    $conn->query($getquery);
    while ($hn = $conn->query_fetch(1)) {
            $name = $hn['NAME'];
            $breed = $hn['BREED'];
            $dob = $hn['DATE_OF_BIRTH'];
            $deworm = $hn['DEWORMING_DATE'];
            $spoton = $hn['SPOT_ON_DATE'];
            $weight = $hn['WEIGHT'];
            $bdate = $hn['DHLLP_DATE'];
            $vdate = $hn['VACCINE_DATE'];
            $other = $hn['OTHER'];
            $color = $hn['COLOR'];
            $sex = $hn['SEX'];
            $microchip = $hn['MICROCHIP'];
    }

?>
<table width="100%">
    <tr>
        <th>Name</th>
        <th>Breed</th>
        <th>D.O.B</th>
        <th>Color</th>
        <th>Weight (KG)</th>
        <th>Sex </th>
        <th>Microchip </th>
        <th>Deworming Date</th>
        <th>DHLLP Vaccine Date</th>
        <th>Rabies Vaccine Date</th> 
        <th>Spot On Date</th> 
        <th>Other Date</th>
    </tr>
    <?php echo "<tr>";
        echo "<td> $name";
        echo "</td>";
        echo "<td>";
        echo $breed;
        echo "</td>";
        echo "<td>";
        if($dob == '0000-00-00'){
          echo "N/A";
        }
        else{
            echo $dob; 
        }
        //echo $hn['DATE_OF_BIRTH'];
        echo "</td>";
        echo "<td>";
        echo $color;
        echo "</td>";
        echo "<td>";
        echo $weight;
        echo "</td>";
        echo "<td>";
        echo $sex;
        echo "</td>";
        echo "<td>";
        echo $microchip;
        echo "</td>";
        echo "<td>";
        if($deworm == '0000-00-00'){
          echo "N/A";
        }
        else{
            echo $deworm; 
        }
        //echo $hn['DEWORMING_DATE'];
        echo "</td><td>";
        if($bdate == '0000-00-00'){
          echo "N/A";
        }
        else{
            echo $bdate; 
        }
        //echo $hn['DHLLP_DATE'];
        echo "</td>";
        echo "<td>";
        if($vdate == '0000-00-00'){
          echo "N/A";
        }
        else{
            echo $vdate; 
        }
        //echo $hn['VACCINE_DATE'];
        echo "</td>";
        echo "<td>";
        if($spoton == '0000-00-00'){
          echo "N/A";
        }
        else{
            echo $spoton; 
        }
        //echo $hn['SPOT_ON_DATE'];
        echo "</td>";
        echo "<td>";
        if($other == '0000-00-00'){
          echo "";
        }
        else{
            echo $other; 
        }
        //echo $hn['OTHER'];
        echo "</td><td>";
        ?>
        <a href="editpage.php?id=<?php echo $id; ?>">Edit</a> |
        <a href="edit.php?pr=d&id=<?php echo $id; ?>">Delete</a>
       <?php
        echo "</td></tr>"; ?>
</table>
<br>Log Report for <?php echo $name; ?> <br>

<table align="left" style="margin-bottom:50px;">
    <tr>
        <th>Type</th><th>Date</th><th>Remarks</th><th></th>
    </tr>
<?php 
$getquery = "SELECT * FROM log where NAME =".$id. " order by DATE desc ";
    $conn->query($getquery);
    while ($hn = $conn->query_fetch(1)) {
        echo "<tr><td>";
         
        if($hn['TYPE'] == 1){
            echo "DHLLP Vaccine";
        }
        elseif($hn['TYPE'] == 2){
            echo "Rabies Vaccine";
        }
        elseif($hn['TYPE'] == 3){
            echo "Other";
        }
        elseif($hn['TYPE'] == 4){
            echo "Deworming";
        }
        elseif($hn['TYPE'] == 5){
            echo "Spot On";
        }
        echo "</td>";
        echo "<td>".$hn['DATE']."</td>";
        echo "<td>".$hn['REMARKS']."</td>";
        echo "<td><a href='editlog.php?id=".$hn['ID']."'>Edit</a>";
        echo "&nbsp;&nbsp;<a href='editloginfo.php?logtype=del&id=".$hn['ID']."&dogid=".$id."'>Delete</a></td>";

        echo "</tr>";
    }


?>
</table>

 <table align="left" style="margin-left:50px;"> 
     <tr><th>Weight</th><th>Date</th></tr>
     <?php 
        $sql = "SELECT * FROM weight_log WHERE DOG_ID = $id";
        $conn->query($sql);
        while($h = $conn->query_fetch()){
            echo "<tr><td>".$h['WEIGHT']."</td><td>".$h['DATE']."</td></tr>";
        }
     
     ?>
 </table>

 <table align="left" style="margin-left:50px;"> 
     <tr><td>
 <img src="/kennel/showpic.php?id=<?php echo $id;?>" width="200px" height="200px"/></td></tr>
 </table>
</body>
<!--    </html>-->
<?php
//}
?>
