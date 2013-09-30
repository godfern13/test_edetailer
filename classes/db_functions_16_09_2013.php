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
     * Storing new presentations
     * 
     */
    public function storePresentaions($contentId, $name) {
        // insert content into database
        $query 	= "	INSERT INTO content(id,name)VALUES(".$contentId.",'".$name."')";
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
     * Getting Presenatation details
     */
    public function getAllPresenatations() {
		$query 	= "	SELECT content.id,content.name,content.downld_status,content.isPublished,content.added_on,content.updated_on
					FROM content
					WHERE content.del_flag = 0";
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
     * Getting Slide details
     */
    public function getSlides($id) {
		$query 	= "	SELECT parent.id,parent.content_id,parent.name,parent.frame,parent.content_url,parent.has_childs,parent.added_on,parent.updated_on FROM parent WHERE parent.content_id = ".$id." AND parent.del_flag=0";
        $result = mysql_query($query)or die(mysql_error());
        return $result;
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