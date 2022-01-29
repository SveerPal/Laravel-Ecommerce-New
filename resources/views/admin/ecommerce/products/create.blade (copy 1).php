@extends('admin.app')
@section('title')@endsection
@section('content')
<div class="app-title">
   <div>
      <h1><i class="fa fa-shopping-bag"></i> </h1>
   </div>
</div>
<div class="row user">
   
   <div class="col-md-12">
      <form action="{{ route('admin.products.store') }}" method="POST" role="form" id="productForm" enctype="multipart/form-data">
            @csrf
         <div class="tab-content" id="dataAdd">         
            <div class="tab-pane active" id="general">
               <div class="tile">               
                  <h3 class="tile-title">Product Information</h3>
                  <hr>
                  <div class="tile-body">
                     <div class="form-group">
                        <label class="control-label" for="name">Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" placeholder="Enter attribute name" id="name" name="name" value="{{ old('name') }}" />
                        <div class="invalid-feedback active">
                           <i class="fa fa-exclamation-circle fa-fw"></i> @error('name') <span >{{ $message }}</span> @enderror
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="control-label" for="slug">Slug</label>
                              <input class="form-control @error('slug') is-invalid @enderror" type="text" placeholder="Enter attribute slug" id="slug" name="slug" value="{{ old('slug') }}" />
                              <div class="invalid-feedback active">
                                 <i class="fa fa-exclamation-circle fa-fw"></i> @error('slug') <span>{{ $message }}</span> @enderror
                              </div>
                           </div>                           
                        </div>   
                        <div class="col-md-6">   
                           <div class="form-group">
                              <label class="control-label" for="product_type">Product Type</label>
                              <div class="form-check">
                                 <label class="form-check-label">
                                 <input  class="form-check-input" type="radio" id="product_type1" name="product_type" value="Simple" @if(old('product_type') == 'Simple') checked @endif />Simple
                                 </label>
                              </div>
                              <div class="form-check">   
                                 <label class="form-check-label">
                                 <input class="form-check-input" type="radio" id="product_type2" name="product_type" value="Variation" @if(old('product_type') == 'Variation') checked @endif/>Variation
                                 </label>
                              </div>  
                              @error('product_type')                            
                              <div class="invalid-feedback active d-block">
                                 <i class="fa fa-exclamation-circle fa-fw"></i>
                                    <span>{{ $message }}</span>     
                              </div>
                              @enderror
                           </div>
                        </div>
                     </div>   
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="control-label" for="sku">SKU</label>
                              <input class="form-control @error('sku') is-invalid @enderror"type="text" placeholder="Enter product sku" id="sku" name="sku" value="{{ old('sku') }}" />
                              <div class="invalid-feedback active">
                                 <i class="fa fa-exclamation-circle fa-fw"></i> @error('sku') <span>{{ $message }}</span> @enderror
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="control-label" for="image">Image</label>
                              <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{ old('image') }}" />
                              <div class="invalid-feedback active">
                                 <i class="fa fa-exclamation-circle fa-fw"></i> @error('image') <span>{{ $message }}</span> @enderror
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6 productadminselect2">
                           <div class="form-group">
                              <label class="control-label" for="categories">Categories</label>
                              <select name="category_id[]" id="categories_id" class="form-control" multiple>
                                 @foreach($categories as $category)
                                 <option value="{{ $category->id }}">{{ $category->name }}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="control-label" for="brand_id">Brand</label>
                              <select name="brand_id" id="brand_id" class="form-control @error('brand_id') is-invalid @enderror">
                                 <option value="0">Select a brand</option>
                                 @foreach($brands as $brand)
                                 <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                 @endforeach
                              </select>
                              <div class="invalid-feedback active">
                                 <i class="fa fa-exclamation-circle fa-fw"></i> @error('brand_id') <span>{{ $message }}</span> @enderror
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="control-label" for="price">Price</label>
                              <input class="form-control @error('price') is-invalid @enderror" type="text" placeholder="Enter product price"
                                 id="price" name="price" value="{{ old('price') }}"
                                 />
                              <div class="invalid-feedback active">
                                 <i class="fa fa-exclamation-circle fa-fw"></i> @error('price') <span>{{ $message }}</span> @enderror
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="control-label" for="special_price">Special Price</label>
                              <input class="form-control" type="text" placeholder="Enter product special price" id="special_price" name="special_price"value="{{ old('special_price') }}" />
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="control-label" for="quantity">Quantity</label>
                              <input class="form-control @error('quantity') is-invalid @enderror" type="number" placeholder="Enter product quantity"id="quantity" name="quantity" value="{{ old('quantity') }}"/>
                              <div class="invalid-feedback active">
                                 <i class="fa fa-exclamation-circle fa-fw"></i> @error('quantity') <span>{{ $message }}</span> @enderror
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="control-label" for="weight">Weight</label>
                              <input class="form-control" type="text" placeholder="Enter product weight" id="weight" name="weight" value="{{ old('weight') }}" />
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-12">
                            <label class="control-label" for="short_description">Short Description</label>
                            <textarea name="short_description" id="short_description" rows="4" class="form-control">{{ old('short_description') }}</textarea>
                            @error('short_description')
                                <div class="alert alert-danger error">{{ $message }}</div>
                            @enderror  
                        </div>
                     </div> 
                     <div class="row"> 
                        <div class="form-group col-md-12">
                            <label class="control-label" for="description">Description</label>
                            <textarea class="form-control" rows="8" placeholder="Enter  description" id="description" name="description" >{{ old('description') }}</textarea>
                            @error('description')
                                <div class="alert alert-danger error">{{ $message }}</div>
                            @enderror    
                        </div> 
                     </div>   
                     <div class="form-group">
                        <div class="form-check">
                           <label class="form-check-label">
                           <input class="form-check-input" type="checkbox" id="status"
                              name="status" value="1" />Status
                           </label>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="form-check">
                           <label class="form-check-label">
                           <input class="form-check-input" type="checkbox" id="featured"
                              name="featured" value="1" />Featured
                           </label>
                        </div>
                     </div>
                  </div>                  
               </div>

               <div class="tile">
                  <h3 class="tile-title">Gallery Images</h3>
                  <hr>
                  <div class="tile-body">
                     <div class="row">  
                        <div class="form-group col-md-12">
                           <label class="control-label" for="meta_title">Gallery</label>
                           <input class="form-control" type="file" id="gallery" name="gallery[]" multiple/>
                           @error('gallery')
                              <div class="alert alert-danger error">{{ $message }}</div>
                           @enderror
                        </div>
                     </div>
                  </div>
               </div> 

               <div class="tile attrproduct d-none">
                  <h3 class="tile-title">Add Variation Product</h3>
                  <span class="variationproduct">
                  <div class="row form-row">
                     <div class="col-md-3 attributediv">
                        <div class="form-group">
                           <label for="parent">Select Attribute <span class="m-l-5 text-danger"> *</span></label>
                           <select onchange="getVariation(this)" class="form-control custom-select mt-15 attribute_id" name="attribute_id[]">
                             <option value=""> Select </option>
                             @foreach($attributes as $attribute):
                              <option value="{{ $attribute->id }}" >{{ $attribute->name }}  </option>
                             @endforeach
                           </select>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="variation_values">Select Variation <span class="m-l-5 text-danger"> *</span></label>
                           <select class="form-control variation mt-15 attribute_variation_id variation" name="attribute_variation_id[]">
                              <option value=""> Select </option>
                           </select>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="form-group">
                           <label class="control-label" for="variation_quantity">Quantity</label>
                           <input class="form-control" type="number" id="variation_quantity" name="variation_quantity[]"/>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="form-group">
                           <label class="control-label" for="variation_price">Price</label>
                           <input class="form-control" type="text" id="variation_price" name="variation_price[]"/>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="form-group">
                           <label class="control-label" for="variation_spacial_price">Special Price</label>
                           <input class="form-control" type="text" id="variation_spacial_price" name="variation_spacial_price[]"/>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="variation_image">Image <span class="m-l-5 text-danger"> *</span></label>
                           <input id="variation_image" type="file" class="form-control  mt-15" name="variation_image[]">                              
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="control-label" for="variation_description">Description</label>
                           <textarea class="form-control" type="text" rows="2" id="variation_description" name="variation_description[]"></textarea>                           
                        </div>
                     </div> 
                     <hr  class="col-md-12">                    
                  </div>
                  </span>
                  <div class="row">
                     <button class="btn btn-primary addProductVariation" type="button"  id="addRow"><i class="fa fa-fw fa-lg fa-plus"></i>Add</button>&nbsp;
                     <button class="btn btn-danger removeProductVariation" type="button" id="deleteRow"><i class="fa fa-fw fa-lg fa-trash"></i>Remove</button>
                  </div>
               </div>
               <div class="tile">
                  <h3 class="tile-title">Meta Information</h3>
                  <hr>
                  <div class="tile-body">
                     <div class="row">  
                        <div class="form-group col-md-6">
                           <label class="control-label" for="meta_title">Meta Title</label>
                           <textarea class="form-control" rows="1" placeholder="Enter Meta Title" id="meta_title" name="meta_title">{{ old('meta_title') }}</textarea>
                           @error('meta_title')
                              <div class="alert alert-danger error">{{ $message }}</div>
                           @enderror
                        </div>
                        <div class="form-group col-md-6">
                           <label class="control-label" for="meta_keywords">Meta Keywords</label>
                           <textarea class="form-control" rows="1" placeholder="Enter Meta Title" id="meta_keywords" name="meta_keywords">{{ old('meta_keywords') }}</textarea>
                           @error('meta_keywords')
                              <div class="alert alert-danger error">{{ $message }}</div>
                           @enderror
                        </div>
                        <div class="form-group col-md-12">
                           <label class="control-label" for="meta_description">Meta Description</label>
                           <textarea class="form-control" rows="4" placeholder="Enter seo meta description for store" id="meta_description" name="meta_description" >{{ old('meta_description') }}</textarea>
                           @error('meta_description')
                              <div class="alert alert-danger error">{{ $message }}</div>
                           @enderror    
                        </div>
                     </div>
                  </div>
               </div> 
               <div class="tile-footer">
                  <div class="row d-print-none mt-2">
                     <div class="col-12 text-right">
                        <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Product</button>
                        <a class="btn btn-danger" href="{{ route('admin.products') }}"><i class="fa fa-fw fa-lg fa-arrow-left"></i>Go Back</a>
                     </div>
                  </div>
               </div>

            </div>
            
                    
         </div>
      </form>   
   </div>
