<?php
include("partials/connect.php");
if($_SERVER["REQUEST_METHOD"] == "POST"){
$name=$_POST['name'];
$email=$_POST['email'];
$subject=$_POST['subject'];
$message=$_POST['message'];

$sql="INSERT INTO contacts(name, email, subject, message) VALUES('$name', '$email', '$subject', '$message')";
$conn->query($sql);
}
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

<div class="container">
	<div class="contact">
 <div class="main-head-section">
		 		
		 			<h3>Contact US</h3>
		 		
				<div class="contact-map">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d501726.46045380377!2d106.41503196962296!3d10.754666397185357!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x317529292e8d3dd1%3A0xf15f5aad773c112b!2sHo%20Chi%20Minh%20City!5e0!3m2!1sen!2s!4v1617631366028!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
		</div>
		 </div>
		
		<div class="contact_top">
			 		
			 			<div class="col-md-8 contact_left">
			 				<h4>Contact Form</h4>
			 				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec tincidunt dolor et tristique bibendum. Aenean sollicitudin vitae dolor ut posuere.</p>
							  <form action=contact.php method=POST>
								 <div class="form_details">
					                 <input type="text" name="name" class="text" value="Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}">
									 <input type="text" name="email" class="text" value="Email Address" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email Address';}">
									 <input type="text" name="subject" class="text" value="Subject" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Subject';}">
									 <textarea value="Message" name="message" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message';}">Message</textarea>
									 <div class="clearfix"> </div>
									 <div class="sub-button">
									 	<input type="submit" value="Send message">
									 </div>
						          </div>
						       </form>
					        </div>
							
<?php 
$pagetype='contactus';
$query=mysqli_query($conn,"select PageTitle,Description from pages where PageName='$pagetype'");
while($row=mysqli_fetch_array($query))
{

?>
					        <div class="col-md-4 company-right">
					        	<div class="company_ad">
							     		<h3><?php echo htmlentities($row['PageTitle'])?></h3>
			      						<address>
											 <p><?php echo $row['Description'];?></p>
											 
									 	 	
							   			</address>
							   		</div>
							   		
							</div>	
							<?php } ?>
							<div class="clearfix"> </div>					
					</div>
				</div>
		<?php
            include ("partials/footer.php");
            ?>
</body>
</html>
