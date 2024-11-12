<!DOCTYPE html>
<html>
<head>
    <title>Invoice PDF</title>
    <style>
        /* General PDF styling */
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        h1 { text-align: center; }
        header, footer { text-align: center; padding: 10px; background-color: #f3f3f3; }
        header h1 { margin: 0; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 8px; border: 1px solid #ccc; text-align: left; }
        .footer-note { margin-top: 20px; font-style: italic; }
        .totals-row { font-weight: bold; }

        /* Company information styling with increased font size */
        .company-info { width: 100%; border: none; margin-top: 20px; font-size: 16px; } /* Larger font size */
        .company-info td { border: none; font-weight: normal; } /* Regular (non-bold) text */
        .left-info { text-align: left; }
        .right-info { text-align: right; }

        /* Invoice details styling */
        .invoice-details { font-size: 14px; margin-top: 10px; } /* Slightly larger font for invoice details */
        .invoice-details p { margin: 5px 0; }
    </style>
</head>
<body>

    <!-- Header Section -->
    <header>
        <h1>INVOICE</h1>
    </header>

    <!-- Invoice Content -->
    <main>
        <!-- Company Information Section (now displayed first) -->
        <table class="company-info">
            <tr>
                <td class="left-info">
                    Vertical System Solution (pvt) Ltd.<br />
                    12345, Infront of Anuradhapura town<br />
                    Anuradhapura
                </td>
                <td class="right-info">
                    Web: www.vertical.lk<br />
                    Email: Vertical@gmail.com<br />
                    Phone: 0255854878
                </td>
            </tr>
        </table>

        <!-- Invoice Details Section -->
        <div class="invoice-details">
            <p><strong>Invoice ID:</strong> {{ $invoiceId }}</p>
            <p><strong>Customer Name:</strong> {{ $customerName }}</p>
            
        </div>

        <!-- Product Details Table -->
        <h2>Product Details</h2>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalPrice = 0;
                @endphp
                @foreach ($gridData as $item)
                    @php
                        $itemTotal = $item['price'] * $item['quantity'];
                        $totalPrice += $itemTotal;
                    @endphp
                    <tr>
                        <td>{{ $item['product_name'] }}</td>
                        <td>{{ number_format($item['price'], 2) }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ number_format($itemTotal, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="totals-row">
                    <td colspan="3">Total Price</td>
                    <td>{{ number_format($totalPrice, 2) }}</td>
                </tr>
                <tr class="totals-row">
                    <td colspan="3">Discount</td>
                    <td>{{ number_format($discount, 2) }}</td>
                </tr>
                <tr class="totals-row">
                    <td colspan="3">Final Balance</td>
                    <td>{{ number_format($finalBalance, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </main>

    <!-- Footer Section -->
    <footer>
        <p class="footer-note">Thank you for your business!</p>
    </footer>

</body>
</html>
