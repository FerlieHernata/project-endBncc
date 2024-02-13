@extends('layout.mainlayout')

@section('title','user')

@section('content')
    <h1>Deleted User List</h1>
    <div class="mt-5 d-flex justify-content-end">
        <a href="user" class="btn btn-primary">Back</a>
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
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deleted as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->phone }}</td>
                        @if ($item->role_id == 1)
                            <td>Admin</td>
                        @else
                            <td>Client</td>
                        @endif
                        <td>
                            <a href="user-restore/{{$item->slug}}">Restore</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
