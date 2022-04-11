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
                    <form id="loginForm" action="" method="post">
                        
                        <div class="form-group">
                            <label>Email address</label>
                            <input type="email" name="email" id="email" class="form-control" value="<?php echo $input['email']?>" required>
                            <div class="text-danger p-2">
                                <small><?php echo ($errors['email'])?></small>    
                            </div>
                            <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                            <div class="text-danger p-2">
                                <small><?php echo ($errors['password'])?></small>    
                            </div>
                        </div>


                        <button type="submit" class="btn btn-warning">Submit</button>

                        <div class="form-group">
                            <small><?php echo $errors['errorcodes']?> </small>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-4">
            </div>
        </div>
    </div>
</div>



    <!-- Recaptcha script -->
    <script>
        $('#loginForm').submit(function(event) {
            event.preventDefault();
            var email = $('#email').val();
            var password = $('#password').val();
            var recaptcha_site_key = '<?php echo $recaptcha_site_key ?>';
    
            grecaptcha.ready(function() {
                grecaptcha.execute(recaptcha_site_key, {action: ''}).then(function(token) {
                    $('#loginForm').prepend('<input type="hidden" name="token" value="' + token + '">');
                    $('#loginForm').prepend('<input type="hidden" name="action" value="">');
                    $('#loginForm').unbind('submit').submit();
                });;
            });
    });
    </script>