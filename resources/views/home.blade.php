@extends('layout.mainlayout')

@section('title','home')

@section('content')
    <div class="my-5">
        <div class="row">
            @foreach ($item as $it)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                <div class="card" style="height: 100%;">
                    @if ($it->photo != '')
                        <div style="height: 200px; overflow: hidden; position: relative;">
                            <img src="{{asset('storage/photo/'.$it->photo)}}" draggable="false" class="card-img-top" style="object-fit: cover; object-position: center; width: 100%; height: 100%;">
                        </div>
                    @else
                        <div style="height: 200px; overflow: hidden; position: relative;">
                            <img src="{{asset('images/template.jpg')}}" draggable="false" class="card-img-top" style="object-fit: cover; object-position: center; width: 100%; height: 100%;">
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{$it->name}}</h5>
                        <p class="card-text">Rp. {{ number_format($it->price, 0, ',', '.') }}</p>
                        <p class="card-text">Category: @foreach ($it->categories as $cat) {{$cat->name}}, @endforeach</p>
                        <p class="card-text d-flex justify-content-between align-items-center">
                            @if ($it->quantity > 0)
                                Stock: {{$it->quantity}}
                                <form action="{{ url('/add_cart',$it->id) }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4 mb-2">
                                            <input type="number" name="quantity" value="1" min="1" class="form-control"> <!-- Tambahkan kelas form-control untuk tata letak yang lebih baik -->
                                        </div>
                                        <div class="col-md-4">
                                            <input type="submit" value="Add to cart" class="btn btn-primary">
                                        </div>
                                    </div>
                                </form>
                            @else
                                Out of stock
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection
