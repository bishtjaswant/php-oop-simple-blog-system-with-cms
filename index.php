
<?php include_once 'inc/header.php';?>

<?php 
	$db = new Database();
	$format= new Format();	 
?>








<!-- slider -->
	<?php include_once './inc/slider.php'; ?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
	 
 

			<!--  pagination -->
			<?php 

          $per_page  =2;
             // get current page
             if (isset($_GET['pageno'])) {
             	$pageno= $_GET['pageno'];
             } else {
             	$pageno=1;
             }
             
             $start_from = ( $pageno-1 ) * $per_page;
      

			 ?>
			<!-- end pagination -->

 	<?php	 $posts=  $db->select("SELECT * FROM `posts` ORDER BY `id` DESC LIMIT $start_from,$per_page");
	       
	       	if ( $posts ): ?>
			<?php foreach ($posts as $post): ?>
		
		  <div class="samepost clear">
				<h2><?= $post['title']; ?></h2>
				<h4>  <?= $format->formateDate($post['postedat']); ?> , By <a href="#"><?= $format->formatString($post['author']) ?></a></h4>
				 <img src="./admin/upload/<?= $post['images']; ?>" alt="<?= $post['title']; ?>"/>
				<p>
				 <?= $format->shortParagraph($post['body'],250) ?>
				</p>
				<div class="readmore clear">
					<a href="post.php?id=<?= $post['id']; ?>">Read More</a>
				</div>
			</div>


			<?php endforeach ?>




            <!-- pagination -->

            <?php 
			 $query= "SELECT * FROM `posts` ";
             $total_rows= $db->numberOfRow($query);
             $total_pages= ceil($total_rows/$per_page);

            ?>
                 <span class="pagination">
                 	<a href="<?= $_SERVER['PHP_SELF']  ?>?pageno=1">first</a>
                   <?php 
                    for ($i = 1; $i <=$total_pages ; $i++) {
                      	echo "<a href='index.php?pageno={$i}'> {$i} </a>";
                     }
                    ?>
                 	<a href="<?= $_SERVER['PHP_SELF']  ?>?pageno=<?=$total_pages; ?>">last</a>
                 
                 </span>

			<!-- end pagination -->








		<?php else: ?>
			<h3>no post</h3>
		<?php endif ?>


		</div>
		<!-- right sidebar-->
		<?php include_once './inc/rightsidebar.php'; ?>


	</div>

	 

<!-- footer -->
	<?php include_once './inc/footer.php'; ?>