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
                <h2>Add New Post</h2>

<?php 

if (isset($_POST['addpost'])) {
     
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
        if (empty($title)|| empty($body)|| empty($category)|| empty($tag) || empty($file_name)  ) {
                echo '<p style="color:red;text-align: center; font-size: 1.1rem;font-weight: 200;"> all field is requied </p>';    
        }  
        // file size check
        elseif ($file_size>5000000) {
              echo '<p style="color:red;text-align: center; font-size: 1.1rem;font-weight: 200;"> file size not greater then 5 mb </p>';  
        }
        // file ext
        elseif (!in_array($file_ext,$permited)) {
              echo '<p style="color:red;text-align: center; font-size: 1.1rem;font-weight: 200;"> only jpg,png, jpeg file are  allowed to upload</p>';  
        }
        else{
            $query= "INSERT INTO `posts`( `title`, `cat`, `body`, `images`, `author`, `tag`)
             VALUES (:title,:cat, :body,:images,:author,:tag)";
              $data= [
                    'title'=>$title,
                    'body'=>$body,
                    'cat'=>$category,
                    'images'=>$unique_image,
                    'author'=>Session::get('username') ,
                    'tag'=>$tag
              ];
             $result= $postDB->insert($query, $data);

            if ($result=="INSERTED") {
                 move_uploaded_file($file_temp, $uploaded_image);
                  echo "<script>window.alert('post created');</script>";
               
            } else {
                 echo "<script>window.alert('query failed');</script>";
                
            }
         
        }

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
                                <input type="text" name="title" placeholder="Enter Post Title..." class="medium" />
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
                                      <option value="<?= $category['id'] ?>" > <?= $category['name'] ?> </option>
                                  <?php endforeach ?>
                                </select>
                            </td>
                        </tr>
                   
                     
                        <tr>
                            <td>
                                <label>Upload Image</label>
                            </td>
                            <td>
                                <input type="file"  name="image" />
                            </td>
                        </tr>

                             <tr>
                            <td>
                                <label>Tags</label>
                            </td>
                            <td>
                                <input type="text" placeholder="specify tags here" name="tag" />
                            </td>
                        </tr>

                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Content</label>
                            </td>
                            <td>
                                <textarea placeholder="content" name="body" class="tinymce"></textarea>
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
                                <input type="submit" name="addpost" Value="Save" />
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
