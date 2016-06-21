<?php

class connect
{

	var $Host       = 'localhost';		// Hostname of our MySQL server
	var $Database	= 'kernel';			// Logical database name on that server
	var $User	= 'root';				// Database user
	var $Password	= '';					// Database user's password	

	var $Link_ID	= 0;					// Result of mysql_connect()
	var $Query_ID	= 0;					// Result of most recent mysql_query()
	var $Record		= array();				// Current mysql_fetch_array()-result
	var $Row;								// Current row number
	var $Errno = 0;							// Error state of query
	var $Error = "";

	function halt($msg)
	{
		/*
		echo("</TD></TR></TABLE><B>Database error:</B> $msg<BR>\n");
		echo("<B>MySQL error</B>: $this->Errno ($this->Error)<BR>\n");
		echo "Session halted.";
		return $this->Error;
		*/
		$err="</TD></TR></TABLE><B>Database error:</B> $msg<BR>\n";
		$err.="<B>MySQL error</B>: $this->Errno ($this->Error)<BR>\n";
		$err.="Session halted.";
		echo $err;
		//mail("surajt@digital.com.np,birijan@digital.com.np","Error On Percess",$err);
		
		
		
	}

	function connect()
	{
		if($this->Link_ID == 0)
		{
			$this->Link_ID = mysql_connect($this->Host, $this->User, $this->Password);
			if (!$this->Link_ID)
			{
				$this->halt("Link_ID == false, connect failed");
			}
			$SelectResult = mysql_select_db($this->Database, $this->Link_ID);
			if(!$SelectResult)
			{
				$this->Errno = mysql_errno($this->Link_ID);
				$this->Error = mysql_error($this->Link_ID);
				$this->halt("cannot select database <I>".$this->Database."</I>");
			}
		}
	}

	function query($Query_String)
	{
		
		$this->connect();
		$this->Query_ID = mysql_query($Query_String,$this->Link_ID);// or $this->Query_ID =mysql_error(); 
		$this->Row = 0;
		$this->Errno = mysql_errno();
		if (!$this->Query_ID)
		{
			$this->halt("Invalid SQL: ".$Query_String);
		
		}
		//echo $this->Query_ID;
		return $this->Query_ID;
		
		
	}
	
	
	function query_return($Query_String)
	{
		$this->connect();
                
		$this->Query_ID = mysql_query($Query_String,$this->Link_ID);
		$this->Row = 0;
		$this->Errno = mysql_errno();
		$this->Error = mysql_error();
		if (!$this->Query_ID)
		{
			return false;
		} else {
			return $this->Query_ID;
		}
	}
	
	
	
function query_fetch($fetch=0)
{
	if($fetch==0) {
		$result=@mysql_fetch_assoc($this->Query_ID);
	} else {
		$result=@mysql_fetch_array($this->Query_ID);
	}
	
	if(!is_array($result)) 
	return false;
	$this->total_field=mysql_num_fields($this->Query_ID);

	foreach($result as $key=>$val){
		$result[$key]=trim(htmlspecialchars($val));
	}
	 return $result; 
}

function query_fetch_tr($css='',$col_name='no',$update='no',$delete='no',$add='no',$not_show='no',$total_rows=0)
{
	if(!empty($not_show)) {
		$val=0;
	 } else {
		$val=1;
	 }
	// For Add

		if($add=="yes") {
			if(!empty($update))  $c=$c+1;
			if(!empty($delete)) $c=$c+1;
			$colspan=$this->num_field()+$c;
			$tr_output="<tr><td colspan='$colspan'><a href='?mode=add'> Add New Data</a> </tr> ";
		}
	
	// End of Add
	if($col_name=="yes") {
		$tr_output.="<tr>";
		for($j=$val;$j<$this->num_field();$j++) {
			$tr_output.="<th>".ucwords(strtolower($this->get_field_name($j)));
		}
		// For Update 
		if($update=="yes") {
			$addNewTD="<th>Update</th>";
		} else {
			$addNewTD="";
		}
		// End of Update
		// For Delete 
		if($delete=="yes") {
			$addDelTD="<th>Delete</th>";
		} else {
			$addDelTD="";
		}
		
		// End of Delete
		$tr_output.="$addNewTD $addDelTD </tr>";
	}
	if($total_rows==0) {
		echo  $tr_output;
	} 
	
	while($result=$this->query_fetch(1))
    {
    	
        if(is_array($result))
		{
        	if($css!="")
            {
            	$css_val="class=".$css;
            }
            $tr_output.="<tr $css_val>";
			
            for($i=$val;$i<$this->num_field();$i++)
            {
            	if($result[$i]=="")
                {
                	$result[$i]="&nbsp;";
                }
                $tr_output.="<td>".$result[$i]."</td>";
            }
			if($update=="yes") {
				$tr_output.="<td><a href='?sn=$result[0]&mode=update'>Update</a></td>";
			}
			if($delete=="yes") {
				$tr_output.="<td><a href='?sn=$result[0]&mode=delete'> Delete</a> </td>";
			}
            $tr_output.="</tr>";
        }
            echo $tr_output;
            unset($tr_output);
    }
 }


function paging($sqlPaging="",$offSet=0) {
	$sqlPaging=$sqlPaging;
	$eu = ($start - 0); 
	$limit = $offSet;                             
	$a = $eu + $limit; 
	$back = $eu - $limit; 
	$next = $eu + $limit; 
	$mainQuery= "Select * from ITEM_DETAILS limit $eu,$limit";
       echo $mainQuery;
	$this->query($mainQuery);
	$nume=$this->num_rows();
echo "<table align = 'left' width='500' border=0>
<tr>
<td  align='left' width='50%'>";
if($back >=0) { 
print "<a href='$page_name?start=$back'><font face='arial' size='1'> << </font></a>"; 
} 
echo " Page ";
$i=0;
$l=1;
for($i=0;$i < $nume;$i=$i+$limit){
	if($i <> $eu){
		echo " <a href='$page_name?start=$i'><font face='arial' size='1'>$l</font></a> ";
	} else { 
		echo "<font face='arial' size='1' color=red> &nbsp;$l</font>";
	}     
	$l=$l+1;
	echo "&nbsp;";
}
	if($a < $nume) { 
		print "<a href='$page_name?start=$next'><font face='arial' size='1'> >> </font></a>";
	} 
	echo "</tr></table>";

	
}

function num_field()
{
	return mysql_num_fields($this->Query_ID);
}
function get_field_name($i)
{
	return mysql_field_name($this->Query_ID,$i);
}


/*
function fetch_field()
{
	return mysql_fetch_field($this->Query_ID,2);
}
*/

function next_record()
	{
		$this->Record = mysql_fetch_array($this->Query_ID);
		$this->Row += 1;
		$this->Errno = mysql_errno();
		$this->Error = mysql_error();
		$stat = is_array($this->Record);
		if (!$stat)
		{
			mysql_free_result($this->Query_ID);
			$this->Query_ID = 0;
		}
		return $this->Record;
	}

