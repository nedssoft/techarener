<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/autoloader/Autoloader.php';
/**
* 
*/
class CommentModel extends Connection
{   public $conn;
	
	function __construct()
	{
		$this->conn  = $this->getConnection();
	}

	public function insertComment($postId, $username, $comment)
	{  
		$comment =  $this->conn->real_escape_string($comment);

		$sql = "insert into comments(`post_id`, `username`, `comment`) VALUES($postId, '$username', '$comment')";
		$this->conn->select_db($this->dbName);

		if ($this->conn->connect_error){

			die("failed to connect to database". $this->conn->error);
		}
		else{

			if (!$this->conn->query($sql)){
				die("failed to insert comment". $this->conn->error);
			}

			else{
				return true;
			}
		}
	}
	public function fetchComments($postId)
	{
		$data = [];
        $sql = "select * from comments where post_id = $postId";
		$this->conn->select_db($this->dbName);

		if ($this->conn->connect_error){
			die($this->conn->error);
		}

		$result= $this->conn->query($sql);
		if (!empty($result)){

			while($ufetched = $result->fetch_assoc()){

				$data[] = $ufetched;
			}
			return $data;
		}

		else{
			return null;
		}
    
	}
}