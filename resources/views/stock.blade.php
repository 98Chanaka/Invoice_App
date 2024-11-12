<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Stock Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Other CSS files -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

    //PDF Genarate link

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>


    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index3.html" class="nav-link">Home</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link">Contact</a>
                </li>
            </ul>
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link">
                <img src="admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-Imageimg-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-Weight-light">AdminLTE 3</span>
            </a>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Stock<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <a href="/invoice" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Invoice<i class="right fas fa-angle-left"></i></p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('logout') }}">Logout</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <!-- Left-aligned Add Product Button -->
                                    <a onclick="addProduct()" href="javascript:void(0)" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Add Product
                                    </a>

                                    <!-- Right-aligned buy Button -->
                                    {{--  <div class="ml-auto">
                                        <a href="javascript:void(0)" class="btn btn-primary" data-toggle="modal" data-target="#InvoiceModal">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-plus-fill" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0M8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5z"/>
                                            </svg>
                                            <i class="bi bi-bag-plus-fill"></i> Buy
                                        </a>
                                    </div>  --}}
                                </div>



                                <div class="card-body">
                                    <table class="display" style="width: 100%" id="stock-datatable">
                                        <thead class="bg-black text-white">
                                            <tr>
                                                <th>Product Code</th>
                                                <th>Product Name</th>
                                                <th>Company Name</th>
                                                <th>Weight</th>
                                                <th>Manufacture Date</th>
                                                <th>Expiration Date</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Dynamic Content Will Be Inserted Here -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->

            <!--  add product and Edit Product Modal -->

            <div class="modal fade" id="ProductModal" tabindex="-1" aria-labelledby="addProductModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form id="ProductForm" action="{{ route('stock.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="modal-header">
                                <h5 class="modal-title" id="addProductModalLabel">Add new Product</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="ID" id="ProductID" value="{{ $product->id ?? '' }}">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="Product_ID">Product Code</label>
                                        <input type="text" class="form-control" id="Product_ID"
                                            placeholder="Product_ID" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="Product_Name">Product Name</label>
                                        <input type="text" class="form-control" id="Product_Name"
                                            placeholder="Product Name" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="Company_Name">Company Name</label>
                                        <input type="text" class="form-control" id="Company_Name"
                                            placeholder="Company Name" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="Weight">Weight</label>
                                        <input type="text" class="form-control" id="Weight"
                                            placeholder="Weight" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="Manufacture_Date">Manufacture Date</label>
                                        <input type="date" class="form-control" id="Manufacture_Date" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="Expiration_Date">Expiration Date</label>
                                        <input type="date" class="form-control" id="Expiration_Date" required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="quantity">Quantity</label>
                                        <input type="text" class="form-control" id="quantity" placeholder="Quantity" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="price">Price</label>
                                        <input type="text" class="form-control" id="price" placeholder="Rs." required>
                                    </div>

                                </div>
                                <div class="form-row">
                                        <label for="Image" class="col-sm-2 control-label">Image</label>
                                        <input type="file" class="form-control-file" id="Image" >
                                        <img id="currentImage" src="#" alt="Product Image"
                                            style="width: 100px; display: none; margin-top: 10px;" />
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" id="saveProductBtn">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>



            <!-- Invoice Modal -->
            <div class="modal fade" id="InvoiceModal" tabindex="-1" role="dialog" aria-labelledby="invoiceModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg double-size-modal" role="document">
                    <div class="modal-content">
                        <!-- Header with Title and Company Name -->
                        <div class="modal-header d-flex justify-content-center position-relative">
                            <div class="text-center w-100">
                                <h3 class="modal-title" id="invoiceModalLabel">INVOICE</h3>
                                <h5><p class="mb-0">ABC Company (Pvt) LTD</p></h5>
                            </div>
                            <button type="button" class="close position-absolute" style="top: 10px; right: 10px;" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>      

                        <!-- Search and Quantity Input Row -->
                        <div class="modal-header">
                            <div class="d-flex align-items-center">
                                <label class="mr-2">Search:</label>
                                <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Search...">
                                {{--  <button type="button" id="clearSearch" class="btn btn-sm btn-secondary ml-2">x</button>  --}}
                            </div>

                            {{--  <div class="d-flex align-items-center ml-auto">
                                <label class="mr-2">Quantity:</label>
                                <input type="number" id="quantity" class="form-control form-control-sm mr-2" min="1" value="1">
                                <button type="button" class="btn btn-sm btn-primary" id="addButton">Add</button>
                            </div>  --}}
                        </div>

                        <!-- Table with Products -->
                        <div class="modal-body">
                            <table class="table">
                                <thead class="bg-black text-white">
                                    <tr>
                                        <th>Product Code</th>
                                        <th>Product Name</th>
                                        <th>Company Name</th>
                                        <th>Stock</th>
                                        <th>Price</th>
                                        <th>Add Quantity</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="invoiceTableBody">
                                    <!-- Data will be inserted here by JavaScript -->
                                </tbody>
                            </table>

                            <!-- New Table for Selected Products -->

                            <div class="modal-header d-flex justify-content-center position-relative">
                                <div class="text-center w-100">
                                    <h4>Selected Products</h4>
                                    <h3 class="modal-title" id="invoiceModalLabel">INVOICE</h3>
                                    <h5><p class="mb-0">ABC Company (Pvt) LTD</p></h5>
                                </div>
                            </div>
                            <table class="table mt-3">
                                <thead class="bg-black text-white">
                                    <tr>
                                        <th>Product ID</th>
                                        <th>Product Name</th>
                                        <th>Add Quantity</th>
                                        <th>Price</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody id="selectedProductsTableBody">
                                    <!-- Selected products will be inserted here by JavaScript -->
                                </tbody>
                                <!-- Footer Row for Total, Discount, and Final Total -->
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" class="text-right font-weight-bold">Total:</td>
                                            <td>
                                                <input type="text" id="total" class="form-control form-control-sm" placeholder="Total Amount" readonly>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="text-right font-weight-bold">Discount:</td>
                                            <td>
                                                <div class="input-group">
                                                    <input type="text" id="discount" class="form-control form-control-sm" placeholder="Enter Discount" aria-label="Discount">
                                                    <div class="input-group-append">
                                                        <span class="form-control form-control-sm">%</span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>


                                        <tr>
                                            <td colspan="4" class="text-right font-weight-bold">Final Total:</td>
                                            <td>
                                                <input type="text" id="final_Total" class="form-control form-control-sm" placeholder="Final Total">
                                            </td>
                                        </tr>
                                    </tfoot>
                            </table>


                        </div>

                        <!-- Footer with Buttons -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            {{--  //<button type="submit" class="btn btn-primary">show</button>  --}}
                            <button type="button" class="btn btn-primary" id="printButton">Print</button>

                        </div>

                        <script>
                            document.getElementById('printButton').addEventListener('click', function () {
                                generatePDF();
                            });

                            function generatePDF() {
                                const companyName = "ABC Company (Pvt) LTD";
                                const date = new Date().toLocaleDateString();
                                const time = new Date().toLocaleTimeString();

                                const total = document.getElementById('total').value;
                                const discount = document.getElementById('discount').value || 0;
                                const finalTotal = document.getElementById('final_Total').value;

                                const element = document.getElementById('selectedProductsTableBody');

                                const { jsPDF } = window.jspdf;
                                const pdf = new jsPDF();

                                pdf.setFontSize(12);
                                pdf.text(companyName, 105, 10, { align: 'center' });
                                pdf.text(`Date: ${date}`, 150, 10);
                                pdf.text(`Time: ${time}`, 150, 16);

                                pdf.text(`Total: ${total}`, 10, 30);
                                pdf.text(`Discount: ${discount}%`, 10, 36);
                                pdf.text(`Final Total: ${finalTotal}`, 10, 42);

                                html2canvas(element).then(canvas => {
                                    const imgData = canvas.toDataURL('image/png');
                                    const imgWidth = 190;
                                    const imgHeight = (canvas.height * imgWidth) / canvas.width;

                                    pdf.addImage(imgData, 'PNG', 10, 50, imgWidth, imgHeight);

                                    pdf.save('invoice.pdf');

                                    $('#yourModalID').modal('hide');
                                    setTimeout(() => {
                                        location.reload();
                                    }, 500);
                                });
                            }

                        </script>

                    </div>
                </div>
            </div>




        <!-- /.content-wrapper -->
        </div>
        <!-- ./wrapper -->

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


        <script>
                let allStocks = []; // Global array to store stock data for filtering and updates
                let selectedProducts = []; // Global array to store selected products in the invoice

                // Load data when the modal is shown
                $('#InvoiceModal').on('show.bs.modal', function () {
                    $.ajax({
                        {{--  url: "{{ route('stocks.get') }}",  --}}
                        method: 'GET',
                        success: function (data) {
                            allStocks = data; // Store data globally for the search and update functions
                            renderTableRows(allStocks);
                        },
                        error: function () {
                            console.log('Error fetching data');
                        }
                    });
                });

                // Function to render rows based on stock data
                function renderTableRows(stocks) {
                    let tbody = '';
                    stocks.forEach(stock => {
                        tbody += `
                            <tr>
                                <td>${stock.Product_ID}</td>
                                <td>${stock.Product_Name}</td>
                                <td>${stock.Company_Name}</td>
                                <td>${stock.quantity}</td>
                                <td>${stock.price}</td>
                                <td>
                                    <input type="number" class="quantity-input form-control form-control-sm text-center" min="1" max="${stock.quantity}" value="1" style="width: 50%;">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary add-to-invoice-button" data-product-id="${stock.Product_ID}" data-product-name="${stock.Product_Name}" data-price="${stock.price}" data-stock="${stock.quantity}">
                                        Add
                                    </button>
                                </td>
                            </tr>`;
                    });
                    $('#invoiceTableBody').html(tbody);
                }

                // Event listener for "Add" buttons
                $(document).on('click', '.add-to-invoice-button', function () {
                    const productId = $(this).data('product-id');
                    const productName = $(this).data('product-name');
                    const price = parseFloat($(this).data('price'));
                    let stock = parseInt($(this).data('stock'));
                    const quantity = parseInt($(this).closest('tr').find('.quantity-input').val());

                    if (quantity > stock) {
                        alert("Not enough stock available.");
                        return;
                    }

                    // Calculate total for the selected item
                    const total = price * quantity;

                    // Update stock value
                    stock -= quantity;
                    $(this).data('stock', stock); // Update stock value in button

                    // Add selected item to the selectedProducts array
                    selectedProducts.push({ productId, productName, quantity, price, total });
                    renderSelectedProductsTable();
                    calculateTotals();

                    // Update the displayed stock for this product in the table
                    $(this).closest('tr').find('td:nth-child(4)').text(stock);

                    // Prepare data for updating product stock
                    const items = selectedProducts.map(product => ({
                        Product_ID: product.productId,
                        quantity: product.quantity
                    }));

                    // Send AJAX request to update stock in database
                    {{--  $.ajax({
                        url: "{{ route('update.product.stock') }}",
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        contentType: 'application/json',
                        data: JSON.stringify({ items: items }),
                        success: function (response) {
                            if (response.success) {
                                console.log("Stock updated successfully.");
                            } else {
                                console.log("Error updating stock:", response.error);
                            }
                        },
                        error: function (xhr, status, error) {
                            console.log("Error updating stock:", error);
                        }
                    });
                });  --}}


                // Render the selected products table
                function renderSelectedProductsTable() {
                    let tbody = '';
                    selectedProducts.forEach(product => {
                        tbody += `
                            <tr>
                                <td>${product.productId}</td>
                                <td>${product.productName}</td>
                                <td>${product.quantity}</td>
                                <td>${product.price}</td>
                                <td>${product.total}</td>
                            </tr>`;
                    });
                    $('#selectedProductsTableBody').html(tbody);
                }

                // Calculate total, discount, and final total
                function calculateTotals() {
                    // Calculate the total from selected products
                    let total = selectedProducts.reduce((acc, product) => acc + product.total, 0);
                    $('#total').val(total.toFixed(2));


                    function updateFinalTotal() {
                        let discount = parseFloat($('#discount').val()) || 0;
                        let finalTotal = discount === 0 ? total : total - (total * discount / 100);
                        $('#final_Total').val(finalTotal.toFixed(2));
                    }

                    $('#discount').on('input', updateFinalTotal);
                    updateFinalTotal();
                }


                // Filter table rows based on search input
                $('#searchInput').on('input', function () {
                    const searchTerm = $(this).val().toLowerCase();
                    const filteredStocks = allStocks.filter(stock => {
                        return (
                            stock.Product_ID.toLowerCase().includes(searchTerm) ||
                            stock.Product_Name.toLowerCase().includes(searchTerm) ||
                            stock.Company_Name.toLowerCase().includes(searchTerm)
                        );
                    });
                    renderTableRows(filteredStocks); // Re-render the table with filtered results
                });

        </script>



        <script type="text/javascript">
            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                //fetch to data to datatable

                $('#stock-datatable').DataTable({
                    responsive: true,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ Route('stock.fetch') }}",
                        type: 'GET',


                    },
                    columns: [{
                            data: 'Product_ID',
                            name: 'Product_ID'
                        },
                        {
                            data: 'Product_Name',
                            name: 'Product_Name'
                        },
                        {
                            data: 'Company_Name',
                            name: 'Company_Name'
                        },
                        {
                            data: 'Weight',
                            name: 'Weight'
                        },
                        {
                            data: 'Manufacture_Date',
                            name: 'Manufacture_Date'
                        },
                        {
                            data: 'Expiration_Date',
                            name: 'Expiration_Date'
                        },
                        {
                            data: 'quantity',
                            name: 'quantity'
                        },
                        {
                            data: 'price',
                            name: 'price'
                        },
                        {
                            data: 'Image',
                            name: 'Image',
                            render: function(data) {
                                return data ?
                                    `<img src="${data}" alt="Image" style="width: 50px; height: 50px ;"/>` :
                                    'No Image';
                            },
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'action',
                            name: 'action'
                        }
                    ],
                    order: [
                        [0, 'desc']
                    ]
                });
            });

            // Add Product

            function addProduct() {

                $('#ProductForm').trigger("reset");
                $('#ProductID').val('');
                $('#currentImage').hide();
                $('#addProductModalLabel').html("Add Product");
                $('#saveProductBtn').html("Save");
                $('#ProductModal').modal('show');

            }

            // Edit product
            function editProduct(id) {
                $.ajax({
                    type: "GET",
                    url: `/stock/edit/${id}`,
                    success: function(response) {
                        $('#ProductID').val(response.id);
                        $('#Product_ID').val(response.Product_ID);
                        $('#Product_Name').val(response.Product_Name);
                        $('#Company_Name').val(response.Company_Name);
                        $('#Weight').val(response.Weight);
                        $('#Manufacture_Date').val(response.Manufacture_Date);
                        $('#Expiration_Date').val(response.Expiration_Date);
                        $('#quantity').val(response.quantity);
                        $('#price').val(response.price);

                        // Show current image
                        if (response.Image) {
                            $('#currentImage').attr('src', response.Image).show();
                        } else {
                            $('#currentImage').hide();
                        }

                        $('#addProductModalLabel').html("Edit Product");
                        $('#saveProductBtn').html("Update");
                        $('#ProductModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", xhr.responseText); // Fix 'xhr' variable name
                        alert("Error occurred while processing your request: " + xhr.responseText);
                    }
                });
            }




            //submit to function save/store and update


            $('#ProductForm').submit(function(e) {
                e.preventDefault();

                var id = $('#ProductID').val();
                var type = id ? 'PUT' : 'POST';
                var url = id ? "{{ route('stock.update', ':id') }}".replace(':id', id) : "{{ route('stock.store') }}";

                var formData = new FormData();
                formData.append('Product_ID', $('#Product_ID').val());
                formData.append('Product_Name', $('#Product_Name').val());
                formData.append('Company_Name', $('#Company_Name').val());
                formData.append('Weight', $('#Weight').val());
                formData.append('Manufacture_Date', $('#Manufacture_Date').val());
                formData.append('Expiration_Date', $('#Expiration_Date').val());
                formData.append('quantity' ,  $('#quantity').val());
                formData.append('price' ,  $('#price').val());


                // Check if a new image is selected
                if ($('#Image')[0].files[0]) {
                    formData.append('Image', $('#Image')[0].files[0]);
                }

                // Add method spoofing for PUT requests
                if (id) {
                    formData.append('_method', 'PUT');  // Spoof the PUT method for update
                }

                console.log('Form Data:', {
                    Product_ID: $('#Product_ID').val(),
                    Product_Name: $('#Product_Name').val(),
                    Company_Name: $('#Company_Name').val(),
                    Weight: $('#Weight').val(),
                    Manufacture_Date: $('#Manufacture_Date').val(),
                    Expiration_Date: $('#Expiration_Date').val(),
                    Quantity: $('#quantity').val(),
                    price: $('#price').val(),
                    Image: $('#Image')[0].files[0] ? $('#Image')[0].files[0].name : null

                });

                $.ajax({
                    url: url,
                    type: 'POST',  // Always send POST; use _method for PUT in the form data
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#ProductModal').modal('hide');
                        $('#stock-datatable').DataTable().ajax.reload();
                        alert(response.message);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", xhr.responseText);
                        alert("Error occurred while processing your request: " + xhr.responseText);
                    }
                });
            });




            // Product delete

            function deleteProduct(id) {
                if (confirm("Are you sure you want to delete this product?")) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('stock.destroy', '') }}/" + id,
                        success: function(response) {
                            $('#stock-datatable').DataTable().ajax.reload();
                            alert(response.message);
                        },
                        error: function(response) {
                            alert('Error occurred while deleting product');
                        }
                    });
                }
            }

            //sent to email


            function sendEmail(id) {
                // Prompt the user for an email address
                const email = prompt("Please enter the email address:");

                if (!email) {
                    alert("Email address is required.");
                    return;
                }

                // Send the email request with the email address
                fetch(`/send-email/${id}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ email: email })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Email sent successfully.");
                    } else {
                        alert("Error: " + data.error);
                    }
                })
                .catch(error => console.error('Error:', error));
            }






        </script>

</body>

</html>
