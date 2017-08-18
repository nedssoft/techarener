<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/autoloader/Autoloader.php';   

class RegistrationController 
{   public $fname;
	public $username;
	public $phone;
	public $email;
	public $password;
	public $cpassword;
    public $model;


	function __construct(){

        $this->model = new UsersModel(); 
	}

    public function recieveData(){

        $this->fname =     htmlspecialchars($_POST['fname']);
        $this->username =  htmlspecialchars($_POST['username']);
        $this->phone =     htmlspecialchars($_POST['phone']);
        $this->email =     htmlspecialchars($_POST['email']);
        $this->password =  htmlspecialchars($_POST['password']);
        $this->cpassword = htmlspecialchars($_POST['cpassword']);

        $this->trimStripSlashes();

         if(!empty($this->validate())){

        $_errors = $this->validate();

        header("location: ../views/register.php?errors=$_errors");
    }

    else {
        
        if ($this->model->insertIntousers($this->fname, $this->username, $this->phone, $this->email, md5($this->password))){
         $success = "Registration successful";  
        } 

        else {

          $success= "Opps! something went wrong";
        }
        header("location: ../views/register.php?success=$success");
    }



    }

    public function trimStripSlashes(){
    	$this->fname     = trim($this->fname);
    	$this->fname=stripslashes($this->fname);
    	$this->username= trim($this->username);
    	$this->username=stripslashes($this->username);
    	$this->phone= trim($this->phone);
    	$this->phone=stripslashes($this->phone);
    	$this->email= trim($this->email);
    	$this->email=stripslashes($this->email);
    	$this->password= trim($this->password);
    	$this->password=stripslashes($this->password);
    	$this->cpassword= trim($this->cpassword);
    	$this->cpassword=stripslashes($this->cpassword);
    }
	public function Validate(){
		$errors = array();

        if (empty($this->fname)){
        	$errors[]= urlencode("full name fiels is empty, please enter your full name");
        }

        if(empty($this->username)){
        	$errors[]= urlencode("please enter your username");
        }
         if(strlen($this->phone) >11 || strlen($this->phone)<11 ){
            $errors[]= urlencode("inavlid phone number");
        }

        if(empty($this->phone)){
        	$errors[]= urlencode("please enter your phone number");
        }
       
        if (empty($this->email)){
        	$errors[]= urlencode("please enter your email");

        }

        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)==TRUE){
        	$errors[]= urlencode("Invalid email format");

		 }

         if (strlen($this->password) < 4) {
            $errors[] = urlencode("password length must be greater than 4");
         }
		 if($this->password!=$this->cpassword){
		 	$errors[]= urlencode("password do not match");
		 }

         if ($this->model->IsDataUnique( "users", "username", $this->username) !== null){
             $errors[] = urlencode("username already exists");
         }
         if ($this->model->IsDataUnique( "users", "phone", $this->phone) !== null){
             $errors[] = urlencode("Phone number already exists");
         }
         if ($this->model->IsDataUnique( "users", "email", $this->email) !== null){
             $errors[] = urlencode("email already exists");
         }

		 if(!empty($errors)){

		 	return join($errors, urlencode('<br>'));
		 }

	}	
}

