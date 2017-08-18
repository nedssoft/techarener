<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/autoloader/Autoloader.php';

/**
* 
*/
class UpdateController
{    
	public $title;
	Public $tag;
	public $post;
	public $userId;
    public $imageKey;
	public $model;
	public $dir;
	public $postId;
	
	function __construct()
	{
		$this->dir='C:\wamp\www\mblog\uploads';
		$this->model =  new PostModel();
	}

	public function recieveData()
	{
		$this->title =   trim(htmlspecialchars($_POST['title']));
		$this->tag   =   trim(htmlspecialchars($_POST['tag']));
		$this->post  =   trim(htmlspecialchars($_POST['post']));
		$this->postId =  trim(htmlspecialchars($_POST['editor']));

		echo $this->title."<br> ".$this->tag."<br> ".$this->post."<br> ".$this->postId;
       
         //$this->validateImage();

        if (( $this->validateImage() ===true) ||  ($this->validateImage()===false)){
        $error = $this->validate();
        if (!empty($error)){
        	session_start();
             $_SESSION['error'] = $error;
 	   header("location: ../views/editor.php?id=$this->postId");
        }

        if ($this->submitPost()) {

        	$success =urlencode("Post updated successfully");
 	        	
        }
        else{
        	$success= urlencode("failed to update post");
        }
        	 
          session_start();
          $_SESSION['success'] = $success;
     }     header("location: ../views/editor.php?id=$this->postId");
	
	}

	public function validate(){


		$errors = [];


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

	public function submitPost(){
		
      echo $this->title."<br> ".$this->tag."<br> ".$this->post."<br> ".$this->postId;
     var_dump($this->model->editPost( $this->postId, $this->title, $this->tag, $this->post, $this->imageKey));  

	}

		public function validateImage()
	{
		 if(isset($_FILES['image'])){
			$imageErr= [];
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_tmp = $_FILES['image']['tmp_name'];
			$file_type = $_FILES['image']['type'];

			$expensions= ["image/jpeg","image/jpg","image/png"];

			if (in_array($file_type, $expensions)=== false){
			    $imageErr[]="extension not allowed, please choose a JPEG or PNG file.";
			}
      
            if ($file_size > 2097152) {
                $imageErr[]='File size must be excately 2 MB';
            }
      
            if (empty($imageErr)==true) {

      	       $this->imageKey = md5(uniqid(rand(0, 1000), TRUE));
           }
           if ( move_uploaded_file($file_tmp, $this->dir."/".$this->imageKey.".jpg")){

           	  return true;
           }
           else{
           	  return false;
           }
        }
	}

	
}