</div>
<div class="procees" style="display: none">
    <div class="center">
        <img  src="{{ asset('backend/images/spinner.gif') }}" />
    </div>
</div>
<style type="text/css">
   
    .procees
    {
        position: fixed;
        z-index: 99999;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        background-color: Black;
        filter: alpha(opacity=60);
        opacity: 0.6;
        -moz-opacity: 0.8;
    }
    .center
    {
        z-index: 9999999;
        margin: 10% auto;
        paddingg: 10px;
        width: 7%;
        background-color: White;
        border-radius: 10px;
        filter: alpha(opacity=100);
        opacity: 1;
        -moz-opacity: 1;
    }
    .center img
    {
        height: 128px;
        width: 128px;
    }
    
.center img {
    position: absolute;
    top: 50%;
    background: #fff;
    border-radius: 20px;
    z-index: 9999;
}
</style>
@endsection
@push('scripts')
<script type="text/javascript" src="{{ asset('backend/js/plugins/select2.min.js') }}"></script>
<script>
   $( document ).ready(function() {
       $('#categories_id').select2();
   });
</script>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script>
   CKEDITOR.replace( 'description' );
   CKEDITOR.replace( 'short_description' );

   $('input[type=radio][name=product_type]').change(function() {
      
       if (this.value == 'Variation') {
           $('.attrproduct').removeClass('d-none')
       }
       else  {
           $('.attrproduct').addClass('d-none')
       }
   });
