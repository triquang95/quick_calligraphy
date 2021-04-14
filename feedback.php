<?php 
session_start();
include('partials/connect.php');
//Genrating CSRF Token
if (empty($_SESSION['token'])) {
 $_SESSION['token'] = bin2hex(random_bytes(32));
}

if(isset($_POST['submit']))
{
  //Verifying CSRF Token
if (!empty($_POST['csrftoken'])) {
    if (hash_equals($_SESSION['token'], $_POST['csrftoken'])) {
$name=$_POST['name'];
$email=$_POST['email'];
$comment=$_POST['comment'];
$postid=intval($_GET['nid']);
$st1='0';
$query=mysqli_query($conn,"insert into feedback(postId,name,email,comment,status) values('$postid','$name','$email','$comment','$st1')");
if($query):
  echo "<script>alert('Comment successfully submit. Comment will be display after admin review ');</script>";
  unset($_SESSION['token']);
else :
 echo "<script>alert('Something went wrong. Please try again.');</script>";  

endif;

}
}
}
?>
<!DOCTYPE HTML>
<html>
<?php
        include ("partials/head.php");
    ?>
<body>
<!-- header -->
<?php
        include ("partials/header.php");
	?>
<!-- header -->
	<!-- Blog -->
	<div class="container">
		<div class="blog">

        <?php
$pid=intval($_GET['nid']);
 $query=mysqli_query($conn,"select post.PostTitle as posttitle,
 post.PostImage,category.CategoryName as category,category.id as cid,
 subcategory.Subcategory as subcategory,post.PostDetails as postdetails,
 post.PostingDate as postingdate,post.PostUrl as url from post left join category on category.id=post.CategoryId
  left join  subcategory on  subcategory.SubCategoryId=post.SubCategoryId where post.id='$pid'");
while ($row=mysqli_fetch_array($query)) {
?>

			
		<div class="blog-content">
					<div class="blog-content-left">
						<div class="blog-articals">
						<div class="blog-artical">
							<div class="blog-artical-info">
								<div class="blog-artical-info-img">
									<a href="#"><img src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" title="post-name"></a>
								</div>
								<div class="blog-artical-info-head">
									<h2><a href="#"><?php echo htmlentities($row['posttitle']);?></a></h2>
									<h6><?php 
             $pt=$row['postdetails'];
              echo  (substr($pt,0));?></h6>
									
								</div>
							
								<div class="artical-links">
                                <?php 
 $sts=1;
 $query=mysqli_query($conn,"select name,comment,postingDate from  feedback where postId='$pid' and status='$sts'");
while ($row=mysqli_fetch_array($query)) {
?>
		  						 	<ul>
		  						 		<li><small> </small><span><?php echo htmlentities($row['postingDate']);?></span></li>
		  						 		<li><a href="#"><small class="admin"> </small><span><?php echo htmlentities($row['name']);?></span></a></li>
		  						 		<li><a href="#"><small class="no"> </small><span> <?php echo htmlentities($row['comment']);?> </span></a></li>
		  						 	
		  						 	</ul>                                     
		  						 </div>
                                   <?php } ?>
                                   <div class="respon">
							<div class="comment">
								<h2>Leave a comment</h2>
								<form name="Comment" method="post">
								<input type="hidden" name="csrftoken" value="<?php echo htmlentities($_SESSION['token']);?>"/>
								 <input type="text" name="name"class="textbox" value="Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}">
								 <input type="text" name="email"class="textbox" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}">
								 <textarea value="Message:" name="comment" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message';}">Message</textarea>
								 <div class="smt1">
									<input type="submit" name="submit" value="add a comment">
								 </div>
							   </form>
                             
							   
							     <!---Comment Display Section --->

        </div>
		
      </div>

                                   
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="blog-artical">
							
							<div class="blog-artical-info">
								
														
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="blog-artical">
						
							<div class="blog-artical-info">							
							</div>
							<div class="clearfix"> </div>
						</div>
					</div>
					<!--start-blog-pagenate-->
							<!-- <nav>
										  <ul class="pagination">
											<li>
											  <a href="#" aria-label="Previous">
												<span aria-hidden="true">«</span>
											  </a>
											</li>
											<li><a href="#">1</a></li>
											<li><a href="#">2</a></li>
											<li><a href="#">3</a></li>
											<li><a href="#">4</a></li>
											<li><a href="#">5</a></li>
											<li>
											  <a href="#" aria-label="Next">
												<span aria-hidden="true">»</span>
											  </a>
											</li>
										  </ul>
										</nav> -->
				<!--//End-blog-pagenate-->
					</div>  <?php } ?>
					</div>
					<div class="blog-content-right">
						<div class="b-search">
							<form>
								<input type="text" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}">
								<input type="submit" value="">
							</form>
						</div>
						<!--start-twitter-weight-->
						<div class="twitter-weights">
							<h3>Tweet Widget</h3>
							<div class="twitter-weight-grid">
								<h4><span> </span>Mr Quang</h4>
								<p>Lorem ipsum dolor sit amet, consectetur elit,labore et dolore magna aliqua. <a href="#">http://t.co/h12k</a></p>
								<i><a href="#">2 days ago</a></i>
							</div>
							<div class="twitter-weight-grid">
								<h4><span> </span>John Doe</h4>
								<p>Lorem ipsum dolor sit amet, consectetur elit,labore et dolore magna aliqua. <a href="#">http://t.co/h12k</a></p>
								<i><a href="#">2 days ago</a></i>
							</div>
							<a class="twittbtn" href="index.php">See all Tweets</a>
						</div>
						<!--//End-twitter-weight-->
						<!-- start-tag-weight-->
						<div class="b-tag-weight">
							<h3>Tags Calligraphy</h3>
							<ul>
							<li><a href="search.php">Search</a></li>
								<li><a href="gallery.php">Gallery</a></li>
								<li><a href="#">Calligraphy Font</a></li>
								<li><a href="#">Calligraphy Art</a></li>
								<li><a href="#">Calligraphy Pen</a></li>
							</ul>
						</div>
						<!---- //End-tag-weight---->
				
						<!---- //End-tag-weight---->
					</div>
					<div class="clearfix"> </div>
				
				</div>
		</div>
		<!-- /Blog -->

        <?php
            include ("partials/footer.php");
            ?>
</body>
</html>