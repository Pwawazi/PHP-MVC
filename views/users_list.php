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

<!-- users Table -->
<div class="d-flex justify-content-around m-2">
    <input class="form-control px-5 mr-3" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search by county..">
    <br>
    <input class="form-control px-5" type="text" id="myInput2" onkeyup="myFunction2()" placeholder="Search by role..">
</div>
<table class="table table-dark px-auto" id="usersTable">

    <thead>
        <tr>
            <th class="px-5" scope="col" data-field="firstname">First Name</th>
            <th class="px-5" scope="col" data-field="lastnae">Last Name</th>
            <th class="px-5" scope="col" data-field="email">Email</th>
            <th class="px-5" scope="col" data-field="phone_number">Phone</th>
            <th class="px-5" scope="col" data-field="role">Role</th>
            <th class="px-5" scope="col" data-field="county">Area</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user) : ?>
            <tr>
                <th class="px-5" scope="row"><?php echo $user->firstname; ?></th>
                <td class="px-5"><?php echo $user->lastname; ?></td>
                <td class="px-5"><?php echo $user->email; ?></td>
                <td class="px-5"><?php echo $user->phone_number; ?></td>
                <td class="px-5"><?php echo $user->role->role; ?>
                </td>
                <td class="px-5"><?php echo $user->county->county_name; ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<!-- end of users table -->


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

<script>
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("usersTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[4];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function myFunction2() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput2");
  filter = input.value.toUpperCase();
  table = document.getElementById("usersTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[3];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>