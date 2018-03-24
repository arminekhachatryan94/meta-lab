<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MetaBlog</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <style>
        /* navbar */
        li {
            padding-left: 10px;
        }
        .meta-navbar {
            background-color: white;
            font-family: arial;
            font-size: 20px;
            vertical-align: middle;
            padding: 5px;
            border-bottom: 1px solid black;
            position: fixed;
            width: 100%;
            z-index:1;
        }

        /* login & register */


        /* other */
        .float-left {
            float: left;
        }
        .float-right {
            float: right;
        }
        .inline {
            display: inline;
        }
        #main-padding {
            padding: 100px;
        }
        .text-black {
            color: black;
        }
        .bg-white {
            background-color: white;
        }
        .btn-white {
            background-color: white;
            color: black;
            border: 1px solid black;
        }
        .text-grey {
            color: grey;
        }
        .cursive {
            font-family: cursive;
        }
    </style>
</head>

<body class="bg-white">
    <header>
        @include ('layouts.nav')
    </header>
    <main id="main-padding">
        @yield('content')
    </main>
</body>
</html>
