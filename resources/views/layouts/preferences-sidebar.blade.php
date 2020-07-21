<ul class="list-group list-group-flush text-uppercase">
    <a class="list-group-item h2 {{ Route::currentRouteName() == 'user.preferences.stores'? 'active': ''}}" href="{{route('user.preferences.stores')}}">stores</a>
    <a class="list-group-item h2 {{ Route::currentRouteName() == 'user.preferences.shopping_priorities'? 'active': ''}}" href="{{route('user.preferences.shopping_priorities')}}">shopping priorities</a>
</ul>
