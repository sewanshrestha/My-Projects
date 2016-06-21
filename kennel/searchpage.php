<html>
     <head>
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
table, td{
    border: 1px solid black;
}
th{
    border: 2px solid black;
}
</style>
<script type="text/javascript">
    function searchresult(){
                        var name = document.getElementById("name").value;
                        var breed = document.getElementById("breed").value;
                        var weight1 = document.getElementById("weight1").value;
                        var weight2 = document.getElementById("weight2").value;
                        var xmlhttp;
                        if (window.XMLHttpRequest)
                        {// code for IE7+, Firefox, Chrome, Opera, Safari
                            xmlhttp=new XMLHttpRequest();
                        }
                        else
                        {// code for IE6, IE5
                            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                        }
                        xmlhttp.onreadystatechange=function()
                        {
                            if (xmlhttp.readyState===4 && xmlhttp.status===200)
                            {
                                document.getElementById("display").innerHTML=xmlhttp.responseText;
                            }
                        }
                        //alert(id);
                        xmlhttp.open("GET","search.php?na="+name+"&br="+breed+"&wt1="+weight1+"&wt2="+weight2,true);
                        xmlhttp.send();  
                    
    }
</script>
</head>
<body>
            <?php
	//include "header.php";
            include ('header.php');
	?> 

            <br>
<a HREF="javascript:history.go(-1)">Go Back</a>
<br>
<a href="addItempage.php">Add</a>  ||  <a href="searchpage.php">Search</a> || <a href="logpage.php">Add Log</a>
|| <a href="vaccination.php">Vaccination Due</a>|| <a href="generallist.php">General List</a>
<div style='float:right; cursor:pointer;' onclick="messageboardopen();">Show alert board</div>
<form>
    By Name: <input type="text" name="name" id="name"/> ||
    By Breed: <input type="text" name="breed" id="breed"/> ||
    By Weight From: <input type="text" name="weight1" id="weight1"/> &nbsp; 
              To:<input type="text" name="weight2" id="weight2"/>
    <input type="button" value="Search" onclick="searchresult();"/>
</form>
<div id="display"></div>
</body>
</html>



