<?php require_once '../lib/Session.php'; 
Session::checkSession();

require_once "../config/config.php"; 
require_once "../helpers/format.php"; 
require_once '../lib/Contact.php'; 
require_once '../lib/Slogan.php';


$sloganDB = new Slogan();
$format=  new Format();
 
$contactDB = new Contact();

header("Cache-Control:no-cache, must-revalidate");
header("Pragma:no-cache");
header("Expires:Sat, 26 July 1997 05:00:00 GMT");
header("Cache-Control:max-age=2592000");
 ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title> Admin Dashboard</title>
    <link rel="stylesheet" href="css/normalize.css">
<link rel="stylesheet" href="css/dist/jBox.all.css">
<link rel="stylesheet" href="css/demo.css">
<link rel="stylesheet" href="css/playground-avatars.css">
<link rel="stylesheet" href="css/playground-inception.css">
<link rel="stylesheet" href="css/playground-login.css">

    <link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
    <link href="css/table/demo_page.css" rel="stylesheet" type="text/css" />
    <!-- BEGIN: load jquery -->
    <script src="js/jquery-1.6.4.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/jquery-ui/jquery.ui.widget.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.accordion.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.core.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.effects.slide.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.mouse.min.js" type="text/javascript"></script>
    <script src="js/jquery-ui/jquery.ui.sortable.min.js" type="text/javascript"></script>
    <script src="js/table/jquery.dataTables.min.js" type="text/javascript"></script>
    <!-- END: load jquery -->
    <script type="text/javascript" src="js/table/table.js"></script>
    <script src="js/setup.js" type="text/javascript"></script>
	 <script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
		    setSidebarHeight();
        });
    </script>

</head>
<body>
    <div class="container_12">
        <div class="grid_12 header-repeat">
            <div id="branding">
               
 
                <?php 
                   require_once $_SERVER['DOCUMENT_ROOT'].'/PhpOopBlog/lib/Slogan.php';
                    $sloganDB = new Slogan(); 
                    $query="SELECT * FROM `slogan` ";
                    $result = $sloganDB->index($query);
                 ?>
               
                <div class="floatleft logo">
                    <img src="logo/<?= $result[0]['logo'] ?>" alt="Logo" />
                </div>


				<div class="floatleft middle">
					<h1> <?= $result[0]['title'] ?> </h1>
					<p> <?= $result[0]['slogan'] ?> </p>
				</div>

                <?php 
                       if (isset($_GET['action']) && $_GET['action']==="logout") {
                          Session::destroy();
                       }  

                 ?>
                <div class="floatright">
                    <div class="floatleft">
                        <img src="img/img-profile.jpg" alt="Profile Pic" /></div>
                    <div class="floatleft marginleft10">
                        <ul class="inline-ul floatleft">
                            <li>Hello <?= Session::get('username') ?> </li>
                            <li><a href="?action=logout">Logout</a></li>
                        </ul>
                    </div>
                </div>
                <div class="clear">
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
        
        <div class="grid_12">
            <ul class="nav main">
                <li class="ic-dashboard"><a href="index.php"><span>Dashboard</span></a> </li>
                <li class="ic-form-style"><a href="userprofile.php"><span>User Profile</span></a></li>
                <li class="ic-typography"><a href="changepassword.php"><span>Change Password</span></a></li>

                <?php 
                    $query="select * from `contacts` where `seen`= 0";
                    $result= $contactDB->unseenMessage($query);
                 ?>
                <li class="ic-grid-tables"><a href="inbox.php"><span>Inbox (<?= $result ?>) </span></a></li>
                <li class="ic-charts"><a href="postlist.php"><span>All Posts</span></a></li>
            </ul>
        </div>
        <div class="clear">
        </div>
       
