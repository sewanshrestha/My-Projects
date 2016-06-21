<!--    <html>-->
<!--        <head>-->
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
    		top: 75;
    		width: 1000px;
		}
</style>

<!--        </head>-->
<body>
            

            <br>
<a href="addalertpage.php">Add Alert</a>  ||  <a href="generallist.php">General List</a>
<br>
<table width="100%">
    <tr>
        <th>SN</th>
        <th>Date</th>
        <th>Remarks</th>
        
    </tr>
    <?php 
    $con = new connect();
    $selectall = "select * from alert order by DATE desc";
    $con->query($selectall);
    $i = 1;
    while ($hn = $con->query_fetch(1)) {
        echo "<tr>";
        echo "<td>".$i++."</td>";
        
        echo "<td>";
        if($hn['DATE'] == '0000-00-00'){
          echo "N/A";
        }
        else{
            echo $hn['DATE']; 
        }
        //echo $hn['DATE_OF_BIRTH'];
        echo "</td>";
        echo "<td>";
        echo $hn['REMARKS'];
        echo "</td><td>";
       
        if($hn['DONE'] == 'N'){ ?>
        <a href="addalert.php?ac=e&id=<?php echo $hn['ID']; ?>">Done</a>
        <?php
        }echo "</td></tr>";
           
        }
    
    ?>
</table>

           
</body>
   </html>
