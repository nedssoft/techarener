<?php

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
            <img src="../uploads/'.$approved[0]["image"].".jpg".'" alt="MIT" >
            <div class="carousel-caption">
              <p ><a class="title" href="detail.php?id='.$approved[0]['id'].'" ><h3>'.$approved[0]["title"].'</a></p>
            </div>
          </div>

          <div class="item">
            <img src="../uploads/'.$approved[1]["image"].".jpg".'" alt="Stanford University" >
            <div class="carousel-caption">
              <p ><a class="title" href="detail.php?id='.$approved[1]['id'].'" ><h3>'.$approved[1]["title"].'</h3></a></p>
            </div>
          </div>
          <div class="item">
            <img src="../uploads/'.$approved[2]["image"].".jpg".'" alt="Flower" >
            <div class="carousel-caption">
             <p ><a class="title" href="detail.php?id='.$approved[2]['id'].'" ><h3>'.$approved[2]["title"].'</h3></a></p>
            </div>
          </div>
          <div class="item">
            <img src="../uploads/'.$approved[3]["image"].".jpg".'" alt="Flower" >
            <div class="carousel-caption">
              
              <p><a class="title" href="detail.php?id='.$approved[3]['id'].'" ><h3>'.$approved[3]["title"].'</h3></a></p>
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
            <img src="../uploads/'."generic".".jpg".'" alt="MIT" >
            <div class="carousel-caption">
             
            </div>
          </div>
          </div>';
}