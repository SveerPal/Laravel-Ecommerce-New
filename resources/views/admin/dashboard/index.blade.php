@extends('admin.app')
@section('title') Dashboard @endsection
@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon">
                <i class="icon fa fa-users fa-3x"></i>
                <div class="info">
                    <h4>Users</h4>
                    <p><b>{{ $ucnt }}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon">
                <i class="icon fa fa-shopping-bag fa-3x"></i>
                <div class="info">
                    <h4>Products</h4>
                    <p><b>{{ $pcnt }}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small warning coloured-icon">
                <i class="icon  fa-3x  fas fa-receipt"></i>
                <div class="info">
                    <h4>Orders</h4>
                    <p><b>{{ $ocnt }}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small danger coloured-icon">
                <i class="icon fas fa-blog fa-3x"></i>
                <div class="info">
                    <h4>Blog</h4>
                    <p><b>{{ $bcnt}}</b></p>
                </div>
            </div>
        </div>
    </div>
@endsection