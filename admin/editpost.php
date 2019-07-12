
 <?php include_once './inc/header.php'; ?>
 <?php include_once './inc/sidebar.php' ?>

<?php require_once '../helpers/format.php' ?>
<?php require_once '../lib/Post.php' ?>
<?php require_once '../lib/Category.php' ?>

<?php $postDB = new Post(); 
 $categoryDB = new Category(); 
$format= new Format();
?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Post</h2>

<?php 

if (isset($_POST['editpost'])) {
     $post_update_id = $_POST['post_edit_id'];
    $title = $format->validation($_POST['title']);
    $body = $format->validation($_POST['body']);
    $category = $format->validation($_POST['category']);
 
    $tag = $format->validation($_POST['tag']); 

                $permited  = array('jpg', 'jpeg', 'png', 'gif');
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_temp = $_FILES['image']['tmp_name'];

                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div));
                $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
                $uploaded_image = "upload/". $unique_image;


// filed val chek
        if (empty($title)|| empty($body)|| empty($category)|| empty($tag)   ) {
                echo '<p style="color:red;text-align: center; font-size: 1.1rem;font-weight: 200;"> all field is requied </p>';    
        }   

     


if (!empty($file_name)) {

        // file size check
        if ($file_size>5000000) {
              echo '<p style="color:red;text-align: center; font-size: 1.1rem;font-weight: 200;"> file size not greater then 5 mb </p>';  
        }
        // file ext
        elseif (!in_array($file_ext,$permited)) {
              echo '<p style="color:red;text-align: center; font-size: 1.1rem;font-weight: 200;"> only jpg,png, jpeg file are  allowed to upload</p>';  
        }
        else{
         
            $query= "UPDATE `posts` SET `title`=:title,`cat`=:cat,`body`=:body,
            `images`=:images,`author`=:author,`tag`=:tag WHERE `id`=:postid";
              $data= [
                    'title'=>$title,
                    'body'=>$body,
                    'cat'=>$category,
                    'images'=>$unique_image,
                    'author'=>Session::get('username') ,
                    'tag'=>$tag,
                    'id'=>$post_update_id
              ];


               // this query for deleting previious pic
                $del_query= "SELECT `images` FROM `posts`  WHERE `id`=:deleteImg_id";
            	$result= $postDB->getImgToDelete($del_query,$post_update_id);

              	// print_r($result);
              if (file_exists("upload/".$result['images']) ) {

                 	// deleting old img
                 	unlink("upload/".$result['images']);

              	    } else {
                  echo "<script>window.alert('file does not exists');</script>";
                 	
                 }


             $result= $postDB->updateWithNewImage($query, $data);

            if ($result=="UPDATED") {
   		                 	// uplad new one
	                 	  move_uploaded_file($file_temp, $uploaded_image);
		                  echo "<script>window.alert('post updated');</script>";
		                      echo "<script>window.location.assign('http://localhost/PhpOopBlog/admin/postlist.php');</script>";       
     
               
            } else {
                 echo "<script>window.alert('query failed');</script>";   
            }
        

        }


    }else {
    	// if user does not uploan an img

    	     $query= "UPDATE `posts` SET `title`=:title,`cat`=:cat,`body`=:body,
            `author`=:author,`tag`=:tag WHERE `id`=:postid";
              $data= [
                    'title'=>$title,
                    'body'=>$body,
                    'cat'=>$category,
                    'author'=>Session::get('username') ,
                    'tag'=>$tag,
                    'id'=>$post_update_id
              ];

 
             $result= $postDB->updateWithOutImage($query, $data);

            if ($result=="UPDATED") { 
            	           echo "<script>window.location.assign('http://localhost/PhpOopBlog/admin/postlist.php');</script>";       
                 echo "<script>window.alert('post updated');</script>";
               
            } else {
                 echo "<script>window.alert('query failed');</script>";   
            }
            	
    }
} 
 ?>
         



<?php 


if ( isset($_GET['edit_id'])  && $_GET['action']=="edit_post"  ) {
	$edit_id = $_GET['edit_id'];

	$query = "SELECT * FROM `posts` WHERE  `id`=:edit_id ";
	$result =  $postDB->edit($query,$edit_id);
}



 ?>


                <div class="block">               
                 <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Title</label>
                            </td>
                            <td>
                                <input type="text" value="<?=$result['title'] ?>" name="title" placeholder="Enter Post Title..." class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Category</label>
                            </td>
                            <td>
                                <select id="select" name="category">
                         <?php $categories= $categoryDB->index(); ?>
                                  <?php foreach ($categories as $category): ?>
                   

                    		  <option 

                            <?php if ( $category['id']== $result['cat'] ): ?>
                              selected
                            <?php endif ?>
                           value="<?= $category['id'] ?>" > 
  
                            <?= $category['name'] ?>

                             </option>
                                  	 
                                    
                                  <?php endforeach ?>
                                </select>
                            </td>
                        </tr>
                   
                     <input type="hidden" name="post_edit_id" style="display: none;" value="<?=$result['id'] ?>">
                        <tr>
                            <td>
                                <label>Upload Image</label>

                            </td>
                            <td>
                                <input type="file"  name="image" />
                                 <img src="./upload/<?= $result['images'] ?>" width="95px" height="95px" alt="">
                            </td>
                             
                        </tr>

                             <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input value="<?=$result['tag'] ?>" type="text" placeholder="specify tags here" name="tag" />
                            </td>
                        </tr>

                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea placeholder="content" name="body" class="tinymce"><?=$result['body'] ?></textarea>
                            </td>
                        </tr>


                        <tr>
                            <td>
                                <label>Author</label>
                            </td>
                            <td>
                                <input disabled title="you are currently logged in as <?= Session::get('username') ?> " value="<?= Session::get('username') ?>" type="text"  name="author" />
                            </td>
                        </tr>
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="editpost" Value="Save changes" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>

<?php include_once './inc/footer.php'; ?>
