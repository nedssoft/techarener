<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'].'/autoloader/Autoloader.php';
date_default_timezone_set('Africa/Lagos');
class PostController
{

	public $title;
	Public $tag;
	public $post;
	public $userId;
    public $imageKey = null;
	public $model;
	public $dir;
	function __construct(){
        $this->dir=$_SERVER['DOCUMENT_ROOT'].'/uploads';
		$this->model =  new PostModel();		
    }

/**
*This function extracts the data submitted from the post form
*It calls the validateImage() wchich checks if an image was attached
*Image is optional,
*It calls the validate() function
*Finally submits the post to the database
*/
    public function recieveData(){

    	$error;
		$this->title =   trim(htmlspecialchars($_POST['title']));
		$this->tag   =   trim(htmlspecialchars($_POST['tag']));
		$this->post  =   trim(htmlspecialchars($_POST['post']));
       
        $this->validateImage();

        $error = $this->validate();

       
        if (!empty($error)){
        	$success = $error;
        } 
        elseif ($this->submitPost()) {

        	$success =urlencode("Post submited successfully");
 	        	
        }
        else{
        	$success= urlencode("failed to submit post");
        }
        header("location: ../views/dashboard.php?success=$success");	 
        
	}
	
    /**
    * validates the post and also validates that the user is registered before making a post
    *@return array
    */
	public function validate(){

		$errors = [];

		if (($this->getUserId() ==null)){

			$errors[] = urlencode("You must be registered to be able to submit posts");
		}

		if (empty($this->title)){
			$errors[] = urlencode("Tilte is empty");
		}

		if (empty($this->post)){
			$errors[] = urlencode("Oops! you can\'t submit empty post");
		}

		if (!empty($errors)){

			return join( $errors, urlencode( '<br>'));
		}

	} 

    /**
    *get the user Id from the session
    *@return null if user is not logged in, nuser_id if the user is logged in 
    */
	public function getUserId(){

		 if (isset($_SESSION['userId'])){

		 return  $_SESSION['userId'];
		 }
          else{
		 return null;
		}
	}
      
    /**
    * submits the post
    *@return boolean whether the insert is successful or not
    */
	public function submitPost(){

      return $this->model->insertpost("posts", $this->getUserId(), $this->title, $this->tag, $this->post, $this->imageKey);
      
	}

	public function approve($postId){

	   if ($this->model->approvePost($postId)){

	   	   $feed_back = urlencode("post successfully approved");

		  header("location: ../views/admindashboard.php?feed_back=$feed_back");
	   }

	}   

	public function showApprovedPost(){

       return $this->model->fetchApprovedPost();

	}

	public function showUnApprovedPost(){

		 return $this->model->fetchUnApprovedPost();
	}

	public function delete($postId){

		if($this->model->deletePost($postId)){
			$feed_back = urlencode("delete successful");

			header("location: ../views/admindashboard.php?feed_back=$feed_back");
		}
	}

	public function userDelete($postId){

		if($this->model->deletePost($postId)){

			
		$feed_back = "post deleted!";

			
		}
		else{
			$feed_back = "post could not be deleted!";
		}
		header("location: ../views/manage_post.php?success=$feed_back");
	}

	public function showDetail($postId){

		$this->model->fetchDetail($postId);
	}
   
	public function validateImage()
	{
		 if(isset($_FILES['image'])){
			$imageErr= [];
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_tmp = $_FILES['image']['tmp_name'];
			$file_type = $_FILES['image']['type'];
  
			$expensions= ["image/jpeg","image/jpg","image/png",""];

			if (in_array($file_type, $expensions)=== false){
			    $imageErr[]="extension not allowed, please choose a JPEG or PNG file.";
			}
      
            if ($file_size > 2097152) {
                $imageErr[]='File size must be excately 2 MB';
            }
      
            if (empty($imageErr)==true) {

      	       $this->imageKey = md5(uniqid(rand(0, 1000), TRUE))."-".date('d-m-Y-H-i-s', time());
           }
           if ( move_uploaded_file($file_tmp, $this->dir."/".$this->imageKey.".jpg")){

           	  return true;
           }
           else{
           	  return join($imageErr, "<br>");
           }
        }

	}

