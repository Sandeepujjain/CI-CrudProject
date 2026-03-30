<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <script src="<?php echo base_url('assets/js/masterAdmin.js'); ?>"></script>
    <!-- C:\xampp8.2.12\htdocs\CodeIgniter-3.1.13\assets\js\masterAdmin.js -->


    <title>Product View Page</title>
</head>

<body>
    <h1 align="center">Product View Page</h1>

    <form action="" method="post">
        <label for="">Product Name</label>
        <input type="text" name="product_name" id="product_name">

        <label for="">Category</label>
        <select name="category_id" id="category_id">
            <option value="">Select Category</option>
            <option value="1">Electronics</option>
            <option value="2">Clothing</option>
            <option value="3">Books</option>
        </select>

        <label for="">Sub Category</label>

        <select name="subcategory_id" id="subcategory_id">
            <option value="">Select Sub Category</option>
            <option value="1">Laptops</option>
            <option value="2">Smartphones</option>
            <option value="3">Shirts</option>
            <option value="4">Pants</option>
            <option value="5">Novels</option>
            <option value="6">Textbooks</option>
        </select>


        <button type="button" onclick="SubmitProduct()">
            Submit
        </button>

    </form>

    <br><br>





     <!-- <table border="1" width="100%" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Sub Category</th>
            </tr>
        </thead>
        <tbody id="productTableBody">
            
        </tbody>
    </table>  -->

    <div class="card mt-2">
        <div class="card-header schl-text-green">
            Product
        </div>
        <div class="row table_width">
            <div class="col">
                <table class="table table-striped table-hover  " width="100%" cellpadding="10" cellspacing="0"
                    id="ProductTableShowId">
                </table>
            </div>
        </div>
    </div>





















</body>











</html>

<script>
    // $(document).ready(function() {

    //     fetchProducts();
    // });

    // function fetchProducts() {
    //     $.ajax({
    //         url: "<?php echo base_url('ProductController/GetProducts'); ?>",
    //         type: "GET",
    //         success: function(response) {
    //             var products = JSON.parse(response);
    //             var tableBody = $('#productTableBody');
    //             tableBody.empty();

    //             products.forEach(function(product) {
    //                 var row = '<tr>' +
    //                     '<td>' + product.product_id + '</td>' +
    //                     '<td>' + product.product_name + '</td>' +
    //                     '<td>' + product.category_id + '</td>' +
    //                     '<td>' + product.subcategory_id + '</td>' +
    //                     '</tr>';
    //                 tableBody.append(row);
    //             });
    //         }
    //     });
    // }





    function SubmitProduct() {
        // 1. Get the values from the inputs first
        var product_name = $('#product_name').val();
        var category_id = $('#category_id').val();
        var subcategory_id = $('#subcategory_id').val();



        // 3. Run the AJAX request
        $.ajax({
            url: "<?php echo base_url('ProductController/InsertUpdateProduct'); ?>",
            type: "POST",
            data: {
                product_name: product_name,
                category_id: category_id,
                subcategory_id: subcategory_id
            },
            success: function(response) {
                console.log("Data submitted successfully:", response);
                alert("Product saved successfully!");
            },
            error: function(xhr, status, error) {
                console.error("Error submitting data:", error);
                alert("An error occurred: " + error);
            }
        });
    }




    // function successCallback(response) {
    //     window.location.href = "<?= base_url('Products') ?>";
    // }

    // function errorCallback(response) {
    //     console.log(response);
    // }


    $(document).ready(function() {
        fetchProducts();
    });
    function fetchProducts(parameter = {}) {
        // var school_id = "</?= $_SESSION['emp_data_session']['emp_schoolid'] ?>";
        // var hostel_id = $('#hostel_id').val();
        // var status = $('#status').val();
        var parameter = {
            // 'hostel_id': hostel_id,
            //  'school_id': school_id,
            // 'status': status,

        }
        DataTableInitialized(
            'ProductTableShowId', // table_id
            "<?= base_url('ProductController/getProductslist') ?>", // url
            'POST', // method
            parameter, // parameter
            successDataTableCallbackFunction // dataTableSuccessCallBack
        );
    }

    function successDataTableCallbackFunction(response) {
        var columns = [{
                title: "S.No.",
                data: null,
                render: function(data, type, row, meta) {
                    return meta.row + 1; // Returns the row index starting from 1
                },
                visible: true
            },
            {
                title: "Product Name",
                data: "product_name"
            },
            {
                title: "Category ID",
                data: "category_id"
            },

            {
                title: "Subcategory ID",
                data: "subcategory_id"
            },
           




        ];

        if (response.ApiResponseStatusCode == 200) {
            return {
                status: response.ApiResponseStatusCode,
                columns: columns,
                data: response.data
            };
        } else {
            return {
                status: response.ApiResponseStatusCode,
                columns: columns,
                data: []
            };
        }
    }
</script>