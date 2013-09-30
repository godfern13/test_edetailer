<?php
require_once("../classes/csGeneral.php");
require_once("../library/dbcon.php");

	$contentId 	= $_POST['c_id'];
	$query 		= "	SELECT parent.id,parent.content_id,parent.name
					FROM parent WHERE parent.content_id = ".$contentId." AND parent.del_flag = 0";
	//echo $query; 
	$result	= mysql_query($query)or die(mysql_error());
	$row_nums = mysql_num_rows($result);
	
	$data = "";
	
	if($row_nums > 0){
		$data = "<div id='prsntDiv'>";
		while($rows = mysql_fetch_assoc($result)){
			$id		= $rows['id'];
			$name	= $rows['name'];
			
			$data .= '	<a href="slide.php?id='.base64_encode($id).'"><div id="slide'.$id.'" class="prsntContent">
							<span>'.$name.'</span>
							<input type="hidden" id="presnt_id" name="presnt_id" value='.$id.'>
						</div></a>';
		}
		$data = $data.'</div>';
		echo $data;
	}
	else{
		//$data = "No Presentations";
	}
?>