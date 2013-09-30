<?php
require_once("../classes/csGeneral.php");
require_once("../library/dbcon.php");

	$query 	= "	SELECT content.id,content.name,content.downld_status,content.isPublished
				FROM content WHERE content.del_flag = 0";
	//echo $query; 
	$result	= mysql_query($query)or die(mysql_error());
	$row_nums = mysql_num_rows($result);
	
	$data = "";
	
	if($row_nums > 0){
		$data = "<div id='prsntDiv'>";
		$pubBtn	= '';
		while($rows = mysql_fetch_assoc($result)){
			$id			= $rows['id'];
			$name		= $rows['name'];
			$publish 	= $rows['isPublished'];
			if($publish == 1){
				$pubIcon 	= '<img src="images/pub.jpg" style="float:right;" title="published"></img>';
				$pubMsg		= "'Are you sure you want to un-publish ?'";
				//<a href="#" title="This is some information for our tooltip."><span title="More">CSS3 Tooltip</span></a>
				$pubBtn		= '<a style="font:14px arial;padding:0px;"  class="tooltip" title="Un-Publish your presentation" onclick="publishPresntn('.$id.','.$pubMsg.',0);"><img src="images/unpublish.jpg" title=""></img></a>';
				
			}
			else{
				$pubIcon 	= '';
				$pubMsg		= "'Are you sure you want to publish ?'";
				$pubBtn		= '<a style="font:14px arial;padding:0px;" title="Publish your presentation" class="tooltip" onclick="publishPresntn('.$id.','.$pubMsg.',1);"><img src="images/publish.jpg" title=""></img></a>';
			}
			
			$data .= '	<div id="prsntn'.$id.'" class="prsntContent">
							<a href="add_slide.php?id='.base64_encode($id).'" class="clickable">
								<span class="presentnHeader"><p>'.$name.$pubIcon.'</p></span>
							</a>								
								<span id="hoverContent" class="viewHover">
									<a style="font:14px arial;padding:0px;" title="Share your presentation with others" id="div#'.$id.'" class="tooltip addbtn2" ><img src="images/share.jpg" title=""></img></a>
									<input type="hidden" id="content_id" name="content_id" value='.$id.'>
									'.$pubBtn.'
									<a style="font:14px arial;padding:0px;" title="Delete your presentation" class="tooltip" onclick="delPresntn('.$id.','.$publish.');"><img src="images/delete.png" title=""></img></a>
								</span>
							<input type="hidden" id="presnt_id" name="presnt_id" value='.$id.'>
							</div>';
		}
		$data = $data.'</div>';
		echo $data;
	}
	else{
		//$data = "No Presentations";
	}
?>
<script src="script/popup.js" type="text/javascript"></script>
