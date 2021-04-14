
<!DOCTYPE HTML>
<html>
<?php 
include("partials/connect.php");
?>
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
         <?php 
    $pagetype='aboutus';
    $query=mysqli_query($conn,"select PageTitle,Description from pages where PageName='$pagetype'");
    while($row=mysqli_fetch_array($query))
{

?>
 			<h2> About Calligraphy</h2>
 			<div class="about-top">
 				
 				 <div class="col-md-12 ab-top">
 				 	<h3><?php echo htmlentities($row['PageTitle'])?></h3>
 				 	<p><?php echo $row['Description'];?></p>
 					
 				 </div>
				  
 				 	<div class="clearfix"> </div>
 			</div>
       	 
     <div class="testimonial">
     <?php } ?>
    
    
     </div>
    </div>
	<?php
    	 include ("partials/footer.php");
     ?>
</body>
</html>
