<nav class="navbar bg-danger sticky-top" data-bs-theme="dark">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="#">
            <img src="{{ asset('assets/img/uns_white.png') }}" alt="Logo" height="35"
                class="d-inline-block align-text-top">
            <span class="ms-2">
                <b>LED</b> UNS
            </span>
        </a>
        <div class="d-flex align-items-center ms-auto">
            @auth
                <a role="button" href="{{ route('home') }}" class="btn btn-light text-danger">Inicio</a>
            @else
                <a role="button" href="{{ route('login') }}" class="btn btn-light text-danger">Login</a>
                @if (Route::has('register'))
                    <a role="button" href="{{ route('register') }}" class="btn btn-light text-danger ms-2">Registrarse</a>
                @endif
            @endauth
        </div>
    </div>
</nav>

{{-- @if (Route::has('login'))
    @auth
        <a href="{{ url('/home') }}">Home</a>
    @else
        <a href="{{ route('login') }}">Log in</a>
        @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
        @endif
    @endauth
@endif --}}
