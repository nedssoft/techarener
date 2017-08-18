<?php

   abstract class Connection
{
	private $serverName= 'localhost';
	private $username='nedsoft';
	private $pass='calculus2689';
	public $connect;
	protected $dbName= "techdltm_techarener";
	
	public function getConnection()
	{
		return  new mysqli($this->serverName, $this->username, $this->pass);
	}
}