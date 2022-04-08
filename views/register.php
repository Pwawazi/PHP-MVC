<?php
	
$this->title = 'Mahindi Online | Register';

?>

<div class="container mt-5 text-white">

<h4 class="text-white">Create an account</h4>

<form action="" method="post">

    <div class="row">

        <div class="col">
            <div class="form-group">
                <label>Fisrtname</label>
                <input type="text" name="firstname" class="form-control" value="<?php echo $input['firstname']?>" class=" <?php echo isset($errors['firstname'])? 'error': ''?> ">
                <div class="text-warning p-2">
                    <small><?php echo ($errors['firstname'])?></small>    
                </div>
            </div>
        </div>

        <div class="col">
            <div class="form-group">
                <label>Lastname</label>
                <input type="text" name="lastname" class="form-control" value="<?php echo $input['lastname']?>" class=" <?php echo isset($errors['lastname'])? 'error': ''?> ">
                <div class="text-warning p-2">
                    <small><?php echo ($errors['lastname'])?></small>    
                </div>
            </div>
        </div>

    </div>
    
    <div class="form-group">
        <label>Email address</label>
        <input type="email" name="email" class="form-control" value="<?php echo $input['email']?>" required>
        <div class="text-warning p-2">
            <small><?php echo ($errors['email'])?></small>    
        </div>
        <small class="form-text text-muted">We'll never share your email with anyone else.</small>
    </div>

    <div class="form-group">
        <label>Phone Number</label>
        <input type="text" name="phone_number" class="form-control" value="<?php echo $input['phone_number']?>" required>
        <div class="text-warning p-2">
            <small><?php echo ($errors['phone_number'])?></small>    
        </div>
    </div>

    <div class="form-group">
        <label>County</label>
        <select class="custom-select" name="county">
            <option>---Select County---</option>
            <?php foreach($counties as $county): ?>
            <option value="<?php echo $county->id?>"><?php echo $county->county_name ?></option>
            <?php endforeach;?>
        </select>
    </div>

    <div class="form-group">
        <label>Role</label>
        <select class="custom-select" name="role">
            <option>---Select Role---</option>
            <?php foreach($roles_available as $role): ?>
            <option value="<?php echo $role->id?>"><?php echo $role->role ?></option>
            <?php endforeach;?>
        </select>
    </div>
    

    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
        <div class="text-warning p-2">
            <small><?php echo ($errors['password'])?></small>    
        </div>
    </div>

    <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" name="confirmPassword" class="form-control" required>
    </div>


    <button type="submit" class="btn btn-warning my-4">Submit</button>
</form>
</div>