<?php
/**
 * General Class 
 * 
 */
class general {
	function setFormField($formField)		
	{
		$formField=strtolower(trim(str_replace("'",'"',$formField)));
		return $formField;
	}
	
	function getFormField($formField)		
	{
		$formField=ucwords(trim(str_replace('"',"'",$formField)));
		return $formField;
	}
	
	function encrypt($string)
	 {
		$result = "";
		for($i=0; $i<strlen($string); $i++)
		{
			$char = substr($string, $i, 1);
			//$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char));
			$result.=$char;
		}
		return base64_encode($result);
	}

	function decrypt($string)
	{
		$result = "";
		$string = base64_decode($string);
		for($i=0; $i<strlen($string); $i++)
		{
			$char = substr($string, $i, 1);
			//$keychar = substr($key, ($i % strlen($key))-1, 1);
			$char = chr(ord($char));
			$result.=$char;
		}
		return $result;
	}
	
	function getPK($tableName,$columnName)
	{
		$strQry="select coalesce(max(".$columnName."),0)+1 as PK from ".$tableName;
		$result = mysql_query($strQry);
		$row = mysql_fetch_array($result);
		return $row[0];
	}
}