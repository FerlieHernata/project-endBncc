<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Item Inventory | @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <div class="main d-flex justify-content-between flex-column">
        <nav class="navbar navbar-dark navbar-expand-lg bg-info">
            <div class="container-fluid">
              <a class="navbar-brand" href="#">Item</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
            </div>
        </nav>
          <div class="body-content h-100">
            <div class="row g-0 h-100">
                <div class="sidebar col-lg-2 collapse d-lg-block" id="navbarTogglerDemo02">
                    @if (Auth::user()->role_id == 1)
                        <p></p>
                        <a href="/dashboard" @if(request()->is('dashboard')) class='active' @endif>Dashboard</a>
                        <a href="/items" @if(request()->is('items') || request()->is('items-add') || request()->is('items-deleted') || str_contains(request()->url(), 'items-edit')) class='active' @endif>Items</a>
                        <a href="/category" @if(request()->is('category') || request()->is('category-add') || request()->is('category-deleted') || str_contains(request()->url(), 'category-edit')) class='active' @endif>Category</a>
                        <a href="/user" @if(request()->is('user') || request()->is('user-add') || request()->is('user-deleted') || str_contains(request()->url(), 'user-edit')) class='active' @endif>User</a>
                        <a href="/invoices" @if(request()->is('invoices')) class='active' @endif>Invoice</a>
                        <a href="/logout" @if(request()->is('logout')) class='active' @endif>Log Out</a>
                    @else
                        <a href="/home" @if(request()->is('home')) class='active' @endif>Home</a>
                        <a href="/cart" @if(request()->is('cart')) class='active' @endif>Cart</a>
                        <a href="/invoice" @if(request()->is('invoice')) class='active' @endif>Invoice</a>
                        <a href="/logout" @if(request()->is('logout')) class='active' @endif>Log Out</a>
                    @endif
                </div>
                <div class="content p-5 col-lg-10">
                    @yield('content')
                </div>
            </div>
          </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
