<?php
	/***********************************************************************************************************
											CONTENT CLASS
	************************************************************************************************************/
	class contentClass
	{
		private $name;
		private $addedDate;
		private $updatedDate;
		private $status;
		private $contentCunt;
		private $parents 	= 	array();
		private $content	=	array();
		function  _construct()
		{
		
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
			
			//--------------------------------- Sql Statement Save parent Query ----------------------------------------------------//
			
			
			//---------------------------------------------------------------------------------------------------------------------//
			
			/*$data	=	'<br>Slide Name:'.$parentName.' CreatedDate:'.$parentCretedDte.' Width:'.$parentWidth.' Height:'.$parentheight;
			return $data;*/
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
			$speDisp	.=	"<td><input type='text' name='sepcBgColor' id='sepcBgColor' onchange='return chngeParSpec()' value='".$this->parentBg."'/></td>";
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
		private $childCntType;	// Type of child content 1: Test; 2: Image
		private $childImgPath;
		private $childText;
		function  _construct()
		{
		
		}
		//------------------------------------------ Function To Add Child Specification ---------------------------------------------------//
		public function addChildSpecification($childName,$childCretedDte,$childUpdtedDte,$childWidth,$childheight,$childNo,$childX,$childY,$childCntType,$childText,$childImgPath)
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
		}
		public function saveChildData()
		{
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
			$childImgPath	=	$this->childImgPath;
			
			//-------------------------------- Query to add Child Data ---------------------------------------------//
			
			//------------------------------------------------------------------------------------------------------//
			
			/*$data11	=	$childX.'==='.$childY.'=='.$childText.'==='.$childImgPath;
			return $data11;*/
		}
		//------------------------------------------------- Function to Get Child Specification ----------------------------------------------//
		public function getChildSpecification()
		{
			$chldspeDisp	=	'';
			$chldspeDisp	.=	"<table id='specfcatnTabl'>";
			$chldspeDisp	.=  "<tr>";
			$chldspeDisp	.=	"<td colspan='3' style='text-align:center'>Specifications<input type='hidden' name='chldCnt' id='chldCnt' value='".$this->childNo."'></td>";
			$chldspeDisp	.=	"</tr>";
			/*$chldspeDisp	.=	"<tr height='5px'></tr>";
			$chldspeDisp	.=	"<tr>";
			$chldspeDisp	.=	"<td>Name</td>";
			$chldspeDisp	.=	"<td>:</td>";
			$chldspeDisp	.=	"<td><input type='text' name='chldName' id='chldName' onchange='return changeWdth()' value='".$this->chldName."'/></td>";
			$chldspeDisp	.=	"</tr>";*/
			$chldspeDisp	.=	"<tr height='5px'></tr>";
			$chldspeDisp	.=	"<tr>";
			$chldspeDisp	.=	"<td>Width</td>";
			$chldspeDisp	.=	"<td>:</td>";
			$chldspeDisp	.=	"<td><input type='text' name='chldWdth' id='chldWdth' onchange='return chngChldSpec($this->childNo)' value='".$this->chldWdth."'/></td>";
			$chldspeDisp	.=	"</tr>";
			$chldspeDisp	.=	"<tr height='5px'></tr>";
			$chldspeDisp	.=	"<tr>";
			$chldspeDisp	.=	"<td>Height</td>";
			$chldspeDisp	.=	"<td>:</td>";
			$chldspeDisp	.=	"<td><input type='text' name='chldHght' id='chldHght' onchange='return chngChldSpec($this->childNo)' value='".$this->chldHght."'/></td>";
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
			$chldspeDisp	.=	"<tr>";
			$chldspeDisp	.=	"<td>Content</td>";
			$chldspeDisp	.=	"<td>:</td>";
			$chldspeDisp	.=	"<td>
									<select name='chldCntSel' id='chldCntSel' onchange='return displyChdCont($this->childNo)'>
										<option value=''>Select</option>
										<option value='1'>Text</option>
										<option value='2'>Image</option>
									</select>
								</td>";
			$chldspeDisp	.=	"</tr>";
			$chldspeDisp	.=	"<tr height='5px'></tr>";
			$chldspeDisp	.=  "<tr id='chldTxtCnt' style='display:none'>";
			$chldspeDisp	.=	"<td colspan='3' style='text-align:center'>
									<textarea name='chldTxt' id='chldTxt' onchange='return changeChildText($this->childNo)'>$this->childText</textarea>
								</td>";
			$chldspeDisp	.=	"</tr>";
			$chldspeDisp	.=	"<tr height='5px'></tr>";
			$chldspeDisp	.=  "<tr id='chldImgCnt' style='display:none'>";
			$chldspeDisp	.=	"<td colspan='3' style='text-align:center'>
									<form name='childImgFrm' method='post' autocomplete='off' enctype='multipart/form-data'>
									<input type='file' name='chldImg' id='chldImg' onchange='return ChldBgImgURL(this,$this->childNo)'/>
									<input type='text' name='chldImgName' id='chldImgName' value='".$this->childImgPath."' /></form>
								</td>";
			$chldspeDisp	.=	"</tr>";
			$chldspeDisp	.=	"</table>";
			
			return $chldspeDisp;
		}
	}
?>