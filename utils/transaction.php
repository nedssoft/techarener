<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/autoloader/Autoloader.php';

if (isset($_POST['action'])) {


	 switch ($_POST['action']) {

	 	case 'register':
	 	
	 	$reg = new RegistrationController();
	 	$reg->recieveData();
	 	
	 	break;

	 	case 'login':
        
        $login = new LoginController();
        $login->recieveData();
        break;

        case 'submit_post':
        
        $post = new PostController();
        $post->recieveData();
        break;

	 }
}
  

if (isset($_POST['delete'])){
	 	$post = new PostController();

 	$post->delete($_POST['delete']);

}

if (isset($_POST['publish'])){
	
 	$post = new PostController();
 	$post->approve($_POST['publish']);
}

if (isset($_POST['view'])){
	
 	$post = new PostController();
 	$post->showDetail($_POST['view']);
 	header("location: ../views/detail.php");
}   

if (isset($_POST['editor'])){

         $post = new PostController();
         $post->updatePost();

    }

if (isset($_POST['submit_comment'])){
  
	$comment = new CommentController();
    session_start();

    $comment->recieveData();
 //    echo $_SESSION['username']."<br>";
	// echo  "the post id is ".$_POST['comment'];
}

if (isset($_POST['edit_image'])){

	  $post = new PostController();
         $post->updateImage();
        // break;
}
if (isset($_POST['user_edit_image'])){

	  $post = new PostController();
         $post->userUpdateImage();
        // break;
}

if (isset($_POST['user_delete'])){

		$post = new PostController();

 	$post->userDelete($_POST['user_delete']);
}


if (isset($_POST['user_editor'])){
       
		$post = new PostController();
		$post->userUpdatePost();	
}




