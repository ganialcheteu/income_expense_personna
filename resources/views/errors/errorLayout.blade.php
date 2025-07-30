<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title') </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('/assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/vendors/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/vendors/typicons/typicons.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('/assets/css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('/assets/images/logo-codec-mini.png') }}" />
    <style>

        .container-fluid{
            background-color: #1b3bb3;
        }
        .animated .digit {
            display: inline-block;
            animation: bounce 1s infinite alternate, colorchange 2s infinite alternate;
            font-size: 7rem;
            font-weight: bold;
            transition: color 0.3s;
        }

        .animated .digit:nth-child(1) {
            animation-delay: 0s, 0s;
        }

         .animated .digit:nth-child(2) {
            animation-delay: 0.2s, 0.2s;
        }

        .animated .digit:nth-child(3) {
            animation-delay: 0.4s, 0.4s;
        }

        @keyframes bounce {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-30px);
            }

            100% {
                transform: translateY(0);
            }
        }

        @keyframes colorchange {
            0% {
                color: #1b20f9;
            }

            50% {
                color: #4a4eff;
            }

            100% {
                color: #2456ee;
            }
        }

        .login {
            background: linear-gradient(75deg, #1b20f9, #4a4eff, #2456ee);
            border-radius: 24px;
            padding: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0.1);
            border: 1px solid #4a4eff;
            width: 120px;
            margin: 0 auto;
            transition: font-size 0.3s ease-in;

            a {
                text-decoration: none;
                color: #fff;
                font-weight: bold;
                font-size: 1.05em;
            }
        }

        .login:hover {
            background: linear-gradient(75deg, #4a4eff, #2456ee, #4a4eff, #2456ee);
            font-size: 1.05em;
        }

        .verify_email{
            display:flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
            h4{
                font-size: 1.1em;
                margin-bottom: 1em;
            }
        }
        .logoVerify {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            padding: 10px;
            border-right: 1px solid #4a4eff;
        }

        .verify_email_control {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
        }

        @media(max-width: 575px) {
            .verify_email_control {
                flex-direction: column;
                padding: 5px;

            }

            .logoVerify {
                width: 100px;
                height: 100px;
            }
        }
    </style>
</head>

<body>

    @yield('content')

    <!-- container-scroller -->

    <!-- plugins:js -->
    <script defer src="{{ asset('/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script defer src="{{ asset('/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script defer src="{{ asset('/assets/js/off-canvas.js') }}"></script>
    <script defer src="{{ asset('/assets/js/template.js') }}"></script>
    <script defer src="{{ asset('/assets/js/settings.js') }}"></script>
    <script defer src="{{ asset('/assets/js/hoverable-collapse.js') }}"></script>
    <script defer src="{{ asset('/assets/js/todolist.js') }}"></script>
    <!-- endinject -->
</body>

</html>
