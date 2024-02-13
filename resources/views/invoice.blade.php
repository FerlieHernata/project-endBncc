@extends('layout.mainlayout')

@section('title','invoice')
@section('content')
    <h1>Invoice List</h1>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Invoice Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->invoice }}</td>
                        <td>
                            <a href="invoice-open/{{$item->invoice}}" class="btn btn-danger">Open</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
