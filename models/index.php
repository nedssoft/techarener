
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

<nav class="navbar navbar-fixed-top navbar-default" style="margin-bottom: 0px; background: white;">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#" id="logo">techArena</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#"><span class="glyphicon glyphicon-home"> Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-phone"> Contact</a></li>
            
          </ul>
          <ul class="nav navbar-nav navbar-right">';
            
            if(isset($_SESSION['fname'])){
                echo '<li><a href="views/dashboard.php"><span class="glyphicon glyphicon-user"></span> My Dashboard</a></li>';
            ;
            }else{
              echo '<li><a href="views/register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li><a href="views/login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
            }
         
           echo ' 
          </ul>
        </div>
      </div>
    </nav>
    <?php 
    //<!--coarousel-->
         require 'carousel.php';
    ?>

      <div class="container-fluid forum" style="margin-top: 20px;">
          <div class="panel panel-primary">
            <div class="panel-heading"><h2 id="fhead" style="font-family: 'Petit Formal Script', cursive;">FORUM</h2></div>
              <div class="panel-body pbody" >
              <div class="row">
                  <div class="col-md-9" style="border-right: 6px solid gray; box-shadow:  0px, 0px, 10px red;" >
               <?php
                for ($i=0; $i < count($approved) ; $i++) { 
                  $fullname = $postMod->getFullname($approved[$i]['user_id']);
                  $image = (($approved[$i]["image"]!==null)? $approved[$i]["image"]:"generic");
                 echo '
                
          <div class="row">
        <div class="col-sm-6 col-md-1"></div>
        <div id="wrap" class="col-md-11">
            <h2 class="text-center page-header">'.$approved[$i]["title"].'</h2>
            <div class="row">
                <div class="col-md-5">

                    <a href="detail.php?id='.$approved[$i]['id'].'">
                        <img src="../uploads/'.$image.".jpg".'"  width="350px" height="400px" class="thumbnail img-responsive">
                        <div class="caption"><span class="text-center" style="font-style: italic;">'.$approved[$i]["title"].'</span></div>
                    </a>    
                </div>
                <div class="col-md-7" id="left">
                   <div style="height: 100px; overflow: hidden;">
                    <p  ><blockquote style="font-size:14px;">'.nl2br($approved[$i]["post"]).'</blockquote></p>
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
                    <a class="btn btn-primary" href="detail.php?id='.$approved[$i]['id'].'">Read detail</a>
                    </div>
                    <div class="col-md-4"></div>
                    </div>
                </div>
         
            </div>
        </div>
       
        </div>';
            }?>
              </div>
              <div class="col-md-3">
         
         <?php
           if(!empty($approved)){
            echo '<h3 class="page-header" style="color: red;">>==Most Recent==<</h3>';
              for($x =0; $x< count($recent); $x++){

                echo '<div>
                      <p><h4>'.$recent[$x]["title"].'</h4></p>
                    <p><a href="detail.php?id='.$recent[$x]['id'].'">Read More</a></p>

                </div>';
              }
            }
           ?>
          </div>
          </div>
          </div>
        </div>
      </section>
      <?php include 'footer.php';?>
    </body>
</html>

