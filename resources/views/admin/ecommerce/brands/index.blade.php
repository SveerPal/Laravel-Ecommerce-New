@extends('admin.app')

@section('title') {{ $title }} @endsection

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fas fa-list"></i> {{ $title }}</h1>
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
    
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('admin.product-brands.create') }}" class="btn btn-primary text-white mr-1 mb-4" type="button">Add New</a>
          <div class="tile">
            <div class="tile-body">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Banner</th>
                    <th>Slug</th>
                    <th>Parent</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                    @foreach($productbrands as $productbrand)
                    <tr>
                        <td>{{ $productbrand->id }}</td>
                        <td>{{ $productbrand->name }}</td>
                        <td>
                            @if ($productbrand->banner != null)
                                <img src="{{ asset('storage/uploads/ecommerce/product_brands/'.$productbrand->banner) }}" id="logoImg" style="width: 80px; height: auto;">
                            @endif  
                        </td>
                        <td>{{ $productbrand->slug }}</td>
                        <td>{{ $productbrand->parent }}</td>
                        <td>
                            <a href="{{ route('admin.product-brands.show',['id'=>$productbrand->id]) }}" class="btn btn-primary text-white" type="button">View</a>
                            <a href="{{ route('admin.product-brands.edit',['id'=>$productbrand->id]) }}" class="btn btn-secondary text-white" type="button">Edit</a>
                            <a href="{{ route('admin.product-brands.delete',['id'=>$productbrand->id]) }}" class="btn btn-danger text-white" type="button">Delete</a>
                        </td>
                    </tr>
                    @endforeach 
                </tbody>  
              </table>
            </div>
          </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
@endpush
