
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

	  <?php if (!isset($_GET['search']) ||  $_GET['search']==null): ?>
	  	<p class="post-description"> your searched data not found please try another keyword	</p>
	  	<p class="gotohome"><a href="index.php">go to home page</a></p>
	  <?php else: ?>
	  	
	  <?php  
         $keyword = $_GET['search']; 
         $query= "SELECT * FROM `posts` WHERE `title` LIKE :title OR `body` LIKE :body ";
         $postByCats = $db->searchQuery($query,$keyword);
         
	   ?>
		
	          <?php if (count($postByCats)>0): ?>
	          		<?php foreach ($postByCats as $post): ?>
						<div class="about">
							 	<h2><?= $post['title']; ?></h2>
								 <h4>  <?= $format->formateDate($post['postedat']); ?> , By <a href="#"><?= $format->formatString($post['author']) ?></a></h4>
								
							   <img src="./admin/upload/<?= $post['images']; ?>" alt="<?= $post['title']; ?>"/>
								<p>
								 <?=$post['body']; ?>
								</p> 

								<div class="readmore clear">
										<a href="post.php?id=<?= $post['id']; ?>">Read More</a>
									</div>
									<br> <br> <br>
		             	</div>

        		<?php endforeach ?>

	          <?php else: ?>
	                	<p class="post-description"> No results found for <?= $keyword ?>	</p>
	                 	<p class="gotohome"><a href="index.php">go to home page</a></p>
	
	          <?php endif ?>
		
	  <?php endif ?>

	  </div>

		<!-- right siiderbar -->
        <?php include_once './inc/rightsidebar.php'; ?>
	</div>



<!-- footer section -->
<?php include_once './inc/footer.php'; ?>