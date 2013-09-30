
<?php
require_once("../classes/csGeneral.php");
require_once("../classes/db_functions.php");
require_once("../library/dbcon.php");
session_start();

	$db 			= new DB_Functions();
	$content 		= $db->getAllPresenatations();
	$content_nums 	= mysql_num_rows($content);	
	$data 			= "";
	
	if($content_nums > 0){
		$data = "<div id='prsntDiv'>";
		$pubBtn	= '';
		while($rows = mysql_fetch_assoc($content)){
			$content_id	= $rows['id'];
			$name		= $rows['name'];
			$publish 	= $rows['isPublished'];
			
			//Check if Content have parent
			$parent 		= $db->getSlides($content_id);
			$parent_nums 	= mysql_num_rows($parent);
			
			if($parent_nums !=0){
				while($rows = mysql_fetch_assoc($parent)){
					$parent_id	= $rows['id'];
					$imgpath	= $rows['content_url'];
					
					if($rows['content_url'] == ''){
						$image = 'images/default.jpg';
					}
					else{
						$image = 'images/child/'.$imgpath.'';
					}
				}				
			}
			else{
				$image = 'images/default.jpg';
			}		
			
			if($publish == 1){
				$pubIcon 	= '<img src="images/pub.jpg" style="float:right;" title="published"></img>';
				$pubMsg		= "'Are you sure you want to un-publish ?'";
				//<a href="#" title="This is some information for our tooltip."><span title="More">CSS3 Tooltip</span></a>
				$pubBtn		= '<a style="font:14px arial;padding:0px;"  class="tooltip" title="Un-Publish your presentation" onclick="publishPresntn('.$content_id.','.$pubMsg.',0);"><img src="images/unpublish.jpg" title=""></img></a>';
			}
			else{
				$pubIcon 	= '';
				$pubMsg		= "'Are you sure you want to publish ?'";
				$pubBtn		= '<a style="font:14px arial;padding:0px;" title="Publish your presentation" class="tooltip" onclick="publishPresntn('.$content_id.','.$pubMsg.',1);"><img src="images/publish.jpg" title=""></img></a>';
			}
			
			$data .= '	<div id="prsntn'.$content_id.'" class="prsntContent" style="background:url('.$image.');">
							<a href="add_slide.php?id='.base64_encode($content_id).'" class="clickable">
								<span class="presentnHeader"><strong style=" display: block;margin:5px 0 ;">'.$name.$pubIcon.'</strong></span>
							</a>								
								<span id="hoverContent" class="viewHover">
									<a style="font:14px arial;padding:0px;" title="Share your presentation with others" id="div#'.$content_id.'" class="tooltip addbtn2" ><img src="images/share.jpg" title=""></img></a>
									<input type="hidden" id="content_id" name="content_id" value='.$content_id.'>
									'.$pubBtn.'
									<a style="font:14px arial;padding:0px;" title="Delete your presentation" class="tooltip" onclick="delPresntn('.$content_id.','.$publish.');"><img src="images/delete.png" title=""></img></a>
								</span>
							<input type="hidden" id="presnt_id" name="presnt_id" value='.$content_id.'>
							</div>';
		}
		$data = $data.'</div>';
		echo $data;
	}
	else{
		//echo -1;
		//$data = "No Presentations";
	}
?>
<script src="script/popup.js" type="text/javascript"></script>
<script>
			$(document).ready(function(){
			var elements = $('.prsntContent');
			elements.fadeOut(100);

			var count = 0;
			function fadeIn(element){
				$(element).fadeIn(function(){
					if(++count <= elements.length){
						fadeIn(elements[count]);
					}
				});
			}

			fadeIn(elements[0]);
			});
		</script>
