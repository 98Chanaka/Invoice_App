<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Other CSS files -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    //<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">

    <!-- jQuery and Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    //<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />

    <!-- jQuery (required for Select2) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>


    {{--  pdf download to cdn  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>


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
                        <button class="btn btn-navbar" type="sub">
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
                            <a href="/stock" class="nav-link active">
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
                            <h1 class="m-0"> Invoice Dashboard</h1>
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
                                    <a href="javascript:void(0)" class="btn btn-primary" onclick="$('#addItemModal').modal('show')">
                                        <i class="fas fa-plus"></i> Add Item
                                    </a>
                                </div>
                                <div class="card-body">
                                    <table class="display" id="invoice-datatable" style="width: 100%">
                                        <thead class="bg-black text-white">
                                            <tr>
                                                <th>ID</th>
                                                <th>Invoice ID</th>
                                                <th>Customer</th>
                                                <th>Discount(%)</th>
                                                <th>Final balance(Rs.)</th>
                                                <th>Status</th>
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

<!-- Add Item Modal -->
<div class="modal fade" id="addItemModal" tabindex="-1" role="dialog" aria-labelledby="addItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">

            <form  id="addItemForm"  method="POST">
                @csrf
                {{--  action="{{ route('invoice.store') }}"  --}}


                <div class="modal-header">
                    <h5 class="modal-title" id="addItemModalLabel">Invoice</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                    <div class="container-fluid">
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <div class="form-group  custom-select-wrapper">
                                    <label for="customer_name" class="form-label">Customer Name</label><br>
                                    <select class="form-control select2 " id="customer_name" name="customer_name" style="width: 520px; " required>
                                        <option value="">Select a customer</option>

                                    </select>
                                </div>

                                <div class="form-group mt-2">
                                    <label for="customerContact">Contact</label>
                                    <input type="text" class="form-control" id="customer_contact" name="customer_contact" required>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="invoice_id">Invoice ID</label>
                                    <input type="text" class="form-control" id="invoice_id" name="invoice_id" value="{{ $formattedInvoiceId }}" readonly>
                                </div>
                                <div class="form-group mt-2">
                                    <label for="date">Date</label>
                                    <input type="text" class="form-control" id="date" name="date" value="" placeholder="XXXX-XX-XX" required>
                                </div>

                            </div>

                        </div>

                        <div class="row my-4">
                            <div class="d-flex align-items-center gap-3 my-4">
                                <label for="item_find" class="mb-0">Items</label>
                                <input id="search_item" name="search_item" type="text" placeholder="Enter" class="form-control" style="max-width: 250px;" onkeypress="checkEnter(event)" >


                                <button type="button" class="btn btn-primary" id="item_find" name="item_find" onclick="findItem()">Find</button>
                            </div>

                        </div>

                        <!-- Scrollable Table Container -->
                        <div class="row mt-3" style="max-height: 250px; overflow-y: auto;">
                            <div class="col-md-12">
                                <table class="table table-bordered" id="stock-details-table">
                                    <thead class="bg-black text-white text-center">
                                        <tr>
                                            <th class="product_id">Product Code</th>
                                            <th class="product_name">Product Name</th>
                                            <th class="company_name">Company Name</th>
                                            <th class="price">Price (Rs.)</th>
                                            <th class="add_quantity">Add Quantity</th>
                                            <th class="column_total">Total (Rs.)</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <!-- Table Rows go here -->
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <table class="table mt-3  borderless-table">
                            <tbody>
                                <tr>
                                    <td colspan="7" class="text-right">
                                        <div class="d-flex justify-content-between" style="width: 50%; margin-left: auto;">
                                            <label>Total Amount:</label>
                                            <input type="text" class="form-control text-right" id="total_amount" name="total_amount" value="0.00" readonly style="width: 50%;">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="7" class="text-right">
                                        <div class="d-flex justify-content-between" style="width: 50%; margin-left: auto;">
                                            <label>Discount (%):</label>
                                            <input type="text" class="form-control text-right" id="discount" name="discount" style="width: 50%;" value="0" onchange="calculateBalance()">
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="7" class="text-right">
                                        <div class="d-flex justify-content-between" style="width: 50%; margin-left: auto;">
                                            <label>Total Balance (Rs.):</label>
                                            <input type="text" class="form-control text-right" id="final_balance" name="final_balance" value="0.00" readonly style="width: 50%;">
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="saveButton" class="btn btn-primary">Save</button>

                </div>
            </div>
        </div>


            </form>


</div>






<!-- Find Item Modal -->
<div class="modal fade" id="findItemModal" tabindex="-1" role="dialog" aria-labelledby="findItemModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content small-text-modal">
            <div class="modal-header">
                <h5 class="modal-title" id="findItemModalLabel">Find Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <h5>Select Items</h5>
                    <table class="table table-bordered" id="select-data-table">
                        <thead class="bg-black text-white">
                            <tr>
                                <th>Product Code</th>
                                <th>Product Name</th>
                                <th>Company Name</th>
                                <th>Price (Rs.)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Payment Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Payment Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form id="paymentForm" method="POST" >
                    @csrf <!-- CSRF Token -->


                    <div class="form-group">
                        <label for="invoice_id">Invoice ID</label>
                        <input type="text" class="form-control" id="invoice_id" name="invoice_id" value="{{ $formattedInvoiceId }}" readonly>
                    </div>


                    <div class="form-group">
                        <label for="paymentMethod">Payment Method</label>
                        <select class="form-control" id="paymentMethod" name="payment_method" required>
                            <option value="cash">Cash</option>
                            {{--  <option value="credit_card">Credit Card</option>
                            <option value="debit_card">Debit Card</option>
                            <option value="paypal">PayPal</option>  --}}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="paymentAmount">Final Payment</label>
                        <input type="number" class="form-control" id="paymentAmount" name="payment_amount" placeholder="Enter amount" required>
                    </div>

                    <div class="form-group">
                        <label for="paymentDate">Payment Date</label>
                        <input type="date" class="form-control" id="paymentDate" name="payment_date" required>
                    </div>

                    <!-- Hidden Fields for Transferring Data -->
                    <input type="hidden" name="customer_name" id="hiddenCustomerName">
                    <input type="hidden" name="customer_contact" id="hiddenCustomerContact">
                    <input type="hidden" name="invoice_id" id="hiddenInvoiceId">
                    <input type="hidden" name="date" id="hiddenDate">
                    <input type="hidden" name="total_amount" id="hiddenTotalAmount">
                    <input type="hidden" name="discount" id="hiddenDiscount">
                    <input type="hidden" name="final_balance" id="hiddenFinalBalance">

                    <!-- Grid Data as Hidden JSON Field -->
                    <input type="hidden" name="grid_data" id="hiddenGridData">
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="submitPaymentButton"  onclick="submitPayment()">Submit Payment</button>
            </div>
        </div>
    </div>
</div>




    <!-- Scripts -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>

        //data fetch to invoice dashboard

            $(document).ready(function() {


                //load to select2 library
                $('#customer_name').select2({
                    placeholder: "Select a customer",
                    allowClear: false,
                    dropdownParent: $('#addItemModal'),
                });




                $('#invoice-datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route('fetch.invoices') }}',
                        type: 'GET'
                    },
                    order: [[0, 'desc'],], // add to order format
                    columns: [
                        {
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'invoice_id',
                             name: 'invoice_id'
                        },
                        {
                            data: 'customer_name',
                             name: 'customer'
                        },
                        {
                            data: 'discount',
                            name: 'discount'
                        },
                        {
                            data: 'final_balance',
                             name: 'total'
                        },
                        {
                            data: 'Status',
                             name: 'status',
                             defaultContent: 'paid'
                        }

                    ]
                });


            });



            //data fetch to find item table

            $(document).ready(function () {
                $('#findItemModal').on('show.bs.modal', function () {
                    // Initialize the DataTable when the modal is opened
                    $('#select-data-table').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                            url: "{{ route('fetch.stocks') }}",
                            type: "GET",
                            data: function (d) {
                                // Add custom search input to request
                                d.search = $('#item_find').val();
                            }
                        },
                        columns: [
                            { data: 'Product_ID', name: 'Product_ID' },
                            { data: 'Product_Name', name: 'Product_Name' },
                            { data: 'Company_Name', name: 'Company_Name' },
                            { data: 'price', name: 'price' },
                            {
                                data: 'Product_ID',
                                name: 'Product_ID',
                                render: function(data, type, row) {
                                    return `<button type="button" class="btn btn-primary btn-sm" onclick="selectItem('${row.Product_ID}', '${row.Product_Name}', '${row.Company_Name}', ${row.price})">Select</button>`;
                                },
                                orderable: false,
                                searchable: false
                            }
                        ],
                        destroy: true,
                        language: {
                            emptyTable: "No items found matching your search criteria"
                        }
                    });
                });

                // Refresh DataTable when searching
                $('#item_find').on('keypress', function (e) {
                    if (e.which === 13) { // Enter key pressed
                        $('#select-data-table').DataTable().ajax.reload();
                    }
                });
            });



