<?php

use app\base\Application;

$this->title = 'Farmland | Add Product';

?>
<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2 text-center">
				<div class="breadcrumb-text">
					<h1>Products</h1>
					<p>Edit a product</p>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- end breadcrumb section -->

<!-- contact form -->
<div class="contact-from-section mt-100 mb-150">
	<div class="container">
		<div class="row">

			<div class="col-lg-8 mb-5 mb-lg-0">
				<div class="form-title">
					<h2>Want to edit some product details?</h2>
					<p>Edit your farm product and follow the guidelines</p>

					<?php if (Application::$app->session->getFlash('success')) : ?>
						<div class="alert alert-warning my-3 rounded-pill">
							<?php echo Application::$app->session->getFlash('success') ?>
						</div>
					<?php endif; ?>

					<?php if (Application::$app->session->getFlash('danger')) : ?>
						<div class="alert alert-danger my-3 rounded-pill">
							<?php echo Application::$app->session->getFlash('danger') ?>
						</div>
					<?php endif; ?>

				</div>
				<div id="form_status"></div>
				<div class="contact-form">
					<form method="POST" action="" enctype="multipart/form-data">
						<p>
						<div class="input-group mb-3">
							<input type="text" name="product" value="<?php echo ($product->product_name) ?>" class="form-control" aria-label="product_name" aria-describedby="inputGroup-sizing-default">
							<div class="text-danger p-2">
								<small><?php echo ($errors['product_name']) ?></small>
							</div>
						</div>

						<input type="hidden" name="user" id="user" value="<?php echo $user->id ?>">

						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text" id="inputGroupFileAddon01">Product Image: </span>
							</div>
							<div class="custom-file">
								<input type="file" name="product_image" accept=".jpg, .jpeg, .png" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" required>
								<label class="custom-file-label" for="inputGroupFile01">Choose file</label>
							</div>
							<div class="text-danger p-2">
								<small><?php echo ($errors['product_image']) ?></small>
							</div>
						</div>
						</p>
						<p>
							<input type="number" placeholder="Price" name="price" value="<?php echo ($product->price) ?>" id="price">
							<small class="text-danger p-2"><?php echo ($errors['price']) ?></small>

							<input type="number" placeholder="Stock" name="stock" value="<?php echo ($product->stock) ?>" id="stock">
							<small class="text-danger p-2"><?php echo ($errors['stock']) ?></small>
						</p>
						<p><textarea name="description" value="<?php echo ($product->description) ?>" id="description" cols="30" rows="10" placeholder="Product description"></textarea></p>
						<!-- <input type="hidden" name="token" value="FsWga4&@f6aw" /> -->
						<p><input type="submit" value="Submit"></p>
					</form>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="contact-form-wrap">
					<div class="contact-form-box">
						<h4><i class="fas fa-map"></i> Shop Address</h4>
						<p>Tom Mboya Street,a <br> Nairobi. <br> Kenya</p>
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