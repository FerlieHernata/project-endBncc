@extends('layout.mainlayout')

@section('title','items')

@section('content')
    <h1>Deleted Item List</h1>
    <div class="mt-5 d-flex justify-content-end">
        <a href="items" class="btn btn-primary">Back</a>
    </div>
    <div class="mt-5">
        @if(session('status'))
            <div class="alert alert-success">
                {{session('status')}}
            </div>
        @endif
    </div>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Category</th>
                    <th>Photo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deleted as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>Rp. {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>
                            @foreach ($item->categories as $cat)
                                {{ $cat->name }},
                            @endforeach
                        </td>
                        <td>
                            @if ($item->photo != '')
                                <img src="{{asset('storage/photo/'.$item->photo)}}" alt="" srcset="" width="200px">
                            @else
                                <img src="{{asset('images/template.jpg')}}" alt="" srcset="" width="200px">
                            @endif
                        </td>
                        <td>
                            <a href="items-restore/{{$item->slug}}">Restore</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
