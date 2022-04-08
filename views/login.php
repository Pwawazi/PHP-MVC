<?php
	
$this->title = 'Mahindi Online | Login';

?>

<div class="contact-from-section mt-50 mb-10 text-white">
    <div class="container mx-8">
        <div class="row">
            <div class="col-lg-8 mb-5 mb-lg-0">
                <div class="form-title">
                    <h2 class="text-white">Login</h2>
                </div>
                <div id="form_status"></div>
                <div class="contact-form">
                    <form action="" method="post">
                        
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $input['email']?>" required>
                            <div class="text-danger p-2">
                                <small><?php echo ($errors['email'])?></small>    
                            </div>
                            <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                            <div class="text-danger p-2">
                                <small><?php echo ($errors['password'])?></small>    
                            </div>
                        </div>


                        <button type="submit" class="btn btn-warning">Submit</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-4">
            </div>
        </div>
    </div>
</div>


<!-- breadcrumb-section -->
<!-- <div class="breadcrumb-section breadcrumb-bg">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 offset-lg-2 text-center">
					<div class="breadcrumb-text">
						<h1>Login</h1>
                        <form action="" method="post">
                        
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $input['email']?>" required>
                            <div class="text-danger p-2">
                                <small><?php echo ($errors['email'])?></small>    
                            </div>
                            <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                            <div class="text-danger p-2">
                                <small><?php echo ($errors['password'])?></small>    
                            </div>
                        </div>


                        <button type="submit" class="btn btn-warning">Submit</button>
                    </form>
					</div>
				</div>
			</div>
		</div>
	</div> -->
	<!-- end breadcrumb section -->