<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <div class="part1">
            <a class="navbar-brand" href="{{ route('main') }}">
                <img src="{{ asset('img/logo.png') }}" width="150px" alt="">
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class=" part2 text-center collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('main') }}">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('main') }}#DownToAboutus">About us <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="categories" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Categories
                    </a>
                    <x-category-component />
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact.create') }}" target="_blank">Contact us</a>
                </li>
            </ul>
        </div>

        <div class="part3 collapse navbar-collapse" id="navbarSupportedContent">
            @auth
            <a href="{{ route('profil') }}" target="_blank"><i class="fa fa-user"></i></a>
            <a href="{{ route('cart.index') }}" target="_blank"><i class="fa fa-shopping-cart"></i>@if(Cart::count() > 0)<span style="font-size: 66%;" class="badge badge-pill badge-info js-cart-count">{{ Cart::count() }}</span>@endif</a>

            <button class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="zmdi zmdi-power"></i>
                {{ __('Logout') }}
            </button>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            @else
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#login">Login</button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#signup">Sign up</button>
            @endauth
        </div>
    </div>
</nav>
<!--End Navbar-->