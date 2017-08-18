<?php session_start();?>

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
  		button[name=edit_image]{
  			margin-top: 20px;
  			
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
      form{
      	height: 200px;
      	width: 400px;
      	border: 1px solid black;
      	padding: 10px;
      	padding-top: 50px;
      	border-radius: 5px;

      }
      a:focus{
      	outline: none;
      }
   
  	</style>
    <script type="text/javascript">

      function verify(){
      confirm("Do you really want to delete this post?");
      }

      var opac = 1;

      function fade(){

        var f = document.getElementById('success');
        opac -=0.3;
       
       if (opac == 0){
        f.style.display= 'none';
       }
         f.style.opacity= opac;

      }
       window.onload = fade();

    </script>
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
          <a class="navbar-brand" href="#" style="font-family: 'Monoton', cursive;">TECHARENER</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li><a href="http://techarener.com><span class="glyphicon glyphicon-home"> Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-phone"> Contact</a></li>
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="dashboard.php"><span class="glyphicon glyphicon-user"></span> My Dashboard</a></li>
            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>
      <div class="row" >
      	<div class="col-md-2"></div>
      	<div class="col-md-8">
      		<form method="post" action="../utils/transaction.php" enctype="multipart/form-data" >	
      		    <?php $error = isset($_SESSION['error'])? $_SESSION['error']:''; echo $error; unset($_SESSION['error']);
              // header("Refresh:5; url=dashboard.php");

              ?>
             </p>
             <p class="text-center" style="color:green";>
             <?php  $success = isset($_SESSION['success'])? $_SESSION['success']:''; echo $success; unset($_SESSION['success']);
                //header("Refresh:5; url=dashboard.php");
             ?>
             </p>
      			  <input type="file" name="image">
      				<div class="row">
      					<div class="col-md-3"></div>
      					<div class="col-md-6">
      						<button name="user_edit_image" type="submit"; value="<?php echo $_GET['id'];?>" class="btn btn-primary" style="width: 100%;">Upload</button>
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
