@extends('layouts.master-sidebar')

@section('headscripts')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
@endsection

@section('sidebar')
    @include('layouts.preferences-sidebar')
@endsection

@section('_content')
    @isset($pt_error)
        @include('layouts.pt-error')
    @else
        <form method="post" action="{{route('user.preferences.create_update_shopping_priorities')}}">
            @csrf
            <div class="form-group mb-5">
                <p class="form-text">Shopping priorites are the things <b>most important</b> to you while comparing products, they are listed in an order with the <b>most important before
                        the less important</b>.
                    The order of the shopping priorities will <b> be considered</b> whenever you search for a product and the results will be curated to reflect the order of these priorities.</p>
            </div>
            <div class="list-group" id="sortable">
                @if(!empty($current_sp))
                    @foreach($current_sp as $sp_name => $sp_priority)
                        <li href="#" data-priority="{{$sp_name}}" class="ui-state-default list-group-item list-group-item-action flex-column align-items-start  ">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1 h4 text-uppercase">{{$sp_name}}</h5>
                                <small id="{{$sp_name}}" class="h5 mt-vh-2">#{{$sp_priority}}</small>
                            </div>
                            <input type="hidden" name="{{$sp_name}}" value="{{$sp_priority}}">
                            <small class="h6">Drag up or down to increase or decrease priority respectively.</small>
                        </li>
                    @endforeach
                @else
                    @php $i = 1 @endphp
                    @foreach($priorities as $priority)
                        <li href="#" data-priority="{{$priority->name}}" class="ui-state-default list-group-item list-group-item-action flex-column align-items-start  ">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1 h4 text-uppercase">{{$priority->name}}</h5>
                                <small id="{{$priority->name}}" class="h5 mt-vh-2">#{{!is_null($priority->priority) ? $priority->priority : $i}}</small>
                            </div>
                            <input type="hidden" name="{{$priority->name}}" value="{{$i++}}">
                            <small class="h6">Drag up or down to increase or decrease priority respectively.</small>
                        </li>
                        @endforeach
                @endif
            </div>

            <input type="hidden" name="_user" value="{{Auth::id()}}">
            <li class="form-group col-sm-12 ">
                <button type="submit" class="btn btn-lg btn-dark text-white pull-right">
                    {{ __('Save') }}
                </button>
            </li>
        </form>

    @endisset
@endsection

@section("extrascripts")
    <script>
        $(function() {
            $( "#sortable" ).sortable({
                // placeholder: "ui-sortable-placeholder",
                // update: function(event, ui){
                //     let items = $("#sortable").sortable("toArray");
                //     console.log(items);
                //     // console.log(ui.item.index());
                //     // console.log(ui);
                // },
                stop: function(e, ui) {
                    $.map($(this).find('li'), function(el) {
                        let id = $(el).attr('data-priority');
                        let index = $(el).index()+1;

                        $("small#"+id).text('#'+index);
                        $("input[name="+id+"]").val(index);
                        // return $(el).attr('data-priority') + ' = ' + $(el).index();
                    });
                    console.log();
                }
            });
        });
    </script>
@endsection
