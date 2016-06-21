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
	//include "header.php";
            include ('header.php');
	?> 

            <br>
<a HREF="javascript:history.go(-1)">Go Back</a>

<form action="addItem.php" method="POST" name="itemadd" id="itemadd" enctype="multipart/form-data">

<table>
    <tr>
        <td>Name</td><td><input type="text" name="name" id="name"/></td>
    </tr>
    <tr>
        <td>Breed</td><td><input type="text" name="breed" id="breed"/></td>
    </tr>
     <tr>
        <td>D.O.B</td><td><input type="text" readonly="readonly" name="birth"
                                        onclick="displayCalendar(birth,'yyyy-mm-dd',this);" /></td>
    </tr>
    <tr>
        <td>Color</td><td><input type="text" name="color" id="color"/></td>
    </tr>
    
<tr>
        <td>Weight (KG)</td><td><input type="text" name="weight" id="weight"/></td>
</tr>
<tr>
        <td>Sex</td><td><select name="sex">
                <option value="M">Male</option>
                 <option value="F">Female</option>
            </select></td>
</tr>
<tr>
        <td>Microchip</td><td><input type="text" name="microchip" id="microchip"/></td>
</tr>
<tr>
        <td>Deworming Date</td><td><input type="text" readonly="readonly"name="deworm"
                                        onclick="displayCalendar(deworm,'yyyy-mm-dd',this);" /></td>
</tr>
<tr>
        <td>DHLLP Vaccine Date</td><td><input type="text" readonly="readonly"name="brought"
                                        onclick="displayCalendar(brought,'yyyy-mm-dd',this);" /></td>
</tr><tr>
        <td>Rabies Vaccine Date</td><td><input type="text" readonly="readonly"name="vaccine"
                                        onclick="displayCalendar(vaccine,'yyyy-mm-dd',this);" /></td>
    </tr>
    <tr>
        <td>Spot On Date</td><td><input type="text" readonly="readonly"name="spoton"
                                        onclick="displayCalendar(spoton,'yyyy-mm-dd',this);" /></td>
    </tr>
    <tr>
        <td>Other Date</td><td><input type="text" readonly="readonly"name="other"
                                        onclick="displayCalendar(other,'yyyy-mm-dd',this);" /></td>
    </tr>
<tr>
                    <td> Photo: </td>
                    <td> <input type="file" name="uploadFile" id="uploadFile"></td>

                                                
                </tr>	
</table>
    <input type="hidden" name="pr" value="a"/>
    <input type="hidden" name="MAX_FILE_SIZE" value="4000000000">
    <input type="submit" value="Add"/>
</form>

</body>
<!--    </html>-->
<?php
//}
?>