// Function to load available stock data with optional filtering based on input value



$(document).ready(function () {

    $('#item_find').on('keypress', function (e) {
        if (e.which === 13) {
            e.preventDefault();
            $('#findItemModal').modal('show');
            loadAvailableStocks();e
            $('#item_find').val('');
        }
    });


    $('#findItemModal').on('show.bs.modal', function () {
        loadAvailableStocks();
    });
});

// Function to load and populate the stock table in the modal
function loadAvailableStocks() {
    const searchInput = $('#item_find').val().trim().toLowerCase();

    $.ajax({
        url: "{{ route('fetch.stocks') }}",
        type: "GET",
        data: {
            search: searchInput  // Send search input as a query parameter
        },
        dataType: "json",
        success: function(response) {
            const stockTableBody = $('#select-data-table tbody');
            stockTableBody.empty();

            // Check if there are results
            if (response.data && response.data.length > 0) {
                response.data.forEach(stock => {
                    stockTableBody.append(`
                        <tr>
                            <td>${stock.Product_ID}</td>
                            <td>${stock.Product_Name}</td>
                            <td>${stock.Company_Name}</td>
                            <td>${stock.price}</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm"
                                    onclick="selectItem('${stock.Product_ID}', '${stock.Product_Name}', '${stock.Company_Name}', ${stock.price})">Select</button>
                            </td>
                        </tr>
                    `);
                });
            } else {
                // Show message if no items match the search
                stockTableBody.append(`
                    <tr>
                        <td colspan="5" class="text-center">No items found</td>
                    </tr>
                `);
            }
        },
        error: function(error) {
            console.error("Error fetching stock data", error);
        }
    });
}

