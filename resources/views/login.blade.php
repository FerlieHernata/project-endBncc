<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Items Inventory | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<style>
    .main{
        height: 100vh;
        box-sizing: border-box;
    }
    .login-box{
        padding: 30px;
        width: 500px;
        border: solid 1px;
    }
    form div{
        margin-bottom: 15px;
    }
    .header{
        font-weight: bold;
        font-size: 200%;
        text-align: center;
    }
</style>

<body>
    <div class="main d-flex justify-content-center align-items-center">
        <div class="login-box">
            @if (session('status'))
                <div class="alert alert-success">
                    {{session('message')}}
                </div>
            @endif
            <form action="" method="post">
                @csrf
                <div>
                    <h1 class="header">Login</h1>
                </div>
                <div>
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div>
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary form-control">Login</button>
                </div>
                <div class="text-center">
                    <a href="register" >Sign Up</a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
