<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GROUP 3 | @yield('title')</title>

    {{-- BOOTSTRAP --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    {{-- FONT Aws --}}
    <script src="https://kit.fontawesome.com/68704db06c.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="{{URL::asset('css/layoutadmin.css')}}">

</head>
<body>

    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto w-30 custom-bg-sidebar">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                    <a href="#" class="d-flex align-items-center text-white py-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <i class="fa-brands fa-trello">&nbsp;&nbsp;</i>
                        <span class="fs-5 d-none d-sm-inline">ADMIN DASHBOARD</span>
                    </a>
                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                        <li class="nav-item">
                            <a href="{{route('admin.dashboard')}}" class="custom-menu-sidebar text-white nav-link align-middle px-0">
                                <i class="fa-solid fa-house"></i>
                                <span class="ms-1 d-none d-sm-inline">&nbsp;Main Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.addMember')}}" class="custom-menu-sidebar text-white nav-link align-middle px-0">
                                <i class="fa-solid fa-user-plus"></i>
                                <span class="ms-1 d-none d-sm-inline">Add Member</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('/')}}" class="custom-menu-sidebar text-white nav-link align-middle px-0">
                                <i class="fa-solid fa-backward"></i>
                                <span class="ms-1 d-none d-sm-inline">Back to Home</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.logout')}}" id="logout_btn" class="custom-menu-sidebar text-white nav-link align-middle px-0">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                <span class="ms-1 d-none d-sm-inline">Log Out</span>
                            </a>
                        </li>
                    </ul>
                    <hr>
                </div>
            </div>
            <div class="col py-3">
                <div class="header_title">
                    <h1>@yield('h_title')</h1>
                    @yield('error_msg')
                </div>
                <div class="msg">
                    @if(session()->has('msg'))
                    <script>
                        alert({{Js::from(session('msg'))}});
                    </script>
                    @endif
                </div>
                <div class="dashboard-content">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{URL::asset('js/adminpage.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/logout.js')}}"></script>
</body>
</html>