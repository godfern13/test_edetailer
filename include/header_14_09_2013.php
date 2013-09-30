<style type="text/css">
        .desc { color:#6b6b6b;}
        .desc a {color:#0092dd;}
        
        .dropdown dd, .dropdown dt, .dropdown ul { margin:0px; padding:0px; }
        .dropdown dd { position:relative; }
        .dropdown a, .dropdown a:visited { color:#816c5b; text-decoration:none; outline:none;}
        .dropdown a:hover { color:#5d4617;}
        .dropdown dt a:hover { color:#5d4617;background:#CECECE;}
        .dropdown dt a {background:url(images/arrow.png) no-repeat scroll right center; display:block; padding-right:20px;
                        }
        .dropdown dt a span {cursor:pointer; display:block; padding:5px;}
        .dropdown dd ul {
			background:#E0E0E0 none repeat scroll 0 0;
			border: 1px solid;
			border-radius: 5px;
			color:#96969D; 
			display:none;
            left:0px; 
			padding:5px 5px; 
			position:absolute;
			top:2px; 
			right:3px;
			width:110px;
			list-style:none;
			text-align:left;
		}
		
		.dropdown dd ul:before{
			border-color: #96969D transparent;
			border-image: none;
			border-style: solid;
			border-width: 0 6px 10px;
			content: "";
			left: 0;
			position: absolute;
			top: -10px;
			z-index: 99;
		}

		
		
        .dropdown span.value { display:none;}
        .dropdown dd ul li a { padding:5px; display:block;width:105px;}
        .dropdown dd ul li a:hover { background-color:#d0c9af;width:105px;}
        
        .dropdown img.flag { border:none; vertical-align:middle; margin-left:10px; }
        .flagvisibility { display:none;}
        
        
</style>
<script type="text/javascript">
	$(document).ready(function() {
		$(".dropdown img.flag").addClass("flagvisibility");

		$(".dropdown dt a").click(function() {
			$(".dropdown dd ul").toggle();
		});
					
		$(".dropdown dd ul li a").click(function() {
			var text = $(this).html();
			$(".dropdown dt a span").html(text);
			$(".dropdown dd ul").hide();
			$("#result").html("Selected value is: " + getSelectedValue("sample"));
		});
					
		function getSelectedValue(id) {
			return $("#" + id).find("dt a span.value").html();
		}

		$(document).bind('click', function(e) {
			var $clicked = $(e.target);
			if (! $clicked.parents().hasClass("dropdown"))
				$(".dropdown dd ul").hide();
		});


		$("#flagSwitcher").click(function() {
			$(".dropdown img.flag").toggleClass("flagvisibility");
		});
	});
</script>

<div id="headerDiv">
	<div style="width:100%;height:35px;background:#A9A9A9;float:left;text-align:center; font: 28px tahoma;">e-Detailer</div>
	<!--<div id="header-top-div">
	<?php	
		
		//echo $_SESSION["userId"];
		//echo isset($_SESSION["uname"]);
		/*if (isset($_SESSION["userId"]) )
		{
			echo "<span style='list-style:none;width:970px;'><font style='float:right;'>Welcome :".$_SESSION["uname"]."</font></span><br><a href='logout.php' style='font:italic bold 12px/30px Georgia,serif;float:right;color:#EAEAEA'>Log out</a>"; 	 
		}
		else
		{
			
		} */
    ?>	
	</div>-->
	<div style="width:100%;height:85px;background:#F6F6F6;float:left;">
		<?if (isset($_SESSION["userId"]) )
			{	?>
		 <dl id="sample" class="dropdown" style="float:right;margin:  5px 75px 0 0;">
			<dt><a href="#"><span>Profile</span></a></dt>
			<dd>
				<ul>
					<li><a href="dashboard.php">Dashboard</a></li>
					<li><a href="#">Profile</a></li>
					<li><a href="logout.php">Logout<img class="flag" src="de.png" alt="" /><span class="value">DE</span></a></li>
					
				</ul>
			</dd>
		</dl>
		<?}?>
	</div>
</div>