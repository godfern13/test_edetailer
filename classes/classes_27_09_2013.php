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
			$colorArray = array('F0F8FF'=>'AliceBlue ','FAEBD7'=>'AntiqueWhite ','00FFFF'=>'Aqua','7FFFD4'=>'Aquamarine','F0FFFF'=>'Azure','F5F5DC'=>'Beige',
					'FFE4C4'=>'Bisque','000000'=>'Black','FFEBCD'=>'BlanchedAlmond','0000FF'=>'Blue','8A2BE2'=>'BlueViolet',
					'A52A2A'=>'Brown','DEB887'=>'BurlyWood','5F9EA0'=>'CadetBlue','7FFF00'=>'Chartreuse','D2691E'=>'Chocolate',
					'FF7F50'=>'Coral','6495ED'=>'CornflowerBlue','FFF8DC'=>'Cornsilk','DC143C'=>'Crimson','00FFFF'=>'Cyan'
					,'00008B'=>'DarkBlue','008B8B'=>'DarkCyan','B8860B'=>'DarkGoldenRod','A9A9A9'=>'DarkGray','006400'=>'DarkGreen',
					'BDB76B'=>'DarkKhaki','8B008B'=>'DarkMagenta','556B2F'=>'DarkOliveGreen','FF8C00'=>'DarkOrange',
					'9932CC'=>'DarkOrchid','8B0000'=>'DarkRed','E9967A'=>'DarkSalmon','8FBC8F'=>'DarkSeaGreen','483D8B'=>'DarkSlateBlue',
					'2F4F4F'=>'DarkSlateGray','00CED1'=>'DarkTurquoise','9400D3'=>'DarkViolet','FF1493'=>'DeepPink','00BFFF'=>'DeepSkyBlue',
					'696969'=>'DimGray','1E90FF'=>'DodgerBlue','B22222'=>'FireBrick','FFFAF0'=>'FloralWhite','228B22'=>'ForestGreen','FF00FF'=>'Fuchsia',
					'DCDCDC'=>'Gainsboro','F8F8FF'=>'GhostWhite','FFD700'=>'Gold','DAA520'=>'GoldenRod','808080'=>'Gray'
					,'008000'=>'Green','ADFF2F'=>'GreenYellow','F0FFF0'=>'HoneyDew','FF69B4'=>'HotPink','CD5C5C'=>'IndianRed',
					'4B0082'=>'Indigo','FFFFF0'=>'Ivory','F0E68C'=>'Khaki','E6E6FA'=>'Lavender','FFF0F5'=>'LavenderBlush','7CFC00'=>'LawnGreen',
					'FFFACD'=>'LemonChiffon','ADD8E6'=>'LightBlue','F08080'=>'LightCoral','E0FFFF'=>'LightCyan'
					,'FAFAD2'=>'LightGoldenRodYellow','D3D3D3'=>'LightGray','90EE90'=>'LightGreen','FFB6C1'=>'LightPink','FFA07A'=>'LightSalmon','20B2AA'=>'LightSeaGreen',
					'87CEFA'=>'LightSkyBlue','778899'=>'LightSlateGray','B0C4DE'=>'LightSteelBlue','FFFFE0'=>'LightYellow','00FF00'=>'Lime',
					'32CD32'=>'LimeGreen','FAF0E6'=>'Linen','FF00FF'=>'Magenta','800000'=>'Maroon','66CDAA'=>'MediumAquaMarine',
					'0000CD'=>'MediumBlue','BA55D3'=>'MediumOrchid','9370DB'=>'MediumPurple','3CB371'=>'MediumSeaGreen','7B68EE'=>'MediumSlateBlue',
					'00FA9A'=>'MediumSpringGreen','48D1CC'=>'MediumTurquoise','C71585'=>'MediumVioletRed','191970'=>'MidnightBlue','F5FFFA'=>'MintCream',
					'FFE4E1'=>'MistyRose','FFE4B5'=>'Moccasin','FFDEAD'=>'NavajoWhite','000080'=>'Navy'
					,'FDF5E6'=>'OldLace','808000'=>'Olive','6B8E23'=>'OliveDrab','FFA500'=>'Orange','FF4500'=>'OrangeRed','DA70D6'=>'Orchid',
					'EEE8AA'=>'PaleGoldenRod','98FB98'=>'PaleGreen','AFEEEE'=>'PaleTurquoise','DB7093'=>'PaleVioletRed','FFEFD5'=>'PapayaWhip',
					'FFDAB9'=>'PeachPuff','CD853F'=>'Peru','FFC0CB'=>'Pink','DDA0DD'=>'Plum'
					,'B0E0E6'=>'PowderBlue','800080'=>'Purple','FF0000'=>'Red','BC8F8F'=>'RosyBrown','4169E1'=>'RoyalBlue',
					'8B4513'=>'SaddleBrown','FA8072'=>'Salmon','F4A460'=>'SandyBrown','2E8B57'=>'SeaGreen','FFF5EE'=>'SeaShell','A0522D'=>'Sienna',
					'C0C0C0'=>'Silver','87CEEB'=>'SkyBlue','6A5ACD'=>'SlateBlue','708090'=>'SlateGray'
					,'FFFAFA'=>'Snow','00FF7F'=>'SpringGreen','4682B4'=>'SteelBlue','D2B48C'=>'Tan','008080'=>'Teal','D8BFD8'=>'Thistle',
					'FF6347'=>'Tomato','40E0D0'=>'Turquoise','EE82EE'=>'Violet','F5DEB3'=>'Wheat','FFFFFF'=>'White','F5F5F5'=>'WhiteSmoke',
					'FFFF00'=>'Yellow','9ACD32'=>'YellowGreen','185871'=>'185871');
			foreach($colorArray as $key => $value)
			{
				if($this->parentBg == $key){ $selCol	=	'selected'; }
				else{$selCol	=	''; } 
				$colorPick .= '<option value="'.$key.'" '.$selCol.'>'.$value.'</option>';
			}
			$speDisp	=	'';
			$speDisp	.=	"<table id='specfcatnTabl' style='width:280px;margin:5px 5px 10px 12px'>";
			$speDisp	.=  "<tr>";
			$speDisp	.=	"<td colspan='3' style='text-align:center'>Specifications</td>";
			$speDisp	.=	"</tr>";
			$speDisp	.=	"<tr height='5px'></tr>";
			$speDisp	.=	"<tr>";
			$speDisp	.=	"<td style='width:120px;text-align:left'>Name</td>";
			$speDisp	.=	"<td style='width:10px;text-align:left'>:</td>";
			$speDisp	.=	"<td style='width:150px;text-align:left'><input type='text' name='sepcName' id='sepcName' onchange='return chngeParSpec()' value='".$this->parName."'/></td>";
			$speDisp	.=	"</tr>";
			$speDisp	.=	"<tr height='5px'></tr>";
			$speDisp	.=	"<tr>";
			$speDisp	.=	"<td style='width:120px;text-align:left'>Width</td>";
			$speDisp	.=	"<td style='width:10px;text-align:left'>:</td>";
			$speDisp	.=	"<td style='width:150px;text-align:left'><input type='text' name='sepcWdth' id='sepcWdth' value='".$this->parWdth."'/></td>";
			$speDisp	.=	"</tr>";
			$speDisp	.=	"<tr height='5px'></tr>";
			$speDisp	.=	"<tr>";
			$speDisp	.=	"<td style='width:120px;text-align:left'>Height</td>";
			$speDisp	.=	"<td style='width:10px;text-align:left'>:</td>";
			$speDisp	.=	"<td style='width:150px;text-align:left'><input type='text' name='sepcHght' id='sepcHght' value='".$this->parHght."'/></td>";
			$speDisp	.=	"</tr>";
			$speDisp	.=	"<tr height='5px'></tr>";
			$speDisp	.=	"<tr>";
			$speDisp	.=	"<td style='width:120px;text-align:left'>Bg Color</td>";
			$speDisp	.=	"<td style='width:10px;text-align:left'>:</td>";
			$speDisp	.=	"<td style='width:150px;text-align:left'>
							<select id='sepcBgColor' name='sepcBgColor' onchange='return chngeParSpec()' style='width:120px'>
								$colorPick
							</select>";
			$speDisp	.=	"</tr>";
			$speDisp	.=	"<tr height='5px'></tr>";
			$speDisp	.=	"<tr>";
			$speDisp	.=	"<td style='width:120px;text-align:left'>Bg Image</td>";
			$speDisp	.=	"<td style='width:10px;text-align:left'>:</td>";
			$speDisp	.=	"<td style='width:150px;text-align:left'>
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
			$chldspeDisp	.=	"<table id='specfcatnTabl' style='width:280px;margin:5px 5px 10px 12px'>";
			$chldspeDisp	.=  "<tr>";
			$chldspeDisp	.=	"<td colspan='3' style='text-align:center'>Specifications<input type='hidden' name='chldCnt' id='chldCnt' value='".$this->childNo."'></td>";
			$chldspeDisp	.=	"</tr>";
			$chldspeDisp	.=	"<tr height='5px'></tr>";
			$chldspeDisp	.=	"<tr>";
			$chldspeDisp	.=	"<td style='width:120px;text-align:left'>Width</td>";
			$chldspeDisp	.=	"<td style='width:10px;text-align:left'>:</td>";
			$chldspeDisp	.=	"<td style='width:150px;text-align:left'><input type='text' name='chldWdth' id='chldWdth' onchange='return chngChldSpec($this->childNo,$this->childCntType)' value='".$this->chldWdth."'/></td>";
			$chldspeDisp	.=	"</tr>";
			$chldspeDisp	.=	"<tr height='5px'></tr>";
			$chldspeDisp	.=	"<tr>";
			$chldspeDisp	.=	"<td style='width:120px;text-align:left'>Height</td>";
			$chldspeDisp	.=	"<td style='width:10px;text-align:left'>:</td>";
			$chldspeDisp	.=	"<td style='width:150px;text-align:left'><input type='text' name='chldHght' id='chldHght' onchange='return chngChldSpec($this->childNo,$this->childCntType)' value='".$this->chldHght."'/></td>";
			$chldspeDisp	.=	"</tr>";
			$chldspeDisp	.=	"<tr height='5px'></tr>";
			$chldspeDisp	.=	"<tr>";
			$chldspeDisp	.=	"<td style='width:120px;text-align:left'>X-Cordinate</td>";
			$chldspeDisp	.=	"<td style='width:10px;text-align:left'>:</td>";
			$chldspeDisp	.=	"<td style='width:150px;text-align:left'><input type='text' name='childX' id='childX' value='".$this->childX."' readonly/></td>";
			$chldspeDisp	.=	"</tr>";
			$chldspeDisp	.=	"<tr height='5px'></tr>";
			$chldspeDisp	.=	"<tr>";
			$chldspeDisp	.=	"<td style='width:120px;text-align:left'>Y-Cordinate</td>";
			$chldspeDisp	.=	"<td style='width:10px;text-align:left'>:</td>";
			$chldspeDisp	.=	"<td style='width:150px;text-align:left'><input type='text' name='childY' id='childY' value='".$this->childY."' readonly/></td>";
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
				$colorArray2 = array('F0F8FF'=>'AliceBlue ','FAEBD7'=>'AntiqueWhite ','00FFFF'=>'Aqua','7FFFD4'=>'Aquamarine','F0FFFF'=>'Azure','F5F5DC'=>'Beige',
					'FFE4C4'=>'Bisque','000000'=>'Black','FFEBCD'=>'BlanchedAlmond','0000FF'=>'Blue','8A2BE2'=>'BlueViolet',
					'A52A2A'=>'Brown','DEB887'=>'BurlyWood','5F9EA0'=>'CadetBlue','7FFF00'=>'Chartreuse','D2691E'=>'Chocolate',
					'FF7F50'=>'Coral','6495ED'=>'CornflowerBlue','FFF8DC'=>'Cornsilk','DC143C'=>'Crimson','00FFFF'=>'Cyan'
					,'00008B'=>'DarkBlue','008B8B'=>'DarkCyan','B8860B'=>'DarkGoldenRod','A9A9A9'=>'DarkGray','006400'=>'DarkGreen',
					'BDB76B'=>'DarkKhaki','8B008B'=>'DarkMagenta','556B2F'=>'DarkOliveGreen','FF8C00'=>'DarkOrange',
					'9932CC'=>'DarkOrchid','8B0000'=>'DarkRed','E9967A'=>'DarkSalmon','8FBC8F'=>'DarkSeaGreen','483D8B'=>'DarkSlateBlue',
					'2F4F4F'=>'DarkSlateGray','00CED1'=>'DarkTurquoise','9400D3'=>'DarkViolet','FF1493'=>'DeepPink','00BFFF'=>'DeepSkyBlue',
					'696969'=>'DimGray','1E90FF'=>'DodgerBlue','B22222'=>'FireBrick','FFFAF0'=>'FloralWhite','228B22'=>'ForestGreen','FF00FF'=>'Fuchsia',
					'DCDCDC'=>'Gainsboro','F8F8FF'=>'GhostWhite','FFD700'=>'Gold','DAA520'=>'GoldenRod','808080'=>'Gray'
					,'008000'=>'Green','ADFF2F'=>'GreenYellow','F0FFF0'=>'HoneyDew','FF69B4'=>'HotPink','CD5C5C'=>'IndianRed',
					'4B0082'=>'Indigo','FFFFF0'=>'Ivory','F0E68C'=>'Khaki','E6E6FA'=>'Lavender','FFF0F5'=>'LavenderBlush','7CFC00'=>'LawnGreen',
					'FFFACD'=>'LemonChiffon','ADD8E6'=>'LightBlue','F08080'=>'LightCoral','E0FFFF'=>'LightCyan'
					,'FAFAD2'=>'LightGoldenRodYellow','D3D3D3'=>'LightGray','90EE90'=>'LightGreen','FFB6C1'=>'LightPink','FFA07A'=>'LightSalmon','20B2AA'=>'LightSeaGreen',
					'87CEFA'=>'LightSkyBlue','778899'=>'LightSlateGray','B0C4DE'=>'LightSteelBlue','FFFFE0'=>'LightYellow','00FF00'=>'Lime',
					'32CD32'=>'LimeGreen','FAF0E6'=>'Linen','FF00FF'=>'Magenta','800000'=>'Maroon','66CDAA'=>'MediumAquaMarine',
					'0000CD'=>'MediumBlue','BA55D3'=>'MediumOrchid','9370DB'=>'MediumPurple','3CB371'=>'MediumSeaGreen','7B68EE'=>'MediumSlateBlue',
					'00FA9A'=>'MediumSpringGreen','48D1CC'=>'MediumTurquoise','C71585'=>'MediumVioletRed','191970'=>'MidnightBlue','F5FFFA'=>'MintCream',
					'FFE4E1'=>'MistyRose','FFE4B5'=>'Moccasin','FFDEAD'=>'NavajoWhite','000080'=>'Navy'
					,'FDF5E6'=>'OldLace','808000'=>'Olive','6B8E23'=>'OliveDrab','FFA500'=>'Orange','FF4500'=>'OrangeRed','DA70D6'=>'Orchid',
					'EEE8AA'=>'PaleGoldenRod','98FB98'=>'PaleGreen','AFEEEE'=>'PaleTurquoise','DB7093'=>'PaleVioletRed','FFEFD5'=>'PapayaWhip',
					'FFDAB9'=>'PeachPuff','CD853F'=>'Peru','FFC0CB'=>'Pink','DDA0DD'=>'Plum'
					,'B0E0E6'=>'PowderBlue','800080'=>'Purple','FF0000'=>'Red','BC8F8F'=>'RosyBrown','4169E1'=>'RoyalBlue',
					'8B4513'=>'SaddleBrown','FA8072'=>'Salmon','F4A460'=>'SandyBrown','2E8B57'=>'SeaGreen','FFF5EE'=>'SeaShell','A0522D'=>'Sienna',
					'C0C0C0'=>'Silver','87CEEB'=>'SkyBlue','6A5ACD'=>'SlateBlue','708090'=>'SlateGray'
					,'FFFAFA'=>'Snow','00FF7F'=>'SpringGreen','4682B4'=>'SteelBlue','D2B48C'=>'Tan','008080'=>'Teal','D8BFD8'=>'Thistle',
					'FF6347'=>'Tomato','40E0D0'=>'Turquoise','EE82EE'=>'Violet','F5DEB3'=>'Wheat','FFFFFF'=>'White','F5F5F5'=>'WhiteSmoke',
					'FFFF00'=>'Yellow','9ACD32'=>'YellowGreen','185871'=>'185871');
				foreach($colorArray2 as $key2 => $value2)
				{
					if($this->childTextClr == $key2){ $selCol	=	'selected'; }
					else{$selCol	=	''; } 
					$colorPick2 .= '<option value="'.$key2.'" '.$selCol.'>'.$value2.'</option>';
				}
				$chldspeDisp	.=	"<tr>";
				$chldspeDisp	.=	"<td style='width:120px;text-align:left'>Text</td>";
				$chldspeDisp	.=	"<td style='width:10px;text-align:left'>:</td>";
				$chldspeDisp	.=	"<td style='width:150px;text-align:left'>
										<textarea name='chldTxt$this->childNo' id='chldTxt$this->childNo' onchange='return changeChildText($this->childNo,$this->childCntType)' style='resize:none'>$this->childText</textarea>
									</td>";
				$chldspeDisp	.=	"</tr>";
				$chldspeDisp	.=	"<tr height='5px'></tr>";
				$chldspeDisp	.=	"<tr>";
				$chldspeDisp	.=	"<td style='width:120px;text-align:left'>Color</td>";
				$chldspeDisp	.=	"<td style='width:10px;text-align:left'>:</td>";
				$chldspeDisp	.=	"<td style='width:150px;text-align:left'>
										<select name='chldTxtClr$this->childNo' id='chldTxtClr$this->childNo' onchange='return changeChildTextClr($this->childNo,$this->childCntType)' style='width:120px'>
											$colorPick2
										</select>
									</td>";
				$chldspeDisp	.=	"</tr>";
				$chldspeDisp	.=	"<tr height='5px'></tr>";
				$chldspeDisp	.=	"<tr>";
				$chldspeDisp	.=	"<td style='width:120px;text-align:left'>Size</td>";
				$chldspeDisp	.=	"<td style='width:10px;text-align:left'>:</td>";
				$chldspeDisp	.=	"<td style='width:150px;text-align:left'>
										<select name='chldTxtSize$this->childNo' id='chldTxtSize$this->childNo' onchange='return changeChildTextSize($this->childNo,$this->childCntType)' style='width:120px'>
											$Sizeoption
										</select>
									</td>";
				$chldspeDisp	.=	"</tr>";
				$chldspeDisp	.=	"<tr height='5px'></tr>";
				$chldspeDisp	.=	"<tr>";
				$chldspeDisp	.=	"<td style='width:120px;text-align:left'>Style</td>";
				$chldspeDisp	.=	"<td style='width:10px;text-align:left'>:</td>";
				$chldspeDisp	.=	"<td style='width:150px;text-align:left'>
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
				$chldspeDisp	.=	"<td style='width:120px;text-align:left'>Image</td>";
				$chldspeDisp	.=	"<td style='width:10px;text-align:left'>:</td>";
				$chldspeDisp	.=	"<td style='width:150px;text-align:left'>
										<form name='childImgFrm' method='post' autocomplete='off' enctype='multipart/form-data'>
										<input type='file' name='chldImg' id='chldImg' onchange='return ChldBgImgURL(this,$this->childNo,$this->childCntType)'/>
										<input type='hidden' name='chldImgName$this->childNo' id='chldImgName$this->childNo' value='".$this->childImgPath."' /></form>
									</td>";
				$chldspeDisp	.=	"</tr>";
			}
			else if($this->childCntType == 3){
				/*$chldspeDisp	.=	"<tr>";
				$chldspeDisp	.=	"<td style='width:120px;text-align:left'>Video Path</td>";
				$chldspeDisp	.=	"<td style='width:10px;text-align:left'>:</td>";
				$chldspeDisp	.=	"<td style='width:150px;text-align:left'><input type='text' name='childVdoPath$this->childNo' id='childVdoPath$this->childNo' onchange='return changeChildVdo($this->childNo,$this->childCntType)' value='$this->childVdoPath'/></td>";
				$chldspeDisp	.=	"</tr>";*/
				
				$chldspeDisp	.=	"<tr>";
				$chldspeDisp	.=	"<td style='width:120px;text-align:left'>Video</td>";
				$chldspeDisp	.=	"<td style='width:10px;text-align:left'>:</td>";
				$chldspeDisp	.=	"<td style='width:150px;text-align:left'>
										<form name='childImgFrm' method='post' autocomplete='off' enctype='multipart/form-data'>
										<input type='file' name='childVdoPath' id='childVdoPath' onchange='return changeChildVdo(this,$this->childNo,$this->childCntType)'/>
										<input type='hidden' name='childVdoPath$this->childNo' id='childVdoPath$this->childNo' value='".$this->childVdoPath."' /></form></td>";
				$chldspeDisp	.=	"</tr>";
			}
			else if($this->childCntType == 4){
				$chldspeDisp	.=	"<tr>";
				$chldspeDisp	.=	"<td style='width:120px;text-align:left'>Bg Image</td>";
				$chldspeDisp	.=	"<td style='width:10px;text-align:left'>:</td>";
				$chldspeDisp	.=	"<td style='width:150px;text-align:left'>
										<form name='childRefImgFrm' method='post' autocomplete='off' enctype='multipart/form-data'>
										<input type='file' name='chldRefBgImg' id='chldRefBgImg' onchange='return ChldRefBgImgURL(this,$this->childNo,$this->childCntType)'/>
										<input type='hidden' name='chldRefBgImg$this->childNo' id='chldRefBgImg$this->childNo' value='".$this->childRefLinkBg."' /></form>
									</td>";
				$chldspeDisp	.=	"</tr>";
			
				$chldspeDisp	.=	"<tr>";
				$chldspeDisp	.=	"<td style='width:120px;text-align:left'>Link</td>";
				$chldspeDisp	.=	"<td style='width:10px;text-align:left'>:</td>";
				$chldspeDisp	.=	"<td style='width:150px;text-align:left'><input type='text' name='childRefLink$this->childNo' id='childRefLink$this->childNo' value='$this->childRefLink' onchange='return chngChldSpec($this->childNo,$this->childCntType)'/></td>";
				$chldspeDisp	.=	"</tr>";
			}
			$chldspeDisp	.=	"<tr height='5px'></tr>";
			$chldspeDisp	.=	"<tr>";
			$chldspeDisp	.=	"<td style='width:120px;text-align:left'>Delete Child</td>";
			$chldspeDisp	.=	"<td style='width:10px;text-align:left'>:</td>";
			$chldspeDisp	.=	"<td style='width:150px;text-align:left'>
									<a href='javascript:void(0)' name='delChild' id='delChild' onclick='return delChild($this->childNo,$this->childCntType)'>
										<img src='images/del.png' />
									</a>
								</td>";
			$chldspeDisp	.=	"</tr>";
			$chldspeDisp	.=	"</table>";
			
			return $chldspeDisp;
		}
	}
?>