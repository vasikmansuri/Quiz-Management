<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="Cigarbros, best quality cigrates">
    <meta name="author" content="Cigarbros">

    <title>Quiz Management</title>
    <link rel="shortcut icon" href="{{ asset('img/CB-Rewards-Logo.svg') }}" type="image/x-icon">

    <!-- Custom fonts for this template-->
    <link href="{{ asset('ax-theme/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('ax-theme/css/sb-admin-2.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<style>
    .error {
        color: #ec0f0f;
        line-height: 1;
        font-size: 1rem;
    }
    .notification-description {
        max-height: 100px;
        overflow-y: auto;
        padding-right: 15px;
    }

    .scrollable-description {
        margin-bottom: 0;
    }

    .view-cart-dialog {
        max-width: 500px;
        margin: 1.75rem;
        margin-left: auto;
    }

    / Media query for responsiveness on mobile devices / @media (max-width: 576px) {
        .view-cart-dialog {
            margin: 0.75rem;
        }
    }

    / Media query for responsiveness on small tablets / @media (min-width: 577px) and (max-width: 768px) {
        .view-cart-dialog {
            max-width: 400px;
        }
    }

    / Media query for responsiveness on larger tablets and small laptops / @media (min-width: 769px) and (max-width: 1024px) {
        .view-cart-dialog {
            max-width: 500px;
        }
    }

    .gm-style-iw.gm-style-iw-c {
        background: #FCDB45;
        font-family: roboto-3;
        color: #1a1a1a;
    }

    .auto-hide-alert {
        animation: hideAlert 5s forwards;
    }

    .gm-style .gm-style-iw-d {
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
        overflow: auto !important;
    }

    .store-list-container {
        max-height: 570px !important;
        overflow-y: auto !important;
    }

    .store-list {
        list-style-type: none;
        padding: 0;
    }

    .store-item {
        border-bottom: 1px solid #000;
        padding-bottom: 15px;
        margin-bottom: 15px;
        color: rgb(0 0 0 / 80%) !important;
        font-family: roboto-3
    }

    .topbar .topbar-divider {
        width: 0;
        border-right: 1px solid #6b6b6b;
        height: calc(2.975rem - 2rem);
        margin: auto 1rem;
    }

    .roboto-4 {
        font-family: 'roboto-4';
    }

    .btn-primary:hover {
        color: #FCDB45 !important;
        background-color: #000000 !important;
        border-color: #000000 !important;
    }

    .btn-primary:hover>svg {
        color: #FCDB45 !important;
    }

    .roboto-3 {
        font-family: 'roboto-3';
    }

    .roboto-2 {
        font-family: 'roboto-2';
    }

    .roboto-1 {
        font-family: 'roboto-1';
    }

    .sidebar-dark .nav-item.active .nav-link {
        color: #FCDB45;
        background: black;
        border-radius: 10px;
        font-family: 'roboto-3';
    }

    .custom-text-display-2 {
        color: #d1d1d1 !important;
        font-size: 16px;
        padding-top: 4px;
        text-decoration: underline;
    }

    .boder-style {
        border: 1px solid #656565;
        border-radius: 12px;
        font-size: 16px;
        padding: 10px 15px;
        width: fit-content;
    }

    .ax-gold {
        margin-right: 1rem;
        color: #FCDB45;
        font-family: roboto-3
    }

    .ax-bg-gold {
        background: #FCDB45;
        font-family: roboto-3
    }

    .topbar .nav-item .nav-link {
        height: 2.375rem;
    }

    .custom-button-1 {
        border-radius: 30px;
        font-size: 16px;
        font-family: 'roboto-3';
        letter-spacing: 1px;
        background: #FCDB45;
        border-color: #FCDB45;
    }

    .width-30 {
        width: 30px;
        height: auto;
    }

    .ax-bg-gold {
        color: #FCDB45;
    }

    .sidebar-dark .nav-item.active .nav-link i {
        color: #FCDB45;
    }

    .sidebar-dark .nav-item .nav-link {
        color: rgb(0 0 0 / 80%);
        background: #efefef;
        border-radius: 10px;
        font-weight: 800;
    }

    .fa-tachometer-alt:before {
        content: "\f3fd";
        color: #FCDB45;

    }

    .sidebar-dark .nav-item .nav-link {
        /* Define initial styles */
        transition: color 0.3s ease-in, background 0.3s ease-in, border-radius 0.3s ease-in, font-weight 0.3s ease-in;
    }

    .sidebar-dark .nav-item .nav-link:active i,
    .sidebar-dark .nav-item .nav-link:focus i,
    .sidebar-dark .nav-item .nav-link:hover i {
        color: #FCDB45;
    }

    .sidebar-dark .nav-item .nav-link i {
        color: black;
    }

    .sidebar-dark .nav-item .nav-link:active,
    .sidebar-dark .nav-item .nav-link:focus,
    .sidebar-dark .nav-item .nav-link:hover {
        color: #FCDB45;
        background: black;
        border-radius: 10px;
        font-weight: 800;
    }

    #wrapper #content-wrapper #content {
        background: linear-gradient(178deg, #362f0e, #362f0e, #362f0e, black);
    }

    .bg-gradient-primary {
        background-color: #ffffff;
        background-image: none;
        background-size: cover;
    }

    .sidebar .sidebar-brand {
        margin-top: 15%;
    }

    .icon-ax {
        font-size: 20px !important;

    }

    .navbar {
        padding: 0rem 1rem;
    }

    .bg-white {
        background-color: #362f0e !important;
    }

    .topbar {
        height: 3.375rem;
    }

    .bottom-menu {
        display: none;
        /* Hide the menu by default */
    }

    .update_color {
        color: white;
    }

    @media (max-width: 768px) {
        .start-points {
            padding-left: 13%;
        }

        #sidebarToggleTop {
            display: none !important;
        }

        #accordionSidebar {
            display: none !important;
        }

        /* Show the menu on devices with max width 768px (tablets and mobiles) */
        .bottom-menu {
            position: fixed;
            bottom: -2px;
            left: 0;
            width: 100%;
            background-color: #000000;
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 10px 0;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
        }

        .bottom-menu-item {
            text-align: center;
            flex: 1;
            padding: 10px;
            color: #888;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .bottom-menu-item:hover {
            color: #333;
        }

        .bottom-menu-item.active {
            color: #333;
            font-weight: bold;
        }
    }

    @media (min-width: 768px) {
        .sidebar {
            width: 25rem !important;
        }

        .sidebar .nav-item .nav-link span {
            font-size: 1.2em;
        }

        .sidebar .nav-item .nav-link {
            width: 15rem;
        }
    }

    /* Media query for smaller devices */
    @media screen and (max-width: 768px) {
        .remove-padding {
            margin-right: 1rem !important;
        }

    }

    label {
        font-weight: 600;
    }

    /* Default styles */
    #greeting {
        font-size: 24px;
        /* Default font size */
    }

    .start-points {
        margin-left: 4px;
    }

    /* Media query for smaller devices */
    @media screen and (max-width: 768px) {
        #greeting {
            font-size: 18px;
            /* Adjust font size for smaller devices */
        }

        .start-points {
            margin-left: 0px;

        }

        .custom-button-1 {
            font-size: 10px;

        }

        .ax-gold {
            margin-right: 3rem;

        }

        .view-cart-dialog {
            /* max-width: 500px; */
            margin: 1.75rem;
            margin-left: ;
        }
    }

    .bottomItem {
        color: white !important;
    }

    .bottomItem:hover {
        color: yellow !important;
    }

    .activeBottom {
        color: yellow !important;
    }


    /* axit css */

    .ax-bg-black {
        background: black;
    }

    .ax-container-xxl {
        background: #FCDB45;
        padding: 2% 3%;
    }

    .ax-line-throw {
        text-decoration: line-through;
    }

    .text-black {
        color: black;
    }

    html {
        height: 100% !important;
    }
