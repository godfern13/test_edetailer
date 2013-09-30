<?php
include('../../library/dbcon.php');
require_once ("../../classes/csGeneral.php");
	
	$generalObj = new general();
	
	if($_POST['page'])
	{
		//require_once('../library/config.php');
		$page = $_POST['page'];
		$cur_page = $page;
		$page -= 1;
		$per_page = 5;
		$previous_btn = true;
		$next_btn = true;
		$first_btn = true;
		$last_btn = true;
		$start = $page * $per_page;	
	
		$userQry = "SELECT * FROM users WHERE u_type=1 AND del_flag=0 ORDER BY id LIMIT $per_page offset $start   ";
		$userResult = mysql_query($userQry)or die('Error in connection'.mysql_error());
		$user_num_rows = mysql_num_rows($userResult);
		
		if($user_num_rows>0){
		
			$data = '<div id="tbContent2">';
			if($start > 1){
				$srno = $start + 1;
			}
			else{
			$srno = 1;
			}
		
			while($rows = mysql_fetch_assoc($userResult))
			{
				$userId		= $rows['id'];
				$user_fullname	= $generalObj->getFormField($rows['name']);
							
				$data .= '<ul>
							<li style="width:100px;border-left:none;">'.$srno.'</li>
							<li style="width:400px; padding: 11px 0 8px;">'.$user_fullname.'</li>
							<li style="width:100px;">
								<span style="margin:0 10px 0 15px;float:left;">
									<a href="edit_user.php?id='.base64_encode($userId).'"><img src="../images/edit.png" ></img></a>
								</span>
								<span style="margin:0 10px 0 10px;float:left;">
									<img src="../images/del.png" onclick="delUser('.$userId.');"></img>
								</span>
							</li>
						</ul>';
				$srno++;
			}
		
			$data .= '</div>';
		
			/* **************************************** Query To Get Total Count Of result *********************************/
			$query_pag_num = "SELECT COUNT(*) AS count FROM  users WHERE u_type=1 AND del_flag=0";
			$result_pag_num = mysql_query($query_pag_num);
			$row = mysql_fetch_array($result_pag_num);
			$count = $row['count'];
			$no_of_paginations = ceil($count / $per_page);
			//echo $no_of_paginations;
			if($no_of_paginations > 0)
			{
				/************************************* Calculating the starting and endign values for the page ******************************************/
				if ($cur_page >= 10) 
				{
					$start_loop = $cur_page - 5;
					if ($no_of_paginations > $cur_page + 5)
					{
						$end_loop = $cur_page + 5;
					}
					else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) 
					{
						$start_loop = $no_of_paginations - 6;
						$end_loop = $no_of_paginations;
					} 
					else 
					{
						$end_loop = $no_of_paginations;
					}
				} 
				else 
				{
					$start_loop = 1;
					//$start_loop = $cur_page - 3;
					if ($no_of_paginations > 10)
						$end_loop = 10;
					else
						$end_loop = $no_of_paginations;
					/*if ($no_of_paginations > 3)
						$end_loop = 3;
					else
						$end_loop = $no_of_paginations;*/
				}
				
				$data .= "<div id='pagination'><ul>";

				//***************************** Enable First Button ************************************//
				if ($first_btn && $cur_page > 1) 
				{
					$data .= "<li p='1' class='active'>First</li>";
				} 
				else if ($first_btn) 
				{
					$data .= "<li p='1' class='inactive'>First</li>";
				}

				//**************************** Enable Previous Button *********************************//
				if ($previous_btn && $cur_page > 1) 
				{
					$pre = $cur_page - 1;
					$data .= "<li p='$pre' class='active'>Pre</li>";
				} 
				else if ($previous_btn) 
				{
					$data .= "<li class='inactive'>Pre</li>";
				}
				for ($i = $start_loop; $i <= $end_loop; $i++) 
				{
					if ($cur_page == $i)
						$data .= "<li p='$i' style='color:#fff;background-color:#006699;' class='active'>{$i}</li>";
					else
						$data .= "<li p='$i' class='active'>{$i}</li>";
				}

				//**************************** Enable Next Button *********************************//
				if ($next_btn && $cur_page < $no_of_paginations) 
				{
					$nex = $cur_page + 1;
					$data .= "<li p='$nex' class='active'>Next</li>";
				} else if ($next_btn) 
				{
					$data .= "<li class='inactive'>Next</li>";
				}

				//**************************** Enable Last Button *********************************//
				if ($last_btn && $cur_page < $no_of_paginations) 
				{
					$data .= "<li p='$no_of_paginations' class='active'>Last</li>";
				} else if ($last_btn) 
				{
					$data .= "<li p='$no_of_paginations' class='inactive'>Last</li>";
				}
				$data .="</ul></div>";
				
			}
			$data = $data;
			echo $data;
		
		}
		else {
			echo "1";
		}
	}

?>