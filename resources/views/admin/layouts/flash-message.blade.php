<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ( Session::has('status') )
                <div class="alert alert-block alert-{{ Session::get('status')[0] }}">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <p class="m-0">{{ Session::get('status')[1] }}</p>
                </div>
            @endif
        </div>
    </div>
</div>
