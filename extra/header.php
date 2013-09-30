
<div id="headerDiv">
	<div style="width:100%;height:35px;background:#A9A9A9;float:left;text-align:center; font: 28px tahoma;">e-Detailer</div>
	<div id="header-top-div">
	<?php	
		
		//echo $_SESSION["userId"];
		if (isset($_SESSION["uname"]) )
		{
			echo "<span style='list-style:none;width:970px;'><font style='float:right;'>Welcome :".$_SESSION["uname"]."</font></span><br><a href='logout.php' style='font:italic bold 12px/30px Georgia,serif;float:right;color:#EAEAEA'>Log out</a>"; 	 
		}
		else
		{
			
		} 
    ?>	
	</div>
	<div style="width:100%;height:85px;background:#F6F6F6;float:left;"></div>
</div>