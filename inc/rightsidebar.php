<?php require_once './config/config.php'; ?>
<?php require_once './lib/Database.php'; ?> 
<?php include_once './helpers/format.php'; ?>
<?php 

	$db = new Database();
	$format= new Format();				


 ?>


<div class="sidebar clear">
			<div class="samesidebar clear">
				<h2>Categories</h2>
				<?php 
                $categories=  $db->select("SELECT * FROM `categories`");
				 ?>
					<ul>
						<?php foreach ($categories as $category): ?>
							<li><a href="posts.php?category=<?=$category['id'] ?>"><?= $category['name']; ?></a></li>
						<?php endforeach ?>
						  				
					</ul>
			</div>
			
			<div class="samesidebar clear">
				<h2>Latest articles</h2>
				 
				<?php 
                      $posts =  $db->select("SELECT `id`,`title`,`body`,`images` FROM `posts` LIMIT 4");
				 ?>
					
			 <?php foreach ($posts as $post): ?>
			 	
					<div class="popular clear">
						<h3><a href="post.php?id=<?= $post['id'] ?>"> <?= $post['title'] ?></a></h3>
						<a href="post.php?id=<?= $post['id'] ?>"><img src="./admin/upload/<?= $post['images'] ?>" alt="<?= $post['title'] ?>"></a>
						 <?= $format->shortParagraph($post['body'],40) ?>	
					</div>
			 <?php endforeach ?>
	
			</div>
			
		</div> 