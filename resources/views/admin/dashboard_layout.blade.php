@php
    //name for dashboard
    $fullName = explode(' ', Auth::user()->name);
    $profilName = $fullName[0] . ' ' . $fullName[1];
    $firstName = $fullName[0];
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Income | Expense">
    <title>Dasborard Income | Expense </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <!-- owl carousel -->
    <link rel="stylesheet" href="{{ asset('assets/owl-carousel/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/owl-carousel/owl.transitions.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/owl-carousel/owl.theme.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/js/select.dataTables.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('assets/images/logo-codec-mini.png') }}" />

    <style>
        .leaderboard {
            font-family: 'Segoe UI', sans-serif;
            max-width: 600px;
            min-width: 340px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .leaderboard-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 1.2em;
            border-radius: 24px;
            cursor: pointer;

        }

        .leaderboard-header .mdi {
            font-size: 40px;
            margin-bottom: 15px;
            color: #FFD700;
            border: 2px solid #FFD700;
            border-radius: 50%;
        }

        .leaderboard-header h2 {
            margin: 0;
            font-weight: 700;
            font-size: 24px;
        }

        .leaderboard-header p {
            margin: 5px 0 0;
            opacity: 0.9;
            font-size: 14px;
        }

        .header-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(255, 255, 255, 0.2);
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badgeTop {
            background: rgba(255, 255, 255, 0.2);
        }

        .leaderboard-list {
            padding: 0;
        }

        .leaderboard-item {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            border-bottom: 1px solid #f0f0f0;
            transition: all 0.3s ease;
            transition: background 0.4s, box-shadow 0.3s, transform 0.2s;
            cursor: pointer;
            position: relative;
            overflow: hidden;

            img,
            .badge span {
                width: 50px;
                height: 50px;
            }
        }

        .bubbles {
            position: absolute;
            top: -1%;
            left: -1%;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 0;
            pointer-events: none;

            span {
                position: absolute;
                display: block;
                border-radius: 50%;
                filter: blur(2px);
                opacity: 0.6;
                transition: transform 3s ease-in-out;
            }
        }

        .top-1:hover {

            background: linear-gradient(90deg, #ffe0b2 0%, #f7b733 100%);
            box-shadow: 0 4px 24px 0 rgba(255, 226, 89, 0.25);
            transform: translateZ(20px) scale(1.03);
            perspective: 1000px;
        }

        .top-2:hover {
            background: linear-gradient(90deg, #c7c7c7 0%, #989897 100%);
            box-shadow: 0 4px 24px 0 rgba(207, 222, 243, 0.25);
            transform: translateZ(20px) scale(1.03);
            perspective: 1000px;
        }

        .top-3:hover {
            background: linear-gradient(90deg, #cda35099 0%, rgb(151, 119, 55) 100%);
            box-shadow: 0 4px 24px 0 rgba(247, 183, 51, 0.25);
            transform: translateZ(20px) scale(1.03);
            perspective: 1000px;
        }

        .leaderboard-item {
            transition: background 0.3s ease-in;
        }

        .leaderboard-item:hover:not(.top-1):not(.top-2):not(.top-3) {
            background: linear-gradient(90deg, #ffffff99 0%, rgb(233, 233, 233) 100%);
        }

        @media(min-width: 992px) {
            .leaderboard-item {
                height: 75px
            }

        }

        .leaderboard-item:hover {
            transform: translateY(-2px);
        }

        .leaderboard-item::after {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: transparent;
            transition: all 0.3s ease;
        }

        .leaderboard-item:hover::after {
            background: #667eea;
        }

        .avatar-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 18px;
        }

        .customer-info {
            flex: 1;
        }

        .customer-info h3 {
            margin: 0;
            font-size: 16px;
            font-weight: 600;
            color: #333;
        }

        .customer-meta {
            margin-top: 5px;
            display: flex;
            flex-direction: column;
            flex-wrap: wrap;
            gap: 10px;
        }

        .customer-meta span {
            font-size: 12px;
            color: #777;
        }

        .customer-meta span {
            margin-right: 5px;
            font-size: 10px;
        }

        .amount-info {
            text-align: right;
            margin-left: 15px;
        }

        .amount {
            font-weight: 700;
            font-size: 16px;
            color: #2c3e50;
        }

        .vip-badge {
            width: 100px;
            margin-top: 5px;
            font-size: 10px;
            padding: 5px 8px;
            border-radius: 10px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .top-1 .vip-badge {
            background: linear-gradient(to right, #FFD700, #FFA500);
            color: #000;
            animation: pulse 2s infinite;
        }

        .top-2 .vip-badge {
            background: linear-gradient(to right, #C0C0C0, #A9A9A9);
            color: #000;
        }

        .top-3 .vip-badge {
            background: linear-gradient(to right, #CD7F32, #A67C52);
            color: #fff;
        }

        .performance-indicator {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: #f0f0f0;
        }

        .leaderboard-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background: #f9f9f9;
            border-top: 1px solid #eee;
        }

        .last-update {
            font-size: 12px;
            color: #777;
        }

        .actions {
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            align-items: center;
            gap: 1em;

            button {
                border: none;
                background: #f0f0f0;
                padding: 8px 15px;
                border-radius: 20px;
                font-size: 12px;
                font-weight: 600;
                margin-left: 10px;
                cursor: pointer;
                transition: all 0.3s ease;
            }
        }

        .actions button:hover {
            transform: scale(1.05);
            color: #1b3bb3;
            background: #e0e0e0;
        }

        .actions button i {
            margin-right: 5px;
        }

        .refresh-btn,
        .export-btn {
            color: #667eea;
            transition: scale 0.3s ease-in;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        /* Responsive */
        @media (max-width: 600px) {
            .leaderboard {
                margin: 10px auto;

                .leaderboard-item {
                    flex-wrap: wrap;
                    padding: 15px;
                }

                .amount-info {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    width: 100%;
                    text-align: center;
                    margin: 10px 0 0 65px;
                }

                .customer-meta {
                    display: none;
                }

                .actions {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    gap: 0.5em;
                }
            }
        }

        .chartsTables {
            display: grid;
            grid-template-columns: 3fr 1fr;
            grid-template-rows: 1fr;
            gap: 10px 15px;
            padding: 10px;

            @media (max-width: 767px) {
                grid-template-columns: 1fr;
                grid-template-rows: 1fr;

            }

            .charts {
                display: flex;
                flex-direction: column;
                gap: 10px;
                flex-shrink: 0;
                width: 100%;

                div {
                    background-color: #fff;
                    border: 1px solid #fff;
                    border-radius: 24px;
                    padding: 10px;
                    overflow-x: hidden;
                }
            }

            @media(max-width: 767px) {

                .charts div:last-child canvas,
                .charts div:nth-child(2) canvas {
                    width: 100%;
                }
            }

            .charts div:last-child {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                grid-template-rows: 1fr;
                gap: 10px;

                @media(max-width: 767px) {
                    grid-template-columns: 1fr;
                    grid-template-rows: 300px
                }
            }
        }

        .tables {
            display: flex;
            flex-direction: column;
            gap: 10px;

            .leaderboard {
                width: 100%;
            }
        }

        .activeAdminsHeader {
            cursor: pointer;

            div:last-child {
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                align-items: flex-end;
                gap: 12px;

                span {
                    width: 100px;
                }
            }
        }

        @media(max-width:576px) {
            .activeAdminsHeader {
                flex-direction: column;
                gap: 16px;

                div {
                    align-self: flex-start;
                }

                div:last-child {
                    align-self: center;
                    flex-direction: row;
                    justify-content: space-between;
                }
            }
        }
    </style>

</head>

<body class="with-welcome-text">
    <!-- container-scroller start-->

    <div class="container-scroller">

        <!-- --------------------------------------------------------------------------- NAVBAR START
        --------------------------------------------------------------------------- -->
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                <div class="me-3">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-bs-toggle="minimize">
                        <span class="icon-menu"></span>
                    </button>
                </div>
                <div>
                    <a class="navbar-brand brand-logo" href="{{ route('dashboard') }}">
                        <img src="{{ asset('assets/images/codec_logo.png') }}" alt="logo" />
                    </a>
                    <a class="navbar-brand brand-logo-mini" href="{{ route('dashboard') }}">
                        <img src="{{ asset('assets/images/codec_logo.png') }}" alt="logo" />
                    </a>
                    <span id="activePoint"></span>
                </div>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-top">
                <ul class="navbar-nav">
                    <li class="nav-item fw-semibold d-none d-lg-block ms-0">
                        <h1 class="welcome-text">
                            <?php
$currentHour = date('H');
if ($currentHour < 12) {
    $greeting = 'Good Morning,';
} elseif ($currentHour < 18) {
    $greeting = 'Good Afternoon,';
} else {
    $greeting = 'Good Evening,';
}
echo htmlspecialchars($greeting, ENT_QUOTES, 'UTF-8');
                            ?>
                            <span class="text-black fw-bold text-capitalize">
                                {{ $firstName}}
                            </span>
                        </h1>
                        <h3 class="welcome-sub-text">Ressources Mastered,Startup Boosted. </h3>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item d-none d-lg-block">
                        <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
                            <span class="input-group-addon input-group-prepend border-right">
                                <span class="icon-calendar input-group-text calendar-icon"></span>
                            </span>
                            <input type="text" class="form-control">
                        </div>
                    </li>

                    <li class="nav-item dropdown  d-lg-block user-dropdown">
                        <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                            {{-- active point --}}
                            <x-active-user-circle active src width='45px' height='45px' />

                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                            <div class="dropdown-header text-center">
                                <div>
                                    {{-- active point --}}
                                    <x-active-user-circle active src width='45px' height='45px' />
                                </div>
                                <p class="mb-1 mt-1 fw-semibold text-capitalize">
                                    {{ $profilName}}
                                </p>
                                <p class="mb-1 mt-1 fw-semibold text-uppercase">{{ Auth::user()->role }}</p>
                                <p class="profileEmail fw-light text-muted mb-0">{{ Auth::user()->email }}</p>
                            </div>

                            <a href="{{ route('profile.edit') }}" class="dropdown-item"><i
                                    class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My
                                Profile</a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Log Out
                                </button>
                            </form>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-bs-toggle="offcanvas">
                    <span class="mdi mdi-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <!-- --------------------------------------------------------------------------- NAVBAR END
        --------------------------------------------------------------------------- -->

        <!-- --------------------------------------------------------------------------- WRAPPER START
        --------------------------------------------------------------------------- -->




        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            {{-- --------------------------------------------------------------------------- SIDEBAR START
            --------------------------------------------------------------------------- --}}

            <nav class="sidebar sidebar-offcanvas" id="sidebar">

                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('dashboard') }}">
                            <i class="mdi mdi-grid-large menu-icon"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item nav-category mx-auto">ADMIN -- CONTROL</li>

                    <li class="nav-item">

                        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                            aria-controls="ui-basic">
                            <i class="menu-icon mdi mdi-floor-plan"></i>
                            <span class="menu-title">Incomes</span>
                            <i class="menu-arrow"></i>
                        </a>

                        <div class="collapse" id="ui-basic">
                            <ul class="nav flex-column sub-menu">
                                {{-- class incomes recommended for active link --}}
                                <li class="nav-item"> <a class="nav-link incomes" href="{{ route('incomes') }}">Our
                                        Incomes</a>
                                </li>
                                <li class="nav-item"> <a class="nav-link "
                                        href="{{ route('incomes_categories') }}">Incomes Categories</a>
                                </li>
                                <li class="nav-item"> <a class="nav-link" href="{{ route('incomes_types') }}">Incomes
                                        Types</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false"
                            aria-controls="form-elements">
                            <i class="menu-icon mdi mdi-card-text-outline"></i>
                            <span class="menu-title">Expenses</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="form-elements">
                            <ul class="nav flex-column sub-menu">
                                {{-- class expenses recommended for active link --}}
                                <li class="nav-item"><a class="nav-link expenses" href="{{ route('expenses') }}">
                                        Our Expenses</a></li>
                                <li class="nav-item"><a class="nav-link"
                                        href="{{ route('expenses_categories') }}">Expenses Categories
                                    </a></li>
                                <li class="nav-item"><a class="nav-link" href="{{ route('expenses_types') }}">Expenses
                                        Types
                                    </a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#charts" aria-expanded="false"
                            aria-controls="charts">
                            <i class="menu-icon mdi mdi-chart-line"></i>
                            <span class="menu-title">Customers</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="charts">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{ route('customers') }}">Our
                                        Customers</a></li>
                                <li class="nav-item"> <a class="nav-link"
                                        href="{{ route('customers_types') }}">Customers Types</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#tables" aria-expanded="false"
                            aria-controls="tables">
                            <i class="menu-icon mdi mdi-table"></i>
                            <span class="menu-title">Suppliers</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="tables">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{ route('suppliers') }}">Our
                                        Suppliers
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="collapse" href="#icons" aria-expanded="false"
                            aria-controls="icons">
                            <i class="menu-icon mdi mdi-layers-outline"></i>
                            <span class="menu-title">Activities</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="collapse" id="icons">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" href="{{ route('activities') }}">
                                        Our Activities</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
            {{-- --------------------------------------------------------------------------- SIDEBAR END
            --------------------------------------------------------------------------- --}}

            <!-- partial -->

            <div class="main-panel">

                {{-- --------------------------------------------------------------------------- CONTENT START
                --------------------------------------------------------------------------- --}}


                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-sm-12">
                            @yield('dashboard_body_content')
                        </div>
                    </div>
                </div>


                {{-- --------------------------------------------------------------------------- CONTENT END
                --------------------------------------------------------------------------- --}}

                <!-- content-wrapper ends -->

                {{-- --------------------------------------------------------------------------- FOOTER START
                --------------------------------------------------------------------------- --}}

                <!-- partial:partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Copyright © 2025. All
                            rights reserved.</span>
                        <span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center text-info">Income |
                            Expense</span>
                    </div>
                </footer>
                {{-- --------------------------------------------------------------------------- FOOTER END
                --------------------------------------------------------------------------- --}}

                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>



        <!-- page-body-wrapper ends -->
        <!-- --------------------------------------------------------------------------- WRAPPER END
        --------------------------------------------------------------------------- -->

    </div>
    <!-- container-scroller end-->

    <!-- Plugin js for this page -->
    <!-- initialize plugin -->
    <!-- jquery -->
    <script src="{{ asset('assets/assets/js/jquery-1.9.1.min.js') }}"></script>
    <!-- jquery end-->
    <!-- plugins:js -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- endinject -->
    <!-- Owl carousel -->
    <script src="{{ asset('assets/owl-carousel/owl.carousel.min.js') }}"></script>

    <script src="{{ asset('assets/vendors/chart.js/chart.umd.js') }}"></script>
    <script src="{{ asset('assets/vendors/progressbar.js/progressbar.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <!--  cdn & script chart.Js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('/js/canvas_chart.js') }}"></script>
    <!-- sdn & script chart.Js end -->

    <script src="{{ asset('assets/js/Chart.roundedBarCharts.js') }}"></script>
    <!-- End custom js for this page-->

    <script type="text/javascript">
        $(document).ready(function () {
            // Initialize the carousel
            $("#owl").owlCarousel({
                navigation: false,
                slideSpeed: 300,
                paginationSpeed: 400,
                autoPlay: true,
                paginationSpeed: 200,
                items: 1,
                itemsDesktop: true,
                itemsDesktopSmall: true,
                itemsTablet: true,
                itemsMobile: true
            });
            //  Owl carousel End
        });

        //  show activity/income/expense modal image start
        let buttons = document.querySelectorAll('.btn-info');
        buttons.forEach(button => {
            button.addEventListener('click', function () {
                let currentImage = button.previousElementSibling;
                let currentPath = currentImage.src;
                let imageSrcModal = document.getElementById('modal-image');
                imageSrcModal.src = currentPath;
            });
        });
        // show activity/income/expense modal image end


        // SIBEBAR LINK ACTIVE  CLASS MANAGER
        document.addEventListener("DOMContentLoaded", function () {
            const currentPath = window.location.pathname;

            // Most specific link before for active class
            const sectionPrefixes = [{
                key: 'incomes_categories',
                selector: '.sidebar .nav-link[href*="incomes_categories"]'
            },
            {
                key: 'incomes_types',
                selector: '.sidebar .nav-link[href*="incomes_types"]'
            },
            {
                key: 'incomes',
                selector: '.sidebar .nav-link.incomes'
            },
            {
                key: 'expenses_categories',
                selector: '.sidebar .nav-link[href*="expenses_categories"]'
            },
            {
                key: 'expenses_types',
                selector: '.sidebar .nav-link[href*="expenses_types"]'
            },
            {
                key: 'expenses',
                selector: '.sidebar .nav-link.expenses'
            },
            {
                key: 'customers',
                selector: '.sidebar .nav-link[href*="customers"]'
            },
            {
                key: 'customers_types',
                selector: '.sidebar .nav-link[href*="customers_types"]'
            },
            {
                key: 'suppliers',
                selector: '.sidebar .nav-link[href*="suppliers"]'
            },
            {
                key: 'activities',
                selector: '.sidebar .nav-link[href*="activities"]'
            },
            ];



            for (let {
                key,
                selector
            }
                of sectionPrefixes) {
                // strict detection: /incomes_categories ou /incomes_categories/edit, etc.
                const regex = new RegExp(`^\/${key}(\/.*)?$`);

                if (regex.test(currentPath)) {
                    const targetLink = document.querySelector(selector);
                    if (targetLink) {
                        targetLink.classList.add("active");

                        const collapse = targetLink.closest(".collapse");
                        if (collapse) {
                            collapse.classList.add("show");
                        }

                        const navItem = targetLink.closest(".nav-item");
                        if (navItem) {
                            navItem.classList.add("active");
                        }
                    }
                    break; // first match ? 'go out' : '';
                }
            }

        });

        //bubble effect on leaderboard header
        document.addEventListener('DOMContentLoaded', () => {
            const containers = document.querySelectorAll('.bubbles');
            containers.forEach((container) => {
                const spans = container.querySelectorAll('span');
                spans.forEach((span) => {
                    const size = Math.floor(Math.random() * 20) + 10;
                    span.style.width = `${size}px`;
                    span.style.height = `${size}px`;
                    span.style.backgroundColor =
                        `rgba(255, 255, 255, ${Math.random() * 0.5 + 0.3})`;
                    const moveBubble = () => {
                        const maxX = container.offsetWidth - size;
                        const maxY = container.offsetHeight - size;
                        const x = Math.random() * maxX;
                        const y = Math.random() * maxY;
                        const speed = Math.random() * 13000 + 2000;

                        span.style.transitionDuration = `${speed}ms`;
                        span.style.transform = `translate(${x}px, ${y}px)`;


                        setTimeout(moveBubble, speed);
                    };

                    moveBubble();
                });
            });
        });
    </script>
</body>

</html>
