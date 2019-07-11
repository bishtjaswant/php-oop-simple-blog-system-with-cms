<div class="footersection templete clear">
	  <div class="footermenu clear">

	  	    	 <?php 
//* you can change the copyrightr*/
require_once $_SERVER['DOCUMENT_ROOT'].'/PhpOopBlog/lib/Copyright.php'; 
$copyrightDB= new Copyright();
$query= "SELECT * FROM `copyright`";
$result= $copyrightDB->index($query);
     ?>
		<ul>
			<li><a href="#">Home</a></li>
			<li><a href="#">About</a></li>
			<li><a href="#">Contact</a></li>
			<li><a href="#">Privacy</a></li>
		</ul>
	  </div>
	  <p>&copy; <?= $result['name'] ?></p>
	</div>
    <div class="fixedicon clear">
    	 <?php 
//* you can change the socia link*/
require_once $_SERVER['DOCUMENT_ROOT'].'/PhpOopBlog/lib/SocialMedia.php'; 
$socialmediaDB= new SocialMedia();
$query= "SELECT * FROM `social_media`";
$result= $socialmediaDB->index($query);
     ?>

		<a href="<?=$result['fb'] ?>" target="_blank"><img src="images/fb.png" alt="Facebook"/></a>
		<a href="<?=$result['tw'] ?>" target="_blank"><img src="images/tw.png" alt="Twitter"/></a>
		<a href="<?=$result['gl'] ?>" target="_blank"><img src="images/gl.png" alt="GooglePlus"/></a>
		<a href="<?=$result['insta'] ?>" target="_blank"><img src="images/insta.png" alt="LinkedIn"/></a>
		<a href="<?=$result['githup'] ?>" target="_blank"><img src="images/githup.png" alt="LinkedIn"/></a>
	</div>
</body>
</html>