	public function UpdatePost()
	{
		$this->title =   trim(htmlspecialchars($_POST['title']));
		$this->tag   =   trim(htmlspecialchars($_POST['tag']));
		$this->post  =   trim(htmlspecialchars($_POST['post']));
		$this->postId=   trim(htmlspecialchars($_POST['editor']));
       
        $error = $this->validate();

        if (!empty($error)){

        $_SESSION['error'] = $error;

 	   header("location: ../views/editor.php?id=$this->postId");

        } 
       if ($this->model->editPost($this->postId, $this->title, $this->tag, $this->post)) {

        	$success =urlencode("Post updated successfully");
 	        	
        }
        else{
        	$success= urlencode("failed to update post");
        }
        	 
          $_SESSION['success'] = $success;
        header("location: ../views/editor.php?id=$this->postId");

	}



	public function  userUpdatePost()
	{
		$this->title =   trim(htmlspecialchars($_POST['title']));
		$this->tag   =   trim(htmlspecialchars($_POST['tag']));
		$this->post  =   trim(htmlspecialchars($_POST['post']));
		$this->postId=   trim(htmlspecialchars($_POST['user_editor']));
       
        $error = $this->validate();
        if (!empty($error)){
       $_SESSION['error'] = $error;
 	   header("location: ../views/user_editor.php?id=$this->postId");
        } 
       if ($this->model->userEditPost($this->postId, $this->title, $this->tag, $this->post)) {

        	$success =urlencode("Post updated successfully");
 	        	
        }
        else{
        	$success= urlencode("failed to update post");
        }
        	 
          $_SESSION['success'] = $success;
       header("location: ../views/user_editor.php?id=$this->postId");

	}


	public function updateImage()

	{

		$this->postId = $_POST['edit_image'];

		$this->deletePreviousImage($this->postId);

		if ($this->validateImage() !=true){
			$error = $this->validateImage();
		  $_SESSION['error'] = $error;
		   header("location: ../views/image_editor.php?id=$this->postId");
		}
		elseif ($this->model->editImage($this->postId, $this->imageKey))
		{

        	$success ="Image updated successfully";
 	        	
        }
        else{
        	$success= "failed to update image";
        }
        	 
         
          $_SESSION['success'] = $success;
     
         header("location: ../views/image_editor.php?id=$this->postId");
			  

     } 

     public function userUpdateImage()

	{    
		 $this->postId = $_POST['user_edit_image'];
		 $this->deletePreviousImage($this->postId);

		if ($this->validateImage() !=true){
			$error = $this->validateImage();
		  $_SESSION['error'] = $error;
		   header("location: ../views/user_image_editor.php?id=$this->postId");
		}
		elseif ($this->model->userEditImage($this->postId, $this->imageKey))
		{

        	$success ="Image updated successfully";
 	        	
        }
        else{
        	$success= "failed to update image";
        }
        	 
         
          $_SESSION['success'] = $success;
     
         header("location: ../views/user_image_editor.php?id=$this->postId");
     } 

     public function fetchMyPost() {

     	$result = $this->model->fetchAllPostFromUser($this->getUserId());

     	if ($result !== null){

     		return $result;
     	}
     }  

     public function showRelatedPosts($tag)
     {
     	return $this->model->relatedPosts($tag);
     }

     public function showMostRecentPosts()
     {
     	return $this->model->fetchMostRecentPost();
     }	
     /**
     *this tracks the existing image and deletes it before storing the new one to avoid duplicate 
     *@param integer $postId
     *@return boolean void
     */
     public function deletePreviousImage($postId)
     {
     	$image = $this->model->getImage($postId);
     	$prevImage = $image['image'].".jpg";

     	$dir = $_SERVER['DOCUMENT_ROOT'].'/uploads/'.$prevImage;

     	unlink($dir);
     }
}

