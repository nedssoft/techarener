<?php
session_start();

require_once $_SERVER['DOCUMENT_ROOT'].'/autoloader/Autoloader.php';

$commentMod = new CommentModel();
$model      = new PostModel();

if (isset($_GET['id'])){
$detail = $model->fetchDetail($_GET['id']);//this fetches the full detail of a post when Read more is clicked 
//$date = date_parse($detail['post_date']);
//print_r($date)
$_SESSION['post_id'] = $_GET['id']; 
$fnam    = $model->getFullname($detail['user_id']);

$fname= $fnam['fullname'];

if ($commentMod->fetchComments($_GET['id']) !== null){
  $comments =  $commentMod->fetchComments($_GET['id']);
}

}
$related = $model->relatedPosts($detail['tag']);

/*$_SESSION['post_id'] = $_GET['id'];
*gets the post id used to reference the post in the comment table
**/
 require 'links.php';
?>

  <body>
    <nav class="navbar navbar-default navbar-fixed" style="margin-bottom: 0px;">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#" style="font-family: 'Monoton', cursive; color: black;">TECHARENER</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li><a href="http://techarener.com"><span class="glyphicon glyphicon-home"></span> HOME</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-phone"></span> Contact</a></li>
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
             <?php 
            if(isset($_SESSION['fname'])){
              if ($_SESSION['role']==0){
                echo '<li><a href="dashboard.php"><span class="glyphicon glyphicon-user"></span> My Dashboard</a></li>
                 <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>';
              }
              else{
                echo '<li><a href="admindashboard.php"><span class="glyphicon glyphicon-user"></span> Admin Dashboard</a></li>
                 <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>';
              }
            
            }else{
              echo '<li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
            }
          ?>
        </div>
      </div>
    </nav> 

    <section>
        <div class="container forum" style="margin-bottom: 0px;">
          
      
              
                
                   <?php
                   $image = (($detail["image"]!==null)? $detail["image"]:"generic");
                
                 echo '
                
          <div class="row">
        
        <div id="wrap" class="col-md-9" style="border-right: 6px solid gray">
            <h2 class="page-header">'.$detail["title"].'</h2>
            <div class="row">
                <div class="col-md-4">
                    
                        <img src="../uploads/'.$image.".jpg".'"  width="350px" height="400px" class="thumbnail img-responsive">
                        <div class="caption"><span class="text-center" style="font-style: italic;">'.$detail["title"].'</span></div>
                        
                </div>
                <div class="col-md-8" id="left">
                  <p  ><blockquote style="font-size:14px;">'.nl2br($detail["post"]).'</blockquote></p>
                    <p>
                        <ol class="breadcrumb">
                            <li><a href="#">Author:'.'&nbsp;&nbsp;&nbsp;'. ucwords($fname).'</a></li>
                            <li><a href="#">'.$detail["post_date"].'</a></li>
                            <li><a href="#">#tag:&nbsp;&nbsp;'.$detail['tag'].'</a></li>
                        </ol>
                    </p>
                   
                </div>
         
            </div>
        </div>';?>
        <div class="col-md-3">
           <h3 class="page-header" style="color: red;">>==Related Posts==<</h3>
           <?php
              for($x =0; $x< count($related); $x++){

                echo '<div>
                      <p><h4>'.$related[$x]["title"].'</h4></p>
                    <p><a href="detail.php?id='.$related[$x]['id'].'&news='.urlencode($related[$x]['title']).'">Read More</a></p>

                </div>';
              }
           ?>
        </div>
        </div>
            

                
             
          
        </div>
      </section>
      <section>
          <?php
                  echo  '<div class="row">
                         <div class="col-md-2"></div>
                        <div class="col-md-10">
                  <h2 class="page-header " style="color:green;">['.count($comments).']Comment(s) </h2>     
                    </div>
                    </div>';    
                for ($i=0; $i < count($comments) ; $i++) { 
                 echo '<div class="row">
                         <div class="col-md-1"></div>
                         <div id="wrap" class="col-md-7">
        
            <div class="row">
               
                <div class="col-md-8" id="left">
                    <p  ><blockquote style="font-size:14px;">'.$comments[$i]["comment"].'</blockquote></p>
                    <p>
                        <ol class="breadcrumb">
                            <li><a href="#">'.$comments[$i]["created_at"].'</a></li>
                            <li><a href="#">By: '.ucwords($comments[$i]["username"]).'</a></li>
                        </ol>
                    </p>
                   
                    
                </div>
               <div class="col-md-4"></div>
            </div>
        </div>
        <div class="col-md-4"></div>
        </div>';
            }?>
      </section>

      <section>
        <div class="row container-fluid" style="background: black;">
        <div class="col-md-4"></div>
        <div class="col-md-4" >
        
          <form method="post" action="../utils/transaction.php">
            
            <fieldset>
              <legend style="text-align: center; color: lightblue">Comment</legend>
              <!-- <p > <?php //echo $successful;?> </p> -->
               <p class="text-center" style="color:red";>
             <?php $error = isset($_SESSION['error'])? $_SESSION['error']:''; echo $error; unset($_SESSION['error']);?>
             </p>
             <p class="text-center" style="color:green";>
             <?php  $success = isset($_SESSION['success'])? $_SESSION['success']:''; echo $success; unset($_SESSION['success']);?>
             </p>
              <textarea value="<?php $comment?>" name="comment" style="width: 100%; height: 200px; border: 2px solid lightblue; padding: 10px;"></textarea>
              <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                  <button name="submit_comment" type="submit"; value="<?php if (isset($_GET["id"])){echo $_GET["id"];}?>" class="btn btn-primary" style="width: 80%; margin: 20px;">Submit comment</button>
                </div>
                <div class="col-md-3"></div>
              </div> 
            </fieldset>
          </form>
        </div>
        <div class="col-md-4"></div>
      </div>
      </section>
      <?php include 'footer.php';?>
</body>
</html>