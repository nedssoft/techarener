<?php session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/autoloader/Autoloader.php'; 

$detail = new PostModel();
if (isset($_GET['id'])){
$approved = $detail->fetchDetail($_GET['id']);
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>My dashboard</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<link href="register.css" type="text/css" rel="stylesheet">
  	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Vidaloka|Monoton|Petit+Formal+Script" rel="stylesheet">
  	<link href="thinkdesign/utility/css/bootstrap.min.css" rel="stylesheet">
  	<link href="thinkdesign/utility/css/signup.css" rel="stylesheet">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  	<script src="thinkdesign/utility/js/bootstrap.min.js"></script>
  	<style type="text/css">
  		.pbody{
  			height: 100%;
  		}
  		button[name=submitpost]{
  			margin-top: 10px;
  			margin-bottom: 20px;
  		}
  		#post-container{
  			max-height: 200px;
  			width: 100%;
  			box-shadow: 0px 5px 0px ;
  			border-radius: 5px;
  			margin:10px;
  			padding: 10px;
  			float: left;
        overflow-y: scroll;
  		}
  		.post-title{
  			color: lightblue;
  			font-weight: bold;
  			font-style: italic;
  			
  		}
  		#getlink{
        text-decoration: none;
      }
      #myNavbar li a:hover{
          background: black;
          color: white;
          border-radius: 4px;
      }
   
  	</style>
</head>
<body>
	<nav class="navbar navbar-default" >
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#" style="font-family: 'Monoton', cursive;">TECHARENAR</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li><a href="http://techarener.com"><span class="glyphicon glyphicon-home"> Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-phone"> Contact</a></li>
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
          <?php
          if ($_SESSION['role']==0){
            echo
            '<li class="active"><a href="dashboard.php"><span class="glyphicon glyphicon-user"></span> My Dashboard</a></li>';
          }
          else{
              echo
            '<li class="active"><a href="admindashboard.php"><span class="glyphicon glyphicon-user"></span> Admin Dashboard</a></li>';
          }
          ?>
            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            
          </ul>
        </div>
      </div>
    </nav> 
    <div class="row" style="background: black;">
        <div class="col-md-2"></div>
        <div class="col-md-8">
          <form method="post" action="../utils/transaction.php" enctype="multipart/form-data">
            <fieldset>
              <legend style="text-align: center; color: lightblue">Edit Post</legend>
                 <p class="text-center" style="color:red";>
             <?php $error = isset($_SESSION['error'])? $_SESSION['error']:''; echo $error; unset($_SESSION['error']);?>
             </p>
             <p class="text-center" style="color:green";>
             <?php  $success = isset($_SESSION['success'])? $_SESSION['success']:''; echo $success; unset($_SESSION['success']);?>
             </p>
                <!-- <p class="text-center" style="color: green;"> <?php $success = isset($_GET['success'])? $_GET['success']:''; echo $success;?> </p> -->
              <input type="text" name="title" style="width: 100%; padding: 8px; border: 2px solid lightblue;" placeholder="Add post topic here" value="<?php echo $approved['title']; ?>">
              <input type="text" name="tag" style="width: 100%; padding: 8px; border: 2px solid lightblue;" value="<?php echo $approved['tag']; ?>" placeholder="Add tag here E.g Politics, Education etc">
              <textarea name="post" style="width: 100%; height: 200px; border: 2px solid lightblue; padding: 10px;" placeholder="-----------Write your post here-----------------"><?php echo $approved['post']; ?></textarea>  
               <input type="file" name="image">
              <small>Add image (Optional) </small>
              <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                  <button name="editor" type="submit"; value="<?php echo $_GET['id'];?>" class="btn btn-primary" style="width: 100%;">update</button>
                </div>
                <div class="col-md-3"></div>
              </div> 
            </fieldset>
          </form>
        </div>
        <div class="col-md-2"></div>
      </div>

</body>
</html>