<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/autoloader/Autoloader.php';

class PostModel extends Connection
{
	public $conn;

	function __construct()
	{
		$this->conn = $this->getConnection();

	}

	public function insertpost($table, $userId, $title, $tag, $post, $image){
		$title = $this->conn->real_escape_string($title);
		$tag =   $this->conn->real_escape_string($tag);
		$post =  $this->conn->real_escape_string($post);

		$sql = "insert into $table(`user_id`, `title`, `tag`, `post`, `image`) VALUES($userId, '$title', '$tag', '$post', '$image')";
		$this->conn->select_db($this->dbName);

		if ($this->conn->connect_error){

			die("failed to connect to database". $this->conn->error);
		}
		else{

			if (!$this->conn->query($sql)){
				die("failed to insert into posts". $this->conn->error);
			}

			else{
				return true;
			}
		}


	}

	public function approvePost($postId){
		$sql = "update posts set status = 1 where id = $postId order by post_date desc";
		$this->conn->select_db($this->dbName);

		if ($this->conn->connect_error){
			die($this->conn->error);
		}

		return $this->conn->query($sql);
	}

	public function fetchUnApprovedPost()
	{
		$data = [];

		$sql= "select * from posts where status = 0 order by post_date desc";
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

	public function fetchApprovedPost(){
     
        $data = [];
		$sql= "select * from posts where status = 1 order by post_date desc";
		$this->conn->select_db($this->dbName);

		if ($this->conn->connect_error){
			die($this->conn->error);
		}

		$result = $this->conn->query($sql);
		if($result)
		{
			while( $fetched = $result->fetch_assoc()){

				$data[] = $fetched;
			}

			return $data;
		}

		else{
			return null;
		}
	}

	public function deletePost($postId){
		$sql = "delete from posts where id = $postId";
		$this->conn->select_db($this->dbName);

		if ($this->conn->connect_error){
			die($this->conn->error);
		}
		return $this->conn->query($sql);
	}

	public function fetchDetail($postId) {
		$sql = "select * from posts where id = $postId";
        $this->conn->select_db($this->dbName);
		if ($this->conn->connect_error){
			die($this->conn->error);
		}

		$result = $this->conn->query($sql);
		if ($result){
		return  $result->fetch_assoc();
	}
	else {

		die($this->conn->error);
	  }
	}

	public function getFullname($userId){

		$sql = "select fullname from users where id = $userId";

        $this->conn->select_db($this->dbName);

		if ($this->conn->connect_error){

			die($this->conn->error);
		}

		return $this->conn->query($sql)->fetch_assoc();
	}

	public function editPost($postId, $title, $tag, $post){
		$title = $this->conn->real_escape_string($title);
		$tag =   $this->conn->real_escape_string($tag);
		$post =  $this->conn->real_escape_string($post);

		$sql = "update posts set title = '$title', tag = '$tag', post = '$post' where id = '$postId'";


        $this->conn->select_db($this->dbName);

		if ($this->conn->connect_error){
			die($this->conn->error);
	}  


	   if (!$this->conn->query($sql)){

	   	die($this->conn->error);
	   }

	   else{
	   	return true;
	   }

    }

    public function userEditPost($postId, $title, $tag, $post){
		$title = $this->conn->real_escape_string($title);
		$tag =   $this->conn->real_escape_string($tag);
		$post =  $this->conn->real_escape_string($post);

		$sql = "UPDATE posts set title = '$title', tag = '$tag', post = '$post', status = 0 where id = '$postId'";


        $this->conn->select_db($this->dbName);

		if ($this->conn->connect_error){
			die($this->conn->error);
	}  


	   if (!$this->conn->query($sql)){

	   	die($this->conn->error);
	   }

	   else{
	   	return true;
	   }

    }


    
    public function insertImage($postId)
    {
    	$sql = "update posts set image = '".$postId."'";
    	$this->conn->select_db($this->dbName);

		if ($this->conn->connect_error){

			die("failed to connect to database". $this->conn->error);
		}
		else{

			if (!$this->conn->query($sql)){
				die("failed to insert into posts". $this->conn->error);
			}

			else{
				return true;
			}
		}
        
    }

    public function getImage($postId){
    	$sql = "select image from posts where id = $postId";
    	 $this->conn->select_db($this->dbName);

		if ($this->conn->connect_error){

			die($this->conn->error);
		}

		return $this->conn->query($sql)->fetch_assoc();
    }

    public function editImage($postId, $image){
		$sql = "update posts set image = '$image' where id = $postId";
		$this->conn->select_db($this->dbName);

		if ($this->conn->connect_error){
			die($this->conn->error);
		}

		return $this->conn->query($sql);
	}

	 public function UserEditImage($postId, $image){
		$sql = "update posts set image = '$image', status =0 where id = $postId";
		$this->conn->select_db($this->dbName);

		if ($this->conn->connect_error){
			die($this->conn->error);
		}

		return $this->conn->query($sql);
	}


	public function fetchAllPostFromUser($userId){
     
        $data = [];
		$sql= "select * from posts where user_id = $userId order by post_date desc";
		$this->conn->select_db($this->dbName);

		if ($this->conn->connect_error){
			die($this->conn->error);
		}

		$result = $this->conn->query($sql);
		if($result)
		{
			while( $fetched = $result->fetch_assoc()){

				$data[] = $fetched;
			}

			return $data;
		}

		else{
			return null;
		}
	}

	public function relatedPosts($tag)
	{    $data = [];
		$sql = "SELECT * from posts where status = 1 AND tag = '$tag' or post like '%$tag' order by post_date desc";
		$this->conn->select_db($this->dbName);

		if ($this->conn->connect_error){
			die($this->conn->error);
		}

		$result = $this->conn->query($sql);
		if($result)
		{
			while( $fetched = $result->fetch_assoc()){

				$data[] = $fetched;
			}

			return $data;
		}

		else{
			return null;
		}

	}
	public function fetchMostRecentPost()
	{
		 $data = [];
		$sql = "SELECT * FROM posts WHERE status = 1 ORDER BY post_date DESC LIMIT 5";

		$this->conn->select_db($this->dbName);

		if ($this->conn->connect_error){
			die($this->conn->error);
		}

		$result = $this->conn->query($sql);
		if($result)
		{
			while( $fetched = $result->fetch_assoc()){

				$data[] = $fetched;
			}

			return $data;
		}

		else{
			return null;
		}

	}


}
	
	


