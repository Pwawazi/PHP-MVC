<?php
	
$this->title = 'Mahindi Online | Users';

?>
	
	<!-- breadcrumb-section -->
	<div class="breadcrumb-section breadcrumb-bg">
	    <div class="container">
	        <div class="row">
	            <div class="col-lg-8 offset-lg-2 text-center">
	                <div class="breadcrumb-text">
	                    <p>View all our users</p>
	                    <h1>Users</h1>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<!-- end breadcrumb section -->

	<!-- products -->
	<div class="product-section mt-150 mb-150">
	    <div class="container">

	        <div class="row">
	            <div class="col-md-12">
	                <div class="product-filters">
	                    <ul>
	                        <li class="active" data-filter="*">All</li>
	                        <li data-filter=".vendor">Vendors</li>
	                        <li data-filter=".buyer">Buyers</li>
	                    </ul>
	                </div>
	            </div>
	        </div>

	        <div class="row product-lists">
	            <?php foreach ($users as $user) : ?>
	                <?php if ($user->role_id == 2) : ?>
	                    <div class="col-lg-4 col-md-6 text-center vendor">
	                        <div class="single-product-item">
	                            <!-- <div class="product-image">
                                    <a href="single-product.html"><img src="/assets/img/products/product-img-1.jpg" alt=""></a>
                                </div> -->
	                            <?php echo ("<h3>$user->firstname</h3>"); ?>
	                            <p class="product-price"><span class="text-uppercase">Role: </span> <?php if($user->role_id == 2){echo ("<h3>Vendor</h3>");} 
																										  if($user->role_id == 1){echo ("<h3>Buyer</h3>");} 
																										  if($user->role_id == 3){echo ("<h3>Admin</h3>");}
																										  if($user->role_id == 4){echo ("<h3>Regulator</h3>");}
																									?> </p>
	                        </div>
	                    </div>
	                <?php else : ?>

	                    <div class="col-lg-4 col-md-6 text-center buyer">
	                        <div class="single-product-item">
	                            <!-- <div class="product-image">
                                        <a href="single-product.html"><img src="/assets/img/products/product-img-1.jpg" alt=""></a>
                                    </div> -->
	                            <?php echo ("<h3>$user->firstname</h3>"); ?>
	                            <p class="product-price"><span class="text-uppercase"> </span> <?php if($user->role_id == 2){echo ("<h3>Vendor</h3>");} 
																										  if($user->role_id == 1){echo ("<h3>Buyer</h3>");} 
																										  if($user->role_id == 3){echo ("<h3>Admin</h3>");}
																										  if($user->role_id == 4){echo ("<h3>Regulator</h3>");}
																									?> </p>
	                        </div>
	                    </div>
	                <?php endif; ?>
	            <?php endforeach; ?>

	        </div>

	    </div>
	</div>
	<!-- end products -->

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