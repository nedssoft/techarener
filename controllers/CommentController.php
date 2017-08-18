<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/autoloader/Autoloader.php';
/**
* 
*/
class CommentController
{
	public $comment;
	public $postId;
	public $username;
	public $model;
	function __construct()
	{
		$this->model = new CommentModel();
	}
	public function recieveData()
	{
      $this->comment  = trim(htmlspecialchars($_POST['comment']));
      $this->postId   = trim(htmlspecialchars($_POST['submit_comment']));
      $this->username = $_SESSION['username'];
       
        if($this->validate()){
        	 $errors = $this->validate();
             session_start();
             $_SESSION['error'] = $errors;
        	header("location: ../views/detail.php?id=$this->postId");
        }

        else if($this->submit()){

        	$_SESSION['success'] = "Comment submited successfully";
        	header("location: ../views/detail.php?id=$this->postId");
        }
        else{
        	$_SESSION['success'] = "Could not submit Comment";
        	header("location: ../views/detail.php?id=$this->postId");
        }
	}

	public function validate(){
		$errors = [];

		if (empty($this->comment)){
           $errors[] = ("Cannot submit empty comment");
		}

		if (!isset($_SESSION['username'])){

			$errors[] = ("You must login to comment");
		}

		if (!empty($errors)){

			return join($errors, ("<br>"));
		}
	}

	public function  submit(){
      
       return $this->model->insertComment($this->postId, $this->username, $this->comment);
	}
}