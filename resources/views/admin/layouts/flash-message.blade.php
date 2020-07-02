<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ( Session::has('status') )
                <div class="alert alert-block alert-{{ Session::get('status')[0] }}">
                    <div class="row">
                        <div class="col-11">
                            <p class="m-0">
                                {{ Session::get('status')[1] }}
                            </p>
                        </div>
                        <div class="col-1">
                            <button type="button" class="close mt-vh-1" data-dismiss="alert">×</button>
                        </div>
                    </div>

                </div>
            @endif
        </div>
    </div>
</div>
