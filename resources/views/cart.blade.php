@extends('layout.mainlayout')

@section('title','cart')

@section('content')
    <h1>Cart List</h1>

    <div>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Item Name</th>
                        <th>Item Quantity</th>
                        <th>Price</th>
                        <th>Photo</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $totalprice = 0; ?>
                    @foreach ($cart as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->item_name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp. {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td>
                                @if ($item->photo != '')
                                    <img src="{{ asset('storage/photo/'.$item->photo) }}" alt="" srcset="" width="200px">
                                @else
                                    <img src="{{ asset('images/template.jpg') }}" alt="" srcset="" width="200px">
                                @endif
                            </td>
                            <td>
                                <a href="/cart-delete/{{$item->id}}" class="btn btn-danger" onclick="return confirm('Are you sure to remove this item?')">Delete</a>
                            </td>
                        </tr>
                        <?php $totalprice = $totalprice + $item->price; ?>
                    @endforeach
                </tbody>
            </table>
            <div>
                <h1 class="total_deg">Total Price: Rp. {{ number_format($totalprice, 0, ',', '.') }}</h1>
            </div>
            <div>
                <h1 style="font-size: 20px">Procced to Order</h1>
                <a href="/order" class="btn btn-danger">Order</a>
            </div>
    </div>
@endsection
