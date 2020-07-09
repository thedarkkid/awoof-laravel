<div class="sticky">
    <div class="container">
        <!-- Nav -->
        <nav class="webimenu">
            <!-- MENU BUTTON RESPONSIVE -->
            <div class="menu-toggle"> <i class="fa fa-bars"> </i> </div>
            <ul class="ownmenu">
                <li class=" text-uppercase active">
                    <a href="#">home</a>
                </li>
                <li class="text-uppercase">
                    <a href="#" >pages</a>
                </li>
                <li class="text-uppercase">
                    <a href="#" >pages</a>
                </li>
                <li class="text-uppercase">
                    <a href="#" >shop</a>
                </li>
            @auth
                <li class="search-nav">
                    <a href="#">{{ Auth::user()->name }} <span class="caret"></span></a>
                    <ul class="dropdown pt-vh-2 max-vw-15 max-vh-7">
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
            </li>
            @else
                <li class="text-uppercase search-nav">
                    <a href="{{ route('login') }}">Login</a>
                </li>
                @if (Route::has('register'))
                    <li class="text-uppercase search-nav">
                        <a href="{{ route('register') }}">Register</a>
                    </li>
                @endif
            @endauth
            </ul>
        </nav>
    </div>
</div>
