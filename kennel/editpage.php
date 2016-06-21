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
    
    $getquery = "SELECT * FROM dogs where ID =".$id;
    $conn->query($getquery);
    while ($hn = $conn->query_fetch(1)) {
            $name = $hn['NAME'];
            $breed = $hn['BREED'];
            $deworm = $hn['DEWORMING_DATE'];
            $weight = $hn['WEIGHT'];
            $dob = $hn['DATE_OF_BIRTH'];
            $sex = $hn['SEX'];
            $microchip = $hn['MICROCHIP'];
            $bdate = $hn['DHLLP_DATE'];
            $vdate = $hn['VACCINE_DATE'];
            $other = $hn['OTHER'];
            $spotondate = $hn['SPOT_ON_DATE'];
            $color = $hn['COLOR'];
    }

?>
<form action="edit.php?pr=e" method="POST" name="itemadd" id="itemadd"  enctype="multipart/form-data">
    <input type="hidden" value="<?php echo $_GET['id']; ?>" id="id" name="id"/>
<table align="left">
    <tr>
        <td>Name</td><td><input type="text" name="name" id="name" value="<?php echo $name; ?>"/></td>
    </tr>
    <tr>
        <td>Breed</td><td><input type="text" name="breed" id="breed" value="<?php echo $breed; ?>"/></td>
    </tr>
    <tr>
        <td>D.O.B</td><td><input type="text" readonly="readonly" name="birth"
                                        onclick="displayCalendar(birth,'yyyy-mm-dd',this);" value="<?php 
                                        if($dob == '0000-00-00'){
                                            echo "";
                                        }
                                        else{
                                            echo $dob; 
                                        }?>"/></td>
    </tr>
    <tr>
        <td>Color</td><td><input type="text" name="color" id="color" value="<?php echo $color; ?>"/></td>
    </tr>
    
<tr>
        <td>Weight (KG)</td><td><input type="text" name="weight" id="weight" value="<?php echo $weight; ?>"/>
        As of: <input type="text" readonly="readonly" name="weightdate"
                                        onclick="displayCalendar(weightdate,'yyyy-mm-dd',this);"/></td>
</tr>
<tr>
        <td>Sex</td><td>
                <select name="sex">
                <option value="M" <?php if($sex == 'M') echo "selected"?>>Male</option>
                 <option value="F" <?php if($sex == 'F') echo "selected"?>>Female</option>
            </select></td>
</tr>
<tr>
        <td>Microchip</td><td><input type="text" name="microchip" id="microchip" value="<?php echo $microchip; ?>"/></td>
</tr>
<tr>
                    <td> Photo: </td>
                    <td> <input type="file" name="uploadFile" id="uploadFile"></td>

                                                
                </tr>	
                <tr> <td><input type="submit" value="Edit"/></td></tr>
</table>
    
   
</form>
<table align="center"> 
     <tr><td>
 <img src="/kennel/showpic.php?id=<?php echo $id;?>" width="200px" height="200px"/></td></tr>
 </table>
</body>
<!--    </html>-->
<?php
//}
?>
