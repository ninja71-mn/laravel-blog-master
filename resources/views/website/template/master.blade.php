<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @php($detail=getSiteDetails())
    @php($categories=getCategories())
    <link rel="icon" href="@if(isset($detail->logo))storage/logo/{{$detail->logo}}@endif" type="image/x-icon">
    <link rel="shortcut icon" href="@if(isset($detail->logo))storage/logo/{{$detail->logo}}@endif" type="image/x-icon">
    <title>@if(isset($detail->site_name)){{$detail->site_name}}@else Site Title @endif | @yield('title')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="loading">
    <div class="loader"></div>
</div>

<div id="lang-switcher" class="d-none d-lg-block">
    <i class="fas fa-language float-right fa-lg pt-1"></i>
    <div class="content-switcher float-left">
        <ul class=" px-0 mx-0 mb-0 list-unstyled">
            <li class=" text-center">
                <a href="{{route('lang',"fa")}}"
                   class="{{(Session::get('local')=='fa'?'font-weight-bold':null)}}">FA</a>
            </li>
            <li class=" text-center">
                <a href="{{route('lang',"en")}}"
                   class="{{(Session::get('local')=='en'?'font-weight-bold':null)}}">ENG</a>
            </li>
        </ul>
    </div>
</div>
<div id="lang-switch" class="" style="margin-left: 0px; display: block;">

</div>

<div id="mode-switcher" class="d-none d-lg-block">
    <i class="fa fa-cog fa-spin"></i>
</div>

<div id="mode-switch" class="" style="margin-left: 0px; display: block;">
    <div class="content-switcher">
        <div class="mode-switch-content">
            <ul class="row px-0 mx-0">
                <li class="col-6 text-center mode" data-color="#fff">
                    <i class="fas fa-sun"></i>
                </li>
                <li class="col-6 text-center mode" data-color="#111">
                    <i class="fas fa-moon"></i>
                </li>
            </ul>
        </div>
        <ul>
            <li class="colors purple" data-color="#6957af">
                <i class="fas fa-tint"></i>
            </li>
            <li class="colors red" data-color="#f72b1c">
                <i class="fas fa-tint"></i>
            </li>
            <li class="colors blueviolet" data-color="#8a2be2">
                <i class="fas fa-tint"></i>
            </li>
            <li class="colors blue" data-color="#4169e1">
                <i class="fas fa-tint"></i>
            </li>
            <li class="colors goldenrod" data-color="#daa520">
                <i class="fas fa-tint"></i>
            </li>
            <li class="colors magenta" data-color="#ee6192">
                <i class="fas fa-tint"></i>
            </li>
            <li class="colors yellowgreen" data-color="#9acd32">
                <i class="fas fa-tint"></i>
            </li>
            <li class="colors orange" data-color="#fa5b0f">
                <i class="fas fa-tint"></i>
            </li>
            <li class="colors green" data-color="#72b626">
                <i class="fas fa-tint"></i>
            </li>
            <li class="colors yellow" data-color="#ffb400">
                <i class="fas fa-tint"></i>
            </li>
        </ul>
    </div>
