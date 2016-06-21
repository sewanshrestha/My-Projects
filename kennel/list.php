<html>
     <head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="calendar.css" />
<?php
	//include "header.php";
            include ('mysql.class.php');
            include ('header.php');
	?> 
<title>Kennel Info Page</title>

<script type="text/javascript" src="jquery.js"></script>

<script type="text/javascript">
    function messageboard_close(){
			document.getElementById('alert-board').style.display="none";
		}
                function messageboardopen(){
			document.getElementById('alert-board').style.display = "block";
		}
</script>
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
#alert-board{
			background: #CCCCCC;
    		left: 425px;
    		margin: 0 0 0 -250px;
		position: absolute;
    		top: 85;
    		width: 1000px;
		}
</style>

      </head>
<body>
            

            <br>
<a href="addItempage.php">Add</a>  ||  <a href="searchpage.php">Search</a> || <a href="logpage.php">Add Log</a>
 || <a href="multipleedit.php">Multiple Log</a>
|| <a href="vaccination.php">Vaccination Due</a>|| <a href="generallist.php">General List</a>
<div style='float:right; cursor:pointer;' onclick="messageboardopen();">Show alert board</div>
<br>
<table width="100%">
    <tr>
        <th>SN</th>
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
    <?php 
    $con = new connect();
    $selectall = "select * from dogs order by BREED";
    $con->query($selectall);
    $i = 1;
    while ($hn = $con->query_fetch(1)) {
        echo "<tr>";
        echo "<td>".$i++."</td>";
        echo "<td>";
       ?> <a href="viewlog.php?id=<?php echo $hn['ID']; ?>">
        <?php 
        echo $hn['NAME']."</a>";
        echo "</td>";
        echo "<td>";
        echo $hn['BREED'];
        echo "</td>";
        echo "<td>";
        if($hn['DATE_OF_BIRTH'] == '0000-00-00'){
          echo "N/A";
        }
        else{
            echo $hn['DATE_OF_BIRTH']; 
        }
        //echo $hn['DATE_OF_BIRTH'];
        echo "</td>";
        echo "<td>";
        echo $hn['COLOR'];
        echo "</td>";
        echo "<td>";
        echo $hn['WEIGHT'];
        echo "</td>";
        echo "<td>";
        echo $hn['SEX'];
        echo "</td>";
        echo "<td>";
        echo $hn['MICROCHIP'];
        echo "</td>";
        echo "<td>";
        if($hn['DEWORMING_DATE'] == '0000-00-00'){
          echo "N/A";
        }
        else{
            echo $hn['DEWORMING_DATE']; 
        }
        //echo $hn['DEWORMING_DATE'];
        echo "</td><td>";
        if($hn['DHLLP_DATE'] == '0000-00-00'){
          echo "N/A";
        }
        else{
            echo $hn['DHLLP_DATE']; 
        }
        //echo $hn['DHLLP_DATE'];
        echo "</td>";
        echo "<td>";
        if($hn['VACCINE_DATE'] == '0000-00-00'){
          echo "N/A";
        }
        else{
            echo $hn['VACCINE_DATE']; 
        }
        //echo $hn['VACCINE_DATE'];
        echo "</td>";
        echo "<td>";
        if($hn['SPOT_ON_DATE'] == '0000-00-00'){
          echo "N/A";
        }
        else{
            echo $hn['SPOT_ON_DATE']; 
        }
        //echo $hn['SPOT_ON_DATE'];
        echo "</td>";
        echo "<td>";
        if($hn['OTHER'] == '0000-00-00'){
          echo "";
        }
        else{
            echo $hn['OTHER']; 
        }
        //echo $hn['OTHER'];
        echo "</td><td>";
        ?>
        <a href="editpage.php?id=<?php echo $hn['ID']; ?>">Edit</a> |
        <a href="edit.php?pr=d&id=<?php echo $hn['ID']; ?>">Delete</a>
       <?php
        echo "</td></tr>";
           
        }
    
    ?>
</table>
<?php
$sql = "SELECT * FROM dogs
           WHERE datediff( curdate( ) , vaccine_date ) >= 365 or 
                    datediff( curdate( ) , DHLLP_DATE ) >= 365 or
                    datediff( curdate( ) , deworming_date ) >= 90";
$con->query($sql);
if($con->num_rows()>0){
?>

    <div id="alert-board">
            <?php 
                     $con = new connect();
     $sql = "SELECT datediff( curdate( ) , vaccine_date ) diff, name,vaccine_date FROM dogs
               WHERE datediff( curdate( ) , vaccine_date ) >= 365";
     $con->query($sql);
    if($con->num_rows()>0){


        ?>
                <div style="float:left; margin-left: 10px;">
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
               WHERE datediff( curdate( ) , DHLLP_DATE ) >= 365";
     $con->query($sql);
    if($con->num_rows()>0){


        ?>
                <div style="float:left; margin-left: 10px;">
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
               WHERE datediff( curdate( ) , deworming_date ) >= 90";
     $con->query($sql);
    if($con->num_rows() > 0){


        ?>

                <div style="float:left; margin-left: 10px;">
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
    $sql = "SELECT datediff( curdate( ) , spot_on_date ) diff, name,spot_on_date FROM dogs
               WHERE datediff( curdate( ) , spot_on_date ) >= 30";
     $con->query($sql);
    if($con->num_rows() > 0){


        ?>

                <div style="float:left; margin-left: 10px;">
                Spot On Due dates:
                <table><tr>
                        <th>
                            Name
                        </th>
                        <th>
                            Last Spot on Date
                        </th>
                    </tr>
        <?php
        $con->query($sql);
        while ($hn = $con->query_fetch(1)) {
            //$hn['NAME']
            echo "<tr><td>".$hn['name']."</td><td>".$hn['spot_on_date']."</td>";
        }
        
        echo "</table> </div>";
    
   
    }
    
         $sql = "SELECT datediff( curdate( ) , DATE ) diff, REMARKS,DATE FROM alert
               WHERE ((datediff( curdate( ) , date ) >= -2) OR (datediff( curdate( ) , date ) >= 0))
               and DONE='N'";
     $con->query($sql);
    if($con->num_rows() > 0){


        ?>

                <div style="float:left; margin-left: 10px;">
                Alerts:
                <table><tr>
                        <th>
                            Remarks
                        </th>
                        <th>
                            Date
                        </th>
                    </tr>
        <?php
        $con->query($sql);
        while ($hn = $con->query_fetch(1)) {
            //$hn['NAME']
            echo "<tr><td>".$hn['REMARKS']."</td><td>".$hn['DATE']."</td>";
        }
        
        echo "</table> </div>";
    }
    //echo 'self.location="notify.wav"';
    echo '<embed hidden="true" src="dog.wav">';
    echo "<div style='float:right; cursor:pointer;' onclick='messageboard_close();'><b>Hide</b></div>";
                    //echo "<div style='float:right; cursor:pointer;' onclick='messageboard_closeforever();'><b>Don't show this again</b></div></div>";
    echo "</div>";
}
?>
           
</body>
   </html>
