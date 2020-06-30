<div class="navbar-right">
    <ul class="navbar-nav">
{{--        <li><a href="javascript:void(0);" class="js-right-sidebar" title="Setting"><i class="zmdi zmdi-settings zmdi-hc-spin"></i></a></li>--}}
        <li>
            <a href="{{route('admin.login')}}"
               class="mega-menu"
               title="Sign Out"
               onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();"
            >
                <i class="zmdi zmdi-power"></i>
            </a>
        </li>
        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </ul>
</div>