</div>
<header class="header" id="navbar-collapse-toggle">
    <!-- Fixed Navigation Starts -->
    <ul class="icon-menu d-none d-lg-block revealator-slideup revealator-once revealator-delay1 no-transform revealator-within">
        <li class="icon-box">
            <i class="fa fa-home"></i>
            <a href="{{route('index')}}">
                <h2 class="{{(Session::get('local')=='en'?'ltr':'rtl font-weight-bold')}}">{{__('menu.home')}}</h2>
            </a>
        </li>
        <li class="icon-box">
            <i class="fas fa-list-ul"></i>
            <a href="{{route('category.index')}}">
                <h2 class="{{(Session::get('local')=='en'?'ltr':'rtl font-weight-bold')}}">{{__('menu.categories')}}</h2>
            </a>
        </li>
        <li class="icon-box">
            <i class="fa fa-user"></i>
            <a href="{{route('about')}}">
                <h2 class="{{(Session::get('local')=='en'?'ltr':'rtl font-weight-bold')}}">{{__('menu.about')}}</h2>
            </a>
        </li>
        {{--<li class="icon-box">
            <i class="fa fa-briefcase"></i>
            <a href="portfolio.html">
                <h2>Portfolio</h2>
            </a>
        </li>--}}
        <li class="icon-box">
            <i class="fa fa-envelope-open"></i>
            <a href="{{route('contact.show')}}">
                <h2 class="{{(Session::get('local')=='en'?'ltr':'rtl font-weight-bold')}}">{{__('menu.contact')}}</h2>
            </a>
        </li>
        {{-- <li class="icon-box">
             <i class="fa fa-comments"></i>
             <a href="blog.html">
                 <h2>Blog</h2>
             </a>
         </li>--}}
        @guest
            <li class="icon-box">
                <i class="fas fa-sign-in-alt"></i>
                <a href="{{ route('login') }}">
                    <h2 class="{{(Session::get('local')=='en'?'ltr':'rtl font-weight-bold')}}">{{ __('menu.login') }}</h2>
                </a>
            </li>
            @if (Route::has('register'))
                <li class="icon-box">
                    <i class="fa fa-user-plus"></i>
                    <a href="{{ route('register') }}">
                        <h2 class="{{(Session::get('local')=='en'?'ltr':'rtl font-weight-bold')}}">{{ __('menu.register') }}</h2>
                    </a>
                </li>
            @endif
        @else
            <li class="icon-box">
                <i class="fas fa-user-cog"></i>
                <a href="{{ route('home') }}">
                    <h2 class="{{(Session::get('local')=='en'?'ltr':'rtl font-weight-bold')}}">{{ __('menu.dashboard') }}</h2>
                </a>
            </li>
            <li class="icon-box">
                <i class="fas fa-sign-out-alt"></i>
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                    <h2 class="{{(Session::get('local')=='en'?'ltr':'rtl')}}">{{__('menu.logout')}}</h2>
                </a>
                <form class="nav-link" id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>
        @endguest
    </ul>
    <!-- Fixed Navigation Ends -->
    <!-- Mobile Menu Starts -->
    <nav role="navigation" class="d-block d-lg-none">
        <div id="sidebar">
            <div class="toggle-btn" onclick="toggleSidebar()">
                <div class="menu-btn__burger"></div>
            </div>
            <div class="row mt-2" style="margin: 0 auto;padding: 5px">
                @guest
                    <div class="p-1 col-6 {{(Session::get('local')=='en'?'ltr':'rtl font-weight-bold')}}">
                        <a href="{{route('login')}}">
                            <div class="btn-success d-block pt-2 pb-2 pr-3 pl-3 rounded">
                            <i class="fa fa-sign-in-alt"></i>
                            {{ __('menu.login') }}
                            </div>
                        </a>
                    </div>
                    @if (Route::has('register'))
                        <div class="p-1 col-6 {{(Session::get('local')=='en'?'ltr':'rtl font-weight-bold')}}">
                            <a href="{{route('register')}}">
                                <div class="btn-primary d-block pt-2 pb-2 pr-3 pl-3 rounded">
                                    <i class="fa fa-user-plus"></i>
                                    {{ __('menu.register') }}
                                </div>
                            </a>
                        </div>
                    @endif
                @else
                    <div class="p-1 col-6 {{(Session::get('local')=='en'?'ltr':'rtl font-weight-bold')}}">
                        <a href="{{route('home')}}">
                            <div class="btn-success d-block pt-2 pb-2 pr-3 pl-3 rounded">
                                <i class="fas fa-user-cog"></i>
                                {{ __('menu.dashboard') }}
                            </div>
                        </a>
                    </div>
                    <div class="p-1 col-6 {{(Session::get('local')=='en'?'ltr':'rtl font-weight-bold')}}">
                        <a href="{{route('logout')}}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <div class="btn-danger d-block pt-2 pb-2 pr-3 pl-3 rounded">
                                <i class="fas fa-sign-out-alt"></i>
                                {{__('menu.logout')}}
                            </div>
                        </a>
                        <form class="nav-link" id="logout-form" action="{{ route('logout') }}" method="POST"
                              class="d-none">
                            @csrf
                        </form>
                    </div>
                @endguest
            </div>
            <ul>
                <li class="{{(Session::get('local')=='en'?'ltr':'rtl font-weight-bold')}}">
                    <a href="{{route('index')}}">
                        <i class="fa fa-home"></i> {{__('menu.home')}}
                    </a></li>
                <li class="{{(Session::get('local')=='en'?'ltr':'rtl font-weight-bold')}}">
                    <a href="{{route('about')}}">
                        <i class="fa fa-user"></i>
                        {{__('menu.about')}}
                    </a>
                </li>

                <li class="{{(Session::get('local')=='en'?'ltr':'rtl font-weight-bold')}}"><a class="category"><i
                            class="fas fa-list-ul"></i>
                        {{__('menu.categories')}}
                    </a>
                </li>
                <li class="border-bottom-0 p-0">
                    <ul class="categories h-auto" style="overflow: scroll; max-height: 200px;">
                        @foreach($categories as $category)
                            <li class="{{(Session::get('local')=='en'?'ltr':'rtl font-weight-bold')}}">
                                <a href="{{url('/category/'.$category->slug)}}">{{$category->name}}</a>

                            </li>
                        @endforeach
                    </ul>
                </li>
                <li class="{{(Session::get('local')=='en'?'ltr':'rtl font-weight-bold')}}"><a class="personalise">
                        <i class="fa fa-cog fa-spin"></i>
                        شخصی سازی
                    </a>
                </li>
                <li class="border-bottom-0 p-0">
                    <ul class="personalises h-auto">
                        <li class="row mobile-switch p-0">
                                <ul class="col-12 mode-switch-content row px-0 mx-0">
                                    <li class="col-6 text-center mode border-bottom-0" data-color="#fff">
                                        <i class="fas fa-sun "></i>
                                    </li>
                                    <li class="col-6 text-center mode border-bottom-0" data-color="#111">
                                        <i class="fas fa-moon "></i>
                                    </li>
                                </ul>
                            <li class="p-0">
                            <ul class="col-12 p-0 text-center">
                                <li class="colors purple d-inline-block border-0 " data-color="#6957af">
                                    <i class="fas fa-tint "></i>
                                </li>
                                <li class="colors red d-inline-block border-0 " data-color="#f72b1c">
                                    <i class="fas fa-tint "></i>
                                </li>
                                <li class="colors blueviolet d-inline-block border-0 " data-color="#8a2be2">
                                    <i class="fas fa-tint "></i>
                                </li>
                                <li class="colors blue d-inline-block border-0 " data-color="#4169e1">
                                    <i class="fas fa-tint "></i>
                                </li>
                                <li class="colors goldenrod d-inline-block border-0 " data-color="#daa520">
                                    <i class="fas fa-tint "></i>
                                </li>
                                <li class="clear border-0 p-0"></li>
                                <li class="colors magenta d-inline-block border-0 " data-color="#ee6192">
                                    <i class="fas fa-tint "></i>
                                </li>
                                <li class="colors yellowgreen d-inline-block border-0 " data-color="#9acd32">
                                    <i class="fas fa-tint "></i>
                                </li>
                                <li class="colors orange d-inline-block border-0 " data-color="#fa5b0f">
                                    <i class="fas fa-tint "></i>
                                </li>
                                <li class="colors green d-inline-block border-0 " data-color="#72b626">
                                    <i class="fas fa-tint "></i>
                                </li>
                                <li class="colors yellow d-inline-block border-0 " data-color="#ffb400">
                                    <i class="fas fa-tint "></i>
                                </li>
                            </ul>
                            </li>


                    </ul>
                </li>
            </ul>
            <br>
        </div>
    </nav>
    <!-- Mobile Menu Ends -->
</header>
@yield('content')

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('js/custom.js') }}" defer></script>

</body>
</html>
