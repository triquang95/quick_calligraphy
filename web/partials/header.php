<!-- header -->
<div class="header">
		<div class="container">
			<div class="logo">
				<a href="index.php"><img src="images/Calligraphy.png" class="img-responsive1" alt=""></a>
			</div>
			
				<div class="head-nav">
					<span class="menu"> </span>
						<ul class="cl-effect-1">
							<li class="active"><a href="index.php">Home</a></li>
							<li><a href="about.php">About Us</a></li>
							<li><a href="gallery.php">Gallery</a></li>							
							<li><a href="contact.php">Contact</a></li>						
							<li><a href="login.php">Login</a></li>							
										<div class="clearfix"></div>
						</ul>
				</div>
	<!-- script-for-nav -->
							<script>
								$( "span.menu" ).click(function() {
								  $( ".head-nav ul" ).slideToggle(300, function() {
									// Animation complete.
								  });
								});
							</script>
						<!-- script-for-nav -->
						<!-- <div class="user">
					<img src="../web/images/co.png" alt="" class="user__img">
					<div class="user__action user__active">
					<h5>Hi, <?php echo htmlspecialchars($_SESSION["username"]); ?></h5>
					<a href="confirm_pass.php"><i class="ti-settings m-r-5"></i> Change Password</a><br>                         
						   <a href="logout.php"><i class="ti-power-off m-r-5"></i> Logout</a>
						

					</div> -->
				</div>			
					<div class="clearfix"> </div>
		</div>
	</div>
<!-- header -->