// Select item function to handle the action button in search results
function selectItem(productId, productName, companyName, price) {
    // Your logic for handling the selected item
    console.log("Selected item:", productId, productName, companyName, price);
}




$(document).ready(function() {
        $('#addItemModal').on('show.bs.modal', function() {
            loadAvailableStocks();
        });
});


// DataTable initialization
$(document).ready(function () {
    $('#invoice-datatable').DataTable();
});


function submitAddItem() {

    var formData = $('#addItemForm').serialize();

    //alert("Item added successfully!");
    $('#addItemModal').modal('hide');
}


        //add to new find mmodal display to
        function findItem() {
            $('#findItemModal').modal('show');
        }


//load to data in add item modal auto load to table in frontend

let selectedItems = [];

let stocksData = [];

// Function to load stocks data from the server
function loadStocksData() {
    fetch('/api/stocks')
        .then(response => response.json())
        .then(data => {
            stocksData = data;
            console.log("Stocks data loaded:", stocksData);
        })
        .catch(error => console.error('Error fetching stocks data:', error));
}


function checkEnter(event) {
    if (event.key === "Enter") {
        event.preventDefault();
        findAndSelectItem();
    }
}


function findAndSelectItem() {
    const searchValue = document.getElementById("search_item").value.trim().toLowerCase();
    const item = stocksData.find(item =>
        item.Product_ID.toLowerCase() === searchValue ||
        item.Product_Name.toLowerCase() === searchValue
    );

    if (item) {
        selectItem(item.Product_ID, item.Product_Name, item.Company_Name, item.price);

    } else {
        alert("Item not found!");
    }
    document.getElementById("search_item").value = "";
}

// Call loadStocksData() when the page loads to fetch data from the server
document.addEventListener("DOMContentLoaded", loadStocksData);

