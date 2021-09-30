@extends('admin.app')

@section('title') {{ $title }} @endsection

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fas fa-blog"></i> {{ $title }}</h1>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('admin.blogs') }}" class="btn btn-primary text-white mr-1 mb-4" type="button">Back To Blogs</a>
          <div class="tile">
            <div class="tile-body">{{ $blogs  }}
               
                   
              <table class="table table-hover table-bordered" id="sampleTable">
                <tbody>
                     @foreach ($blogs as $blogs) 
                    <tr><th>ID</th><td>{{ $blogs->id }}</td></tr>
                    <tr> <th>Name</th><td>{{ $blogs->name }}</td></tr>
                    <tr><th>Banner</th>
                        <td>
                            @if ($blogs->banner != null)
                                <img src="{{ asset('storage/uploads/blogs/'.$blogs->banner) }}" id="logoImg" style="width: 80px; height: auto;">
                            @endif 
                        </td>
                    </tr>
                    <tr><th>Slug</th><td>{{ $blogs->slug }}</td></tr>
                    <tr><th>Parent</th><td>{{ $blogs->blog_category_id }}</td></tr>
                    <tr><th>Meta Title</th><td>{{ $blogs->meta_title }}</td></tr>                  
                    <tr><th>Meta Descriptipn</th><td>{{ $blogs->meta_description }}</td></tr>                  
                    <tr><th>Meta Keywords</th><td>{{ $blogs->meta_keywords }}</td></tr>                  
                    <tr><th>Descriptipn</th><td>{!! $blogs->description !!}</td></tr>   
                    @endforeach               
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>
@endsection
