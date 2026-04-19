<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Styled Table</title>
    <style>
        /* Table styles */
        table {
            width: 100%;
            border-collapse: collapse; /* Ensures borders are collapsed into a single line */
        }

        th, td {
            border: 1px solid #000; /* Black border for cells */
            padding: 10px;
            text-align: center; /* Center the text in all table cells */
            font-size: 23px;
        }

        th {
            font-weight: bold; /* Bold text for the header */
        }

        /* Optional: Add some space between the table and the edges of the container */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
    </style>
</head>
<body>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Reference</th>
                <th>Customer</th>
                <th>Total Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($quotations as $quotation)
            <tr>
                <td>{{ $quotation->date }}</td>
                <td>{{ $quotation->reference }}</td>
                <td>{{ $quotation->customer->customer_name }}</td>
                <td>{{ format_currency($quotation->total_amount) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>