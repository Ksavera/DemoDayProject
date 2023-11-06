<header>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <!-- <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{url('/photos/logo.png')}}" class="logo" alt="logo">
                {{ config('app.name', 'KA') }}
            </a> -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <div>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">{{ __('Home') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('students') }}">{{ __('Students') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/projects') }}">{{ __('Projects') }}</a>
                        </li>
                    </ul>
                </div>

                <!-- Right Side Of Navbar -->
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">

                    <!-- Authentication Links -->
                    @guest
                    @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @endif

                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @else
                    @if (auth()->check())
                    @if (App\Models\Profile::where('user_id', auth()->user()->id)->exists())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('newProject') }}">{{ __('Create Project') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('myProfile') }}">{{ __('My Profile') }}</a>
                    </li>

                    @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('newProfile') }}">{{ __('Create Profile') }}</a>
                    </li>

                    @endif
                    @endif
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>
                        @if (auth()->check())

                        <div class="dropdown-menu dropdown-menu-end text-center" aria-labelledby="navbarDropdown"><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endif
                    @endguest
                </ul>

            </div>
        </div>
    </nav>
</header>