<?php
	
$this->title = 'Mahindi Online | Shop';

?>

	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<p>See more Details</p>
						<h1><?php echo $product->product_name ?></h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end breadcrumb section -->

	<!-- single product -->
	<div class="single-product mt-150 mb-150">
		<div class="container">
			<div class="row">
				<div class="col-md-5">
					<div class="single-product-img">
						<?php echo '<img src="/product_images/'.$product->product_image_name.'"/>'; ?>
					</div>
				</div>
				<div class="col-md-7">
					<div class="single-product-content">
						<h3><?php echo $product->product_name?></h3>
						<p class="single-product-pricing"><span>Per Unit</span> KES<?php echo $product->price?></p>
						<p><?php echo $product->product_description ?></p>
						<div class="single-product-form">
							<!-- <form action="index.html">
								<input type="number" placeholder="0">
							</form> -->
							<a href="<?php echo '/contact-vendor/'.$product->id ?>" class="cart-btn">Contact Vendor <i class="fas fa-phone"></i></a>
							<p><strong>Categories: </strong>Produce, Organic</p>
						</div>
						<h4>Share:</h4>
						<ul class="product-share">
							<li><a href=""><i class="fab fa-facebook-f"></i></a></li>
							<li><a href=""><i class="fab fa-twitter"></i></a></li>
							<li><a href=""><i class="fab fa-google-plus-g"></i></a></li>
							<li><a href=""><i class="fab fa-linkedin"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end single product -->

	<!-- more products -->
	<div class="more-products mb-150">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="section-title">	
						<h3><span class="orange-text">Related</span> Products</h3>
						<p>These are some products you might like</p>
					</div>
				</div>
			</div>
			<?php foreach($some_products as $product):?>
			<div class="row">
				<div class="col-lg-4 col-md-6 text-center">
					<div class="single-product-item">
						<div class="product-image">
							<a href="single-product.html"><?php echo '<img src="/product_images/'.$product->product_image_name.'"/>'; ?></a>
						</div>
						<h3><?php echo $product->product_name?></h3>
						<p class="product-price"><span>Per Unit</span> KES. <?php echo $product->price?> </p>
						<a class="cart-btn" href="<?php echo '/shop/'.$product->id ?>"><i class="fas fa-shopping-cart"></i> View Product</a>
						<!-- <form id="<?php echo $product->id?>" method="post" action="">
							<a class="cart-btn" href="javascript:;" onclick="document.getElementById('<?php echo $product->id ?>').submit()"><i class="fas fa-shopping-cart"></i> View Product</a>
							<input type="hidden" name="product_id" value="<?php echo $product->id ?>">
						</form> -->
					</div>
				</div>
			<?php endforeach;?>
		</div>
	</div>
	<!-- end more products -->

	<!-- logo carousel -->
	<div class="logo-carousel-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="logo-carousel-inner">
						<div class="single-logo-item">
							<img src="/assets/img/company-logos/1.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="/assets/img/company-logos/2.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="/assets/img/company-logos/3.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="/assets/img/company-logos/4.png" alt="">
						</div>
						<div class="single-logo-item">
							<img src="/assets/img/company-logos/5.png" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end logo carousel -->