<!doctype html>
<html lang="zh_CN" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.display_name') }}</title>

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    {{-- <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
<div id="app">
    <nav class="navbar navbar-expand-md shadow-sm bg-body">
        <div class="container">
            <a class="navbar-brand text-auto" href="{{ route('earnings') }}">
                {{ config('app.display_name') }}
            </a>
            <button class="navbar-toggler text-auto" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                @auth
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link text-auto" href="{{ route('earnings') }}">首页</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-auto" href="{{ route('users.index') }}">客户</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-auto" href="{{ route('servers.index') }}">NAT 网关</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-auto" href="{{ route('regions.index') }}">可用区</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-auto" href="{{ route('pools.index') }}">地址池</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-auto" href="{{ route('ips.index') }}">IP 地址</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-auto" href="{{ route('work-orders.index') }}">工单</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-auto" href="{{ route('admins.index') }}">管理员</a>
                        </li>
                    </ul>
                @endauth

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">登录</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    退出登录
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        <x-alert/>

        <div class="container">
            {{ $slot }}
        </div>
    </main>

</div>
</body>

</html>
