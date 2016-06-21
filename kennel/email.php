<?php
print_r('wer');
//die();
mail('sewan.shrestha@worldlink.com.np', 'test', 'test_mail');

/*
 include ('mysql.class.php');
 $con = new connect();
 $sql = "SELECT datediff( curdate( ) , vaccine_date ) , name,vaccine_date FROM dogs
           WHERE datediff( curdate( ) , vaccine_date ) > 365
            OR vaccine_date IS NULL";
if($con->query($sql) != null){
    
    $tosend = "Vaccination due list: <br>";
    $con->query($sql);
    while ($hn = $con->query_fetch(1)) {
        //$hn['NAME']
        $tosend .= "Name:".$hn['name']." Last vaccination date: ".$hn['vaccine_date']."<br>";
    }
}        
$to      = 'sewanshrestha@gmail.com';
$subject = 'Vaccination report';
$message = $tosend;
$headers = 'From: sewanshrestha@gmail.com' . "\r\n" .
    'Reply-To: sewanshrestha@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
echo $tosend;
mail($to, $subject, $message, $headers);
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */