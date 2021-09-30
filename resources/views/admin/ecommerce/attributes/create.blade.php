@extends('admin.app')

@section('title') {{ $title }} @endsection

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fas fa-tag"></i> {{ $title }}</h1>
        </div>
    </div>
    @if(Session::has('success'))
    <div class="bs-component">
        <div class="alert alert-dismissible alert-success">
            <button class="close" type="button" data-dismiss="alert">×</button><strong></strong>{{Session::get('success')}}
        </div>
    </div>
    @else    
       
        @if ($errors->any())
        <div class="bs-component">
            <div class="alert alert-dismissible alert-danger">
                <button class="close" type="button" data-dismiss="alert">×</button><strong>Oh snap! </strong>Something went wrong. Please Check try again.
            </div>
        </div>
        @endif    
    @endif   
    <div class="row user">       
        <div class="col-md-12">
            <a href="{{ route('admin.product-attributes') }}" class="btn btn-primary text-white mr-1 mb-4" type="button">Back To Product Attributes</a>
            <form action="{{ route('admin.product-attributes.store') }}" method="POST" role="form" enctype="multipart/form-data">
                @csrf
                <div class="tile">  
                    <div class="row">
                        <div class="form-group col-md-8">
                            <label class="control-label" for="name"> Name</label>
                            <input class="form-control" type="text" placeholder="Enter  name" id="name" name="name" value="{{ old('name') }}"/>
                            @error('name')
                                <div class="alert alert-danger error">{{ $message }}</div>
                            @enderror                                  
                        </div>
                        <div class="form-group col-md-8">
                            <label class="control-label" for="slug">Code</label>
                            <input class="form-control" type="text" placeholder="Enter Code" id="code" name="code" value="{{ old('code') }}"/>
                            @error('code')
                                <div class="alert alert-danger error">{{ $message }}</div>
                            @enderror
                        </div>              
                    </div>  
                </div>
                <div class="tile-footer">
                    <div class="row d-print-none mt-2">
                        <div class="col-12 text-right">
                            <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update Settings</button>
                        </div>
                    </div>
                </div>    
            </form>    
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        loadFile = function(event, id) {
            var output = document.getElementById(id);
            output.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
     <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
     <script>
            CKEDITOR.replace( 'description' );
        </script>
@endpush