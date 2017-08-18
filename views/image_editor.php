<?php session_start();
require 'links.php';
?>


<body>
<nav class="navbar navbar-fixed-top navbar-default" style="margin-bottom: 0px; background: white;">
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
            <li><a href="http://techarener.com"><span class="glyphicon glyphicon-home"> Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-phone"> Contact</a></li>
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="admindashboard.php"><span class="glyphicon glyphicon-user"></span> ADMIN Dashboard</a></li>
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

                //header("Refresh:5; url=admindashboard.php");
              ?>
             </p>
             <p class="text-center" style="color:green";>
             <?php  $success = isset($_SESSION['success'])? $_SESSION['success']:''; echo $success; unset($_SESSION['success']);
               
                //header("Refresh:5; url=admindashboard.php");
             ?>
             </p>
      			  <input type="file" name="image">
      				<div class="row">
      					<div class="col-md-3"></div>
      					<div class="col-md-6">
      						<button name="edit_image" type="submit"; value="<?php echo $_GET['id'];?>" class="btn btn-primary" style="width: 100%;">Upload</button>
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
