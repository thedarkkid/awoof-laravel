@extends('admin.layouts.master')
@section('title', 'Dashboard')
@section('page-style')
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-lime text-white">Stores</div>

                <div class="card-body bg-white bg-light text-dark" >
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
@endsection

