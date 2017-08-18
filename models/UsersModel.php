<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/autoloader/Autoloader.php';   

class UsersModel extends Connection
{
	public $conn;

 	function __construct(){
 		$this->conn = $this->getConnection();

 	}

 	public function insertIntoUsers($fname, $username, $phone, $email, $password){

 		$sql = "insert into users(`fullname`, `username`, `phone`, `email`, `password`)".
 		        "VALUES('$fname', '$username', '$phone', '$email', '$password' )";

 	
 		$this->conn->select_db($this->dbName);

        if ($this->conn->connect_error){
      	die("unable to connect to database".$this->conn->connect_error);

       }

       if(!$this->conn->query($sql)){

       	die("failed to insert into user". $this->conn->error);
       }

       else{
       	return true;
       }

    }

    /** checks if either username, phone number or email is unique
    
     @params  table name, column name, data(username, phone, email)

    @return null if the data is unique, the data if not unique

    **/

     public function IsDataUnique($table, $col, $data){
     	$sql = "select ". $col. " from ". $table. " where ". $col. " = '".$data."'";
     	$this->conn->select_db($this->dbName);

     	   $selected = $this->conn->query($sql) or die("unable to connect to database". $this->conn->error);

     	    if ($this->conn->affected_rows > 0){
               return $selected;
     	    }
     	    else{
     	    	return null;
     	    }
     }
 
     /** Login Authentication function
     // checks if user exists
     // @params username, and password
     // @return null if no such user exists, returns username and user's fullname if user exists in db

     **/
     public function fetchUser($username){
     	$sql = "select `role`, `id`,`username`, `fullname`, `password` from `users` where `username` = '". $username. "'" ;

        $this->conn->select_db($this->dbName);

        $selected = $this->conn->query($sql) or die("unable to connect to database". $this->conn->error);
       //if ($selected){ echo "query succeeded!";}

        if ($this->conn->affected_rows > 0 ){
        	//echo "i caught something!";
        	return $selected->fetch_assoc();
        }

        else{

        	
        	//echo "i caught nothing";
        	return null;
        	
        }

     }
 }
 


