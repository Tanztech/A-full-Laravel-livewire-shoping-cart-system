
<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
<!-- BEGIN: Head -->
<head>
    <meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    {{--    <link rel="stylesheet" href="{{ asset('resources/css/app.css')}}">--}}
    {{--    <link rel="stylesheet" href="{{ asset('resources/sass/app.scss')}}">--}}
    <!-- Scripts -->
    @vite(['resources/sass/app.scss','resources/css/app.css', 'resources/js/app.js'])
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
        }

        .bg {
            background-image: url("https://img.freepik.com/free-vector/white-background-with-blue-tech-hexagon_1017-19366.jpg?w=740&t=st=1683885049~exp=1683885649~hmac=3b6e3994f9a903be58b847dbc651184d7eb6e8d4b0c91306d071d7debb3519e6");
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        div>#overlay-header {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .center {
            min-height: 100%;
            /* Fallback for browsers do NOT support vh unit */
            min-height: 100vh;
            /* These two lines are counted as one :-)       */
            margin: 0;
            display: flex;
            align-items: center;
        }

        .spinner-border {
            width: 3rem;
            height: 3rem;
        }

        .foot-message {
            position: fixed;
            left: 50%;
            bottom: 20px;
            transform: translate(-50%, -50%);
            margin: 0 auto;
        }
    </style>
    <!-- END: CSS Assets-->
</head>
<!-- END: Head -->
<body class="p-0">
<div class="bg">
    <div id="overlay-header">
        <div class="text-center center">
            <div class="container">
                <div class="row spinner-border text-light" role="status">
                    <span class="sr-only"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="foot-message">
        <p class="text-white" style="font-size: 22px">You are being redirected to a secure page</p>
    </div>
</div>
    @if (Route::has('login'))
        @auth()
            <script>
                setTimeout(function() {
                    window.location.href = "{{ route('login') }}";
                }, 5000);
            </script>
        @else
            <script>
                setTimeout(function() {
                    window.location.href = "{{ route('register') }}";
                }, 5000);
            </script>
        @endauth
    @endif
<script>
    setTimeout(function() {
        window.location.href = "{{ route('home') }}";
    }, 5000);
</script>

</body>
</html>
