<!DOCTYPE html>
<html lang="en" dir="ltr" data-nav-layout="vertical" data-theme-mode="light" data-header-styles="transparent"
    data-width="fullwidth" data-menu-styles="transparent" data-page-style="flat" data-toggled="close"
    data-vertical-style="doublemenu" data-toggled="double-menu-open">

<head>

    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> HR Management Project </title>
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
        content="admin dashboard html,admin html template,admin panel bootstrap template,admin panel html template,admin template html,bootstrap admin panel,bootstrap html template,bootstrap template,bootstrap with html,dashboard html template,dashboards ui,html admin dashboard,html bootstrap,html dashboard template,html template">

    <!-- Favicon -->
    <link rel="icon"
        href="https://preview.sprukomarket.com/html/bootstrap/vyzor/dist/assets/images/brand-logos/favicon.ico"
        type="image/x-icon">

    <!-- Choices JS -->
    <script src="{{asset('assets')}}/libs/choices.js/public/assets/scripts/choices.min.js"></script>

    <!-- Main Theme Js -->
    <script src="{{asset('assets')}}/js/main.js"></script>

    <!-- Bootstrap Css -->
    <link id="style" href="{{asset('assets')}}/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Style Css -->
    <link href="{{asset('assets')}}/css/styles.css" rel="stylesheet">

    <!-- Icons Css -->
    <link href="{{asset('assets')}}/css/icons.css" rel="stylesheet">

    <!-- Node Waves Css -->
    <link href="{{asset('assets')}}/libs/node-waves/waves.min.css" rel="stylesheet">

    <!-- Simplebar Css -->
    <link href="{{asset('assets')}}/libs/simplebar/simplebar.min.css" rel="stylesheet">

    <!-- Color Picker Css -->
    <link rel="stylesheet" href="{{asset('assets')}}/libs/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" href="{{asset('assets')}}/libs/%40simonwep/pickr/themes/nano.min.css">

    <!-- Choices Css -->
    <link rel="stylesheet" href="{{asset('assets')}}/libs/choices.js/public/assets/styles/choices.min.css">

    <!-- FlatPickr CSS -->
    <link rel="stylesheet" href="{{asset('assets')}}/libs/flatpickr/flatpickr.min.css">

    <!-- Auto Complete CSS -->
    <link rel="stylesheet" href="{{asset('assets')}}/libs/%40tarekraafat/autocomplete.js/css/autoComplete.css">
    @yield('css')

</head>

<body>
    <div class="progress-top-bar"></div>

    <!-- Start Switcher -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="switcher-canvas" aria-labelledby="offcanvasRightLabel">
        @include("layout.erp.partials.switcher")
    </div>
    <!-- End Switcher -->


    <!-- Loader -->
    <div id="loader">
        <img src="https://preview.sprukomarket.com/html/bootstrap/vyzor/dist/assets/images/media/loader.svg"
            alt="">
    </div>
    <!-- Loader -->

    <div class="page">
        <!-- app-header -->
        <header class="app-header sticky" id="header">

            <!-- Start::main-header-container -->
            @include("layout.erp.partials.header")
            <!-- End::main-header-container -->

        </header>
        <!-- /app-header -->
        <!-- Start::app-sidebar -->
        <aside class="app-sidebar sticky" id="sidebar">

            <!-- Start::main-sidebar-header -->
            <div class="main-sidebar-header">
                <a href="{{url('/')}}" class="header-logo">
                    <img src="{{asset('assets')}}/images/brand-logos/desktop-logo.png" alt="logo" class="desktop-logo">
                    <img src="{{asset('assets')}}/images/brand-logos/toggle-dark.png" alt="logo" class="toggle-dark">
                    <img src="{{asset('assets')}}/images/brand-logos/desktop-dark.png" alt="logo" class="desktop-dark">
                    <img src="{{asset('assets')}}/images/brand-logos/toggle-logo.png" alt="logo" class="toggle-logo">
                </a>
            </div>
            <!-- End::main-sidebar-header -->

            <!-- Start::main-sidebar -->
            <div class="main-sidebar" id="sidebar-scroll">

                <!-- Start::nav -->
                @include("layout.erp.partials.sidebar")
                <!-- End::nav -->

            </div>
            <!-- End::main-sidebar -->

        </aside>
        <!-- End::app-sidebar -->

        <!-- Start:: Doublemenu Bottom Menu -->
        <!-- End:: Doublemenu Bottom Menu -->

        <!-- Start::app-content -->
        <div class="main-content app-content">

            @yield("content")


        </div>
        <!-- End::app-content -->


        <!-- Footer Start -->
        <footer class="footer mt-auto py-3 text-center">
            @include("layout.erp.partials.footer")
        </footer>
        <!-- Footer End -->
        <div class="modal fade" id="header-responsive-search" tabindex="-1"
            aria-labelledby="header-responsive-search" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="input-group">
                            <input type="text" class="form-control border-end-0"
                                placeholder="Search Anything ..." aria-label="Search Anything ..."
                                aria-describedby="button-addon2">
                            <button class="btn btn-primary" type="button" id="button-addon2"><i
                                    class="bi bi-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- Scroll To Top -->
    <div class="scrollToTop">
        <span class="arrow lh-1"><i class="ti ti-arrow-big-up fs-18"></i></span>
    </div>
    <div id="responsive-overlay"></div>
    <!-- Scroll To Top -->

    <!-- Popper JS -->
    <script src="{{asset('assets')}}/libs/%40popperjs/core/umd/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="{{asset('assets')}}/libs/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Defaultmenu JS -->
    <script src="{{asset('assets')}}/js/defaultmenu.min.js"></script>

    <!-- Node Waves JS-->
    <script src="{{asset('assets')}}/libs/node-waves/waves.min.js"></script>

    <!-- Sticky JS -->
    <script src="{{asset('assets')}}/js/sticky.js"></script>

    <!-- Simplebar JS -->
    <script src="{{asset('assets')}}/libs/simplebar/simplebar.min.js"></script>
    <script src="{{asset('assets')}}/js/simplebar.js"></script>

    <!-- Auto Complete JS -->
    <script src="{{asset('assets')}}/libs/%40tarekraafat/autocomplete.js/autoComplete.min.js"></script>

    <!-- Color Picker JS -->
    <script src="{{asset('assets')}}/libs/%40simonwep/pickr/pickr.es5.min.js"></script>

    <!-- Date & Time Picker JS -->
    <script src="{{asset('assets')}}/libs/flatpickr/flatpickr.min.js"></script>


    <!-- Apex Charts JS -->
    <script src="{{asset('assets')}}/libs/apexcharts/apexcharts.min.js"></script>

    <!-- HRM Dashboard -->
    <script src="{{asset('assets')}}/js/hrm-dashboard.js"></script>

    <!-- Custom JS -->
    <script src="{{asset('assets')}}/js/custom.js"></script>


    <!-- Custom-Switcher JS -->
    <script src="{{asset('assets')}}/js/custom-switcher.min.js"></script>

</body>

</html>
