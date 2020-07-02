<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
        <a href="{{route('admin.home')}}"><span class="m-l-10 text-uppercase">{{ config('app.name', 'Laravel') }} Admin</span></a>
    </div>
    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info">
                    <div class="image"><a href="#"><img src="{{asset('/assets/images/profile_av.jpg')}}" alt="User"></a></div>
                    <div class="detail">
                        <h4 class="small">{{ Auth::user()->name }}</h4>
                    </div>
                </div>
            </li>
            <li class="{{ Route::currentRouteName() === 'admin.home' ? 'active open' : null }}"><a href="{{route('admin.home')}}"><i class="zmdi zmdi-home"></i><span>{{ __('Dashboard') }}</span></a></li>

            <li class="{{ Request::segment(2) === 'preferences' ? 'active open' : null }}">
                <a href="#App" class="menu-toggle"><i class="zmdi zmdi-apps"></i> <span>{{ __('Preferences') }}</span></a>
                <ul class="ml-menu">
                    <li class="{{ Request::segment(3) === 'shopping_priorities' ? 'active' : null }}"><a href="{{route('preferences.shopping_priorities.index')}}">{{ __('Shopping Priorities') }}</a></li>
                    <li class="{{ Request::segment(3) === 'stores' ? 'active' : null }}"><a href="{{route('preferences.stores.index')}}">{{ __('Stores') }}</a></li>
                </ul>
            </li>
            <li class="{{ Request::segment(4) === 'types' ? 'active open' : null }}">
                <a href="#App" class="menu-toggle"><i class="zmdi zmdi-apps"></i> <span>{{ __('Preference Types') }}</span></a>
                <ul class="ml-menu">
                    <li class="{{ Request::segment(4) === '' ? 'active' : null }}"><a href="{{route('preferences.types.index')}}">{{ __('Preference Types') }}</a></li>
                    <li class="{{Request::segment(4) === 'new'? 'active' : null }}"><a href="{{route('preferences.types.create')}}">{{ __('New Preference Type') }}</a></li>
                </ul>
            </li>


        </ul>
    </div>
</aside>
