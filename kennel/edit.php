<?php
include ('mysql.class.php');
$conn = new connect();
if($_GET['pr'] == 'e'){
  if ($_POST['name'] == "") {
        header('Location: javascript:history.go(-1)');
    } else {
        $con = new connect();
       
        //Insert process in the Items table
        $name = $_POST['name'];
        $breed = $_POST['breed'];
        $weight = $_POST['weight'];
        $sex = $_POST['sex'];
        $color = $_POST['color'];
        $microchip = $_POST['microchip'];
        $dob = $_POST['birth'];
        $weightdate = $_POST['weightdate'];
        
        $id = $_POST['id'];
        
        $addItemSQL = "update dogs "
                .     "set NAME = '$name', "
                .         "BREED = '$breed',"
                .         "WEIGHT = $weight,"
                .         "COLOR = '$color',
                           SEX = '$sex',
                           MICROCHIP = '$microchip',
                           DATE_OF_BIRTH = '$dob'"
                . "where ID = $id";
        $con->query($addItemSQL);
       
        $content = null;
        if ($_FILES['uploadFile']['size'] > 0) {
            $sql = "DELETE from pic_file where NAME = $id)";
	     $con->query($sql);
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
         $sql = "select WEIGHT from weight_log where DOG_ID = $id and 
                                DATE = (select max(DATE) from weight_log where DOG_ID = $id)";
              $con->query($sql);
              $latest_wt = null;
              while ($hn = $con->query_fetch(1)) {
                  $latest_wt = $hn['WEIGHT'];
              }
              if(($latest_wt == null || $latest_wt != $weight) && !empty($weightdate)){
                 
                  $sql = "INSERT INTO weight_log(DOG_ID,WEIGHT,DATE) values($id,$weight,'$weightdate')";
                  $con->query($sql);
              }
        header('Location: list.php'); 
        
    }
   
}
else if($_GET['pr'] == 'd'){
    $delete = "DELETE from dogs where ID =". $_GET['id'];
    $conn->query($delete);
     $delete = "DELETE from log where NAME =". $_GET['id'];
    $conn->query($delete);
 header('Location: list.php'); 
    
}
