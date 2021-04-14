
	</div>
	<div class="col-md-3 bann-left">
		<div class="b-search">
			<form name="search" action="search.php" method="post">
				<input type="text" name="searchtitle" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}">
				<input type="submit" value="">
			</form>
		</div>
		<h3>Recent Posts</h3>
		<div class="blo-top">
			<div class="blog-grids">
            <?php
$query=mysqli_query($conn,"select post.id as pid,post.PostTitle as posttitle from post left join category on category.id=post.CategoryId left join  subcategory on  subcategory.SubCategoryId=post.SubCategoryId limit 5");
while ($row=mysqli_fetch_array($query)) {

?>
			
				<div class="blog-grid-right">
					<h5> <a href="feedback.php?nid=<?php echo htmlentities($row['pid'])?>"><?php echo htmlentities($row['posttitle']);?></a></h5>
					
				</div>
				<div class="clearfix"> </div>
			
			<div class="blog-grids">
			</div>			
                <?php } ?>
				
			</div>
		</div>
		<h3>Categories</h3>
		<div class="blo-top">
        <?php $query=mysqli_query($conn,"select id,CategoryName from category");
while($row=mysqli_fetch_array($query))
{
?>
			<li><a href="category.php?catid=<?php echo htmlentities($row['id'])?>"><?php echo htmlentities($row['CategoryName']);?></a></li>
            <?php } ?>
		</div>
		<h3>Newsletter</h3>
		
		<div class="blo-top">
			<div class="name">
				<form>
					<input type="text" placeholder="Email" required="">
				</form>
			</div>	
			<div class="button">
				<form>
					<input type="submit" value="Subscribe">
				</form>
			</div>
				<div class="clearfix"> </div>
		</div>
	</div>
	<div class="clearfix"> </div>
