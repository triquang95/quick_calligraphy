<?php 
session_start();
include('partials/connect.php');

    ?>
<!DOCTYPE HTML>
<html>
    <?php
        include ("partials/head.php");
    ?>
<body>
    <?php
        include ("partials/header.php");
	?>
		<div class="container">
		<div class="col-md-9 bann-right">

<!-- header -->
 	<div class="container">
 		<div class="about">
 			<h2> Calligraphy</h2>
 			<div class="about-top">
 				 <div class="col-md-6 ab-top">
 				 	<img src="images/o1.jpg" class="img-responsive2" alt="">
 				 </div>
 				 <div class="col-md-6 ab-top">
 				 	<h3>Introduction to Modern Brush Calligraphy Workbook Kit</h3>
 				 	<p>Introducing the ultimate beginners’ guide to modern brush calligraphy! In the Introduction to Modern Brush Calligraphy Kit, Kimberly Shrack from Hoopla! Letters will teach you how to transform a brush marker into a magical wand capable of creating Instagram-worthy masterpieces — seriously!</p>
 					<p>This kit has absolutely everything you need to get started with the super fun art of brush calligraphy, including a Tombow Fudenosuke Brush Pen and the brand new Introduction to Modern Brush Calligraphy Guide & Workbook. <br>
						  This workbook includes: <br>

- An in-depth breakdown of brush pen mechanics <br>

- The 10 basic strokes of modern calligraphy; <br>

- A stroke-by-stroke breakdown of a lower- and upper-case alphabet; <br>

- Detailed guidance on connecting letters; <br>

- More than 50 worksheets so you can practice as you learn; <br>

- Tips for lefties; <br>

- Additional themed practice sheets and prompts; <br>

- … and so much more!</p>
 				 </div>
 				 	<div class="clearfix"> </div>
 			</div>
			 <div class="nam-matis">
			<div class="nam-matis-top">
			<h3 class="m_1">Gallery</h3>
            <?php 
     if (isset($_GET['pageno'])) {
            $pageno = $_GET['pageno'];
        } else {
            $pageno = 1;
        }
        $no_of_records_per_page = 32;
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
						<div class="col-md-3 nam-matis-1">
						
							<a href="gallery.php"><img src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>"class="img-responsive3" alt=""></a><hr>
							<!-- <h6><a href="#"><?php echo htmlentities($row['posttitle']);?></a></h6>                      -->
						</div>
                        <?php } ?>
							<div class="clearfix"> </div>
				</div>
		</div>
     <div class="testimonial">
     	
     		<h3>World Traditions</h3>
     		<p>Styles Cursive styles such as xíngshū (行書/行书)(semi-cursive or running script) and cǎoshū (草書/草书)(cursive, rough script, or grass script) 
				  are less constrained and faster, where more movements made by the writing implement are visible.
				  These styles' stroke orders vary more, sometimes creating radically different forms.  <br>
				  They are descended from Clerical script, in the same time as Regular script (Han Dynasty), but xíngshū and cǎoshū were used for personal notes only, and never used as a standard. 
				 The cǎoshū style was highly appreciated in Emperor Wu of Han reign (140–187 AD).[17]  
				Examples of modern printed styles are Song from the Song Dynasty's printing press, and sans-serif. <br>
				These are not considered traditional styles, and are normally not written.</p>
     	    <ul class="test_icon">
     	    	<li><a href="#"><img src="images/10.jpg" class="img-responsive"></a></li>
     	    	<li><a href="#"><img src="images/2.jpg" class="img-responsive"></a></li>
     	    	<li><a href="#"><img src="images/3.jpg" class="img-responsive"></a></li>
     	    	<li><a href="#"><img src="images/4.jpg" class="img-responsive"></a></li>
     	    	<li><a href="#"><img src="images/1b.jpg" class="img-responsive"></a></li>
     	    	<div class="clearfix"> </div>
     	    </ul>
     	
     </div>
    </div>
	<?php
    	 include ("partials/footer.php");
     ?>
</body>
</html>