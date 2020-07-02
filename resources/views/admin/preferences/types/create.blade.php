@extends('admin.layouts.master')
@section('title', 'Preference Types')
@section('parentPageTitle', 'App')
@section('page-style')
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}"/>
@stop
@section('content')
    <div class="row justify-content-center clearfix">
        <div class="  col-lg-6 col-md-12 col-sm-12">
            <div class="card">
                <div class="header">
                    <h2><strong>New</strong> Preference Type</h2>
                </div>
                <div class="body">
                    <form id="form_advanced_validation" method="POST" action="{{ route('preferences.types.store') }}">
                        @csrf
                        <div class="form-group form-float">
                            <input type="text" class="form-control" name="name" placeholder="Preference Type Name" required>
                            @if ( $errors->has('name') )
                                <p class="text-danger">{{ $errors->first('name') }}</p>
                            @endif
                        </div>
                        <button class="btn btn-raised btn-primary waves-effect text-uppercase" type="submit">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
@section('page-script')
    <script src="{{asset('assets/plugins/jquery-validation/jquery.validate.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery-steps/jquery.steps.js')}}"></script>
    <script src="{{asset('assets/js/pages/forms/form-validation.js')}}"></script>
@stop

