@extends('layouts.master')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-4">
                @yield('sidebar')
            </div>
            <div class="col-8">
                @yield('_content')
            </div>
        </div>
    </div>
@endsection
