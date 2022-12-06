<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Site Metas -->
    <title>Freshshop - Ecommerce Bootstrap 4 HTML Template</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Site Icons -->
    <link rel="shortcut icon" href="/template/client/images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="/template/client/images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/template/client/css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="/template/client/css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="/template/client/css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/template/client/css/custom.css">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="d-flex justify-content-center vh-100">

<div class="contact-form-right" style="margin-top: 200px; width: 500px;">
    <h2 class="text-center">CLIENT REGISTER</h2>
    @include('admin/alert')
    <form action="/shop/register" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" required="" data-error="Please enter your name" value={{old('name')}}>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <input type="text" class="form-control" id="email" name="email" placeholder="Email" required="" data-error="Please enter your email" value={{old('email')}}>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required="" data-error="Please enter your username" value={{old('username')}}>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <input type="password" placeholder="Password" id="password" class="form-control" name="password" required="" data-error="Please enter your password" value={{old('password')}}>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <input type="password" placeholder="Confirm Password" id="cpassword" class="form-control" name="cpassword" required="" data-error="Please enter confirm password" value={{old('cpassword')}}>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            
            <div class="col-md-12">
                <div class="submit-button text-center">
                    <button class="btn hvr-hover disabled" id="submit" type="submit" style="pointer-events: all; cursor: pointer;">REGISTER</button>
                    <div id="msgSubmit" class="h3 text-center hidden"></div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <br>
            <div class="col-md-12 text-center">
                <a class="text-primary" href="{{route('client.login')}}">I already have an account</a>
            </div>

        </div>

    </form>
</div>

{{-- Footer --}}
@include('client.foot')
{{-- Footer --}}