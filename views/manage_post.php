<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/autoloader/Autoloader.php';   
$data = new PostController;
$approved = $data->fetchMyPost();

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
            <li class="active"><a href="dashboard.php"><span class="glyphicon glyphicon-user"></span> My Dashboard</a></li>
            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>
     <div class="container">
     <?php
            $feedback = isset($_GET['success'])? $_GET['success']:''; echo $feedback;  
                for ($i=0; $i < count($approved) ; $i++) { 


                 echo '
                
          <div class="row">
        <div class="col-sm-6 col-md-1"></div>
        <div id="wrap" class="col-md-6">
            <h2 class="text-center page-header">'.$approved[$i]["title"].'</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="thumbnail">
                        <img src="../uploads/'.$approved[$i]["image"].".jpg".'"  width="100%" height="100%" >
                        <div class="caption"><small class="text-center" style="font-style: italic;">'.$approved[$i]["title"].'</small></div>
                    </div > 
                   
                </div>
                <div class="col-md-8" id="left">
                    <p  ><blockquote style="font-size:14px;">'.$approved[$i]["post"].'</blockquote></p>
                    <p>
                        <ol class="breadcrumb">
                            <li><a href="#">Posted on: '.$approved[$i]["post_date"].'</a></li>
                            <li><a href="#"></a></li>
                        </ol>
                    </p>
                   <form method="post" action="../utils/transaction.php">
                    <div class="btn-group">
                        <button type="submit" name="user_delete" value='.$approved[$i]['id'].' class="btn btn-primary"  onclick="verify()">Delete</button>
                        <a class="btn btn-primary" href="user_editor.php?id='.$approved[$i]['id'].'">Edit</a>
                        <a class="btn btn-primary" href="detail.php?id='.$approved[$i]['id'].'">View</a>
                         <a class="btn btn-primary" href="user_image_editor.php?id='.$approved[$i]['id'].'">Edit Image</a> 
                    </div>
                    </form>

                </div>
         
            </div>
        </div>
        <div class="col-md-5"></div>
        </div>';
            }?>
            </div>

 </body>
 </html>   