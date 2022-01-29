@extends('admin.app')

@section('title') {{ $title }} @endsection

@section('content')
    <div class="app-title">
        <div>
            <h1><i class="fa fa-shopping-bag"></i> {{ $title }}</h1>
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
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary text-white mr-1 mb-4" type="button">Add New</a>
          <div class="tile">
            <div class="tile-body">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Slug</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                    @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>
                            @if ($product->image != null)
                                <img src="{{ asset('storage/uploads/ecommerce/products/'.$product->image) }}" id="logoImg" style="width: 80px; height: auto;">
                            @endif  
                        </td>
                        <td>{{ $product->slug }}</td>
                        <td>{{ $product->status }}</td>
                        <td>
                            <a href="{{ route('admin.products.show',['id'=>$product->id]) }}" class="btn btn-primary text-white" type="button">View</a>
                            <a href="{{ route('admin.products.edit',['id'=>$product->id]) }}" class="btn btn-secondary text-white" type="button">Edit</a>
                            <a onclick="deleteProduct({{ $product->id }})" class="btn btn-danger text-white" type="button">Delete</a>
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

    <script type="text/javascript">
        function deleteProduct(priductId){
          
           var url = "{{ route('admin.products.delete',':id') }}";
           url = url.replace(':id',priductId);

            if(priductId!='' && priductId!=null){
                swal({
                        title: "Are you sure?",
                        text: "You will not be able to recover this product!",
                        type: "warning",
                        showCancelButton: true,
                       // confirmButtonColor: '#DD6B55',
                        confirmButtonText: 'Yes, I am sure!',
                        cancelButtonText: "No, cancel it!",
                        closeOnConfirm: false,
                        closeOnCancel: true
                    }, function (isConfirm) {
                    if (isConfirm){

                              
                           
                        $.ajax({
                            type : "get",     
                            url:url,
                            data:priductId,
                            cache:false,
                            contentType: false,
                            processData: false,
                            dataType:'json',
                            beforeSend : function() {
                                $(".updbtn").attr("disabled","disabled");
                                //$(".procees").show();
                            },
                            success : function(response) {

                                $(".updbtn").removeAttr("disabled","disabled");
                                // $(".procees").hide();
                                // console.log(response);
                                if(response.status==true){
                                   swal({
                                        title: "Product Deleted",
                                        text: "Product has been deleted successfully",
                                        type: "success",
                                      }, function () {
                                        window.location="{{ route('admin.products') }}";
                                   })
                                }else{
                                   swal("Oops!",'Something went wrong please try again' , "error");
                                          
                                }
                            },
                            error: function(requestObject, error, errorThrown) {
                                swal("Error!",errorThrown , "error");  
                            }
                        });
                    } else {
                      swal("Cancelled", "Your product is safe :)", "error");
                         e.preventDefault();
                    }   
                }) 
            }else{
              swal({
                      title: "Product Error!",
                      text: "Please reload page",
                      type: "error",
                    }, function () {
                      window.location.reload();
                 })
            }   
        }
    </script>
@endpush
