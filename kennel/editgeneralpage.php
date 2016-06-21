<!--    <html>-->
<!--        <head>-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="calendar.css" />

<title>Kennel Info Page</title>

<script type="text/javascript" src="jquery.js"></script>

<script src='calendar.js' type="text/javascript"></script>

<style type="text/css">
body {
	background-color: white;
}
</style>
<!--        </head>-->
<body>
            <?php
	
    include ('mysql.class.php');
    include ('header.php');
	?> 

            <br>
<a HREF="javascript:history.go(-1)">Go Back</a>
<?php 
    
    $conn = new connect();
    $id = $_GET['id'];
    
    $getquery = "SELECT * FROM general where ID =".$id;
    $conn->query($getquery);
    while ($hn = $conn->query_fetch(1)) {
            $date = $hn['DATE'];
            $remarks = $hn['REMARKS'];
            
    }

?>
<form action="editgeneral.php?pr=e" method="POST" name="itemadd" id="itemadd"  enctype="multipart/form-data">
    <input type="hidden" value="<?php echo $_GET['id']; ?>" id="id" name="id"/>
<table>
    <tr>
        <td>Date</td><td><input type="text" readonly="readonly" name="date"
                                        onclick="displayCalendar(date,'yyyy-mm-dd',this);" value="<?php echo $date; ?>"/></td>
    </tr>
    <tr>
        <td>Remarks</td><td><textarea name="remarks"><?php echo $remarks; ?></textarea></td>
    </tr>

</table>
    
    <input type="submit" value="Edit"/>
</form>

</body>
<!--    </html>-->
<?php
//}
?>
