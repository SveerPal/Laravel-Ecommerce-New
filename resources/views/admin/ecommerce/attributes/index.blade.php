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
    
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('admin.product-attributes.create') }}" class="btn btn-primary text-white mr-1 mb-4" type="button"><i class="fas fa-plus"></i> Add Attribute</a>
          <div class="tile">
            <div class="tile-body">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>                    
                    <th>Code</th>
                    <th>Add Value</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                    @foreach($productattributes as $productattribute)
                    <tr>
                        <td>{{ $productattribute->id }}</td>
                        <td>{{ $productattribute->name }}</td>
                       
                        <td>{{ $productattribute->code }}</td>
                        <td> </td>
                        <td>
                            <a href="{{ route('admin.product-attributes.show',['id'=>$productattribute->id]) }}" class="btn btn-info text-white" type="button"><i class="fas fa-eye"></i></a>                           
                            <a href="{{ route('admin.product-attributes.edit',['id'=>$productattribute->id]) }}" class="btn btn-secondary text-white" type="button"><i class="fas fa-edit"></i></a>
                            <a href="{{ route('admin.product-attributes.delete',['id'=>$productattribute->id]) }}" class="btn btn-danger text-white" type="button"><i class="fas fa-trash"></i></a>
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
