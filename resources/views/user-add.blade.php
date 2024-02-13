@extends('layout.mainlayout')

@section('title','user')

@section('content')
    <h1>Add New User</h1>

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
        <form action="user-add" method="post">
            @csrf
            <div>
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="User Name">
            </div>
            <div>
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" id="email" class="form-control" placeholder="User Email">
            </div>
            <div>
                <label for="password" class="form-label">Password</label>
                <input type="text" name="password" id="password" class="form-control" placeholder="User Password">
            </div>
            <div>
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" id="phone" class="form-control" placeholder="User Phone">
            </div>
            <div class="mt-3">
                <button class="btn btn-success" type="submit">Save</button>
                <a href="user" class="btn btn-primary">Back</a>
            </div>
        </form>
    </div>
@endsection
