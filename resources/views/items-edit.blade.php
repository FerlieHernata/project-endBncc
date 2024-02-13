@extends('layout.mainlayout')

@section('title','items')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <h1>Edit Item</h1>

    <div class="mt-5 w-50">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="/items-edit/{{$items->slug}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" value={{$items->name}} placeholder="Item Name">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" name="price" id="price" class="form-control" value="{{$items->price}}" placeholder="Item Price">
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Quantity</label>
                <input type="text" name="quantity" id="quantity" class="form-control" value="{{$items->quantity}}" placeholder="Item Quantity">
            </div>
            <div class="mb-3">
                <label for="photos" class="form-label">Photo</label>
                <input type="file" name="photos" class="form-control">
            </div>
            <div class="mb-3">
                <label for="currentImage" class="form-label" style="display:block">Current Image</label>
                @if ($items->photo != '')
                    <img src="{{asset('storage/photo/'.$items->photo)}}" alt="" srcset="" width="300px">
                @else
                    <img src="{{asset('images/template.jpg')}}" alt="" srcset="" width="300px">
                @endif
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select name="categories[]" id="category" class="form-control select-multiple" multiple>
                    @foreach ($categories as $item )
                    <option value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="currentCategory">Current Category</label>
                <ul>
                    @foreach ($items->categories as $category)
                        <li>{{ $category->name}}</li>
                    @endforeach
                </ul>
            </div>
            <div class="mt-3">
                <button class="btn btn-success" type="submit">Update</button>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
            <script>
                $(document).ready(function() {
                    $('.select-multiple').select2();
                });
            </script>
@endsection