function selectItem(Product_ID, Product_Name, companyName, price) {

    const table = document.getElementById("stock-details-table").getElementsByTagName("tbody")[0];


    const quantity = 1;


    const newRow = table.insertRow();
    newRow.innerHTML = `
        <td class="product_id">${Product_ID}</td>
        <td class="product_name">${Product_Name}</td>
        <td class="company_name">${companyName}</td>
        <td class="price">${price}</td>
        <td>
            <input type="number" value="${quantity}" min="1" class="form-control add-quantity" onchange="updateRowTotal(this)">
        </td>
        <td class="column_total">${price}</td>
        <td><button type="button" class="btn btn-danger" onclick="removeRow(this)">Remove</button></td>
    `;

    // Prepare the JSON data for session storage
    const selectedItemData = {
        product_id: Product_ID,
        product_name: Product_Name,
        company_name: companyName,
        quantity: quantity,
        price: price
    };


    selectedItems.push(selectedItemData);

    sessionStorage.setItem('selectedItems', JSON.stringify(selectedItems));

    console.log(JSON.stringify(selectedItemData, null, 2));

    calculateTotalAmount();

    $('#findItemModal').modal('hide');
}




//save button working

$(document).ready(function() {
    $('form').on('submit', function(event) {
        event.preventDefault();

        const formData = $(this).serializeArray();
        let items = [];

        $('#stock-details-table tbody tr').each(function() {
            const productId = $(this).find('.product_id').text().trim();
            const productName = $(this).find('.product_name').text().trim();
            const companyName = $(this).find('.company_name').text().trim();
            const priceText = $(this).find('.price').text().trim();
            const quantityInput = $(this).find('. add-quantity').text().trim();
            const columnTotalText = $(this).find('.column_total').text().trim();


            // Parse numeric values and handle empty strings
            const price = parseFloat(priceText) || 0;
            const quantity = parseInt(quantityInput) || 0; // Convert to integer
            const columnTotal = parseFloat(columnTotalText) || 0;

            const item = {
                product_id: productId,
                product_name: productName,
                company_name: companyName,
                price: price,
                quantity: quantity,  // Ensure quantity is properly parsed
                column_total: columnTotal
            };

            // Log the constructed item object to confirm quantity value
            console.log("Constructed Item:", item);
            items.push(item);
        });

        // Add items to the form data
        formData.push({ name: 'items', value: JSON.stringify(items) });
        submitPayment(items);



    });
});


//calculate function

// Function to update the row total when quantity changes
function updateRowTotal(input) {
    const row = input.closest("tr");
    const price = parseFloat(row.querySelector(".price").innerText) || 0;
    const quantity = parseFloat(input.value) || 0;
    const rowTotal = price * quantity;

    // Update the row total cell
    row.querySelector(".column_total").innerText = rowTotal.toFixed(2);

    // Recalculate the total amount with updated row total
    calculateTotalAmount();
}

// Function to calculate the total amount and update the final balance
function calculateTotalAmount() {
    let total_amount = 0;
    const rows = document.getElementById("stock-details-table").getElementsByTagName("tbody")[0].rows;

    for (let row of rows) {
        const rowTotal = parseFloat(row.querySelector(".column_total").innerText) || 0;
        total_amount += rowTotal;
    }

    // Update total amount display
    const totalAmountElement = document.getElementById("total_amount");
    if (totalAmountElement) {
        totalAmountElement.value = total_amount.toFixed(2);
    } else {
        console.error("total_amount element not found");
    }

    // Calculate and update the balance immediately
    calculateBalance(total_amount);
}

// Function to calculate the final balance after discount
function calculateBalance(total_amount) {
    const discount = parseFloat(localStorage.getItem("discount")) || 0;
    const discountAmount = (total_amount * discount) / 100;
    let final_balance = total_amount - discountAmount;

    // Ensure final_balance is a valid number
    if (isNaN(final_balance) || final_balance < 0) {
        final_balance = 0;
    }

    const totalBalanceElement = document.getElementById("final_balance");
    if (totalBalanceElement) {
        totalBalanceElement.value = final_balance.toFixed(2);
    } else {
        console.error("final_balance element not found");
    }

    return final_balance;
}

// Function to update discount and apply it instantly
function updateDiscount() {
    const discountValue = parseFloat(document.getElementById("discount").value) || 0;
    localStorage.setItem("discount", discountValue);

    // Recalculate balance immediately after setting the discount
    const total_amount = parseFloat(document.getElementById("total_amount").value) || 0;
    calculateBalance(total_amount);
}

// Event listeners for discount input to apply discount immediately
document.getElementById("discount").addEventListener("input", updateDiscount);
document.getElementById("discount").addEventListener("change", updateDiscount);

// Function to load the discount from local storage on page load
function loadDiscount() {
    const discount = localStorage.getItem("discount");
    if (discount) {
        document.getElementById("discount").value = discount;
        calculateBalance(parseFloat(document.getElementById("total_amount").value) || 0);
    }
}

// Call loadDiscount on page load to apply stored discount
window.onload = loadDiscount;

// Function to remove a row and recalculate totals
function removeRow(button) {
    const row = button.closest("tr");
    row.parentNode.removeChild(row);
    calculateTotalAmount();
}



// payment details display to


document.getElementById('submitPaymentButton').addEventListener('click', function() {
    // Trigger PDF download
    downloadPDF().then(() => {

        submitPaymentForm();
    }).catch(error => {
        console.error('Error downloading PDF:', error);
        alert('Error downloading PDF: ' + error.message);
    });
});


// payment details display to

document.getElementById('submitPaymentButton').addEventListener('click', function() {
    // Get form data
    var form = document.getElementById('paymentForm');
    var formData = new FormData(form);

    // Convert form data to JSON
    var jsonData = {};
    formData.forEach(function(value, key) {
        jsonData[key] = value;
    });


});



// Fetch customers via AJAX and populate dropdown
$.ajax({
    url: "{{ route('getCustomers') }}",
    type: "GET",
    success: function(data) {
        // Clear existing options
        $('#customer_name').empty().append('<option value="">Select a customer</option>');

        // Append each customer to the dropdown
        $.each(data, function(key, customer) {
            $('#customer_name').append(
                $('<option></option>').val(customer.customer_name).text(customer.customer_name)
            );
        });
    },
    error: function(xhr, status, error) {
        console.error("Error fetching customers:", error);
    }
});





document.getElementById('saveButton').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent default form submission

    // Collect data from form fields with null checks
    const customerName = document.getElementById('customer_name')?.value || '';
    const customerContact = document.getElementById('customer_contact')?.value || '';
    const invoiceId = document.getElementById('invoice_id')?.value || '';
    const date = document.getElementById('date')?.value || '';
    const totalAmount = document.getElementById('total_amount')?.value || '';
    const discount = document.getElementById('discount')?.value || '';
    const finalBalance = document.getElementById('final_balance')?.value || '';

    // Log the main invoice number once
    console.log("Invoice:", invoiceId);

    // Collect grid data (from stock-details-table)
    const gridData = [];
    document.querySelectorAll('#stock-details-table tbody tr').forEach(row => {
        const productId = row.querySelector('.product_id')?.textContent.trim() || '';
        const productName = row.querySelector('.product_name')?.textContent.trim() || '';
        const companyName = row.querySelector('.company_name')?.textContent.trim() || '';
        const price = parseFloat(row.querySelector('.price')?.textContent.trim()) || 0;


        const addQuantityInput = row.querySelector('.add-quantity ');
        const addQuantity = addQuantityInput ? parseInt(addQuantityInput.value) : 0;
        const columnTotal = parseFloat(row.querySelector('.column_total')?.textContent.trim()) || 0;

        // Log quantity for debugging
        console.log(`Product ID: ${productId}, Quantity: ${addQuantity}`);

        const rowInvoiceId = row.querySelector('.invoice')?.textContent.trim() || invoiceId;
        console.log(`invoice:${rowInvoiceId} invoice:${invoiceId} Product ID: ${productId} Quantity: ${addQuantity}`);

        // Push data to gridData array
        gridData.push({
            product_id: productId,
            product_name: productName,
            company_name: companyName,
            price: price,
            quantity: addQuantity,
            column_total: columnTotal
        });
    });

    // Assign grid data to the hidden field
    document.getElementById('hiddenGridData').value = JSON.stringify(gridData);

    // Log grid data array with the main invoice ID
    console.log(`invoice:${invoiceId} Grid Data:`, gridData);

    // Populate hidden fields in Payment Modal
    document.getElementById('hiddenCustomerName').value = customerName;
    document.getElementById('hiddenCustomerContact').value = customerContact;
    document.getElementById('hiddenInvoiceId').value = invoiceId;
    document.getElementById('hiddenDate').value = date;
    document.getElementById('hiddenTotalAmount').value = totalAmount;
    document.getElementById('hiddenDiscount').value = discount;
    document.getElementById('hiddenFinalBalance').value = finalBalance;

    // Show the Payment Modal
    $('#paymentModal').modal('show');
});



