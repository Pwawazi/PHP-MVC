<?php

$this->title = 'Mahindi Online | All Products';

?>

<!-- breadcrumb-section -->
<div class="breadcrumb-section breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 text-center">
                <div class="breadcrumb-text">
                    <p>View all our products</p>
                    <h1>Products</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end breadcrumb section -->

<!-- products Table -->

<!-- <div class="d-flex justify-content-around m-2">
    <input class="form-control px-5 mr-3" type="text" id="countyInput" onkeyup="countyFunction()" placeholder="Search by county..">
    <br>
    <input class="form-control px-5 mr-3" type="text" id="saleInput" onkeyup="saleFunction()" placeholder="Search by sale..">
    <br>
</div> -->

<div class="m-5 px-auto">
<table id="productsTable" class="display" style="width:100%">

    <thead>
        <tr>
            <th class="px-5" scope="col" data-field="product_name">Product Name</th>
            <th class="px-5" scope="col" data-field="user">Vendor</th>
            <th class="px-5" scope="col" data-field="price">Price</th>
            <th class="px-5" scope="col" data-field="description">Description</th>
            <th class="px-5" scope="col" data-field="stock">Stock</th>
            <th class="px-5" scope="col" data-field="on_sale">On sale</th>
            <th class="px-5" scope="col" data-field="on_sale">County From</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($products as $product) : ?>
            <tr>
                <th class="px-5" scope="row"><?php echo $product->product_name; ?></th>
                <td class="px-5"><?php echo $product->user->firstname; ?></td>
                <td class="px-5"><?php echo $product->price; ?></td>
                <td class="px-5"><?php echo $product->description; ?></td>
                <td class="px-5"><?php echo $product->stock; ?></td>
                <td class="px-5"><?php if ($product->on_sale == 0) {
                                        echo ("No");
                                    }
                                    if ($user->role_id == 1) {
                                        echo ("Yes");
                                    }
                                    ?></td>
                <td class="px-5"><?php echo $product->user->county->county_name; ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
</div>
<!-- end of products table -->



<script>
    function countyFunction() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("countyInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("productsTable");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[5];
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

    function saleFunction() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("saleInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("productsTable");
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
</script>