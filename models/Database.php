<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/autoloader/Autoloader.php';

class Database extends Connection
{
    /**
    * @var DB Connection object
    */
    public $conn;
    /**
    *Constructor
    *@return Connection object
    */
  	public function __construct(){

  		$this->conn= $this->getConnection();
  	}

  	/**
    *this creates the database if none has been created at the time of call
  	*/
  	public function createDb(){
		if($this->conn->connect_error){
			die("failed to connect". $this->conn->connect_error);
		}

		$sql = 'CREATE DATABASE if not exists '.$this->dbName.'';

		if ($this->conn->query($sql)){
			echo "database created successfully <br>";
		}
		else{
			echo "error creating database <br>". $this->conn->error;
		}
	}


	public function createUsers(){
		
		$this->conn->select_db($this->dbName);


		$sql= "create table if not exists users(id int not null AUTO_INCREMENT , username varchar(20) not null unique, fullname varchar(50) not null,  phone varchar(15) not null unique, email varchar(50) not null unique, image varchar(50), password varchar(150), role boolean not null default 0, created_at datetime DEFAULT now(),  PRIMARY KEY (id))";

		if($this->conn->query($sql)){
			echo "table users created <br> ";
		}
		else{
			die("failed to create table users <br>".$this->conn->error);
		}
	}

	public function createPostTable(){
		$sql= "create table if not exists posts(id int not null AUTO_INCREMENT,user_id int not null, title varchar(255), tag varchar(100), post text, status boolean not null default 0, image varchar(100), post_date datetime DEFAULT now()  ,
			PRIMARY KEY (id),
			FOREIGN KEY (user_id) REFERENCES users(id) on delete cascade)";

			if($this->conn->query($sql)){
			echo "table posts created <br> ";
		}
		else{
			die("failed to create table posts <br>".$this->conn->error);
		}
	}

	public function createCommentTable(){
		$sql = "create table if not exists comments(id int not null AUTO_INCREMENT, post_id int not null, username varchar (20) not null, comment text, created_at datetime default now(),
		PRIMARY KEY (id), 
		FOREIGN KEY (post_id) REFERENCES posts(id) on delete cascade)";

			if($this->conn->query($sql)){
			echo "table comments created <br> ";
		}
		else{
			die("failed to create table comments <br>".$this->conn->error);
		}

	}
}

	