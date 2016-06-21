

<!--    <html>-->
<!--        <head>-->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link rel="stylesheet" type="text/css" href="calendar.css" />
<link
	href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css"
	rel="stylesheet" type="text/css" />
<title>Kennel Info Page</title>
<script
	src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<script
	src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
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
	//include "header.php";
            include ('header.php');
            include ('mysql.class.php');
            $con = new connect();
            $getdogs = "SELECT * FROM dogs";
            $con->query($getdogs);
	?> 

            <br>
<a HREF="javascript:history.go(-1)">Go Back</a>
<br>
<a href="addItempage.php">Add</a>  || 
<a href="vaccination.php">Vaccination Due</a>|| <a href="generallist.php">General List</a>
<div style='float:right; cursor:pointer;' onclick="messageboardopen();">Show alert board</div>
<form action="addLog.php" method="POST" name="logadd" id="logadd">

<table>
    <tr>
        <td>Name</td><td>
            <select name="name">
            <?php while ($hn = $con->query_fetch(1)) {
                echo "<option value=".$hn['ID'].">".$hn['NAME']."</option>";
            }
?>
            </select></td>
    </tr>
<tr>
    <td>Type</td><td>
        <select name="type">
            <option value="4">Deworming</option>
            <option value="1">DHLLP Vaccine</option>
            <option value="2">Rabies Vaccine</option>
            <option value="5">Spot On </option>
            <option value="3">Other </option>

        </select>
    </td>
</tr><tr>
        <td>Date</td><td><input type="text" readonly="readonly"name="date"
                                        onclick="displayCalendar(date,'yyyy-mm-dd',this);" /></td>
    </tr>
    <tr>
        <td>Remarks</td><td><textarea name="remarks"></textarea></td>
    </tr>
	
</table>
    
    <input type="submit" value="Add"/>
</form>
</body>
<!--    </html>-->
<?php
//}
?>


