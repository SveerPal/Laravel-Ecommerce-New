@extends('admin.app')

@section('title') {{ $title }} @endsection

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-user"></i> {{ $title }}</h1>
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
            <a href="{{ route('admin.clienteles') }}" class="btn btn-primary text-white mr-1 mb-4" type="button">Back To Clientele</a>
            @foreach($clientelesdetails as $clientelesdetail)
            <form action="{{ route('admin.clienteles.update',['id'=>$clientelesdetail->id]) }}" method="POST" role="form" enctype="multipart/form-data">
                @csrf                
                <div class="tile">  
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label" for="name"> Name</label>
                            <input class="form-control" type="text" placeholder="Enter  name" id="name" name="name" value="{{ old('name', $clientelesdetail->name) }}"/>
                            @error('name')
                                <div class="alert alert-danger error">{{ $message }}</div>
                            @enderror                                  
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="link">Link</label>
                            <input class="form-control" type="text" placeholder="Enter Link" id="link" name="link" value="{{ old('link', $clientelesdetail->link) }}"/>
                            @error('link')
                                <div class="alert alert-danger error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-5">
                            <label class="control-label">Image</label>                             
                            <input class="form-control" type="file" name="image" onchange="loadFile(event,'logoImg')"/>
                            <input class="form-control" type="hidden" name="image_old" value="{{ $clientelesdetail->image }}"/>
                            @error('image')
                                <div class="alert alert-danger error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-1">
                            @if ($clientelesdetail->image != null)
                                <img src="{{ asset('storage/uploads/clienteles/'.$clientelesdetail->image) }}" id="logoImg" style="width: 80px; height: auto;">
                            @else
                                <img src="https://via.placeholder.com/80x80?text=Placeholder+Image" id="logoImg" style="width: 80px; height: auto;">
                            @endif                
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="alt"> Alt</label>
                            <input class="form-control" type="text" placeholder="Enter  alt" id="alt" name="alt" value="{{ old('alt', $clientelesdetail->alt) }}"/>
                            @error('alt')
                                <div class="alert alert-danger error">{{ $message }}</div>
                            @enderror                                  
                        </div>            
                    </div>  
                </div>                
                <div class="tile-footer">
                    <div class="row d-print-none mt-2">
                        <div class="col-12 text-right">
                            <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Update </button>
                        </div>
                    </div>
                </div>    
            </form>  
            @endforeach  
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
@endpush