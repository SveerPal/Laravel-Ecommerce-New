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
            <a href="{{ route('admin.blog-categories.create') }}" class="btn btn-primary text-white mr-1 mb-4" type="button">Add New</a>
          <div class="tile">
            <div class="tile-body">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Banner</th>
                    <th>Slug</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                    @foreach($blog_categories as $blog_category)
                    <tr>
                        <td>{{ $blog_category->id }}</td>
                        <td>{{ $blog_category->name }}</td>
                        <td>
                            @if ($blog_category->banner != null)
                                <img src="{{ asset('storage/uploads/blogs/'.$blog_category->banner) }}" id="logoImg" style="width: 80px; height: auto;">
                            @endif  
                        </td>
                        <td>{{ $blog_category->slug }}</td>
                        <td>
                            <a href="{{ route('admin.blog-categories.show',['id'=>$blog_category->id]) }}" class="btn btn-primary text-white" type="button"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('admin.blog-categories.edit',['id'=>$blog_category->id]) }}" class="btn btn-secondary text-white" type="button"><i class="fas fa-edit"></i></a>
                            <a href="{{ route('admin.blog-categories.delete',['id'=>$blog_category->id]) }}" class="btn btn-danger text-white" type="button"><i class="fas fa-trash"></i></a>
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
