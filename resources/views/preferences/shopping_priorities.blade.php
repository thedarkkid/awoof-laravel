@extends('layouts.master-sidebar')

@section('sidebar')
    @include('layouts.preferences-sidebar')
@endsection

@section('_content')
    @isset($pt_error)
        @include('layouts.pt-error')
    @else
    @endisset
@endsection
