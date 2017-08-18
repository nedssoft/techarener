<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/autoloader/Autoloader.php';

class LoginController
{
	public $username;
	public $password;

	function __construct(){	

	}

	public function recieveData(){
          $rows = [];
		$this->username=  trim(htmlspecialchars($_POST['username']));
		$this->password = trim(htmlspecialchars($_POST['password']));

		if ($this->validateUser()){

			$logError = $this->validateUser();
			header("location: ../views/login.php?error=$logError");
		}

		else if ($this->authenticateUser() !== null)
		{

	 				$rows = $this->authenticateUser();

	 				$pass = $rows['password'];

	    			if (md5($this->password) !== $pass){

	 	    				$feedBack = "username or password incorrect";

	 	     				header("location: ../views/login.php?feed_back=$feedBack");

	 	     		}
	 	     		elseif($this->username !== $rows['username']){
                          	$feedBack = "username or password incorrect";
	 	     				header("location: ../views/login.php?feed_back=$feedBack");
	 	     		}		
	        

	    else if ($rows['role']==0)
	    {

	 	 			session_start();
	 	 			$_SESSION['fname'] = $rows['fullname'];
	 	 			$_SESSION['userId'] =$rows['id'];
	 	 			$_SESSION['username']= $rows['username'];
	 	 			$_SESSION['role']   =$rows['role'];

	 	 			header("location: ../views/dashboard.php");
	    }

	    elseif ($rows['role']==1)
	    {
		 			session_start();
		 			$_SESSION['fname'] = $rows['fullname'];
		 			$_SESSION['userId'] =$rows['id']; 
		 			$_SESSION['role']   =$rows['role'];

	 	            header("location: ../views/admindashboard.php");
	    }

	}
	else{
		     $feedBack = "username or password incorrect";

	 	     header("location: ../views/login.php?feed_back=$feedBack");
	}
	
    }

	public function validateUser(){
		$errors = [];

		if (empty($this->password)){
			$errors[]= urlencode("password field is empty");
		}

		if (empty($this->username)){
			$errors[] = urlencode("Please enter your username to login");
		}
		if (!empty($errors)){
			return join($errors, '<br>');
		}
	}


	public function authenticateUser() {

		
		$user = new UsersModel();

        $fetchedUser = $user->fetchUser($this->username);

		if ( $fetchedUser !== null) {

          return $fetchedUser;
         

		}

		else{
			return null;
		}

		
	}
}