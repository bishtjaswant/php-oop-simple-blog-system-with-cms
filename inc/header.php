<?php require_once $_SERVER['DOCUMENT_ROOT']. '/PhpOopBlog/config/config.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']. '/PhpOopBlog/lib/Database.php'; ?>
<?php include_once $_SERVER['DOCUMENT_ROOT']. '/PhpOopBlog/helpers/format.php'; ?>


<!DOCTYPE html>
<html>
<head>
	<title> <?= SITE_TITLE ?></title>
	<meta name="language" content="English">
	<meta name="description" content="It is a website about education">
	<meta name="keywords" content="blog,cms blog">
	<meta name="author" content="Delowar">
	<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
	<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="style.css">
	<script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/jquery.nivo.slider.js" type="text/javascript"></script>

<script type="text/javascript">
$(window).load(function() {
	$('#slider').nivoSlider({
		effect:'random',
		slices:10,
		animSpeed:500,
		pauseTime:5000,
		startSlide:0, //Set starting Slide (0 index)
		directionNav:false,
		directionNavHide:false, //Only show on hover
		controlNav:false, //1,2,3...
		controlNavThumbs:false, //Use thumbnails for Control Nav
		pauseOnHover:true, //Stop animation while hovering
		manualAdvance:false, //Force manual transitions
		captionOpacity:0.8, //Universal caption opacity
		beforeChange: function(){},
		afterChange: function(){},
		slideshowEnd: function(){} //Triggers after all slides have been shown
	});
});
</script>
</head>



<body>
	<div class="headersection templete clear">
		<a href="#">


                <?php
 
/*
you can change the site  title  from backend easily*/
                   require_once $_SERVER['DOCUMENT_ROOT'].'/PhpOopBlog/lib/Slogan.php';
                    $sloganDB = new Slogan(); 
                    $query="SELECT * FROM `slogan` ";
                    $result = $sloganDB->index($query);
        
                 ?>

			<div class="logo">
				<img src="admin/logo/<?= $result[0]['logo'] ?>" alt="<?= $result[0]['title'] ?>"/>
				<h2><?= $result[0]['title'] ?></h2>
				<p><?= $result[0]['slogan'] ?></p>
			</div>
		</a>

		<div class="social clear">
			<div class="icon clear">

<?php 
//* you can change the socia link*/
require_once $_SERVER['DOCUMENT_ROOT'].'/PhpOopBlog/lib/SocialMedia.php'; 
$socialmediaDB= new SocialMedia();
  
                    $query= "SELECT * FROM `social_media`";
                    $result= $socialmediaDB->index($query);
                ?>
				<a href="<?= $result['fb'] ?>" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="<?= $result['tw'] ?>" target="_blank"><i class="fa fa-twitter"></i></a>
				<a href="<?= $result['insta'] ?>" target="_blank"><i class="fa fa-instagram"></i></a>
				<a href="<?= $result['gl'] ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
				<a href="<?= $result['githup'] ?>" target="_blank"><i class="fa fa-github"></i></a>
			</div>
			<div class="searchbtn clear">
			<form action="search.php" method="get">
				<input type="text" name="search" placeholder="Search..."/>
				<input type="submit"  value="Search"/>
			</form>
			</div>
		</div>
	</div>
<div class="navsection templete">
	<ul>
		<li><a id="active" href="index.php">Home</a></li>
		<li><a href="about.php">About</a></li>	
		<li><a href="contact.php">Contact</a></li>
	</ul>
</div>