	function num_rows()
	{
		return mysql_num_rows($this->Query_ID);
	}
	
	function maxRow($tablename,$field,$condition)
	{
		$sql="select max($field) from $tablename $condition";
		$this->query($sql);
		$result=@mysql_fetch_array($this->Query_ID);
		return $result[0];
	}
	
	function fetch_val()
	{		
		$result=@mysql_fetch_array($this->Query_ID);
		return $result[0];
	}
	
	
	function affected_rows()
	{
		return mysql_affected_rows($this->Link_ID);
	}

	function optimize($tbl_name)
	{
		$this->connect();
		$this->Query_ID = @mysql_query("OPTIMIZE TABLE $tbl_name",$this->Link_ID);
	}

	function clean_results()
	{
		if($this->Query_ID != 0) mysql_free_result($this->Query_ID);
	}

	function close()
	{
		if($this->Link_ID != 0) mysql_close($this->Link_ID);
	}
	
	function cur_id() {
		return mysql_insert_id($this->Link_ID);
	}
	
	function selectBox($sql="",$name="",$parameter="",$selected="") {
		$this->query($sql);
		$output="";
		
		$output.="<select name='$name' $parameter> ";
		$output.="<option value=''>--Select -- </option>";
			while($result=$this->query_fetch(1)) { 
				if($result[0]==$selected) {
					$a="selected";
				} else {
					$a="";
				}
				$output.="<option value='".$result[0]."' $a> ".$result[1]."</option>";
			}
		$output.="</select>";
		return $output;
	}
	
	

	
	

var $properties=array();