</script>
<script type="text/javascript">
@if(old('product_type') == 'Variation')
    $('#product_type2').trigger('click');
    alert("oo");
@endif   
$(document).ready(function () {
   var attropt=Array();
   @foreach($attributes as $attribute)
      attropt+='<option value="{{ $attribute->id }}" >{{ $attribute->name }}  </option>';
   @endforeach
     
   $("#addRow").click(function(){ 
      $("#dataAdd .variationproduct:last").append('<div class="row form-row"><div class="col-md-3 attributediv"><div class="form-group"><label for="parent">Select Attribute <span class="m-l-5 text-danger">*</span></label><select onchange="getVariation(this)" class="form-control custom-select mt-15 attribute_id" name="attribute_id[]"><option value="">Select</option>'+attropt+'</select></div></div><div class="col-md-3"><div class="form-group"><label for="variation_values">Select Variation <span class="m-l-5 text-danger">*</span></label><select class="form-control mt-15 attribute_variation_id variation" name="attribute_variation_id[]"><option value="">Select</option></select></div></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="variation_quantity">Quantity</label><input class="form-control" type="number" id="variation_quantity" name="variation_quantity[]"></div></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="variation_price">Price</label><input class="form-control" id="variation_price" name="variation_price[]"></div></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="variation_spacial_price">Special Price</label><input class="form-control" id="variation_spacial_price" name="variation_spacial_price[]"></div></div><div class="col-md-3"><div class="form-group"><label for="variation_image">Image <span class="m-l-5 text-danger">*</span></label><input id="variation_image" type="file" class="form-control mt-15" name="variation_image[]"></div></div><div class="col-md-6"><div class="form-group"><label class="control-label" for="variation_description">Description</label><textarea class="form-control" type="text" rows="2" id="variation_description" name="variation_description[]"></textarea></div></div><hr class="col-md-12"></div>');           
   });
});
$("#deleteRow").click(function(){
  var len=$('#dataAdd .variationproduct .form-row').length;
  if(len>1){
      
      <?php //if($_REQUEST['fld_id']!=""){ ?>
     var variation_id= $("#dataAdd .variationproduct .form-row").last().find('.fld_id_variation').val();
     //alert(variation_id)
      $.ajax({
          type : "POST",
          url : "get_attri_variation.php",
          data : {delete_variation:'delete_variation',variation_id:variation_id},
          dataType:'json',
          beforeSend : function() {
               // $(".post_submitting").show().html("<center><img src='images/loading.gif'/></center>");
          },
          success : function(response) {
              console.log(response);
              if(response.sts==1){
                $("#dataAdd .variationproduct .form-row").last().remove(); 
              }else{alert("Something Went Wrong");}
              
          }
      });
      <?php //}else{ ?>
      
      $("#dataAdd .variationproduct .form-row").last().remove();
      <?php //} ?>
  }else{
      alert('Not able to Delete');
  }
});

