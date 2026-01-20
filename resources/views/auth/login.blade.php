{{-- @extends('layouts.app')

@section('content') --}}
<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-vertical-style="overlay" data-theme-mode="light"
    data-header-styles="light" data-menu-styles="light" data-toggled="close">

<head>

    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> HR Management </title>
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
        content="dashboard template,dashboard html,bootstrap admin,dashboard admin,admin template,sales dashboard,crypto dashboard,projects dashboard,html template,html,html css,admin dashboard template,html css bootstrap,dashboard html css,pos system,bootstrap dashboard">
    <!-- Favicon -->
    <link rel="icon"
        href="https://preview.sprukomarket.com/html/bootstrap/vyzor/dist/assets/images/brand-logos/favicon.ico"
        type="image/x-icon">

    <!-- Main Theme Js -->
    <script src="../assets/js/authentication-main.js"></script>

    <!-- Bootstrap Css -->
    <link id="style" href="../assets/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Style Css -->
    <link href="../assets/css/styles.css" rel="stylesheet">

    <!-- Icons Css -->
    <link href="../assets/css/icons.css" rel="stylesheet">

</head>

<body class="bg-white">



    <div class="row authentication authentication-cover-main mx-0">
        <div class="col-xxl-9 col-xl-9">
            <div class="row justify-content-center align-items-center h-100">
                <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-6 col-sm-8 col-12">
                    <div class="card custom-card border-0 shadow-none my-4">
                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="card-body p-5">
                                <div>
                                    <h4 class="mb-1 fw-semibold">Hi,Welcome back!</h4>
                                    <p class="mb-4 text-muted fw-normal">Please enter your credentials</p>
                                </div>
                                <div class="row gy-3">
                                    <div class="col-xl-12">
                                        <label for="signin-email" class="form-label text-default">Email</label>
                                        <input type="text" class="form-control" id="signin-email"
                                            placeholder="Enter Email" name="email">
                                    </div>
                                    <div class="col-xl-12 mb-2">
                                        <label for="signin-password"
                                            class="form-label text-default d-block">Password</label>
                                        <div class="position-relative">
                                            <input type="password" class="form-control" id="signin-password"
                                                placeholder="Enter Password" name="password">
                                            <a href="javascript:void(0);" class="show-password-button text-muted"
                                                onclick="createpassword('signin-password',this)" id="button-addon2"><i
                                                    class="ri-eye-off-line align-middle"></i></a>
                                        </div>
                                        <div class="mt-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value=""
                                                    id="defaultCheck1" checked>
                                                <label class="form-check-label" for="defaultCheck1">
                                                    Remember me
                                                </label>
                                                <a href="reset-password-basic.html"
                                                    class="float-end link-danger fw-medium fs-12">Forget password ?</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-grid mt-3">
                                    <button type="submit" class="btn btn-primary">Sign In</button>
                                </div>
                                {{-- <div class="text-center my-3 authentication-barrier">
                                        <span class="op-4 fs-13">OR</span>
                                    </div>
                                    <div class="d-grid mb-3">
                                        <button
                                            class="btn btn-white btn-w-lg border d-flex align-items-center justify-content-center flex-fill mb-3">
                                            <span class="avatar avatar-xs">
                                                <img src="../assets/images/media/apps/google.png" alt="">
                                            </span>
                                            <span class="lh-1 ms-2 fs-13 text-default fw-medium">Signup with Google</span>
                                        </button>
                                        <button
                                            class="btn btn-white btn-w-lg border d-flex align-items-center justify-content-center flex-fill">
                                            <span class="avatar avatar-xs flex-shrink-0">
                                                <img src="../assets/images/media/apps/facebook.png" alt="">
                                            </span>
                                            <span class="lh-1 ms-2 fs-13 text-default fw-medium">Signup with Facebook</span>
                                        </button>
                                    </div>
                                    <div class="text-center mt-3 fw-medium">
                                        Dont have an account? <a href="sign-up-basic.html" class="text-primary">Register
                                            Here</a>
                                    </div> --}}
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xxl-3 col-xl-3 col-lg-12 d-xl-block d-none px-0">
            <div class="authentication-cover overflow-hidden">
                <div class="authentication-cover-logo">
                    <a href="index.html">
                        <img src="../assets/images/brand-logos/toggle-logo.png" alt="logo" class="desktop-dark">
                    </a>

                </div>
                <div class="authentication-cover-background">
                    <img src="../assets/images/media/backgrounds/9.png" alt="">
                </div>
                <div class="authentication-cover-content">
                    <div class="p-5">
                        <h3 class="fw-semibold lh-base">Welcome to Dashboard</h3>
                        <p class="mb-0 text-muted fw-medium">Manage your website and content with ease using our
                            powerful admin tools.</p>
                    </div>
                    <div>
                        <img src="../assets/images/media/media-72.png" alt="" class="img-fluid">
                    </div>
                    <div class="btn-group">
                        <button type="button" class="btn btn-outline-info btn-sm dropdown-toggle"
                            data-bs-toggle="dropdown" aria-expanded="false">Login-Info</button>

                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item login-type" href="#" data-email="mnnadeembd@gmail.com" data-password="12345678">Login as a /Super Admin</a></li>
                            <li><a class="dropdown-item login-type" href="#" data-email="elenga@hotmail.com" data-password="12345678">Login as a Employee</a></li>
                            <li><a class="dropdown-item login-type" href="#" data-email="mdrashedulislam604@gmail.com" data-password="12345678">Login as a Admin</a></li>
                        </ul>
                    </div>


                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap JS -->
    <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Show Password JS -->
    <script src="../assets/js/show-password.js"></script>

</body>

<script>
    document.querySelectorAll('.login-type').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();

            const email = this.getAttribute('data-email');
            const password = this.getAttribute('data-password');
            document.getElementById('signin-email').value = email;
            document.getElementById('signin-password').value = password;
        });
    });



</script>

</html>
{{-- @endsection --}}
