<?php  require 'links.php';?>
<body>
	<nav class="navbar navbar-default" style="margin-bottom: 0px; background: white;">
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
            <li> <a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li class="active"><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          </ul>
        </div>
      </div>
    </nav> 
    <div class="row container">
    	<div class="col-md-4"></div>
    	<div class="col-md-4 wrap">
	    	<div class="panel panel-primary" style="margin-top: 100px;">
	            <div class="panel-heading">
	            	<div class="panel-title" >Login</div>
	            </div>	
              	<div class="panel-body pbody">
              		<form method="post" action="../utils/transaction.php">
              		<!-- php here -->
                   <p class="text-center" style="color: red;"><?php   $errors= (isset($_GET['error']))? $_GET['error']: ""; echo $errors;?> </p>
                   <p class="text-center" style="color: red;"> <?php   $errors= (isset($_GET['feed_back']))? $_GET['feed_back']: ""; echo $errors;?></p>
              			<div class="form-group input-group">
                        	<span class="input-group-addon"><i class="glyphicon glyphicon-user" style="color:lightblue"></i>
                        	</span>
                        	<input type="text"  name="username"  class="form-control" id="username"  placeholder="Enter username">
                		</div>
                		<div class="form-group input-group">
	                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock" style="color:lightblue"></i>
	                        </span>
	                        <input type="password"  name="password"  class="form-control" id="password"  placeholder="Enter password" >
                		</div>
                		<div class="form-group input-group register">
                    		<input type="submit"  name="action" value="login" class="form-control register" >
                		</div>
              		</form>	
             	</div>
             	<div class="panel-footer">
             		<p class="text-muted"> Not Yet Registerd?<a href="register.php" id="signup"><strong> Sign Up</strong></a></p> 
             	</div>
	        </div>
	   </div> 
	   <div class="col-md-4"></div>
	</div>
</body>
</html>
