<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Frest admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Frest admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="apple-touch-icon" href="/img/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="/img/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ mix('/css/vendor/vendors.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ mix('/css/theme/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ mix('/css/theme/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ mix('/css/theme/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ mix('/css/theme/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ mix('/css/theme/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ mix('/css/theme/semi-dark-layout.css') }}">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ mix('/css/page/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ mix('/css/page/authentication.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ mix('/css/custom/style.css') }}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern dark-layout 1-column  navbar-sticky footer-static bg-full-screen-image  blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- register section starts -->
                <section class="row flexbox-container">
                    <div class="col-xl-8 col-10">
                        <div class="card bg-authentication mb-0" style=" background-color: #21254a;">
                            <div class="row m-0">
                                <!-- register section left -->
                                <div class="col-md-6 col-12 px-0">
                                    <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
                                        <div class="card-header pb-1">
                                            <div class="card-title">
                                                <h4 class="text-center mb-2">Registro</h4>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <p> <small> Por favor ingresa los detalles de tu registro</small>
                                            </p>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <form method="POST" action="{{ route('register') }}">
                                                    @csrf
                                                    <div class="form-group mb-50">
                                                        <label class="text-bold-600" for="exampleInputUsername1">Nombre</label>
                                                        <input type="text" name="name" class="form-control" id="exampleInputUsername1" value="{{ old('name') }}">
                                                    </div>
                                                    @error('name')
                                                        <code>{{ $message }}</code>
                                                    @enderror
                                                    <div class="form-group mb-50">
                                                        <label class="text-bold-600" for="exampleInputEmail1">Correo electronico</label>
                                                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" value="{{ old('email') }}">
                                                    </div>
                                                    @error('email')
                                                        <code>{{ $message }}</code>
                                                    @enderror
                                                    <div class="form-group mb-50">
                                                        <label class="text-bold-600" for="exampleInputPassword1">Contraseña</label>
                                                        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                                                    </div>
                                                    @error('password')
                                                        <code>{{ $message }}</code>
                                                    @enderror
                                                    <div class="form-group mb-50">
                                                        <label class="text-bold-600" for="exampleInputPassword1">Confirmar contraseña</label>
                                                        <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1">
                                                    </div>
                                                    <button type="submit" class="btn btn-primary glow position-relative w-100 mb-50">Registrarme<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                                                </form>
                                                <hr>
                                                <div class="text-center"><small class="mr-25">Ya tienes una cuenta?</small><a href="/login"><small>Iniciar sesión</small> </a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- image section right -->
                                <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                                    <img class="img-fluid" src="/img/login.jpg" alt="branding logo">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- register section endss -->
            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ mix('/js/vendor/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ mix('/js/theme/app-menu.js') }}"></script>
    <script src="{{ mix('/js/theme/app.js') }}"></script>
    <script src="{{ mix('/js/theme/components.js') }}"></script>
    <script src="{{ mix('/js/theme/footer.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>