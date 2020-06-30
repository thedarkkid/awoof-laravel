@extends('admin.layouts.master')
@section('title', 'Shopping Priorities')
@section('parentPageTitle', 'App')
@section('page-style')
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css')}}"/>
    <link rel="stylesheet" href="{{asset('assets/plugins/bootstrap-select/css/bootstrap-select.css')}}"/>
@stop
@section('content')
    <!-- Advanced Validation -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="header">
                    <h2><strong>New</strong> Shopping Priority</h2>
                </div>
                <div class="body">
                    <form id="form_advanced_validation" method="POST">
                        <div class="form-group form-float">
                            <input type="text" class="form-control" name="minmaxlength" maxlength="10" minlength="3" required>
                            <div class="help-info">Min. 3, Max. 10 characters</div>
                        </div>
                        <div class="form-group form-float">
                            <input type="text" class="form-control" name="minmaxvalue" min="10" max="200" required>
                            <div class="help-info">Min. Value: 10, Max. Value: 200</div>
                        </div>
                        <div class="form-group form-float">
                            <input type="url" class="form-control" name="url" required>
                            <div class="help-info">Starts with http://, https://, ftp:// etc</div>
                        </div>
                        <div class="form-group form-float">
                            <input type="text" class="form-control" name="date" required>
                            <div class="help-info">YYYY-MM-DD format</div>
                        </div>
                        <div class="form-group form-float">
                            <input type="number" class="form-control" name="number" required>
                            <div class="help-info">Numbers only</div>
                        </div>
                        <div class="form-group form-float">
                            <input type="text" class="form-control" name="creditcard" pattern="[0-9]{13,16}" required>
                            <div class="help-info">Ex: 1234-5678-9012-3456</div>
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

