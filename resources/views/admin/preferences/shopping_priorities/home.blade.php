@extends('admin.layouts.master')
@section('title', 'Shopping Priorities')
@section('parentPageTitle', 'App')
@section('page-style')
    <link rel="stylesheet" href="{{asset('assets/plugins/footable-bootstrap/css/footable.bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/plugins/footable-bootstrap/css/footable.standalone.min.css')}}" />
@stop
@section('content')
    <div class="row clearfix">
        <div class="col-lg-12 align-right pr-5">
            <a href="{{route('preferences.shopping_priorities.create')}}" class="btn btn-primary btn-sm text-uppercase"><i class="zmdi zmdi-plus"></i> Add New</a>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="table-responsive contact">
                    <table class="table table-hover mb-0 c_list c_table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Shopping Priority</th>
                            <th data-breakpoints="xs sm md">Created by</th>
                            <th data-breakpoints="xs">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                <div class="checkbox">
                                    <input id="delete_2" type="checkbox">
                                    <label for="delete_2">&nbsp;</label>
                                </div>
                            </td>
                            <td>
                                <address><i class="zmdi zmdi-pin"></i>123 6th St. Melbourne, FL 32904</address>
                            </td>
                            <td>
                                <span class="email"><a href="javascript:void(0);" title="">johnsmith@gmail.com</a></span>
                            </td>
                            <td>
                                <button class="btn btn-primary btn-sm"><i class="zmdi zmdi-edit"></i></button>
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#defaultModal" data-color="red"><i class="zmdi zmdi-delete"></i></button>
                            </td>
                            <div class="modal fade " id="defaultModal" tabindex="-1" role="dialog">
                                <div class="modal-dialog align-self-center mt-vh-33" role="document">
                                    <div class="modal-content bg-warning">
                                        <div class="modal-header">
                                            <h4 class="title text-danger text-uppercase text-center" id="defaultModalLabel">Are you sure you want to delete?</h4>
                                        </div>
                                        <div class="modal-body  text-light">
                                            <p>A deleted shopping priority cannot be recovered and all user preferences with
                                                this priority will be deleted</p>
                                        </div>
                                        <div class="modal-footer ">
                                            <button type="button" class="btn btn-default waves-effect text-light text-uppercase" data-dismiss="modal">CLOSE</button>
                                            <button type="button" class="btn btn-danger waves-effect text-light text-uppercase">Delete</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                        <tr>
                            <td>
                                <div class="checkbox">
                                    <input id="delete_3" type="checkbox">
                                    <label for="delete_3">&nbsp;</label>
                                </div>
                            </td>
                            <td>
                                <address><i class="zmdi zmdi-pin"></i>44 Shirley Ave. West Chicago, IL 60185</address>
                            </td>
                            <td>
                                <span class="email"><a href="javascript:void(0);" title="">hosseinshams@gmail.com</a></span>
                            </td>
                            <td>
                                <button class="btn btn-primary btn-sm"><i class="zmdi zmdi-edit"></i></button>
                                <button class="btn btn-danger btn-sm"><i class="zmdi zmdi-delete"></i></button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
@section('page-script')
    <script src="{{asset('assets/bundles/footable.bundle.js')}}"></script>
    <script src="{{asset('assets/js/pages/tables/footable.js')}}"></script>
@stop
