<div id="header-top-div">
	<?php	
		if ($_SESSION["userId"]=="" or !isset($_SESSION["userId"]) )
		{
				 
		}
		else
		{
			echo "<li style='list-style:none;width:970px;'><font style='float:right;'>Welcome :".$_SESSION["adminName"]."<br><a href='logout.php' style='font:italic bold 12px/30px Georgia,serif;'>Log out</a></font></li>"; 
		} 
    ?>	
</div>
<div id="admin-logos">
	<ul>
		<li  style="width:620px"><a href="admin_dashboard.php" class="main_logo">e-Detailing</a></li>
		<li   style="width:980px"><a href="admin_dashboard.php" class="logo_text">Admin Panel</a></li>
	</ul>
</div>
	
	<div id="DivAdminLinks">
		<ul id="menu">
			<li style="width:50px;">
				<a id="link_homeview" href="admin_dashboard.php" class="homeLink">HOME</a>
			</li>
			<li style="width:85px;">
			<a id="link_homeview" href="#" class="homeLink">Users</a>
				<ul>
					<li><a id="link_rest" href="add_user.php" class="">Add</a></li>
					<li><a id="link_rest" href="view_users.php" class="" style=" border-bottom:none;">View All</a></li>
				</ul>
			</li>
		</ul>
	</div>