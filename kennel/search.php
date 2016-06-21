<?php
include ('mysql.class.php');
$conn = new connect();
$name = trim($_GET['na']);
$breed = trim($_GET['br']);
$weight1 = trim($_GET['wt1']);
$weight2 = trim($_GET['wt2']);


$sql = "SELECT * FROM dogs where 1=1";
if(!empty($name)){
    $sql .= " AND lower(NAME) like lower('%$name%')";
}
if(!empty($breed)){
     $sql .= " AND lower(BREED) like lower('%$breed%')";
}
if(!empty($weight1) && empty($weight2)){
     $sql .= " AND WEIGHT = $weight1";
}
elseif(!empty($weight1) && !empty($weight2)){
     $sql .= " AND WEIGHT between $weight1 and $weight2";
}
$sql .= " order by BREED";
$conn->query($sql);
if($conn->num_rows() > 0){
    ?>
    <table width="100%">
     <tr>
        <th>SN</th>
        <th>Name</th>
        <th>Breed</th>
        <th>D.O.B</th>
        <th>Color</th>
        <th>Weight (KG)</th>
        <th>Sex </th>
        <th>Microchip </th>
        <th>Deworming Date</th>
        <th>DHLLP Vaccine Date</th>
        <th>Rabies Vaccine Date</th> 
        <th>Spot On Date</th> 
        <th>Other Date</th>
    </tr>
    <?php 
    
    $conn->query($sql);
    $i = 1;
    while ($hn = $conn->query_fetch(1)) {
       echo "<tr>";
        echo "<td>".$i++."</td>";
        echo "<td>";
       ?> <a href="viewlog.php?id=<?php echo $hn['ID']; ?>">
        <?php 
        echo $hn['NAME']."</a>";
        echo "</td>";
        echo "<td>";
        echo $hn['BREED'];
        echo "</td>";
        echo "<td>";
        if($hn['DATE_OF_BIRTH'] == '0000-00-00'){
          echo "N/A";
        }
        else{
            echo $hn['DATE_OF_BIRTH']; 
        }
        //echo $hn['DATE_OF_BIRTH'];
        echo "</td>";
        echo "<td>";
        echo $hn['COLOR'];
        echo "</td>";
        echo "<td>";
        echo $hn['WEIGHT'];
        echo "</td>";
        echo "<td>";
        echo $hn['SEX'];
        echo "</td>";
        echo "<td>";
        echo $hn['MICROCHIP'];
        echo "</td>";
        echo "<td>";
        if($hn['DEWORMING_DATE'] == '0000-00-00'){
          echo "N/A";
        }
        else{
            echo $hn['DEWORMING_DATE']; 
        }
        //echo $hn['DEWORMING_DATE'];
        echo "</td><td>";
        if($hn['DHLLP_DATE'] == '0000-00-00'){
          echo "N/A";
        }
        else{
            echo $hn['DHLLP_DATE']; 
        }
        //echo $hn['DHLLP_DATE'];
        echo "</td>";
        echo "<td>";
        if($hn['VACCINE_DATE'] == '0000-00-00'){
          echo "N/A";
        }
        else{
            echo $hn['VACCINE_DATE']; 
        }
        //echo $hn['VACCINE_DATE'];
        echo "</td>";
        echo "<td>";
        if($hn['SPOT_ON_DATE'] == '0000-00-00'){
          echo "N/A";
        }
        else{
            echo $hn['SPOT_ON_DATE']; 
        }
        //echo $hn['SPOT_ON_DATE'];
        echo "</td>";
        echo "<td>";
        if($hn['OTHER'] == '0000-00-00'){
          echo "";
        }
        else{
            echo $hn['OTHER']; 
        }
        //echo $hn['OTHER'];
        echo "</td><td>";
        ?>
        <a href="editpage.php?id=<?php echo $hn['ID']; ?>">Edit</a> |
        <a href="edit.php?pr=d&id=<?php echo $hn['ID']; ?>">Delete</a>
       <?php
        echo "</td></tr>";
        }
    
    ?>
</table>
<?php
}
