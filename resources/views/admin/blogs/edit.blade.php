@extends('admin.app')

@section('title') {{ $title }} @endsection

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-blogs"></i> {{ $title }}</h1>
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
            <a href="{{ route('admin.blogs') }}" class="btn btn-primary text-white mr-1 mb-4" type="button">Back To Blogs</a>
            @foreach($blogsdetail as $blogsdtl)
            <form action="{{ route('admin.blogs.update',['id'=>$blogsdtl->id]) }}" method="POST" role="form" enctype="multipart/form-data">
                @csrf                
                <div class="tile">  
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label class="control-label" for="site_name"> Name</label>
                            <input class="form-control" type="text" placeholder="Enter  name" id="name" name="name" value="{{ old('name', $blogsdtl->name) }}"/>
                            @error('name')
                                <div class="alert alert-danger error">{{ $message }}</div>
                            @enderror                                  
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="slug">Slug</label>
                            <input class="form-control" type="text" placeholder="Enter Slug" id="slug" name="slug" value="{{ old('slug', $blogsdtl->slug) }}"/>
                            @error('slug')
                                <div class="alert alert-danger error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="blog_category_id"> Blog Category</label>
                            <select class="form-control" id="blog_category_id" name="blog_category_id[]" multiple="multiple"/>
                                <option value="">Select Category</option>
                                @php $bccat = explode(",",$blogsdtl->blog_category_id);@endphp
                                @foreach($blog_categories as $blog_category)                                
                                    <option @if (in_array("$blog_category->id",$bccat)) selected="selected" @endif value="{{ $blog_category->id }}">{{ $blog_category->name }}</option>
                                @endforeach 
                            </select>
                            @error('blog_category_id')
                                <div class="alert alert-danger error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="blog_tag_id"> Blog Tags</label>
                            <select class="form-control" id="blog_tag_id" name="blog_tag_id[]" multiple="multiple"/>
                                <option value="">Select Tag</option>
                                @php $bctag = explode(",",$blogsdtl->blog_tag_id);@endphp
                                @foreach($blog_tags as $blog_tag)                                
                                    <option @if (in_array("$blog_tag->id",$bctag)) selected="selected" @endif value="{{ $blog_tag->id }}">{{ $blog_tag->name }}</option>
                                @endforeach 
                            </select>
                            @error('blog_tag_id')
                                <div class="alert alert-danger error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-5">
                            <label class="control-label">Banner</label>                             
                            <input class="form-control" type="file" name="banner" onchange="loadFile(event,'logoImg')"/>
                            <input class="form-control" type="hidden" name="banner_old" value="{{ $blogsdtl->banner }}"/>
                            @error('banner')
                                <div class="alert alert-danger error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-1">
                            @if ($blogsdtl->banner != null)
                                <img src="{{ asset('storage/uploads/blogs/'.$blogsdtl->banner) }}" id="logoImg" style="width: 80px; height: auto;">
                            @else
                                <img src="https://via.placeholder.com/80x80?text=Placeholder+Image" id="logoImg" style="width: 80px; height: auto;">
                            @endif                
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="alt"> Alt</label>
                            <input class="form-control" type="text" placeholder="Enter  alt" id="alt" name="alt" value="{{ old('alt', $blogsdtl->alt) }}"/>
                            @error('alt')
                                <div class="alert alert-danger error">{{ $message }}</div>
                            @enderror                                  
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="meta_title">Meta Title</label>
                            <textarea class="form-control" rows="1" placeholder="Enter Meta Title" id="meta_title" name="meta_title">{{ old('meta_title', $blogsdtl->meta_title) }}</textarea>
                            @error('meta_title')
                                <div class="alert alert-danger error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="meta_keywords">Meta Kaywords</label>
                            <textarea class="form-control" rows="1" placeholder="Enter Meta Kaywords" id="meta_keywords" name="meta_keywords">{{ old('meta_keywords', $blogsdtl->meta_keywords) }}</textarea>
                            @error('meta_keywords')
                                <div class="alert alert-danger error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label class="control-label" for="meta_description">Meta Description</label>
                            <textarea class="form-control" rows="4" placeholder="Enter seo meta description for store" id="meta_description" name="meta_description" >{{ old('meta_description', $blogsdtl->meta_description) }}</textarea>
                            @error('meta_description')
                                <div class="alert alert-danger error">{{ $message }}</div>
                            @enderror    
                        </div> 
                        <div class="form-group col-md-12">
                            <label class="control-label" for="description">Description</label>
                            <textarea class="form-control" rows="4" placeholder="Enter  description" id="description"
                                name="description" >{{ old('description', $blogsdtl->description) }}</textarea>
                            @error('description')
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
    <script src="{{ asset('backend/js/plugins/select2.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#blog_tag_id').select2();
            $('#blog_category_id').select2();            
        });
    </script>
     <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
     <script>
            CKEDITOR.replace( 'description' );
        </script>
@endpush