
<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/autoloader/Autoloader.php';
$data = new PostController;
$approved = $data->showApprovedPost();
$postMod = new PostModel();
if (!empty($approved)){
$recent = $data->showMostRecentPosts();
}
  require 'views/links.php';
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
          <a class="navbar-brand" href="#" id="logo">TECHARENER</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            <li class="active"><a href="http://techarener.com"><span class="glyphicon glyphicon-home"> Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#"><span class="glyphicon glyphicon-phone"> Contact</a></li>
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <?php
            if(isset($_SESSION['fname'])){
              if ($_SESSION['role']==0){
                echo '<li><a href="views/dashboard.php"><span class="glyphicon glyphicon-user"></span> My Dashboard</a></li>
                <li><a href="views/logout.php"><span class="glyphicon glyphicon-logout"></span> Logout</a></li>';
              }
              else{
                echo '<li><a href="views/admindashboard.php"><span class="glyphicon glyphicon-user"></span>AdminDashboard</a></li>
                <li><a href="views/logout.php"><span class="glyphicon glyphicon-logout"></span> Logout</a></li>';
              }
         
            }else{
              echo '<li><a href="views/register.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
            <li><a href="views/login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
            }
         
           echo ' 
          </ul>
        </div>
      </div>
    </nav>';
    
    $image1 = isset($approved[0]["image"])?$approved[0]["image"]:"generic";
    $image2 = isset($approved[1]["image"])?$approved[1]["image"]:"generic";
    $image3= isset($approved[2]["image"])?$approved[2]["image"]:"generic";
    $image4 = isset($approved[3]["image"])?$approved[3]["image"]:"generic";
if (count($approved)>=4){
echo '<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active" style="background: #eee;"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
          <li data-target="#myCarousel" data-slide-to="3"></li>
        </ol>

    <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img src="uploads/'.$approved[0]["image"].".jpg".'" alt="MIT" >
            <div class="carousel-caption">
              <p ><a class="title" href="views/detail.php?id='.$approved[0]['id'].'&news='.urlencode($approved[0]['title']).'" ><h3>'.$approved[0]["title"].'</a></p>
            </div>
          </div>

          <div class="item">
            <img src="uploads/'.$approved[1]["image"].".jpg".'" alt="Stanford University" >
            <div class="carousel-caption">
              <p ><a class="title" href="views/detail.php?id='.$approved[1]['id'].'&news='.urlencode($approved[1]['title']).'" ><h3>'.$approved[1]["title"].'</h3></a></p>
            </div>
          </div>
          <div class="item">
            <img src="uploads/'.$approved[2]["image"].".jpg".'" alt="Flower" >
            <div class="carousel-caption">
             <p ><a class="title" href="views/detail.php?id='.$approved[2]['id'].'&news='.urlencode($approved[2]['title']).'" ><h3>'.$approved[2]["title"].'</h3></a></p>
            </div>
          </div>
          <div class="item">
            <img src="uploads/'.$approved[3]["image"].".jpg".'" alt="Flower" >
            <div class="carousel-caption">
              
              <p><a class="title" href="view/detail.php?id='.$approved[3]['id'].'&news='.urlencode($approved[3]['title']).'" ><h3>'.$approved[3]["title"].'</h3></a></p>
            </div>
          </div>
          <!-- Left and right controls -->
          <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
';}

else{
  echo '<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active" style="background: #eee;"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
          <li data-target="#myCarousel" data-slide-to="3"></li>
        </ol>

    <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
          <div class="item active">
            <img src="uploads/'."generic".".jpg".'" alt="MIT" >
            <div class="carousel-caption">
             
            </div>
          </div>
          </div>';
}
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

                    <a href="views/detail.php?id='.$approved[$i]['id'].'">
                        <img src="uploads/'.$image.".jpg".'"  width="350px" height="400px" class="thumbnail img-responsive">
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
                    <a class="btn btn-primary" href="views/detail.php?id='.$approved[$i]['id'].'&news='.urlencode($approved[$i]['title']).'">Read Details</a>
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
       <footer class="container-fluid" style="margin-top: 0px; background: black;" >
      <div style="padding: 20px;">
        <div class="row">
          <div class="col-md-4" style="margin-top: 30px; text-align: center;" >
            <p> &copy 2017 All Rights Reserved</p>
          </div>
          <div class="col-md-4">
            <p>  Contact Us</p>
            <p><span class="glyphicon glyphicon-phone"> 07035052689</span></p>
            <address> 
            <p>Floor 2, Hollifield Plaza aroma Awka </p>
            <p>Website: <a href="tribenigeria.com">Tribe Nigeria</a></p>
            <p>Email: info@tribenigeria.com</p>
            </address>
          </div>
          <div class="col-md-4">
            <p> <a href="facebook.com/orie.chinedu">
              <img src="utils/images/facebook.png" alt="../http://facebook.com/orie.chinedu" width="100px"; height="30px;" >
            </a></p>
            <p> <a href="twitter.com/orie.chinedu">
              <img src="utils/images/twitter.jpg" alt="../http://facebook.com/orie.chinedu" width="100px"; height="30px;" >
            </a></p>
            <p> <a href="facebook.com/orie.chinedu">
              <img src="utils/images/instagram.jpg" alt="../http://facebook.com/orie.chinedu" width="100px"; height="30px;" >
            </a></p>
          </div>
        </div>
        </div>
      </footer>
       <!--Start of Tawk.to Script-->
      <script type="text/javascript">
            var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
            (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/598e0d451b1bed47ceb042ae/default';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
            })();
      </script>
      <!--End of Tawk.to Script-->
    </body>
</html>

