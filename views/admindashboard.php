<?php 
require_once $_SERVER['DOCUMENT_ROOT'].'/autoloader/Autoloader.php';   
$data = new PostController;
$approved = $data->showUnApprovedPost();
 
 require   'links.php';
?>


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
            <li><a href="http://techArener.com"><span class="glyphicon glyphicon-home"> Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-phone"> Contact</a></li>
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="admindashboard.php"><span class="glyphicon glyphicon-user"></span> ADMIN DASHBOARD</a></li>
            <li><a href="../views/logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
          </ul>
        </div>
      </div>
    </nav> 
    
   
    <section>
        <div class="container-fluid forum" style="margin-bottom: 0px;">
          <div class="panel panel-primary">
            <div class="panel-heading"><p class="text-muted" style="text-align: center; font-size: 18px; color: lightblue"><strong><i>Welcome:: <span class="glyphicon glyphicon-user" style="color: black;"></span>  <?php echo ucwords($_SESSION['fname']);?>  to techArener Admin Dashboard</i></strong></p></div>
              <div class="panel-body pbody" >
                <p class="text-center" style="color: green" id="success"> <?php $success = isset($_GET['success'])? $_GET['success']:''; echo $success;?></p>
                
                <?php
                   

                for ($i=0; $i < count($approved) ; $i++) { 


                 echo '
                
          <div class="row">
        <div class="col-sm-6 col-md-1"></div>
        <div id="wrap" class="col-md-6">
            <h2 class="text-center page-header">'.$approved[$i]["title"].'</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="thumbnail">
                        <img src="../uploads/'.$approved[$i]["image"].".jpg".'"  width="350px" height="400px" class="thumbnail img-responsive">
                        <div class="caption"><small class="text-center" style="font-style: italic;">Descriptive Image</small></div>
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
                   <form method="post" action="../utils/transaction.php" onsubmit="return confirm("Do you really want to take this action?")";>
                    <div class="btn-group">
                        <button type="submit" name="delete" value='.$approved[$i]['id'].' class="btn btn-primary" >Delete</button>
                        <button type="submit" name="publish" value='.$approved[$i]['id'].' class="btn btn-primary">Publish</button>
                        <a class="btn btn-primary" href="editor.php?id='.$approved[$i]['id'].'">Edit</a>
                        <a class="btn btn-primary" href="detail.php?id='.$approved[$i]['id'].'">View</a>
                         <a class="btn btn-primary" href="image_editor.php?id='.$approved[$i]['id'].'">Edit Image</a> 
                    </div>
                    </form>

                </div>
         
            </div>
        </div>
        <div class="col-md-5"></div>
        </div>';
            }?>
            </div>

                <!-- <a href="../utils/transaction.php?post_id=1"><button class="btn btn-primary">Approve Post</button></a> -->
              </div>
          </div>
        </div>
      </section>
      <div class="row" style="background: black;">
      	<div class="col-md-2"></div>
      	<div class="col-md-8">
      		<form method="post" action="../utils/transaction.php" >
      			<fieldset>
      				<legend style="text-align: center; color: lightblue">Add New Post</legend>
      				  <p > <!-- <?php //echo $successful;?> --> </p>
      				<input type="text" name="title" style="width: 100%; padding: 8px; border: 2px solid lightblue;" placeholder="Add post topic here">
              <input type="text" name="tag" style="width: 100%; padding: 8px; border: 2px solid lightblue;" placeholder="Add tag here E.g Politics, Education etc">
      				<textarea name="post" style="width: 100%; height: 200px; border: 2px solid lightblue; padding: 10px;" placeholder="-----------Write your post here-----------------"></textarea>	
      			
      				<div class="row">
      					<div class="col-md-3"></div>
      					<div class="col-md-6">
      						<button name="action" type="submit"; value="submit_post" class="btn btn-primary" style="width: 100%;">Submit Post</button>
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