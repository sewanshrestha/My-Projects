<table width="100%">
    <tr><td colspan="60" align="center" bgcolor="orange">Fujairah Zoo : Kennel System</td></tr>
</table>
<style>
    nav ul ul {
	display: none;
}

	nav ul li:hover > ul {
		display: block;
	}
        
        nav ul {
	background: #BBBDC4; 
	background: linear-gradient(top, #BBBDC4 10%, #bbbbbb 50%);  
	background: -moz-linear-gradient(top, #BBBDC4 10%, #bbbbbb 50%); 
	background: -webkit-linear-gradient(top, #BBBDC4 10%,#bbbbbb 50%); 
	list-style: none;
        position: relative;
	
}
	nav ul:after {
		content: ""; clear: both; display: block;
	}
        nav ul li {
	float: left;
}
	nav ul li:hover {
		background: #4b545f;
		background: linear-gradient(top, #4f5964 0%, #5f6975 90%);
		background: -moz-linear-gradient(top, #4f5964 0%, #5f6975 90%);
		background: -webkit-linear-gradient(top, #4f5964 0%,#5f6975 90%);
	}
		nav ul li:hover a {
			color: #fff;
		}
	
	nav ul li a {
		display: block; padding: 5px 40px;
		color: #757575; text-decoration: none;
	}
        nav ul ul {
	background: #5f6975; border-radius: 0px; padding: 0;
	position: absolute; top: 100%;
}
	nav ul ul li {
		float: none; 
		border-top: 1px solid #6b727c;
		border-bottom: 1px solid #575f6a;
		position: relative;
	}
		nav ul ul li a {
			padding: 8px 30px;
			color: #fff;
		}	
			nav ul ul li a:hover {
				background: #4b545f;
			}
                        
                        nav ul ul ul {
	position: absolute; left: 50%; top:0;
}
    
</style>


<nav>
	<ul>
		<li><a href="#">Kennel</a>
                    <ul>
				<li><a href="list.php">View List</a></li>
				<li><a href="searchpage.php">Search Kennel</a></li>
			</ul>
                </li>
		<li><a href="#">Vaccine Log</a>
			<ul>
                                <li><a href="vaccination.php">Vaccination Due</a></li>
				<li><a href="logpage.php">Single Log</a></li>
				<li><a href="multipleedit.php">Multiple Logs</a></li>
				
			</ul>
		</li>
		<li><a href="#">Miscellaneous</a>
			<ul>
				<li><a href="generallist.php">General List</a></li>
				<li><a href="alertlist.php">Alert List</a></li>
			</ul>
		</li>
		
	</ul>
</nav>