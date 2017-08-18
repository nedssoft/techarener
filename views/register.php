
<?php  require 'links.php';?>
<body>
  <nav class="navbar navbar-default" style=" background: white;">
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
            <li class="active"><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          </ul>
        </div>
      </div>
    </nav> 
  <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4  form-wrap" style="margin: 20px;">
      <div class="panel panel-primary">
            <div class="panel-heading"><h4 class="text-center">Register</h4></div>
              <div class="panel-body pbody" >
                <form method="post" action="../utils/transaction.php">
                <p class="text-center" style="color: red;">
                <!-- get the error passed via url from validation and display-->
                <?php   $errors= (isset($_GET['errors']))? $_GET['errors']: ""; echo $errors;?> 
                 </p>
                 <p class="text-center" style="color:green;"><?php $success= (isset($_GET['success']))? $_GET['success']: ""; echo $success;?></p>
                  <div class="form-group input-group input-group-sm">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user" style="color:lightblue"></i>
                        </span>
                        <input type="text"  name="fname" value="" class="form-control" id="fname"  placeholder="Enter Full Name" >
                    </div>
                    <div class="form-group input-group input-group-sm">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user" style="color:lightblue"></i>
                        </span>
                        <input type="text"  name="username" value=""  class="form-control" id="username"  placeholder="Enter username" >
                    </div>
                    <div class="form-group input-group input-group-sm">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-phone-alt" style="color:lightblue"></i>
                        </span>
                        <input type="text"  name="phone" value=""   class="form-control" id="phone"  placeholder="Enter Phone number" >
                    </div>
                    <div class="form-group input-group input-group-sm">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope" style="color:lightblue"></i>
                        </span>
                        <input type="text"  name="email" value=""   class="form-control" id="email"  placeholder="Enter Email" >
                    </div>
                    <div class="form-group input-group input-group-sm">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock" style="color:lightblue"></i>
                        </span>
                        <input type="password"  name="password"  class="form-control" id="password"  placeholder="Enter password" >
                    </div>
                    <div class="form-group input-group input-group-sm">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock" style="color:lightblue"></i>
                        </span>
                        <input type="password"  name="cpassword"  class="form-control" id="cpassword"  placeholder="Re-type password" >
                    </div>
                     <div class="form-group input-group register">
                        <input type="submit"  name="action" value="register" class="form-control register" >
                    </div>
                    <div class="panel-footer">
                      <p class="text-muted text-center">Already Registerd?<a href="login.php" id="signup" style="text-decoration: none"><strong> Login</strong></a></p> 
                    </div>
                    
                </form>
              </div>
          </div>
        </div>
      <div class="col-md-4"></div>
    </div>
  </body>
</html>