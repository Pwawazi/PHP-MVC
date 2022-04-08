	<?php

	$this->title = 'Mahindi Online | Profile';

	?>


	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<h1>Contact Vendor</h1>
						<p><?php echo $vendor->firstname ?>'s contact form</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- contact form -->
	<div class="contact-from-section mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 mb-5 mb-lg-0">
					<div class="form-title">
						<h2>Wanna reach out to <?php echo $vendor->firstname ?> <?php echo $vendor->lastname ?>?</h2>
						<p>If you wanna reach out to <?php echo $vendor->firstname ?>, fill out the form below that will email them with your inquiry</p>
					</div>
					<div id="form_status"></div>
					<div class="contact-form">
						<form action="/email-vendor" method="POST">
							<p>
								<input type="text" placeholder="Name" name="name" id="name" value=<?php echo $user->firstname ?>>
								<input type="email" placeholder="Email" name="from_email" id="email" value="<?php echo $user->email ?>">
							</p>
							<p>
								<input type="email" name="to_email" id="email" value="<?php echo $vendor->email ?>" disabled>
							</p>
							<p>
								<input type="tel" placeholder="Phone" name="phone" id="phone">
								<input type="text" placeholder="Subject" name="subject" id="subject">
							</p>
							<p><textarea name="message" id="message" cols="30" rows="10" placeholder="Message"></textarea></p>
							<input type="hidden" name="to_email" value="<?php echo $vendor->email ?>" />
							<p><input type="submit" value="Submit"></p>
						</form>
					</div>
					<div>
						<p>Or if you prefer calling them then call <span><a href="tel:<?php echo $vendor->phone_number ?>"><?php echo $vendor->firstname ?>'s number </a></span>(NB: Only accessible via phone)</span></p>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="contact-form-wrap">
						<div class="contact-form-box">
							<h4><i class="fas fa-map"></i> Mahindi Online Address</h4>
							<p>Tom Mboya Street, <br> Nairobi. <br> Kenya</p>
						</div>
						<div class="contact-form-box">
							<h4><i class="far fa-clock"></i> Shop Hours</h4>
							<p>MON - FRIDAY: 8 to 9 PM <br> SAT - SUN: 10 to 8 PM </p>
						</div>
						<div class="contact-form-box">
							<h4><i class="fas fa-address-book"></i> Contact</h4>
							<p>Phone: +00 111 222 3333 <br> Email: support@mahindionline.com</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end contact form -->

	<!-- find our location -->
	<div class="find-location blue-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 text-center">
					<p> <i class="fas fa-map-marker-alt"></i> Find Our Location</p>
				</div>
			</div>
		</div>
	</div>
	<!-- end find our location -->

	<!-- google map section -->
	<div class="embed-responsive embed-responsive-21by9">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d26432.42324808999!2d-118.34398767954286!3d34.09378509738966!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2bf07045279bf%3A0xf67a9a6797bdfae4!2sHollywood%2C%20Los%20Angeles%2C%20CA%2C%20USA!5e0!3m2!1sen!2sbd!4v1576846473265!5m2!1sen!2sbd" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" class="embed-responsive-item"></iframe>
	</div>
	<!-- end google map section -->