<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">

    <a class="navbar-brand" href="/">{{config('app.name')}}</a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar"
        aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar">
        <!-- Left side of navbar -->
        <div class="navbar-nav">
            <ul class="navbar-nav mx-2">
                <li class="nav-item"><a class="nav-link" href="/dashboard">Dashboard</a></li>
            </ul>

            <ul class="navbar-nav mx-2">
                <li class="nav-item"><a class="nav-link" href="/journal">Journal</a></li>
            </ul>

            <li class="nav-item dropdown mx-2">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    Trades <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/trades">
                        View
                    </a>

                    <a class="dropdown-item" href="/trades/import">
                        Import
                    </a>
                </div>
            </li>
        </div>


        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">

            <!-- Authentication Links -->
            @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
            @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
            @endif
            @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }} <span class="caret"></span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            @endguest
        </ul>
    </div>
</nav>
<br />
<br />