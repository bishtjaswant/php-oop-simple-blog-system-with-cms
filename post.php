<?php require_once './config/config.php'; ?>
<?php require_once './lib/Database.php'; ?>
  <?php include_once './helpers/format.php'; ?>

<?php 
$db = new Database() ;
	$format= new Format();				 
?>
<!-- header -->
 <?php include_once './inc/header.php'; ?>
		 
 
	<div class="contentsection contemplete clear">
	    
	    <div class="maincontent clear">

	  <?php if (!isset($_GET['id']) ||  $_GET['id']==null): ?>
	  	<p class="post-description"> post does not exist or may be deleted from server	</p>
	  	<p class="gotohome"><a href="index.php">go to home page</a></p>
	  <?php else: ?>
	  	
	  <?php  
         $postid = $_GET['id'];
         $query= "SELECT * FROM `posts` WHERE `id`=:id ";
         $posts = $db->executeRow($query,$postid);
 
    
	   ?>
		
		<?php foreach ($posts as $post): ?>
				<div class="about">
			 	<h2><?= $post['title']; ?></h2>
				 <h4>  <?= $format->formateDate($post['postedat']); ?> , By <a href="#"><?= $format->formatString($post['author']) ?></a></h4>
				
			   <img src="./admin/upload/<?= $post['images']; ?>" alt="<?= $post['title']; ?>"/>
				<p>
				 <?=$post['body']; ?>
				</p>


				<div class="relatedpost clear">


					<?php 
                     $catid= $post['cat'];
                     $catquery= "SELECT `id`,`images` FROM `posts` WHERE `cat`=:id LIMIT 6";
                     $cats  = $db->executeRow($catquery,$catid);
                 

                ?>
					<h2>Related articles</h2>

                    <?php foreach ($cats as $cat): ?>
					<a href="#"><img src="./admin/upload/<?= $cat['images'] ?>" alt="post image"/></a>
                    					 	
                    <?php endforeach ?>					 
				</div>
             	</div>


		<?php endforeach ?>
		
	  <?php endif ?>

	  </div>

		<!-- right siiderbar -->
        <?php include_once './inc/rightsidebar.php'; ?>
	</div>



<!-- footer section -->
<?php include_once './inc/footer.php'; ?>