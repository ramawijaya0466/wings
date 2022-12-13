<nav class="navbar navbar-expand-lg navbar-light navbar-store fixed-top navbar-fixed-top" data-aos="fade-down">
    <div class="container">
        <a href="{{ route('home') }}" class="navbar-brand">
            <img src="/template/images/logo.svg" alt="Logo" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('product.index') }}" class="nav-link">Products</a>
                </li>
                @guest
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link">Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{  route('login') }}" class="btn btn-success nav-link px-4 text-white">Sign In</a>
                    </li>
                @endguest
            </ul>

            @auth
                <ul class="navbar-nav d-none d-lg-flex">
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link" id="navbarDropdown" role="button" data-toggle="dropdown">
                            <img src="/template/images/icon-user.png" alt="" class="rounded-circle mr-2 profile-picture" />
                            Hi, {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu">
                            <a href="{{ route('dashboard') }}" class="dropdown-item">My Dashboard</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('checkout.index') }}" class="nav-link d-inline-block mt-2 position-relative">
                            @php
                                $carts = \App\Models\Cart::where('user_id', Auth::user()->id)->count();
                            @endphp
                            @if($carts > 0)
                                <img src="/template/images/icon-cart-filled.svg" alt="" />
                                <div class="card-badge position-absolute rounded-circle bg-success text-center text-white" style="top: -4px; right: -4px; width: 22px; height: 22px;">
                                    {{ $carts }}
                                </div>
                            @else
                                <img src="/template/images/icon-cart-empty.svg" alt="" />
                                <div class="card-badge position-absolute rounded-circle bg-danger text-center text-white" style="top: -4px; right: -4px; width: 22px; height: 22px;">
                                    0
                                </div>
                            @endif
                        </a>
                    </li>
                </ul>

                <ul class="navbar-nav d-block d-lg-none">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link">
                            Hi, {{ Auth::user()->name }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link d-inline-block">
                            Cart
                        </a>
                    </li>
                </ul>
            @endauth
        </div>
    </div>
</nav>
