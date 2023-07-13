<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.css')}}">

    <title>Trang Chủ</title>
</head>
<body>

                @if(session('msg'))
                    <div class="alert alert-primary">
                    {{session('msg')}}
                    </div>
                @endif


        <div class="container">
            <header>
                <nav>
                    <ul>
                        <li>
                            <a>Trang Chủ</a>
                        </li>
                    </ul>
                </nav>
            </header>
            <div class="content">
                @yield('content')
            </div>

            <footer>
                <div class="text-center">
                    Nguyễn Văn Quang
                </div>
            </footer>
        </div>

</body>
<script src="{{asset('bootstrap/js/bootstrap.js')}}"></script>
</html>