//Get Variation 
function getVariation(ele){
   var attr_id=$('option:selected',ele).attr('value');
   var opt=Array();
   opt+='<option value="">Select</option>';
   // alert(attr_id);
   if(attr_id==""){
      alert("Please Select Attribute");
      $(ele).closest('.attributediv').next().find('.variation').first().html(opt);
      return false;
   }    
   $.ajax({
      type : "get",     
      url:"/admin/product-attributes-variation/getvariation/"+attr_id,
      data : {attribute:attr_id,"_token":"{{ csrf_token() }}"},
      dataType:'json',
      beforeSend : function() {
         $(".procees").show();
      },
      success : function(response) {
         $(".procees").hide();
         console.log(response);
         var var_length=response.length;
         for(l=0;l<var_length;l++){
            opt +=' <option value="'+response[l].id+'">'+response[l].name+'</option>';
         }
         $(ele).closest('.attributediv').next().find('.variation').first().html(opt);
      }
   });  
}
$('#productForm').submit(function(e){
   e.preventDefault();
   $.ajax({
      type : "post",     
      url:"{{ route('admin.products.store') }}",
      data : $('#productForm').serialize(),
      dataType:'json',
      beforeSend : function() {
         $(".updbtn").attr("disabled","disabled");
         $(".procees").show();
      },
      success : function(response) {
         $(".updbtn").removeAttr("disabled","disabled");
         $(".procees").hide();
         console.log(response);
         var err=[];
         $.each(response.errors, function (key, val) {
            //err.push('<li>'+val[0]+'</li>');
            alert(key)
            $("#" + key ).text(val[0]);
         });
         if(response.status==true){
            jQuery('.msg').html('<div class="alert alert-success" role="alert">'+response.value+'! Has been Updated Successfully </div>');
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
})
</script>
@endpush