document.getElementById('submitPaymentButton').addEventListener('click', function () {
    const finalBalance = parseFloat(document.getElementById('hiddenFinalBalance')?.value || '0');
    const paymentAmount = parseFloat(document.getElementById('paymentAmount')?.value || '0');

    // Check if final_balance is equal to payment_amount
    if (finalBalance !== paymentAmount) {
        alert("The payment amount does not match the final balance. Please check the amounts and try again.");
        return; // Stop further execution if the amounts don't match
    }

    const paymentData = {
        customer_name: document.getElementById('hiddenCustomerName')?.value || '',
        customer_contact: document.getElementById('hiddenCustomerContact')?.value || '',
        invoice_id: document.getElementById('hiddenInvoiceId')?.value || '',
        date: document.getElementById('hiddenDate')?.value || '',
        total_amount: document.getElementById('hiddenTotalAmount')?.value || '',
        discount: document.getElementById('hiddenDiscount')?.value || '',
        final_balance: finalBalance,
        grid_data: JSON.parse(document.getElementById('hiddenGridData')?.value || '[]'),
        payment_method: document.getElementById('paymentMethod')?.value || '',
        payment_amount: paymentAmount,
        payment_date: document.getElementById('paymentDate')?.value || '',
    };

    fetch('/save-invoice-body', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(paymentData)
    })
    .then(response => {
        if (!response.ok) {
            console.error("Response failed with status:", response.status);
            return Promise.reject('Error: ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            alert("Invoice saved successfully.");
            const items = paymentData.grid_data.map(item => ({
                product_id: item.product_id,
                quantity: item.quantity
            }));
            updateProductStock(items);
        }
    })
    .catch(error => {
        console.error("Error saving invoice:", error);
    });
});

function submitPayment() {
    const finalBalance = parseFloat(document.getElementById('hiddenFinalBalance')?.value || '0');
    const paymentAmount = parseFloat(document.getElementById('paymentAmount')?.value || '0');

    if (finalBalance !== paymentAmount) {
        alert("The payment amount does not match the final balance. Please check the amounts and try again.");
        return;
    }

    let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let formData = new FormData(document.getElementById('paymentForm'));

    fetch("{{ route('invoice.store') }}", {
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        console.log('Invoice stored successfully.');
        return fetch("{{ route('update.payment') }}", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            body: formData
        });
    })
    .then(response => response.json())
    .then(data => {
        console.log('Payment updated successfully.');
        $('#paymentModal').modal('hide');
        $('#addItemModal').modal('hide');
        window.location.reload();
        return fetch("{{ route('generate.invoice.pdf') }}", {
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                invoiceId: document.getElementById("invoice_id").value,
                paymentMethod: document.getElementById("paymentMethod").value,
                paymentAmount: document.getElementById("paymentAmount").value,
                paymentDate: document.getElementById("paymentDate").value,
                customerName: document.getElementById("hiddenCustomerName").value,
                customerContact: document.getElementById("hiddenCustomerContact").value,
                totalAmount: document.getElementById("hiddenTotalAmount").value,
                discount: document.getElementById("hiddenDiscount").value,
                finalBalance: document.getElementById("hiddenFinalBalance").value,
                gridData: JSON.parse(document.getElementById("hiddenGridData").value)
            })
        });
    })
    .then(response => response.blob())
    .then(blob => {
        let url = window.URL.createObjectURL(blob);
        let a = document.createElement('a');
        a.href = url;
        a.download = `Payment_Invoice_${document.getElementById("invoice_id").value}.pdf`;
        document.body.appendChild(a);
        a.click();
        a.remove();

        let items = [];

        return fetch('/update-product-stock', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ items: items })
        });
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Stock quantities updated successfully.");
        } else {
            alert("Error updating stock: " + data.error);
        }
    })
    .catch(error => {
        console.error("Error processing payment or updating stock:", error);
    });
}







</script>



</body>

</html>
