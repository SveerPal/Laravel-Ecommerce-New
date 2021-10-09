@extends('admin.app')

@section('title') {{ $title }} @endsection

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-cogs"></i> {{ $title }}</h1>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('admin.product-categories') }}" class="btn btn-primary text-white mr-1 mb-4" type="button">Back To Blog Categories</a>
          <div class="tile">
            <div class="tile-body">
              <table class="table table-hover table-bordered" id="sampleTable">
                <tbody>
                    <tr><th>ID</th><td>{{ $product_categories->id }}</td></tr>
                    <tr> <th>Name</th><td>{{ $product_categories->name }}</td></tr>
                    <tr><th>Banner</th>
                        <td>
                            @if ($product_categories->banner != null)
                                <img src="{{ asset('storage/uploads/ecommerce/product_category/'.$product_categories->banner) }}" id="logoImg" style="width: 80px; height: auto;">
                            @endif 
                        </td>
                    </tr>
                    <tr><th>Slug</th><td>{{ $product_categories->slug }}</td></tr>
                    <tr><th>Parent</th><td>{{ $product_categories->parentcatname }}</td></tr>
                    <tr><th>Meta Title</th><td>{{ $product_categories->meta_title }}</td></tr>                  
                    <tr><th>Meta Keywords</th><td>{{ $product_categories->meta_keywords }}</td></tr>                  
                    <tr><th>Meta Descriptipn</th><td>{{ $product_categories->meta_description }}</td></tr>                  
                    <tr><th>Descriptipn</th><td>{!! $product_categories->description !!}</td></tr>                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
@endsection
