@php
    $menus = [
        'home' => [
            'name' => 'Home',
            'route' => route('home'),
            'active' => str_contains(Request::url(), route('home')),
        ],
        'shop' => [
            'name' => 'Shop',
            'route' => route('shop'),
            'active' => str_contains(Request::url(), route('shop')),
        ],
        'about' => [
            'name' => 'About us',
            'route' => route('about'),
            'active' => str_contains(Request::url(), route('about')),
        ],
        'services' => [
            'name' => 'Services',
            'route' => route('services'),
            'active' => str_contains(Request::url(), route('services')),
        ],
        'blog' => [
            'name' => 'Blog',
            'route' => route('blog'),
            'active' => str_contains(Request::url(), route('blog')),
        ],
        'contact' => [
            'name' => 'Contact',
            'route' => route('contact'),
            'active' => str_contains(Request::url(), route('contact')),
        ],
    ];
@endphp

<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="Furni navigation bar">

    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">Furni<span>.</span></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsFurni"
            aria-controls="navbarsFurni" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsFurni">
            <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                @foreach ($menus as $menu)
                    <li class="nav-item {{ $menu['active'] ? 'active' : '' }}">
                        <a class="nav-link" href="{{ $menu['route'] }}">{{ $menu['name'] }}</a>
                    </li>
                @endforeach

                {{-- // <li><a class="nav-link" href="{{route('shop')}}">Shop</a></li>
                 <li><a class="nav-link" href="{{route('about')}}">About us</a></li>
                 <li><a class="nav-link" href="{{route('services')}}">Services</a></li>
                 <li><a class="nav-link" href="{{route('blog')}}">Blog</a></li>
                 <li><a class="nav-link" href="{{route('contact')}}">Contact us</a></li> --}}
            </ul>

            <ul class="custom-navbar-cta navbar-nav mb-2 mb-md-0 ms-5">
                <li><a class="nav-link" href="#"><img src="images/user.svg"></a></li>
                <li><a class="nav-link" href="{{ route('cart') }}"><img src="images/cart.svg"></a></li>
            </ul>
        </div>
    </div>

</nav>
