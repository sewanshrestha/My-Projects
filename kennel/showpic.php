<?php
include ('mysql.class.php');
            $con = new connect();
 $id = $_GET['id'];
 
            //$logo = $this->schoolmodel->getlogo($schoolId);
            $sql = "SELECT * FROM pic_file where NAME = $id";
            $rows = $con->query($sql);
            if($rows != null){
             //$con->query_return($sql);
             $hn = $con->results($sql);
            //print_r($hn); die();
                foreach($hn as $h) {
                    
                      $logodata = $h[4];
                     $type = $h[2];
                }
               //print_r($type); 
               //print_r($logodata); 
               //die();
                $logodatadisp = str_replace("\'", " '", $logodata);
                //$logodata = preg_replace("\'", " '", $logodata);
                header("Content-type:".$type);
                header('Content-Disposition: inline;');
                echo $logodatadisp;	
            }
            else {
                return null;
            }