	/**
	 * This function is used set new single or multiple properties
	 * based on parameter. 
	 * 1. if we provide properties name only then it will register properties
	 * 2. if we provide properties name & value then it will register properties and assign value 
	 *    for given properites.
	 * 3. if properties name is array then it will set multiple
	 * properties.
	 * ex: $prArr=array("age"=>20,"sex"=>"male");
	 *
	 * @param string|array $propName
	 * @param string $propValue optional
	 */	 
	function setProperty($propName=NULL,$propValue=NULL){
			if(is_array($propName)){
				foreach($propName as $propKey=>$propValue){
					$this->properties[$propKey]=$propValue;	
				}
			}else
				$this->properties[$propName]=$propValue;	
	}
	
	/**
	 * This function is used retrive the value of given properties name.
	 * @param string $propName
	 * @returns string
	 */	 
	function getProperty($propName=NULL){
	return isset($this->properties[$propName])?$this->properties[$propName]:NULL;	
	}
	
	
	/**
	 * This function is used to test weather property is set or not.
	 * @param string $propName
	 * @returns boolean
	 */	 

		function isPropertySet($propName=NULL){
		/*	foreach($this->properties as $key=>$val){
			if($propName==$key)
				return true;
			}
		*/
		if(trim($this->properties[$propName])=="")
			return false;	
		else
			return true;
		}
	
	
	
	/**
	 * This function is used print all available properties of object.
	 * This is mainly used for Diagnosis.
	 */	 
	function propertyDump(){
		print  "<pre>";
		print_r($this->properties);
		print "</pre>";
	}

	/**
	 * This function is used to reset the properties object.
	 */	
	function resetProperty(){
		$this->properties=NULL;
	}
	
	 function totalRecord() {			
			if(eregi("^select",trim($this->queryStr))){
				$sqlCount="SELECT COUNT(*)   AS COUNT FROM (".$this->queryStr.") a";						
				$this->query($sqlCount);
				$totalRecord=$this->query_fetch();			
				return $totalRecord['COUNT'];			
			}else
			return 0;
		 }
	
		/**
	 * This function is used to fire sql query.
	 * @param string $queryStr
	 */	  
       function dbQuery($queryStr=NULL)
       {
		  $this->queryStr=$queryStr;
		 $this->query=mssql_query($queryStr,$this->connection);
		}
		
		function dbFetchRangeMod(&$objPaging,$fetch_type=1,$db="DEFAULT"){
			   
				$start=$objPaging->start;
				$display=$objPaging->display;
				$total_record=$objPaging->total_rec;
			   if($start>$total_record || $this->rec_position>$total_record)
					return false;
			   
			   else if($this->rec_position<$start){
					$this->rec_position=$start;
					$result=$this->dbFetchArrayMod($fetch_type,$this->rec_position-1,$display, $db);
				}
				else if($this->rec_position<($start+$display-1)){
					$this->rec_position++;
					$result=$this->dbFetchArrayMod($fetch_type,$this->rec_position-1,$display, $db);
				}
				else
					return false;
				return $result;
	}
	
	###########################################################################

	
	 /**
	 * This function fetch value defined in paging class 
	 * @param object $objPaging
 	 * @param int $fetch_type optional default 0
	 * @return array();
	 */
		 function dbFetchRange(&$objPaging,$fetch_type=1,$db="DEFAULT",$sql){
		   
			$start=$objPaging->start;
			$display=$objPaging->display;
			$total_record=$objPaging->total_rec;
		   if($start>$total_record || $this->rec_position>$total_record)
				return false;
		   else if($this->rec_position<$start){
				for($i=0;$i<$start;$i++){
				$result=$this->query();
				$this->rec_position++;
				}
			}
			else if($this->rec_position<($start+$display-1)){
				$this->rec_position++;
				$result=$this->query();
			}
			else
				return false;
			return $result;
		   }
		   
		   /**
	 * This function is used to fetch value of fire sql in array format.
	 * @param string $fetch_type OPTIONAL DEFAULT 0
	 * @param string $db OPTIONAL
	 * @return array();
	 */
       function dbFetchArray($fetch_type=0,$db="DEFAULT")
       {

		 $this->sql;
	     return mssql_fetch_array($this->sql);
       }
	   
	   	function getSql(){
			return 	$this->queryStr;
		}


		/**
	 * This function query at database which returns 
	 * @param string $queryStr
	 * @return boolean
	 */

       function dbQueryReturn($queryStr=NULL)
       {
	    return $this->query($queryStr);
				
	   }	
	
	
		function  results($sql)
		{
		 $count = 0;
		 $data = array();

		$res =  connect::query($sql);
		
		 while ($row = mysql_fetch_array($res)) {
				 $data[$count] = $row;
				 $count++;
			  }
	//	 @odbc_free_result($res);
			  return $data;
		
		}
			
}
?>
