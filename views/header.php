<?php

echo '<!Doctype html>
<html lang="en">
  <head>
  <title> Simple||Blog||Home</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Vidaloka|Monoton|Petit+Formal+Script" rel="stylesheet">
   <link href="blog.css" type="text/css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

  <style type="text/css">
    body{
      font-family: "Vidaloka", serif;
    }
    #logo{
    font-family: "Monoton", cursive; 
    color: red;
    
    }
    .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
     max-height: 400px;
     width: 100%;
     margin-top: 0px;
     padding-top: 0px;
  }


    #post-container{
        max-height: 200px;
        width: 100%;
        box-shadow: 0px 5px 0px ;
        border-radius: 5px;
        margin:10px;
        padding: 10px;
        float: left;

      }
      .post-title{
        color: lightblue;
        font-weight: bold;
        font-style: italic;
        
      }
      #getlink{
        text-decoration: none;
      }
      .pp{font-family: "Petit Formal Script", cursive;}
      #myNavbar li a:hover{
        background: black;
        color: white;
        border-radius: 4px;


      }
  </style>
  </head>
  <body>
    <nav class="navbar navbar-fixed-top navbar-default" style="margin-bottom: 0px; background: white;">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#" id="logo" style="">TECHARENER||Recent new in Tech industry</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#"><span class="glyphicon glyphicon-home"> Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-phone"> Contact</a></li>
            
          </ul>
          <ul class="nav navbar-nav navbar-right">';
            
            if(isset($_SESSION['fname'])){
                echo '<li><a href="dashboard.php"><span class="glyphicon glyphicon-user"></span> My Dashboard</a></li>';
            ;
            }else{
              echo '<li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
            }
          
          echo '  
          </ul>
        </div>
      </div>
    </nav>';