</style>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper" style="height: 100%;">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion text-uppercase" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
                <div class="sidebar-brand-icon">

                </div>
                <div class="sidebar-brand-text mx-3"> <img src="{{ asset('img/quiz_logo.jpeg') }}" height='150' />
                </div>
            </a>


            <!-- Nav Item - Dashboard -->
            @if(Auth::user()->userRole->role_name == "admin")
                <li
                    class="nav-item  {{ Request::routeIs('admin.dashboard') ? 'active' : '' }} d-flex align-items-center justify-content-center mt-5">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <svg class='icon-ax pr-2' width="28" height="28" viewBox="0 0 18 18" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_1208_259)">
                                <path
                                    d="M17.5147 7.82913C17.5143 7.82872 17.5139 7.82831 17.5135 7.8279L10.1709 0.485596C9.85791 0.172485 9.4418 0 8.99919 0C8.55658 0 8.14047 0.172348 7.82736 0.485458L0.488635 7.82405C0.486163 7.82652 0.483692 7.82913 0.48122 7.8316C-0.161481 8.47801 -0.160382 9.52679 0.484378 10.1716C0.778949 10.4663 1.168 10.637 1.58397 10.6548C1.60086 10.6565 1.61789 10.6573 1.63506 10.6573H1.92771V16.0608C1.92771 17.13 2.79769 18 3.86721 18H6.73986C7.03099 18 7.2672 17.7639 7.2672 17.4727V13.2363C7.2672 12.7484 7.66408 12.3515 8.15201 12.3515H9.84638C10.3343 12.3515 10.7312 12.7484 10.7312 13.2363V17.4727C10.7312 17.7639 10.9673 18 11.2585 18H14.1312C15.2007 18 16.0707 17.13 16.0707 16.0608V10.6573H16.342C16.7845 10.6573 17.2006 10.4849 17.5139 10.1718C18.1593 9.52597 18.1596 8.4754 17.5147 7.82913Z"
                                    fill="currentColor" />
                            </g>
                            <defs>
                                <clipPath id="clip0_1208_259">
                                    <rect width="18" height="18" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                        <span class="ml-2">Dashboard</span></a>
                </li>

                <li
                    class="nav-item  {{ Request::routeIs('admin.users') ? 'active' : '' }} d-flex align-items-center justify-content-center mt-2">
                    <a class="nav-link" href="{{ route('admin.users') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                            <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                        </svg>
                        <span class="ml-2">Users</span></a>
                </li>
                <li
                    class="nav-item  {{ Request::routeIs('questions.index') ? 'active' : '' }} d-flex align-items-center justify-content-center mt-2">
                    <a class="nav-link" href="{{ route('questions.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-patch-question-fill" viewBox="0 0 16 16">
                            <path d="M5.933.87a2.89 2.89 0 0 1 4.134 0l.622.638.89-.011a2.89 2.89 0 0 1 2.924 2.924l-.01.89.636.622a2.89 2.89 0 0 1 0 4.134l-.637.622.011.89a2.89 2.89 0 0 1-2.924 2.924l-.89-.01-.622.636a2.89 2.89 0 0 1-4.134 0l-.622-.637-.89.011a2.89 2.89 0 0 1-2.924-2.924l.01-.89-.636-.622a2.89 2.89 0 0 1 0-4.134l.637-.622-.011-.89a2.89 2.89 0 0 1 2.924-2.924l.89.01zM7.002 11a1 1 0 1 0 2 0 1 1 0 0 0-2 0m1.602-2.027c.04-.534.198-.815.846-1.26.674-.475 1.05-1.09 1.05-1.986 0-1.325-.92-2.227-2.262-2.227-1.02 0-1.792.492-2.1 1.29A1.7 1.7 0 0 0 6 5.48c0 .393.203.64.545.64.272 0 .455-.147.564-.51.158-.592.525-.915 1.074-.915.61 0 1.03.446 1.03 1.084 0 .563-.208.885-.822 1.325-.619.433-.926.914-.926 1.64v.111c0 .428.208.745.585.745.336 0 .504-.24.554-.627"/>
                        </svg>
                        <span class="ml-2">Question</span></a>
                </li>
            @else
                <li
                    class="nav-item  {{ Request::routeIs('dashboard.view') ? 'active' : '' }} d-flex align-items-center justify-content-center mt-5">
                    <a class="nav-link" href="{{ route('dashboard.view') }}">
                        <svg class='icon-ax pr-2' width="28" height="28" viewBox="0 0 18 18" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_1208_259)">
                                <path
                                    d="M17.5147 7.82913C17.5143 7.82872 17.5139 7.82831 17.5135 7.8279L10.1709 0.485596C9.85791 0.172485 9.4418 0 8.99919 0C8.55658 0 8.14047 0.172348 7.82736 0.485458L0.488635 7.82405C0.486163 7.82652 0.483692 7.82913 0.48122 7.8316C-0.161481 8.47801 -0.160382 9.52679 0.484378 10.1716C0.778949 10.4663 1.168 10.637 1.58397 10.6548C1.60086 10.6565 1.61789 10.6573 1.63506 10.6573H1.92771V16.0608C1.92771 17.13 2.79769 18 3.86721 18H6.73986C7.03099 18 7.2672 17.7639 7.2672 17.4727V13.2363C7.2672 12.7484 7.66408 12.3515 8.15201 12.3515H9.84638C10.3343 12.3515 10.7312 12.7484 10.7312 13.2363V17.4727C10.7312 17.7639 10.9673 18 11.2585 18H14.1312C15.2007 18 16.0707 17.13 16.0707 16.0608V10.6573H16.342C16.7845 10.6573 17.2006 10.4849 17.5139 10.1718C18.1593 9.52597 18.1596 8.4754 17.5147 7.82913Z"
                                    fill="currentColor" />
                            </g>
                            <defs>
                                <clipPath id="clip0_1208_259">
                                    <rect width="18" height="18" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                        <span class="ml-2">Dashboard</span></a>
                </li>
                <li
                    class="nav-item  {{ Request::routeIs('users.question') ? 'active' : '' }} d-flex align-items-center justify-content-center mt-2">
                    <a class="nav-link" href="{{ route('users.question') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-patch-question-fill" viewBox="0 0 16 16">
                            <path d="M5.933.87a2.89 2.89 0 0 1 4.134 0l.622.638.89-.011a2.89 2.89 0 0 1 2.924 2.924l-.01.89.636.622a2.89 2.89 0 0 1 0 4.134l-.637.622.011.89a2.89 2.89 0 0 1-2.924 2.924l-.89-.01-.622.636a2.89 2.89 0 0 1-4.134 0l-.622-.637-.89.011a2.89 2.89 0 0 1-2.924-2.924l.01-.89-.636-.622a2.89 2.89 0 0 1 0-4.134l.637-.622-.011-.89a2.89 2.89 0 0 1 2.924-2.924l.89.01zM7.002 11a1 1 0 1 0 2 0 1 1 0 0 0-2 0m1.602-2.027c.04-.534.198-.815.846-1.26.674-.475 1.05-1.09 1.05-1.986 0-1.325-.92-2.227-2.262-2.227-1.02 0-1.792.492-2.1 1.29A1.7 1.7 0 0 0 6 5.48c0 .393.203.64.545.64.272 0 .455-.147.564-.51.158-.592.525-.915 1.074-.915.61 0 1.03.446 1.03 1.084 0 .563-.208.885-.822 1.325-.619.433-.926.914-.926 1.64v.111c0 .428.208.745.585.745.336 0 .504-.24.554-.627"/>
                        </svg>
                        <span class="ml-2">Question</span></a>
                </li>

            @endif
            <li class="nav-item  d-flex align-items-center justify-content-center mt-2">
                <a class="nav-link" href="{{ route('users.logout') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-arrow-right-square-fill" viewBox="0 0 16 16">
                        <path d="M0 14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2zm4.5-6.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5a.5.5 0 0 1 0-1"/>
                    </svg>


                    <span class="ml-2">Logout</span><br>
                    <p class="mb-0 ml-4">
                        <small class="text-capitalize">Logout from your account</small>
                    </p>
                </a>
            </li>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-1 pt-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>



                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto d-none">


                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="javascript:void(0);" id="viewNotificationModel"
                                role="button">
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-arrow-right-square-fill" viewBox="0 0 16 16">
                                    <path d="M0 14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2zm4.5-6.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5a.5.5 0 0 1 0-1"/>
                                </svg>
                                <svg fill="none" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M17 16L21 12M21 12L17 8M21 12L7 12M13 16V17C13 18.6569 11.6569 20 10 20H6C4.34315 20 3 18.6569 3 17V7C3 5.34315 4.34315 4 6 4H10C11.6569 4 13 5.34315 13 7V8" stroke="#374151" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"/></svg>
                            </a>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->


                <div class="container-fluid ax-call" style="margin-bottom:100px;">
                    @if ($errors->has('message'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ $errors->first('message') }}
                        </div>
                    @endif
                    @if (session('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            {{ session('message') }}
                        </div>
                    @endif

                    @yield('content')
                </div>



                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->



        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>




    <div class="bottom-menu">
        <!-- Nav Item - Dashboard -->
        <a class="nav-link d-flex flex-column align-items-center bottomItem {{ Request::routeIs('admin.dashboard') ? 'activeBottom' : '' }}"
            href="{{ route('admin.dashboard') }}">
            <svg class='icon-ax pr-2' width="28" height="28" viewBox="0 0 18 18" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <g clip-path="url(#clip0_1208_259)">
                    <path
                        d="M17.5147 7.82913C17.5143 7.82872 17.5139 7.82831 17.5135 7.8279L10.1709 0.485596C9.85791 0.172485 9.4418 0 8.99919 0C8.55658 0 8.14047 0.172348 7.82736 0.485458L0.488635 7.82405C0.486163 7.82652 0.483692 7.82913 0.48122 7.8316C-0.161481 8.47801 -0.160382 9.52679 0.484378 10.1716C0.778949 10.4663 1.168 10.637 1.58397 10.6548C1.60086 10.6565 1.61789 10.6573 1.63506 10.6573H1.92771V16.0608C1.92771 17.13 2.79769 18 3.86721 18H6.73986C7.03099 18 7.2672 17.7639 7.2672 17.4727V13.2363C7.2672 12.7484 7.66408 12.3515 8.15201 12.3515H9.84638C10.3343 12.3515 10.7312 12.7484 10.7312 13.2363V17.4727C10.7312 17.7639 10.9673 18 11.2585 18H14.1312C15.2007 18 16.0707 17.13 16.0707 16.0608V10.6573H16.342C16.7845 10.6573 17.2006 10.4849 17.5139 10.1718C18.1593 9.52597 18.1596 8.4754 17.5147 7.82913Z"
                        fill="currentColor" />
                </g>
                <defs>
                    <clipPath id="clip0_1208_259">
                        <rect width="18" height="18" fill="white" />
                    </clipPath>
                </defs>
            </svg>
            <span>Home</span>

        </a>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('ax-theme/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('ax-theme/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('ax-theme/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('ax-theme/js/sb-admin-2.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('.alert').hide();
            }, 5000);

        });
    </script>
    @stack('scripts')
</body>

</html>
