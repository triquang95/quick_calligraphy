<?php
// Initialize the session
session_start();
include("partials/connect.php");

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
<div class="container">
	<div class="col-md-9 bann-right">
		<!-- banner -->
        <?php
        include ("partials/banner.php");
    ?>
		<!-- banner -->	
		<!-- nam-matis -->
		<div class="nam-matis">
			<div class="nam-matis-top">
            <?php 
     if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 6;
        $offset = ($pageno-1) * $no_of_records_per_page;


        $total_pages_sql = "SELECT COUNT(*) FROM post";
        $result = mysqli_query($conn,$total_pages_sql);
        $total_rows = mysqli_fetch_array($result)[0];
        $total_pages = ceil($total_rows / $no_of_records_per_page);


$query=mysqli_query($conn,"select post.id as pid,post.PostTitle as posttitle,
post.PostImage,category.CategoryName as category,category.id as cid,subcategory.Subcategory as subcategory,
post.PostDetails as postdetails,post.PostingDate as postingdate,post.PostUrl as url from post left join category
 on category.id=post.CategoryId left join  subcategory on  subcategory.SubCategoryId=post.SubCategoryId where post.Is_Active=1 
 order by post.id desc  LIMIT $offset, $no_of_records_per_page");
while ($row=mysqli_fetch_array($query)) {
?>
						<div class="col-md-4 nam-matis-1">
							<a href="#"><img src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>"class="img-responsive" alt=""></a>
							<h6><br>
                                <a href="gallery.php"><?php echo htmlentities($row['posttitle']);?></a>
                            </h6>                     
						</div>
                        <?php } ?>
							<div class="clearfix"> </div>
				</div>
		</div>
		<!-- nam-matis -->	
        <?php
            include ("partials/sidebar.php");
            ?>

	<?php
            include ("partials/slide.php");
            ?>
		</div>
        <?php
            include ("partials/footer.php");
            ?>
</body>
</html>