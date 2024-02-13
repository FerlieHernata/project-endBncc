<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Faktur Item</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 20px;
            max-width: 600px; /* Set the maximum width of the container */
            width: 100%;
        }

        h1 {
            margin: 5px;
            text-align: center;
            font-size: 20px;
            margin-bottom: 10px;
        }

        p {
            margin: 0;
        }

        table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .total-row {
            text-align: end;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Faktur Item</h1>
        <p>No. Invoice: {{$invoice}}</p>
        <p>Alamat: {{$user->address}}</p>
        <p>Kode Pos: {{$user->post_code}}</p><br>
        <p>Pembeli: {{$user->name}}</p>
        <p>Telp: {{$user->phone}}</p>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Quantity</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php $totalprice = 0; ?>
                @foreach ($order as $data)
                    <tr>
                        <td>{{ $data->item_name }}</td>
                        <td>
                            <?php
                                $item = \App\Models\Item::find($data->item_id);
                                if ($item) {
                                    foreach ($item->categories as $category) {
                                        echo $category->name . ", ";
                                    }
                                }
                            ?>
                        </td>
                        <td>{{ $data->quantity }}</td>
                        <td>Rp. {{ number_format($data->price, 0, ',', '.') }}</td>
                    </tr>
                    <?php $totalprice = $totalprice + $data->price; ?>
                @endforeach

                <tr class="total-row">
                    <td colspan="3" style="text-align: end">Total</td>
                    <td>Rp. {{ number_format($totalprice, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
