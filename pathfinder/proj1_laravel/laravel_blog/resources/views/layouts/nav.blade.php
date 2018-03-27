<nav class="meta-navbar navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <div class="float-left">
            <a class="navbar-brand cursive" href="{{ url('/') }}">
                <b class="h3">MetaBlog</b>
            </a>
            @guest
            @else
            <div style="display:inline-block">
                <li style="list-style-type: none;"><a class="text-black" href="/posts">Posts</a></li>
            </div>
            <div style="display:inline-block">
                <li style="list-style-type: none;"><a class="text-black" href="/myposts">My Posts</a></li>
            </div>
            <div style="display:inline-block">
                <li style="list-style-type: none;"><a class="text-black" href="/posts/create">Create</a></li>
            </div>
            @endguest
        </div>

        <div class="float-right collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                        @guest
                            <li><a class="text-black" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            <li><a class="text-black" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="text-black dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="text-black dropdown-item" href="/settings">
                                        Settings
                                    </a>
                                    <a class="text-black dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
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
            </div>
        </nav>