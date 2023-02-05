<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <section class="ftco-section">
        <div class="container"> 
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="login-wrap p-4 p-md-5">
                        <div class="icon d-flex align-items-center justify-content-center">
                            <span class="fa fa-user-o"></span>
                        </div>
                        <h3 class="text-center mb-4">Sign In</h3>

                        @if ($errors->any())
                            <ul style="color: red;">
                                @foreach ($errors->all() as $error)
                                    <li> {{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        <form class="login-form" method="POST" action="{{ route('login') }}">

                            @csrf

                            <div class="form-group">
                                <input name="email" type="text" class="form-control rounded-left" placeholder="Email" required>
                            </div>
                            <div class="form-group d-flex">
                                <input name="password" type="password" class="form-control rounded-left" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary rounded submit px-3">Login</button>
                            </div>
                        </form>
                        <h6 class="text-center"><a href="{{ route('register') }}">Create Account</a></h6>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>