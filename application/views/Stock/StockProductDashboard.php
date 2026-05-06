<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .table_width {
            margin-top: 30px;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .input_field_wrapper {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .error-message {
            color: red;
            font-size: 12px;
            margin-top: 5px;
            display: block;
        }

        .btn-schl-white {
            background: linear-gradient(45deg, #2196F3, #1976D2);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-schl-white:hover {
            transform: translateY(-2px);
            transition: all 0.3s;
        }

        .status-badge {
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 12px;
            font-weight: bold;
        }

        .status-active {
            background: #4CAF50;
            color: white;
        }

        .status-inactive {
            background: #f44336;
            color: white;
        }

        .action-buttons .btn {
            margin: 0 3px;
            padding: 5px 10px;
        }

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-weight: bold;
        }
    </style>
</head>

<!-- <body>
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0"><i class="fas fa-box"></i> Products Management</h4>
            </div> -->
            <!-- <div class="card-body">
                
                <form id="product_formid" method="post">
                    <div class="row input_field_wrapper">
                        <input type="hidden" name="product_id" id="product_id" value="">

                        <div class="col-md-3 mb-3">
                            <label class="form-label">Product Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="product_name" name="product_name"
                                placeholder="Enter product name" />
                            <span class="error-message" id="product_name-error"></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label">Category <span class="text-danger">*</span></label>
                            <select class="form-select" id="category" name="category">
                                <option value="">Select Category</option>
                                <option value="Electronics">Electronics</option>
                                <option value="Clothing">Clothing</option>
                                <option value="Food & Beverages">Food & Beverages</option>
                                <option value="Furniture">Furniture</option>
                                <option value="Books & Stationery">Books & Stationery</option>
                                <option value="Beauty & Health">Beauty & Health</option>
                                <option value="Sports">Sports</option>
                                <option value="Toys">Toys</option>
                                <option value="Other">Other</option>
                            </select>
                            <span class="error-message" id="category-error"></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label">Subcategory</label>
                            <input type="text" class="form-control" id="subcategory" name="subcategory"
                                placeholder="Enter subcategory" />
                            <span class="error-message" id="subcategory-error"></span>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label">Barcode</label>
                            <input type="text" class="form-control" id="barcode" name="barcode"
                                placeholder="Enter barcode" />
                            <span class="error-message" id="barcode-error"></span>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label class="form-label">Price <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">₹</span>
                                <input type="number" step="0.01" class="form-control" id="price" name="price"
                                    placeholder="0.00" />
                            </div>
                            <span class="error-message" id="price-error"></span>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label class="form-label">Quantity <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="quantity" name="quantity"
                                placeholder="Enter quantity" />
                            <span class="error-message" id="quantity-error"></span>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                            <span class="error-message" id="status-error"></span>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description"
                                rows="1" placeholder="Enter product description"></textarea>
                            <span class="error-message" id="description-error"></span>
                        </div>

                        <div class="col-md-12 text-end">
                           <?php $message = !empty(@$id) ? 'Update' : 'Save' ?>
                        <button type="button"
                            onclick="CommonAjaxWithValidation('<?= $message ?> Dish ?','<?= $message ?>','product_formid', function_url, {swal: true, successCallback: successCallback, errorCallback: errorCallback})"
                            class="btn schl-btn-white mt-4">
                            <img width="40" height="40" src="https://img.icons8.com/clouds/100/checked--v1.png"
                                alt="checked--v1" /> <?= !empty(@$id) ? 'Update' : 'Save' ?>
                        </button>
                        </div>
                    </div>
                </form>

                
                <div class="row table_width">
                    <div class="col">
                        <table class="table table-striped table-hover table-sm" id="ProductsTable">
                            
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> -->
        <!-- </div>
    </div>
</body> -->

<body>
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-box"></i> Products Management</h4>
            </div>
            <div class="card-body">
                <?php if(isset($user)): ?>
                    <div class="alert alert-info">
                        Welcome, <strong><?= $user['name'] ?></strong> (<?= $user['email'] ?>)
                    </div>
                <?php endif; ?>
                
                <!-- Your products table and form will go here -->
                <div class="row">
                    <div class="col-md-12">
                        <p>Dashboard content here...</p>
                    </div>
                </div>
                
                <div class="mt-3">
                    <a href="<?= base_url('LoginController/logout') ?>" class="btn btn-danger">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>