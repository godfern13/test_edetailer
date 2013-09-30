<?php
	/*************************** Presentation Class *************************************/
	class contentClass
	{
		private $name;
		private $addedDate;
		private $updatedDate;
		private $status;
		private $parents = array();
		function  _construct()
		{
		
		}
		public function saveContent()
		{
			
		}
		public function addParents($parent)
		{
			array_push($this->parents,$parent);
		}
		public function displayParent($msg)
		{
			foreach($this->parents as $parnt)
			{
				echo $result	=	$parnt;
			}
		}
	}
	/*************************************** Parent Classs ***********************************/
	class parentClass
	{
		private $parentName;
		private $parentCretedDte;
		private $parentUpdtedDte;
		private	$parentWidth;
		private	$parentheight;
		private $childCount;
		private $childArray = array();
		function  _construct()
		{
		
		}
		public function countParent()
		{
			$this->childArray	=	$childArray;
			$parentCount	=	count($this->childArray);
			return $parentCount;
		}
		public function addParents($parent)
		{
			array_push($this->parents,$parent);
		}
		public function displayParent($msg)
		{
			foreach($this->parents as $parnt)
			{
				echo $result	=	$parnt;
			}
		}
	}
?>