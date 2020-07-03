@extends('admin.layouts.master')
@section('title', 'Preference Types')
@section('parentPageTitle', 'App')
@section('page-style')
    <link rel="stylesheet" href="{{asset('assets/plugins/footable-bootstrap/css/footable.bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/plugins/footable-bootstrap/css/footable.standalone.min.css')}}" />
@stop
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 align-right pr-5">
            <button data-toggle="modal" data-target="#addModal" class="btn btn-primary btn-sm text-uppercase"><i class="zmdi zmdi-plus"></i> Add New</button>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="table-responsive contact">
                    <table class="table table-hover mb-0 c_list c_table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Preference Type</th>
                            <th data-breakpoints="xs sm md">Created At</th>
                            <th data-breakpoints="xs">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($preference_types as $preference_type)
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <input id="delete_{{$preference_type->id}}" value="{{$preference_type->id}}" name="delete_preference" type="checkbox">
                                        <label for="delete_{{$preference_type->id}}">&nbsp;</label>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-capitalize">{{$preference_type->name}}</span>
                                </td>
                                <td>
                                    <span class="">{{$preference_type->created_at}}</span>
                                </td>
                                <td>
                                    <button data-toggle="modal" data-target="#editModal{{$preference_type->id}}" class="btn btn-primary btn-sm"><i class="zmdi zmdi-edit"></i></button>
                                    <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#defaultModal{{$preference_type->id}}" data-color="red"><i class="zmdi zmdi-delete"></i></button>
                                </td>
                                <div class="modal fade " id="editModal{{$preference_type->id}}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog align-self-center mt-vh-33" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="title text-danger text-uppercase text-center" id="defaultModalLabel">{{__('Edit '.$preference_type->name)}}</h4>
                                            </div>
                                            <form action="{{route('preferences.types.update', $preference_type->id)}}" method="POST" class="d-inline">
                                                @csrf
                                                <div class="modal-body ">
                                                    <div class="form-group form-float">
                                                        <input type="text" class="form-control" value="{{$preference_type->name}}" name="name" placeholder="Preference Type Name" required>
                                                        @if ( $errors->has('name') )
                                                            <p class="text-danger">{{ $errors->first('name') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="modal-footer ">
                                                    <button type="button" class="btn btn-default waves-effect text-light text-uppercase" data-dismiss="modal">CLOSE</button>
                                                    <button type="submit" class="btn btn-primary waves-effect text-light text-uppercase">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade " id="defaultModal{{$preference_type->id}}" tabindex="-1" role="dialog">
                                    <div class="modal-dialog align-self-center mt-vh-33" role="document">
                                        <div class="modal-content bg-warning">
                                            <div class="modal-header">
                                                <h4 class="title text-danger text-uppercase text-center" id="defaultModalLabel">Are you sure you want to delete {{$preference_type->name }}?</h4>
                                            </div>
                                            <div class="modal-body  text-light">
                                                <p>A deleted preference type cannot be recovered and all relation to that preference will be deleted</p>
                                            </div>
                                            <div class="modal-footer ">
                                                <button type="button" class="btn btn-default waves-effect text-light text-uppercase" data-dismiss="modal">CLOSE</button>
                                                <form action="{{route('preferences.types.destroy', $preference_type->id)}}" method="POST" class="d-inline">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-danger waves-effect text-light text-uppercase">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{$preference_types->links()}}
            </div>
            <div class="modal fade " id="addModal" tabindex="-1" role="dialog">
                <div class="modal-dialog align-self-center mt-vh-33" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="title text-danger text-uppercase text-center" id="defaultModalLabel">{{__('Add New Preference Type')}}</h4>
                        </div>
                        <form id="form_advanced_validation" method="POST" action="{{ route('preferences.types.store') }}">
                            @csrf
                            <div class="modal-body ">
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" name="name" placeholder="Preference Type Name" required>
                                    @if ( $errors->has('name') )
                                        <p class="text-danger">{{ $errors->first('name') }}</p>
                                    @endif
                                </div>
                            </div>
                            <div class="modal-footer ">
                                <button type="button" class="btn btn-default waves-effect text-light text-uppercase" data-dismiss="modal">CLOSE</button>
                                <button type="submit" class="btn btn-success waves-effect text-light text-uppercase">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('page-script')
    <script src="{{asset('assets/bundles/footable.bundle.js')}}"></script>
    <script src="{{asset('assets/js/pages/tables/footable.js')}}"></script>
@stop
