@extends('layouts.master-sidebar')

@section('sidebar')
    @include('layouts.preferences-sidebar')
@endsection

@section('_content')
    @isset($pt_error)
        @include('layouts.pt-error')
    @else

    <form method="POST" action="{{route('user.preferences.create_update_stores')}}">
        @csrf

        @foreach($stores as $store)
            <li class="ml-vh-2">
                <div class="checkbox">
                    <input class="form-check-input" type="checkbox" name="{{$store->name}}" id="{{$store->name}}"
                        {{ (isset($current_stores[$store->name]) && $current_stores[$store->name] > 0) ? 'checked' : '' }}>
                    <label class="text-uppercase h3" for="{{$store->name}}">
                        {{ __($store->name) }}
                    </label>
                </div>
            </li>
        @endforeach

        <input type="hidden" name="_user" value="{{Auth::id()}}">
        <li class="form-group col-sm-12 ">
            <button type="submit" class="btn btn-lg btn-dark text-white pull-right mr-vh-10">
                {{ __('Save') }}
            </button>
        </li>
        </form>
    @endisset
@endsection
