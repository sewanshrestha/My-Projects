

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
            $logid = $_GET['id'];
            $con = new connect();
            $getlog = "SELECT d.ID DOGID,d.NAME DNAME,l.TYPE LTYPE, l.DATE DATE,l.REMARKS REMARKS FROM log l,dogs d where l.NAME=d.id and l.id = $logid";
            $con->query($getlog);
            while($hn = $con->query_fetch(1)){
                $dogname = $hn['DNAME'];
                $dogid = $hn['DOGID'];
                $logtype = $hn['LTYPE'];
                $date = $hn['DATE'];
                $remarks = $hn['REMARKS'];
            }
	?> 

            <br>
<a HREF="javascript:history.go(-1)">Go Back</a>

<form action="editLoginfo.php" method="GET" name="logedit" id="logedit">

<table>
    <tr>
        <td>Name</td><td>
            <input type="text" name="name" value="<?php echo $dogname; ?>" readonly>
        </td>
    </tr>
<tr>
    <td>Type</td><td>
        <select name="type">
            <option value="4" <?php if($logtype == 4) echo "selected"; ?>>Deworming</option>
            <option value="1" <?php if($logtype == 1) echo "selected"; ?>>DHLLP Vaccine</option>
            <option value="2" <?php if($logtype == 2) echo "selected"; ?>>Rabies Vaccine</option>
            <option value="5" <?php if($logtype == 5) echo "selected"; ?>>Spot On</option>
            <option value="3" <?php if($logtype == 3) echo "selected"; ?>>Other </option>

        </select>
    </td>
</tr><tr>
        <td>Date</td><td><input type="text" readonly="readonly" name="date"
                                        onclick="displayCalendar(date,'yyyy-mm-dd',this);" value="<?php 
                                        if($date == '0000-00-00'){
                                            echo "";
                                        }
                                        else{
                                            echo $date; 
                                        } ?>"/></td>
    </tr>
    <tr>
        <td>Remarks</td><td><textarea name="remarks"><?php echo $remarks; ?></textarea></td>
    </tr>
	
</table>
    <input type="hidden" name="dogid" value="<?php echo $dogid; ?>"/>
    <input type="hidden" name="id" value="<?php echo $logid; ?>"/>
    <input type="hidden" name="logtype" value="edit"/>

    <input type="submit" value="Edit"/>
</form>
</body>
<!--    </html>-->
<?php
//}
?>


