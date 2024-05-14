<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Customer Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        body {
            background: #fddb45;
        }

        .login-form {
            padding: 30px;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        .brand-logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .h1 {
            font-size: 24px;
            font-weight: bold;
        }

        .card-header {
            background-color: rgba(0, 0, 0, 1);
            width: 400px;
            height: 60px;
            top: 307px;
            left: 760px;
            gap: 0px;
            border-radius: 10px 10px 0px 0px !important;
            opacity: 0px;
        }

        .card-title {
            color: #fddb45;
            text-align: center;
        }

        .card {
            margin-top: 3% !important;
            margin-left: auto;
            margin-right: auto;
            width: 25rem;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-check-label {
            font-weight: normal;
        }

        a {
            color: #fddb45;
            font-size: smaller;
            font-weight: 700;
        }

        .btn-warning {
            text-align: center;
            border-radius: 15%;
        }

        @media (max-width: 768px) {
            .card-header {
                width: 100% !important;
            }

            .card {
                width: 100% !important;
            }
        }
    </style>
</head>

<body>
    <div class="container">

        <div class="d-flex flex-column justify-content-center align-items-center " style="height: 100vh;">
            <div class="text-center">
                <img src="{{ asset('img/quiz_logo.jpeg') }}" height="100px"  width="100px" alt="cigarbros">
            </div>
            @if (session()->has('success'))
                <div class="alert alert-success">
                    @if(is_array(session('success')))
                        <ul>
                            @foreach (session('success') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @else
                        {{ session('success') }}
                    @endif
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger">
                    @if(is_array(session('error')))
                        <ul>
                            @foreach (session('error') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @else
                        {{ session('error') }}
                    @endif
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Login</h3>
                </div>

                <div class="card-body">
                    @if ($errors->has('message'))
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first('message') }}
                        </div>
                    @endif
                    @if (session('message'))
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                    @if (request()->has('message'))
                        <div class="alert alert-success" role="alert">
                            {{ request('message') }}
                        </div>
                    @endif
                    <form id="loginForm" action="{{route('login.action')}}" method="POST" action="">
                        @csrf
                        <div class="mb-3">
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="Enter email" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Enter Password" required>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="rememberMe">
                                <label class="form-check-label" for="rememberMe">Remember me</label>
                            </div>
                        </div>
                        <div style="text-align:center;">
                            <button type="submit" class="btn btn-warning"><b>LOGIN</b></button>
                        </div>
                        <div style="text-align:center;">
                            <a href="{{route('register.view')}}">create a new account?</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>
    // Remove the error message after 2 seconds
        setTimeout(function() {
            $('.alert').hide();
        }, 5000);
</script>

</html>
