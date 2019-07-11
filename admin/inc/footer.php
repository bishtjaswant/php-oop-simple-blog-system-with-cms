     <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>
    <div id="site_info">

<?php 
//* you can change the copyrightr*/
require_once $_SERVER['DOCUMENT_ROOT'].'/PhpOopBlog/lib/Copyright.php'; 
$copyrightDB= new Copyright();
$query= "SELECT * FROM `copyright`";
$result= $copyrightDB->index($query);
?>
        <p>
         &copy; COPYRIGHT <?= $result['name'] ?>
        </p>
    </div>

    <script src="js/dist/jBox.all.js"></script>
<script src="js/demo.js"></script>
<script src="js/playground-avatars.js"></script>
<script src="js/playground-inception.js"></script>
<script src="js/playground-login.js"></script>
<script>
    new jBox('Modal', {
  attach: '#myModal',
  title: 'Grab an element',
  content: $('#readmore')
});
</script>
</body>
</html>