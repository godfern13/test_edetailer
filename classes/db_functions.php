<?php

class DB_Functions {

    private $db;

    //put your code here
    // constructor
    function __construct() {
        include_once 'db_connect.php';
        // connecting to database
        $this->db = new DB_Connect();
        $this->db->connect();
    }

    // destructor
    function __destruct() {
        
    }

    
	/**
     * Getting Brand details
     */
    /*public function getAllBrands($id) {
		$query 	= "	SELECT brand.id,brand.name,brand.added_on,brand.updated_on
					FROM brand
					INNER JOIN user_vs_brands ON brand.id = user_vs_brands.brand_id
					WHERE brand.id = ".$id." AND brand.del_flag = 0";
        //echo $query;
		$result = mysql_query($query)or die(mysql_error());
        return $result;
    }*/
	
	/**
     * Adding new presentations
     * 
     */
    public function storePresentaions($contentId, $name,$brandId) {
        // insert content into database
        $query1 	= "	INSERT INTO content(id,name)VALUES(".$contentId.",'".$name."')";
		$result = mysql_query($query1)or die(mysql_error());
		if ($result) {
            // get content details
            $id = mysql_insert_id(); // last inserted id
			
			//Inserting into mapping table
			$query2 	= "	INSERT INTO brand_vs_contents(brand_id ,content_id)VALUES(".$brandId.",".$id.")";
			$result = mysql_query($query2)or die(mysql_error());
			
			return $id;
		}
		else {
            return false;
        }
	}	
	
	/**
     * Getting Presenatation details
     */
    public function getAllPresenatations($id) {
		$query 	= "	SELECT content.id,content.name,content.downld_status,content.isPublished,content.added_on,content.updated_on
					FROM  content
					INNER JOIN brand_vs_contents ON content.id = brand_vs_contents.content_id 
					INNER JOIN brand ON brand_vs_contents.brand_id = brand.id
					INNER JOIN user_vs_brands ON brand.id = user_vs_brands.brand_id 
					INNER JOIN users ON user_vs_brands.user_id = users.id
					WHERE brand.id = 1 AND users.id= ".$id." AND content.del_flag = 0";
        $result = mysql_query($query)or die(mysql_error());
        return $result;
    }
	
	/**
     * Getting Presenatation Name
     */
    public function getPresentatnName($id) {
		$query 	= "	SELECT name
					FROM  content
					WHERE id= ".$id." AND del_flag = 0";
        $result = mysql_query($query)or die(mysql_error());
        return $result;
    }
	
	/**
	*Deleting Presentation
	*/	
	public function delete_presentation($id){
		
		$contentId = $id;
		$callSlidesDelete = $this->delete_slides($contentId);
		
		//Updating/Deleting a presentation
		$updateQuery 	= "UPDATE content SET del_flag = 1 WHERE id = ".$contentId." ";
		$result			= mysql_query($updateQuery) or die(mysql_error());
		return true;
	}
	
	/**
	*Checking Presentation Name
	*/	
	public function check_presentation($id,$name){
		
		$contentId = $id;
		if($contentId == ''){
			$query 	= "	SELECT content.id FROM content WHERE content.name='".$name."' AND content.del_flag = 0";
			$result = mysql_query($query)or die(mysql_error());
			$nums	= mysql_num_rows($result);
			return $nums;
		}
		else{
			$query 	= "	SELECT content.id FROM content WHERE content.name='".$name."' AND content.id !=".$contentId." AND content.del_flag = 0";
			$result = mysql_query($query)or die(mysql_error());
			$nums	= mysql_num_rows($result);
			return $nums;		
		}
	}
	
	/**
     * Adding new Slides
     * 
     */
    public function storeSlide($prntId,$contentId, $name) {
        // insert content into database
		$query 	= "	INSERT INTO parent(id,content_id,name)VALUES(".$prntId.",".$contentId.",'".$name."')";
		$result = mysql_query($query)or die(mysql_error());
		if ($result) {
            // get content details
            $id = mysql_insert_id(); // last inserted id
			return $id;
		}
		else {
            return false;
        }
	}
	
	
	/**
     * Getting Slide details
     */
    public function getSlides($id) {
		$query 	= "	SELECT parent.id,parent.content_id,parent.name,parent.frame,parent.content_url,parent.has_childs,parent.added_on,parent.updated_on FROM parent WHERE parent.content_id = ".$id." AND parent.del_flag=0";
        $result = mysql_query($query)or die(mysql_error());
        return $result;
    }
	
	/**
	*Checking Slide Name
	*/	
	public function check_slide($id,$name){
		
		$parentId = $id;
		if($parentId == ''){
			$query 	= "	SELECT parent.id FROM parent WHERE parent.name='".$name."' AND parent.del_flag = 0";
			$result = mysql_query($query)or die(mysql_error());
			$nums	= mysql_num_rows($result);
			return $nums;
		}
		else{
			$query 	= "	SELECT parent.id FROM parent WHERE parent.name='".$name."' AND parent.id !=".$parentId." AND parent.del_flag = 0";
			$result = mysql_query($query)or die(mysql_error());
			$nums	= mysql_num_rows($result);
			return $nums;		
		}
	}

    /**
     * Get user profile details
     */
    public function getUserProfile($id) {
		$query 	= "SELECT * FROM users WHERE id = ".$id." AND del_flag= 0";
        $result = mysql_query($query)or die(mysql_error());
        return $result;
    }	
	
	
	/**
	*Deleting Slide
	*/
	public function delete_slides($id){
	
		$contentId = $id;
		
		//Checking if presentations have slides
		$selectQuery 	= "SELECT id FROM parent WHERE content_id = ".$contentId." AND del_flag= 0";
		$result			= mysql_query($selectQuery)or die(mysql_error());
		$num_row		= mysql_num_rows($result);
		
		//if yes-->then deleting the children first
		if($num_row > 0)
		{
			while($row	= mysql_fetch_assoc($result))
			{
				$parentId 			= $row['id'];
				$callChildDelete 	= $this->delete_child($parentId);				
			}			
		}
		else
		{
			//No Slides
		}
		
		//Updating/Deleting slide of a presentation
		$updateQuery 	= "UPDATE parent SET del_flag = 1 WHERE content_id = ".$contentId." ";
		$result			= mysql_query($updateQuery) or die(mysql_error());
		
	}
	
	/**
	*Deleting Child
	*/	
	function delete_child($id){
	
		$parentId = $id;
		
		//Updating/Deleting child of a slide
		$updateQuery 	= "UPDATE child SET del_flag = 1 WHERE parent_id = ".$parentId." ";
		$result			= mysql_query($updateQuery) or die(mysql_error());				
	}
	
	
	
}

?>