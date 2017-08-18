<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/autoloader/Autoloader.php';
$data = new PostController;
$approved = $data->showApprovedPost();
$postMod = new PostModel();
if (!empty($approved)){
$recent = $data->showMostRecentPosts();
}
require 'links.php';
?>

<body>
	<nav class="navbar  navbar-default" style=" background: white;">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#" style="font-family: 'Monoton', cursive;"><big>TECHARENER</big></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li><a href="http://techarener.com"><span class="glyphicon glyphicon-home"></span> Home</a></li>
             <li><a href="manage_post.php">Manage My Posts</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-phone"></span> Contact</a></li>
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
             <li><a href="#"><span class="glyphicon glyphicon-user"></span><?php echo 'Hi '.ucwords($_SESSION['fname']);?> </a></li>
             <?php 
              

            if(isset($_SESSION['username'])){
                echo '<li><a href="dashboard.php"> My Dashboard</a></li>
                       <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>';                   
            }else{
              echo '<li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
            }
          ?>
          </ul>
        </div>
      </div>
    </nav> 
   
    <section>
        <div class="container-fluid forum" style="margin-bottom: 0px;">
          <div class="panel panel-primary">
            <div class="panel-heading"> <div class="panel-heading"><h2 id="fhead" style="font-family: 'Petit Formal Script', cursive;">FORUM</h2></div></div>
              <div class="panel-body pbody" >
               <div class="row">
                  <div class="col-md-9" style="border-right: 6px solid gray; box-shadow:  0px, 0px, 10px red;" >
                     <?php
                     
                for ($i=0; $i < count($approved) ; $i++) {

                     $fullname = $postMod->getFullname($approved[$i]['user_id']);

                    $image = (($approved[$i]["image"]!==null)? $approved[$i]["image"]:"generic");
                 echo '
                
          <div class="row">
          <div class="col-sm-4 col-md-1"></div>
          <div id="wrap" class="col-md-11">
            <h2 class="text-center page-header">'.$approved[$i]["title"].'</h2>
            <div class="row">
              <div class="col-md-5">
                <a href="detail.php?id='.$approved[$i]['id'].'"> <img src="../uploads/'.$image.".jpg".'" width="350px" height="400px"  class="thumbnail img-responsive">   
                  <div class="caption"><small class="text-center" style="font-style: italic;">'.$approved[$i]["title"].'</small></div>
                </a>
              </div > 
               <div class="col-md-7" id="left">
                  <div style="height: 100px; overflow: hidden;">
                    <p><blockquote style="font-size:14px;">'.$approved[$i]["post"].'</blockquote></p> 
                  </div>
                  <p>
                    <ol class="breadcrumb">
                      <li><a href="#">Posted on: '.$approved[$i]["post_date"].'</a></li>   
                       <li><a href="#">By: '.$fullname["fullname"].'</a></li>
                       <li><a href="#">tag: '.$approved[$i]["tag"].'</a></li>
                    </ol>
                  </p>
                  <div class="row">
                     <div class="col-md-4"></div>
                     <div class="col-md-4">
                       <a class="btn btn-primary" href="detail.php?id='.$approved[$i]['id'].'&news='.urlencode($approved[$i]['title']).'">Read Details</a>
                     </div>
                     <div class="col-md-4"></div>
                  </div>
                </div>
              </div>
            </div>
          <div class="col-md-5"></div>
        </div>';
            } ?>
      </div>
        <div class="col-md-3">
         
         <?php
               if (!empty($approved)){
                echo '<h3 class="page-header" style="color: red;">>==Most Recent==<</h3>';
              for($x =0; $x< count($recent); $x++){

                echo '<div>
                      <p><h4>'.$recent[$x]["title"].'</h4></p>
                    <p><a href="detail.php?id='.$recent[$x]['id'].'&news='.urlencode($recent[$x]['title']).'">Read More</a></p>

                </div>';
              }
            }
           ?>
      </div>
      </div>
      </div>
      </div>
        
      </section>
      <div class="row container-fluid" style="background: black;">
      	<div class="col-md-2"></div>
      	<div class="col-md-8">
      		<form method="post" action="../utils/transaction.php" enctype="multipart/form-data" >
      			<fieldset>
      				<legend style="text-align: center; color: lightblue">Add New Post</legend>
      				  <p class="text-center" style="color: green;"> <?php $success = isset($_GET['success'])? $_GET['success']:''; echo $success;?> </p>
      				<input type="text" name="title" style="width: 100%; padding: 8px; border: 2px solid lightblue;" placeholder="Add post topic here">
              <input type="text" name="tag" style="width: 100%; padding: 8px; border: 2px solid lightblue;" placeholder="Add tag here E.g Politics, Education etc">
      				<textarea name="post" style="width: 100%; height: 200px; border: 2px solid lightblue; padding: 10px;" placeholder="-----------Write your post here-----------------"></textarea>	
      			  <input type="file" name="image">
              <small>Add image (Optional) </small>
      				<div class="row">
      					<div class="col-md-3"></div>
      					<div class="col-md-6">
      						<button name="action" type="submit"; value="submit_post" class="btn btn-primary" style="width: 80%;">Submit Post</button>
      					</div>
      					<div class="col-md-3"></div>
      				</div> 
      			</fieldset>
      		</form>
      	</div>
      	<div class="col-md-2"></div>
      </div>
       <?php include 'footer.php';?>
</body>
</html>