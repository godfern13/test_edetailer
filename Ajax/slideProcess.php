<?php
require_once("../classes/csGeneral.php");
require_once("../classes/db_functions.php");
require_once("../library/dbcon.php");

	$contentId 	= $_POST['c_id'];
	
	$db 			= new DB_Functions();
	$slides 		= $db->getSlides($contentId);
	$slides_nums 	= mysql_num_rows($slides);	
	$data 			= "";
	
	$PresntnName 	= 	$db->getPresentatnName($contentId);
	$rowsP 			= 	mysql_fetch_assoc($PresntnName);
	$presnTantName	=	preg_replace('/\s+/','',$rowsP['name']);
	$foldrPath		=	trim($presnTantName).$contentId;
	if($slides_nums > 0){
	
		$data = "<div id='prsntDiv'>";
		while($rows = mysql_fetch_assoc($slides)){
			$id			= $rows['id'];
			$name		= $rows['name'];
			$imgpath 	= $rows['content_url'];
			
			
			if($imgpath == ''){
				$image = 'images/default.jpg';
			}
			else{
				$image = "images/".$foldrPath."/parent/".$imgpath."";
			}
			
			$data .= '	<a href="slide.php?id='.base64_encode($id).'">
							<div id="slide'.$id.'" class="prsntContent" >
								<span class="slideHeader"><strong style=" display: block;margin:5px 0 ;">'.$name.'</strong></span>
								<img src='.$image.' class="presntnImg"></img>
								<input type="hidden" id="presnt_id" name="presnt_id" value='.$id.'>
							</div>
						</a>';
		}
		$data = $data.'</div>';
		echo $data;
	}
	else{
		//$data = "No Presentations";
	}
?>