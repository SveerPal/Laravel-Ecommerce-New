@extends('admin.app')

@section('title') {{ $title }} @endsection

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-list"></i> {{ $title }}</h1>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('admin.product-brands') }}" class="btn btn-primary text-white mr-1 mb-4" type="button">Back To Product Brands</a>
          <div class="tile">
            <div class="tile-body">
              <table class="table table-hover table-bordered" id="sampleTable">
                <tbody>
                    <tr><th>ID</th><td>{{ $product_brands->id }}</td></tr>
                    <tr> <th>Name</th><td>{{ $product_brands->name }}</td></tr>
                    <tr><th>Banner</th>
                        <td>
                            @if ($product_brands->banner != null)
                                <img src="{{ asset('storage/uploads/ecommerce/product_brand/'.$product_brands->banner) }}" id="logoImg" style="width: 80px; height: auto;">
                            @endif 
                        </td>
                    </tr>
                    <tr><th>Slug</th><td>{{ $product_brands->slug }}</td></tr>
                    <tr><th>Parent</th><td>{{ $product_brands->parentbrandname }}</td></tr>
                    <tr><th>Meta Title</th><td>{{ $product_brands->meta_title }}</td></tr>                 
                    <tr><th>Meta Keywords</th><td>{{ $product_brands->meta_keywords }}</td></tr>
                    <tr><th>Meta Descriptipn</th><td>{{ $product_brands->meta_description }}</td></tr>
                    <tr><th>Descriptipn</th><td>{!! $product_brands->description !!}</td></tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
@endsection
