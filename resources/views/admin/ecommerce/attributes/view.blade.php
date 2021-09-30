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
            <a href="{{ route('admin.product-attributes') }}" class="btn btn-primary text-white mr-1 mb-4" type="button">Back To Product Attributes</a>            
          <div class="tile">
            <div class="tile-body">
              <table class="table table-hover table-bordered" id="sampleTable2">
                <tbody>
                    <tr><th>ID</th><td>{{ $productattributes->id }}</td></tr>
                    <tr> <th>Name</th><td>{{ $productattributes->name }}</td></tr>
                    
                    <tr><th>Slug</th><td>{{ $productattributes->code }}</td></tr>                     
                </tbody>
              </table>
            </div>
          </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-primary text-white mr-1 mb-4" onclick="addvalue({{ $productattributes->id }},'{{ $productattributes->name }}')" type="button"><i class="fas fa-plus"></i> Add Attribute Value</a>
          <div class="tile">
            <div class="tile-body">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Value</th> 
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>

                    @foreach($productattributesvalues as $productattributesvalue)
                    <tr>
                        <td>{{ $productattributesvalue->id }}</td>
                        <td>{{ $productattributesvalue->value }}</td>
                        <td>                                                    
                            <a onclick="updatevalue({{ $productattributesvalue->id }},'{{ $productattributesvalue->value }}')"class="btn btn-secondary text-white" type="button"><i class="fas fa-edit"></i></a>
                            <a href="{{ route('admin.product-attributes-value.delete',['id'=>$productattributesvalue->id,'attr_id'=>$productattributes->id]) }}" class="btn btn-danger text-white" type="button"><i class="fas fa-trash"></i></a>
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
<!-- Button trigger modal -->
<button type="button" id="valuemodel" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"></button>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  method="post" id="attributeValueForm">
                    @csrf
                    <div class="form-group col-md-8">
                        <input type="text" name="productattribute_id" id="productattribute_id" class="form-control">
                        <label class="control-label" for="value"> Attribute Value</label>
                        <input class="form-control" type="text" placeholder="Enter  Value" id="value" name="value" value="{{ old('value') }}"/>
                        @error('value')
                            <div class="alert alert-danger error">{{ $message }}</div>
                        @enderror                                  
                    </div>                  
                </form>
                <span class="msg"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="saveAttributeValue()">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- Button trigger modal -->
<button type="button" id="updatevaluemodel" class="btn btn-primary" data-toggle="modal" data-target="#updateModalCenter"></button>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="updateModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateexampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  method="post" id="updateattributeValueForm">
                    @csrf
                    <div class="form-group col-md-8">
                        <input type="text" name="productattribute_id" id="updateproductattribute_id" class="form-control">
                        <label class="control-label" for="value"> Attribute Value</label>
                        <input class="form-control" type="text" placeholder="Enter  Value" id="updatevalue" name="value" value="{{ old('value') }}"/>
                        @error('value')
                            <div class="alert alert-danger error">{{ $message }}</div>
                        @enderror                                  
                    </div>                  
                </form>
                <span class="msgupdate"></span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="updateAttributeValue()">Save</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script type="text/javascript" src="{{ asset('backend/js/plugins/jquery.dataTables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/plugins/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
    <script type="text/javascript">
        function addvalue(id,attrName){
            jQuery('#exampleModalLongTitle').text('Add '+attrName+' Value');
            jQuery('#productattribute_id').val(id);
            jQuery('#valuemodel').trigger('click');
            
           // alert(id);
        }

        function updatevalue(id,attrValue){
            jQuery('#updateexampleModalLongTitle').text('Update Value');
            jQuery('#updateproductattribute_id').val(id);
            jQuery('#updatevalue').val(attrValue);
            jQuery('#updatevaluemodel').trigger('click');
            
           // alert(id);
        }

        function saveAttributeValue(){
            var data=jQuery('#attributeValueForm').serialize();
            jQuery.ajax({
                url:"{{ route('admin.product-attributes-value.store') }}",
                dataType:'json',
                data:data,
                method:'post',
                beforeSend:function (argument) {
                   
                },
                success :function(response){
                    var err=[];
                    $.each(response.errors, function (key, val) {
                        err.push('<li>'+val[0]+'</li>');
                       // $("#" + key + "_error").text(val[0]);
                    });
                    if(response.status==true){
                        jQuery('.msg').html('<div class="alert alert-success" role="alert">'+response.value+'! Has been Add Successfully </div>');
                        setTimeout(function(){
                            window.location.reload();
                        },2000);
                    }else{
                       
                        jQuery('.msg').html('<div class="alert alert-danger" role="alert">'+err+'</div>');          
                    }
                },
                error: function(requestObject, error, errorThrown) {
                    jQuery('.msg').html('<div class="alert alert-danger" role="alert">'+errorThrown+'</div>');
                    
                }
            });
            setTimeout(function(){
                jQuery('.msg').html('');
            },5000);
        }

        function updateAttributeValue(){
            var data=jQuery('#updateattributeValueForm').serialize();
            var updateproductattribute_id=jQuery('#updateproductattribute_id').val();
            alert(updateproductattribute_id)
            jQuery.ajax({
               // url:"{{ route('admin.product-attributes-value.update',['id' => "+updateproductattribute_id+"]) }}",
                
                url:"/admin/product-attributes-value/update/"+updateproductattribute_id,
                dataType:'json',
                data:data,
                method:'post',
                beforeSend:function (argument) {
                   
                },
                success :function(response){
                    var err=[];
                    $.each(response.errors, function (key, val) {
                        err.push('<li>'+val[0]+'</li>');
                       // $("#" + key + "_error").text(val[0]);
                    });
                    if(response.status==true){
                        jQuery('.msgupdate').html('<div class="alert alert-success" role="alert">'+response.value+'! Has been Updated Successfully </div>');
                        setTimeout(function(){
                            window.location.reload();
                        },2000);
                    }else{
                       
                        jQuery('.msgupdate').html('<div class="alert alert-danger" role="alert">'+err+'</div>');          
                    }
                },
                error: function(requestObject, error, errorThrown) {
                    jQuery('.msgupdate').html('<div class="alert alert-danger" role="alert">'+errorThrown+'</div>');
                    
                }
            });
            setTimeout(function(){
                jQuery('.msgupdate').html('');
            },5000);
        }
    </script>
@endpush