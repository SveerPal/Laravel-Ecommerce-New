@extends('admin.app')

@section('title') {{ $title }} @endsection

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fas fa-list"></i> {{ $title }}</h1>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('admin.product-brands') }}" class="btn btn-primary text-white mr-1 mb-4" type="button">Back To Product Brands</a>
          <div class="tile">
            <div class="tile-body">
              <table class="table table-hover table-bordered" id="sampleTable">
                <tbody>
                    <tr><th>ID</th><td>{{ $productbrands->id }}</td></tr>
                    <tr> <th>Name</th><td>{{ $productbrands->name }}</td></tr>
                    <tr><th>Banner</th>
                        <td>
                            @if ($productbrands->banner != null)
                                <img src="{{ asset('storage/uploads/ecommerce/product_brands/'.$productbrands->banner) }}" id="logoImg" style="width: 80px; height: auto;">
                            @endif 
                        </td>
                    </tr>
                    <tr><th>Slug</th><td>{{ $productbrands->slug }}</td></tr>
                    <tr><th>Parent</th><td>{{ $productbrands->parent }}</td></tr>
                    <tr><th>Meta Title</th><td>{{ $productbrands->meta_title }}</td></tr>                  
                    <tr><th>Meta Descriptipn</th><td>{{ $productbrands->meta_description }}</td></tr>                  
                    <tr><th>Descriptipn</th><td>{!! $productbrands->description !!}</td></tr>                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
@endsection
