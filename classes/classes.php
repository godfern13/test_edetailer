<?php
	/***********************************************************************************************************
											CONTENT CLASS
	************************************************************************************************************/
	class contentClass
	{
		private $id;/*Added*/
		private $name;
		private $addedDate;
		private $updatedDate;
		private $status;
		private $contentCunt;
		private $parents 	= 	array();
		private $content	=	array();
		
		function  __construct()
		{
			
		}
				
		//Getters and Setters Methods
		public function getId() {
			return $this->id;
		}
		
		public function setId($x) {
			$this->id = $x;
			
		}
		
		//---------------------------------- Function To Add & Get && Update Content Count -------------------------------------//
		public function addToContentArray($content)
		{
			array_push($this->content,$content);
		}
		public function getContentCount()
		{
			$contCnt	=	0;
			foreach($this->content as $cont)
			{
				$contCnt	=	$cont+1;
			}
			return $contCnt;
		}
		//---------------------------------- Function To Add & Get Parents -------------------------------------//
		public function addParents($parent)
		{
			array_push($this->parents,$parent);
		}
		public function getParentCount()
		{
			$parentCount	=	0;
			foreach($this->parents as $parnt)
			{
				$parentCount	=	$parentCount+1;
			}
			return $parentCount;
		}
	}
	/*****************************************************************************************************************
											PARENT CLASS
	******************************************************************************************************************/
	class parentClass extends contentClass
	{
		private $parentName;
		private $parentCretedDte;
		private $parentUpdtedDte;
		private	$parentWidth;
		private	$parentheight;
		private $childCount;
		private $parentBg;
		private $parentBgImg;
		private $parentX;
		private $parentY;
		private $childArray = array();
		function  _construct()
		{
		
		}
		public function addParentSpec($parentName,$parentCretedDte,$parentUpdtedDte,$parentWidth,$parentheight,$childCount,$parentBg,$parentBgImg,$parentX,$parentY)
		{
			$this->parName		=	$parentName;
			$this->parCrDte		=	$parentCretedDte;
			$this->parUpDte		=	$parentUpdtedDte;
			$this->parWdth		=	$parentWidth;
			$this->parHght		=	$parentheight;
			$this->parChldCnt	=	$childCount;
			$this->parentBg		=	$parentBg;
			$this->parentBgImg	=	$parentBgImg;
			$this->parentX		=	$parentX;
			$this->parentY		=	$parentY;
		}
		public function saveParentData()
		{
			
			$generalObj = new general();
			
			$table_name	= 'parent';
			$table_col	= 'id';
			$prntId		= $generalObj->getPK($table_name,$table_col);
			
			$contentId = $generalObj->getLastId('content');//Fetch the content id Content Table
			//$url = '';
			
			$parentName			=	$this->parName;
			$parentCretedDte	=	$this->parCrDte;
			$parentUpdtedDte	=	$this->parUpDte;
			$parentWidth		=	$this->parWdth;
			$parentheight		=	$this->parHght;
			$childCount			=	$this->parChldCnt;
			$parentBg			=	$this->parentBg;
			$parentBgImg		=	$this->parentBgImg;
			$parentX			=	$this->parentX;
			$parentY			=	$this->parentY;
			
			if($parentBgImg == ''){
				$imgUrl = '';
			}
			else{
				$imgUrl = $parentBgImg;
			}
			
			if($childCount> 0 ){
				$chldStatus = 1;//Has Child
			}
			else{
				$chldStatus = 0;//No Child
			}
			
			$prntFrameData = $parentWidth.','.$parentheight.','.$parentX.','.$parentY;
			
			//--------------------------------- Sql Statement Save parent Query ----------------------------------------------------//
			$query 	= "	INSERT INTO parent(id,content_id,name,frame,content_url,has_childs,added_on,updated_on)
									VALUES(".$prntId.",".$contentId.",'".$parentName."','".$prntFrameData."','".$imgUrl."',".$chldStatus.",'".$parentCretedDte."','".$parentUpdtedDte."')";
			//echo $query;
			$result = mysql_query($query)or die(mysql_error());
			//---------------------------------------------------------------------------------------------------------------------//
		}
		//----------------------------------------- Function to Add & Get Child Count -----------------------------//
		public function addChild($childArray)
		{
			array_push($this->childArray,$childArray);
		}
		public function getChildCount()
		{
			$childCount	=	0;
			foreach($this->childArray as $childArray)
			{
				$childCount	=	$childCount+1;
			}
			return $childCount;
		}
		//---------------------------------------------------------------------------------------------------------//
		
		//--------------------------------------- Function to Get parent Sepcifcation ----------------------------//
		public function getParentSpecification()
		{
			$colorPick	=	'';
			$colorArray	=	array('ffffff','ffce93','fffc9e','ffffc7','9aff99','96fffb','cdffff','185871','cbcefb','cfcfcf','fd6864',
								'fe996b','fffe65','fcff2f','67fd9a','38fff8','68fdff','9698ed','c0c0c0','fe0000','f8a102','ffcc67',
								'f8ff00','34ff34','68cbd0','34cdf9','6665cd','9b9b9b','cb0000','f56b00','ffcb2f','ffc702','32cb00',
								'00d2cb','3166ff','6434fc','656565','9a0000','ce6301','cd9934','999903','009901','329a9d','3531ff',
								'6200c9','343434','680100','963400','986536','646809','036400','34696d','00009b','303498','000000',
								'330001','643403','663234','343300','013300','003532','010066','340096');
			for($i=0;$i<count($colorArray);$i++)
			{
				if($this->parentBg == $colorArray[$i]){ $selCol	=	'selected'; }
				else{$selCol	=	''; } 
				$colorPick .= '<option value="'.$colorArray[$i].'" '.$selCol.'>#'.$colorArray[$i].'</option>';
			}
			$speDisp	=	'';
			$speDisp	.=	"<table id='specfcatnTabl'>";
			$speDisp	.=  "<tr>";
			$speDisp	.=	"<td colspan='3' style='text-align:center'>Specifications</td>";
			$speDisp	.=	"</tr>";
			$speDisp	.=	"<tr height='5px'></tr>";
			$speDisp	.=	"<tr>";
			$speDisp	.=	"<td>Name</td>";
			$speDisp	.=	"<td>:</td>";
			$speDisp	.=	"<td><input type='text' name='sepcName' id='sepcName' onchange='return chngeParSpec()' value='".$this->parName."'/></td>";
			$speDisp	.=	"</tr>";
			$speDisp	.=	"<tr height='5px'></tr>";
			$speDisp	.=	"<tr>";
			$speDisp	.=	"<td>Width</td>";
			$speDisp	.=	"<td>:</td>";
			$speDisp	.=	"<td><input type='text' name='sepcWdth' id='sepcWdth' value='".$this->parWdth."'/></td>";
			$speDisp	.=	"</tr>";
			$speDisp	.=	"<tr height='5px'></tr>";
			$speDisp	.=	"<tr>";
			$speDisp	.=	"<td>Height</td>";
			$speDisp	.=	"<td>:</td>";
			$speDisp	.=	"<td><input type='text' name='sepcHght' id='sepcHght' value='".$this->parHght."'/></td>";
			$speDisp	.=	"</tr>";
			$speDisp	.=	"<tr height='5px'></tr>";
			$speDisp	.=	"<tr>";
			$speDisp	.=	"<td>Bg Color</td>";
			$speDisp	.=	"<td>:</td>";
			$speDisp	.=	"<td>
							<select id='sepcBgColor' name='sepcBgColor' onchange='return chngeParSpec()' style='width:120px'>
								$colorPick
							</select>";
			$speDisp	.=	"</tr>";
			$speDisp	.=	"<tr height='5px'></tr>";
			$speDisp	.=	"<tr>";
			$speDisp	.=	"<td>Bg Image</td>";
			$speDisp	.=	"<td>:</td>";
			$speDisp	.=	"<td>
								<form name='parentImgFrm' method='post' autocomplete='off' enctype='multipart/form-data'>
								<input type='file' name='sepcBgImg' id='sepcBgImg' onchange='return ParntBgImgURL(this)'/></form>
								<input type='hidden' name='pBgImgName' id='pBgImgName' value='".$this->parentBgImg."' />
							</td>";
			$speDisp	.=	"</tr>";
			$speDisp	.=	"</table>";
			
			return $speDisp;
		}
		//-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
	}
	/*************************************************************************************************************************
												CHILD CLASS
	***************************************************************************************************************************/
	class childClass extends parentClass
	{
		private $childName;
		private $childCretedDte;
		private $childUpdtedDte;
		private	$childWidth;
		private	$childheight;
		private	$childNo;
		private	$childX;
		private	$childY;
		private $childCntType;	// Type of child content 1: Test; 2: Image; 3:Video; 4:Reference
		private $childImgPath;
		private $childText;
		private $childTextClr;
		private $childTextSize;
		private	$childVdoPath;
		private	$childRefLink;
		private $childRefLinkBg;
		private	$i;
		function  _construct()
		{
		
		}
		//------------------------------------------ Function To Add Child Specification ---------------------------------------------------//
		public function addChildSpecification($childName,$childCretedDte,$childUpdtedDte,$childWidth,$childheight,$childNo,$childX,$childY,$childCntType,$childText,$childImgPath,$childTextClr,$childTextSize,$childVdoPath,$childRefLink,$childRefLinkBg)
		{
			$this->chldName		=	$childName;
			$this->chldCrDte	=	$childCretedDte;
			$this->chldUpDte	=	$childUpdtedDte;
			$this->chldWdth		=	$childWidth;
			$this->chldHght		=	$childheight;
			$this->childNo		=	$childNo;
			$this->childX		=	$childX;
			$this->childY		=	$childY;
			$this->childCntType	=	$childCntType;
			$this->childText	=	$childText;
			$this->childImgPath	=	$childImgPath;
			$this->childTextClr	=	$childTextClr;
			$this->childTextSize=	$childTextSize;
			$this->childVdoPath	=	$childVdoPath;
			$this->childRefLink	=	$childRefLink;
			$this->childRefLinkBg	=	$childRefLinkBg;
		}
		public function saveChildData()
		{
			$generalObj = new general();
			$table_name	= 'child';
			$table_col	= 'id';
			$chldId		= $generalObj->getPK($table_name,$table_col);
			
			$parentId = $generalObj->getLastId('parent');//Fetch parent id from parent table
			
			$animated = 0;
			$animationType = '';
			$animationPathCord = '';
			$delaySlideTime = '';
			$ext = '';
			
			$childName		=	$this->chldName;
			$childCretedDte	=	$this->chldCrDte;
			$childUpdtedDte	=	$this->chldUpDte;
			$childWidth		=	$this->chldWdth;
			$childheight	=	$this->chldHght;
			$childNo		=	$this->childNo;
			$childX			=	$this->childX;
			$childY			=	$this->childY;
			$childCntType	=	$this->childCntType;
			$childText		=	$this->childText;
			$childTextClr	=	$this->childTextClr;
			$childTextSize	=	$this->childTextSize;
			$childImgPath	=	$this->childImgPath;
			$childVdoPath	=	$this->childVdoPath;
			$childRefLink	=	$this->childRefLink;
			$childRefLinkBg	=	$this->childRefLinkBg;
			
			$childCntType = 0;
			$childImgPath = '';
			
			//-------------------------------- Query to add Child Data ---------------------------------------------//
			$query = "	INSERT INTO child(id,parent_id,name,type,content_url,frame,isAnimated,animType,animPathCord,delayTime,content_extention,added_on,updated_on)
									VALUES(".$chldId.",".$parentId.",'".$childName."',".$childCntType.",'".$childImgPath."','".$childFrameData."',".$animated.",'".$animationType."','".$animationPathCord."','".$delaySlideTime."','".$ext."','".$childCretedDte."','".$childUpdtedDte."')";
			$result = mysql_query($query)or die(mysql_error());
		}
		//------------------------------------------------- Function to Get Child Specification ----------------------------------------------//
		public function getChildSpecification()
		{
			$i				=	0;
			
			$chldspeDisp	=	'';
			$chldspeDisp	.=	"<table id='specfcatnTabl'>";
			$chldspeDisp	.=  "<tr>";
			$chldspeDisp	.=	"<td colspan='3' style='text-align:center'>Specifications<input type='hidden' name='chldCnt' id='chldCnt' value='".$this->childNo."'></td>";
			$chldspeDisp	.=	"</tr>";
			$chldspeDisp	.=	"<tr height='5px'></tr>";
			$chldspeDisp	.=	"<tr>";
			$chldspeDisp	.=	"<td>Width</td>";
			$chldspeDisp	.=	"<td>:</td>";
			$chldspeDisp	.=	"<td><input type='text' name='chldWdth' id='chldWdth' onchange='return chngChldSpec($this->childNo,$this->childCntType)' value='".$this->chldWdth."'/></td>";
			$chldspeDisp	.=	"</tr>";
			$chldspeDisp	.=	"<tr height='5px'></tr>";
			$chldspeDisp	.=	"<tr>";
			$chldspeDisp	.=	"<td>Height</td>";
			$chldspeDisp	.=	"<td>:</td>";
			$chldspeDisp	.=	"<td><input type='text' name='chldHght' id='chldHght' onchange='return chngChldSpec($this->childNo,$this->childCntType)' value='".$this->chldHght."'/></td>";
			$chldspeDisp	.=	"</tr>";
			$chldspeDisp	.=	"<tr height='5px'></tr>";
			$chldspeDisp	.=	"<tr>";
			$chldspeDisp	.=	"<td>X-Cordinate</td>";
			$chldspeDisp	.=	"<td>:</td>";
			$chldspeDisp	.=	"<td><input type='text' name='childX' id='childX' value='".$this->childX."' readonly/></td>";
			$chldspeDisp	.=	"</tr>";
			$chldspeDisp	.=	"<tr height='5px'></tr>";
			$chldspeDisp	.=	"<tr>";
			$chldspeDisp	.=	"<td>Y-Cordinate</td>";
			$chldspeDisp	.=	"<td>:</td>";
			$chldspeDisp	.=	"<td><input type='text' name='childY' id='childY' value='".$this->childY."' readonly/></td>";
			$chldspeDisp	.=	"</tr>";
			$chldspeDisp	.=	"<tr height='5px'></tr>";
			if($this->childCntType == 1)
			{
				$Sizeoption		=	'';
				for($i=8;$i<=36;$i++)
				{
					if($this->childTextSize == $i){ $selected	=	'Selected';}
					else{ $selected	=	''; }
					$Sizeoption	.=	'<option value="'.$i.'" '.$selected.'>'.$i.'</option>';
				}
				$colorPick2	=	'';
				$colorArray2	=	array('ffffff','ffce93','fffc9e','ffffc7','9aff99','96fffb','cdffff','185871','cbcefb','cfcfcf','fd6864',
									'fe996b','fffe65','fcff2f','67fd9a','38fff8','68fdff','9698ed','c0c0c0','fe0000','f8a102','ffcc67',
									'f8ff00','34ff34','68cbd0','34cdf9','6665cd','9b9b9b','cb0000','f56b00','ffcb2f','ffc702','32cb00',
									'00d2cb','3166ff','6434fc','656565','9a0000','ce6301','cd9934','999903','009901','329a9d','3531ff',
									'6200c9','343434','680100','963400','986536','646809','036400','34696d','00009b','303498','000000',
									'330001','643403','663234','343300','013300','003532','010066','340096');
				for($cj=0;$cj<count($colorArray2);$cj++)
				{
					if($this->childTextClr == $colorArray2[$cj]){ $selCol	=	'selected'; }
					else{$selCol	=	''; } 
					$colorPick2 .= '<option value="'.$colorArray2[$cj].'" '.$selCol.'>#'.$colorArray2[$cj].'</option>';
				}
				$chldspeDisp	.=	"<tr>";
				$chldspeDisp	.=	"<td>Text</td>";
				$chldspeDisp	.=	"<td>:</td>";
				$chldspeDisp	.=	"<td style='text-align:center'>
										<textarea name='chldTxt$this->childNo' id='chldTxt$this->childNo' onchange='return changeChildText($this->childNo,$this->childCntType)'>$this->childText</textarea>
									</td>";
				$chldspeDisp	.=	"</tr>";
				$chldspeDisp	.=	"<tr height='5px'></tr>";
				$chldspeDisp	.=	"<tr>";
				$chldspeDisp	.=	"<td>Color</td>";
				$chldspeDisp	.=	"<td>:</td>";
				$chldspeDisp	.=	"<td style=''>
										<select name='chldTxtClr$this->childNo' id='chldTxtClr$this->childNo' onchange='return changeChildTextClr($this->childNo,$this->childCntType)' style='width:120px'>
											$colorPick2
										</select>
									</td>";
				$chldspeDisp	.=	"</tr>";
				$chldspeDisp	.=	"<tr height='5px'></tr>";
				$chldspeDisp	.=	"<tr>";
				$chldspeDisp	.=	"<td>Size</td>";
				$chldspeDisp	.=	"<td>:</td>";
				$chldspeDisp	.=	"<td style=''>
										<select name='chldTxtSize$this->childNo' id='chldTxtSize$this->childNo' onchange='return changeChildTextSize($this->childNo,$this->childCntType)' style='width:120px'>
											$Sizeoption
										</select>
									</td>";
				$chldspeDisp	.=	"</tr>";
				$chldspeDisp	.=	"<tr height='5px'></tr>";
				$chldspeDisp	.=	"<tr>";
				$chldspeDisp	.=	"<td>Style</td>";
				$chldspeDisp	.=	"<td>:</td>";
				$chldspeDisp	.=	"<td style=''>
										<table>
											<tr>
												<td width='20px' style='border:1px solid #fff;background:#000;cursor:pointer;color:#fff' onclick='return changeFntWght(1,$this->childNo,$this->childCntType)'><b>B</b></td><td width='2px'></td>
												<td width='20px' style='border:1px solid #fff;background:#000;cursor:pointer;font-style:Italic;color:#fff' onclick='return changeFntWght(2,$this->childNo,$this->childCntType)'>I</td><td width='2px'></td>
												<td width='20px' style='border:1px solid #fff;background:#000;cursor:pointer;color:#fff' onclick='return changeFntWght(3,$this->childNo,$this->childCntType)'><u>U</u></td><td width='2px'></td>
											</tr>
										</table>
									</td>";
				$chldspeDisp	.=	"</tr>";
			}
			else if($this->childCntType == 2){ 
				$chldspeDisp	.=	"<tr>";
				$chldspeDisp	.=	"<td>Image</td>";
				$chldspeDisp	.=	"<td>:</td>";
				$chldspeDisp	.=	"<td style='text-align:center'>
										<form name='childImgFrm' method='post' autocomplete='off' enctype='multipart/form-data'>
										<input type='file' name='chldImg' id='chldImg' onchange='return ChldBgImgURL(this,$this->childNo,$this->childCntType)'/>
										<input type='hidden' name='chldImgName$this->childNo' id='chldImgName$this->childNo' value='".$this->childImgPath."' /></form>
									</td>";
				$chldspeDisp	.=	"</tr>";
			}
			else if($this->childCntType == 3){
				$chldspeDisp	.=	"<tr>";
				$chldspeDisp	.=	"<td>Video Path</td>";
				$chldspeDisp	.=	"<td>:</td>";
				
				$chldspeDisp	.=	"<td>
										<form name='childVideoFrm' method='post' autocomplete='off' enctype='multipart/form-data'>
											<input type='file' name='childVdoPath$this->childNo' id='childVdoPath$this->childNo' onchange='return changeChildVdo($this->childNo,$this->childCntType)' value='$this->childVdoPath'/>
										</form>
									</td>";
				$chldspeDisp	.=	"</tr>";
			}
			else if($this->childCntType == 4){
				$chldspeDisp	.=	"<tr>";
				$chldspeDisp	.=	"<td>Bg Image</td>";
				$chldspeDisp	.=	"<td>:</td>";
				$chldspeDisp	.=	"<td>
										<form name='childRefImgFrm' method='post' autocomplete='off' enctype='multipart/form-data'>
										<input type='file' name='chldRefBgImg' id='chldRefBgImg' onchange='return ChldRefBgImgURL(this,$this->childNo,$this->childCntType)'/>
										<input type='hidden' name='chldRefBgImg$this->childNo' id='chldRefBgImg$this->childNo' value='".$this->childRefLinkBg."' /></form>
									</td>";
				$chldspeDisp	.=	"</tr>";
			
				$chldspeDisp	.=	"<tr>";
				$chldspeDisp	.=	"<td>Link</td>";
				$chldspeDisp	.=	"<td>:</td>";
				$chldspeDisp	.=	"<td><input type='text' name='childRefLink$this->childNo' id='childRefLink$this->childNo' value='$this->childRefLink' onchange='return chngChldSpec($this->childNo,$this->childCntType)'/></td>";
				$chldspeDisp	.=	"</tr>";
			}
			$chldspeDisp	.=	"</table>";
			
			return $chldspeDisp;
		}
	}
?>