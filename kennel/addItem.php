<?php

include ('mysql.class.php');

//Logic when the process is Edit or Copy a Server
if ($_POST['pr'] == "a") {
    //If invalid, return to previous page    
    if ($_POST['name'] == "") {
        header('Location: javascript:history.go(-1)');
    } else {
        $con = new connect();
       
        //Insert process in the Items table
        $name = $_POST['name'];
        $breed = $_POST['breed'];
        $deworm = $_POST['deworm'];
        $weight = $_POST['weight'];
        $sex = $_POST['sex'];
        $color = $_POST['color'];
        $bdate = $_POST['brought'];
        $vdate = $_POST['vaccine'];
        $other = $_POST['other'];
        $microchip = $_POST['microchip'];
        $spoton = $_POST['spoton'];
        $dob = $_POST['birth'];
        
        $maxid = "SELECT max(ID) id from dogs";
        $con->query($maxid);
        while ($hn = $con->query_fetch(1)) {
            $id = $hn['id']+1;
           
        }
        $addItemSQL = "INSERT INTO dogs(ID,NAME, BREED,DEWORMING_DATE,DATE_OF_BIRTH,WEIGHT,SEX,MICROCHIP,COLOR,DHLLP_DATE,VACCINE_DATE,SPOT_ON_DATE,OTHER)"
                . "    VALUES($id,'" . $name . "','$breed','$deworm','$dob',$weight,'$sex','$microchip','$color','$bdate','$vdate','$spoton','$other')";
        //echo $addItemSQL;
        $con->query($addItemSQL);
        $content = null;
        if ($_FILES['uploadFile']['size'] > 0) {
            $fileName = $_FILES['uploadFile']['name'];
            //$tmpName  = $_FILES['uploadFile']['tmp_name'];
            $fileSize = $_FILES['uploadFile']['size'];
            $fileType = $_FILES['uploadFile']['type'];

            //$fileType = "application/pdf";
            // 			$fp      = fopen($tmpName, 'r');
            // 			$content = fread($fp, filesize($tmpName));
            // 			$content = addslashes($content);
            // 			fclose($fp);
            $content = file_get_contents($_FILES['uploadFile']['tmp_name']);


            //$content = str_replace("'", "\'", $content);


            if (!get_magic_quotes_gpc()) {
                $fileName = addslashes($fileName);
                //$content = addcslashes($content);
            }
            $content = addslashes($content);
            $maxid = "SELECT max(ID) id from pic_file";
            $con->query($maxid);
            while ($hn = $con->query_fetch(1)) {
                $idpic = $hn['id']+1;
            }
             $sql = "INSERT INTO pic_file(ID,FILENAME,FILETYPE,FILESIZE,FILECONTENTS,NAME) values($idpic,'$fileName','$fileType','$fileSize','$content',$id)";
	     $con->query($sql);
        }
         header('Location: list.php'); 
    }
    
}
?>
