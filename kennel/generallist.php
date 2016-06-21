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
      <a HREF="list.php">Main List</a>      

            <br>
<a href="addgeneralpage.php">Add</a>  || 
<a href="alertlist.php">Alert List</a> 
<table width="100%">
    <tr>
        <th>SN</th>
        <th>Remarks</th>
        <th>Date</th>
        
    </tr>
    <?php 
    $con = new connect();
    $selectall = "select * from general order by DATE";
    $con->query($selectall);
    $i = 1;
    while ($hn = $con->query_fetch(1)) {
        echo "<tr>";
        echo "<td>".$i++."</td>";
        echo "<td>";
        echo $hn['REMARKS']."</a>";
        echo "</td>";
        echo "<td>";
        echo $hn['DATE'];
        echo "</td>";
        echo "<td>";
        ?>
        <a href="editgeneralpage.php?id=<?php echo $hn['ID']; ?>">Edit</a> |
        <a href="editgeneral.php?pr=d&id=<?php echo $hn['ID']; ?>">Delete</a>
       <?php
        echo "</td></tr>";
           
        }
    
    ?>
</table>
           
</body>
   </html>
