@extends('admin.app')

@section('title') {{ $title }} @endsection

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-list-alt"></i> {{ $title }}</h1>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('admin.product-categories') }}" class="btn btn-primary text-white mr-1 mb-4" type="button">Back To Product Categories</a>
          <div class="tile">
            <div class="tile-body">
              <table class="table table-hover table-bordered" id="sampleTable">
                <tbody>
                    <tr><th>ID</th><td>{{ $productcategories->id }}</td></tr>
                    <tr> <th>Name</th><td>{{ $productcategories->name }}</td></tr>
                    <tr><th>Banner</th>
                        <td>
                            @if ($productcategories->banner != null)
                                <img src="{{ asset('storage/uploads/ecommerce/product_category/'.$productcategories->banner) }}" id="logoImg" style="width: 80px; height: auto;">
                            @endif 
                        </td>
                    </tr>
                    <tr><th>Slug</th><td>{{ $productcategories->slug }}</td></tr>
                    <tr><th>Parent</th><td>{{ $productcategories->parent }}</td></tr>
                    <tr><th>Meta Title</th><td>{{ $productcategories->meta_title }}</td></tr>                  
                    <tr><th>Meta Descriptipn</th><td>{{ $productcategories->meta_description }}</td></tr>                  
                    <tr><th>Descriptipn</th><td>{!! $productcategories->description !!}</td></tr>                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
@endsection
