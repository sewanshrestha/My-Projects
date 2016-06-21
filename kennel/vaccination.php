<!--    <html>-->
<!--        <head>-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="calendar.css" />

<title>Kennel Info Page</title>

<script type="text/javascript" src="jquery.js"></script>

<style type="text/css">
body {
	background-color: white;
}
table {
    border-collapse: collapse;
}
table, td
{
    border: 1px solid black;
}
th{
    border: 2px solid black;
}
</style>
<!--        </head>-->
<body>
            <?php
	//include "header.php";
            include ('mysql.class.php');
            include ('header.php');
	?> 
    <br>
<a HREF="javascript:history.go(-1)">Go Back</a>
            <br>

<?php
 $con = new connect();
 $sql = "SELECT datediff( curdate( ) , vaccine_date ) diff, name,vaccine_date FROM dogs
           WHERE datediff( curdate( ) , vaccine_date ) >= 365
            OR vaccine_date IS NULL";
if($con->query($sql) != null){
    
    
    ?>
            <div style="float:left;">
            Rabies Vaccination Due dates:
            <table><tr>
                    <th>
                        Name
                    </th>
                    <th>
                        Last Vaccine Date
                    </th>
                </tr>
    <?php
    $con->query($sql);
    while ($hn = $con->query_fetch(1)) {
        //$hn['NAME']
        echo "<tr><td>".$hn['name']."</td><td>".$hn['vaccine_date']."</td>";
    }
    echo "</table> </div>";
}   

 $con = new connect();
 $sql = "SELECT datediff( curdate( ) , DHLLP_DATE ) diff, name,DHLLP_DATE FROM dogs
           WHERE datediff( curdate( ) , DHLLP_DATE ) >= 365
            OR DHLLP_DATE IS NULL";
if($con->query($sql) != null){
    
    
    ?>
            <div style="float:left; margin-left: 100px;">
            DHLLP Vaccination Due dates:
            <table><tr>
                    <th>
                        Name
                    </th>
                    <th>
                        Last Vaccine Date
                    </th>
                </tr>
    <?php
    $con->query($sql);
    while ($hn = $con->query_fetch(1)) {
        //$hn['NAME']
        echo "<tr><td>".$hn['name']."</td><td>".$hn['DHLLP_DATE']."</td>";
    }
    echo "</table> </div>";
}   
 $sql = "SELECT datediff( curdate( ) , deworming_date ) diff, name,deworming_date FROM dogs
           WHERE datediff( curdate( ) , deworming_date ) >= 90
            OR deworming_date IS NULL";
if($con->query($sql) != null){
    
    
    ?>
               
            <div style="float:left; margin-left: 170px;">
            Deworming Due dates:
            <table><tr>
                    <th>
                        Name
                    </th>
                    <th>
                        Last Deworming Date
                    </th>
                </tr>
    <?php
    $con->query($sql);
    while ($hn = $con->query_fetch(1)) {
        //$hn['NAME']
        echo "<tr><td>".$hn['name']."</td><td>".$hn['deworming_date']."</td>";
    }
    echo "</table> </div>";
}  