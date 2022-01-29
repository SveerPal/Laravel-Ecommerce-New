@extends('admin.app')
@section('title')@endsection
@section('content')
<div class="app-title">
   <div>
      <h1><i class="fa fa-shopping-bag"></i>Edit Product </h1>
   </div>
</div>
<div class="row user">
   
   <div class="col-md-12">
       @foreach($products as $productsdetail)
      <form action="" method="POST" role="form" id="productForm" enctype="multipart/form-data">
            @csrf
         <div class="tab-content" id="dataAdd">         
            <div class="tab-pane active" id="general">
               <div class="tile">               
                  <h3 class="tile-title">Product Information</h3>
                  <hr>
                  <div class="tile-body">
                     <div class="form-group">
                        <label class="control-label" for="name">Name</label>
                        <input type="hidden" name="product_id" id="product_id" value="{{ $productsdetail->id }}">
                        <input class="form-control" type="text" placeholder="Enter name" id="name" name="name" value="{{ $productsdetail->name }}" />
                        <div class="invalid-feedback active">
                           <i class="fa fa-exclamation-circle fa-fw"></i><span class="name_error customerror" id="name_error"></span> 
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="control-label" for="slug">Slug</label>
                              <input class="form-control" type="text" placeholder="Enter attribute slug" id="slug" name="slug" value="{{ $productsdetail->slug }}" />
                              <div class="invalid-feedback active">
                                 <i class="fa fa-exclamation-circle fa-fw"></i> <span class="slug_error customerror" id="slug_error"></span> 
                              </div>
                           </div>                           
                        </div>   
                        <div class="col-md-6">   
                           <div class="form-group">
                              <label class="control-label" for="product_type">Product Type</label>
                              <div class="form-check">
                                 <label class="form-check-label">
                                 <input class="form-check-input" type="radio" id="product_type1" name="product_type" value="Simple" {{ ($productsdetail->product_type=="Simple")? "checked" : "" }}/>Simple
                                 </label>
                              </div>
                              <div class="form-check">   
                                 <label class="form-check-label">
                                 <input class="form-check-input" type="radio" id="product_type2" name="product_type" value="Variation" {{ ($productsdetail->product_type=="Variation")? "checked" : "" }}/>Variation
                                 </label>
                              </div>  
                                                          
                              <div class="invalid-feedback active d-block">
                                 <i class="fa fa-exclamation-circle fa-fw"></i>
                                    <span class="product_type_error customerror" id="product_type_error"></span>     
                              </div>
                              
                           </div>
                        </div>
                     </div>   
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="control-label" for="sku">SKU</label>
                              <input class="form-control"type="text" placeholder="Enter product sku" id="sku" name="sku" value="{{ $productsdetail->sku }}" />
                              <div class="invalid-feedback active">
                                 <i class="fa fa-exclamation-circle fa-fw"></i> <span class="sku_error customerror" id="sku_error"></span> 
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="control-label" for="image">Image</label>
                              <input type="file" class="form-control" id="image" name="image" value="{{ $productsdetail->image }}" />
                              <input type="hidden" class="form-control" id="old_image" name="old_image" value="{{ $productsdetail->image }}" />
                              @if($productsdetail->image !="")                              
                              <img src="{{ asset('storage/uploads/ecommerce/products/'.$productsdetail->image) }}" height="100px" width="100px">
                              @endif
                              <div class="invalid-feedback active">
                                 <i class="fa fa-exclamation-circle fa-fw"></i> <span class="image_error customerror" id="image_error"></span> 
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6 productadminselect2">
                           <div class="form-group">
                              <label class="control-label" for="categories">Categories</label>
                              <?php $categry="";
                                 if($productsdetail->category_id !="")
                                 $categry=explode(",",$productsdetail->category_id);
                              ?>
                              <select name="category_id[]" id="category_id" class="form-control" multiple>
                                 
                                 @foreach($categories as $category)
                                 <option value="{{ $category->id }}" {{ (in_array($category->id,$categry))? "selected" : "" }}>{{ $category->name }}</option>
                                 @endforeach
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="control-label" for="brand_id">Brand</label>
                              <select name="brand_id" id="brand_id" class="form-control">
                                 <option value="">Select a brand</option>
                                 @foreach($brands as $brand)
                                 <option value="{{ $brand->id }}" {{ ($productsdetail->brand_id==$brand->id)? "selected" : "" }}>{{ $brand->name }}</option>
                                 @endforeach
                              </select>
                              <div class="invalid-feedback active">
                                 <i class="fa fa-exclamation-circle fa-fw"></i> <span class="brand_id_error customerror" id="brand_id_error"></span> 
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="control-label" for="price">Price</label>
                              <input class="form-control" type="text" placeholder="Enter product price" id="price" name="price" value="{{ $productsdetail->price }}"/>
                              <div class="invalid-feedback active">
                                 <i class="fa fa-exclamation-circle fa-fw"></i> <span class="price_error customerror" id="price_error"></span> 
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="control-label" for="special_price">Special Price</label>
                              <input class="form-control" type="text" placeholder="Enter product special price" id="special_price" name="special_price"value="{{ $productsdetail->special_price }}" />
                              <div class="invalid-feedback active">
                                 <i class="fa fa-exclamation-circle fa-fw"></i> <span class="special_price_error customerror" id="special_price_error"></span> 
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="control-label" for="quantity">Quantity</label>
                              <input class="form-control" type="number" placeholder="Enter product quantity"id="quantity" name="quantity" value="{{ $productsdetail->quantity }}"/>
                              <div class="invalid-feedback active">
                                 <i class="fa fa-exclamation-circle fa-fw"></i> <span class="quantity_error customerror" id="quantity_error"></span> 
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label class="control-label" for="weight">Weight</label>
                              <input class="form-control" type="text" placeholder="Enter product weight" id="weight" name="weight" value="{{ $productsdetail->weight }}" />
                              <div class="invalid-feedback active">
                                 <i class="fa fa-exclamation-circle fa-fw"></i> <span class="weight_error customerror" id="weight_error"></span> 
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="form-group col-md-12">
                           <label class="control-label" for="short_description">Short Description</label>
                           <textarea name="short_description" id="short_description" rows="4" class="form-control">{{ $productsdetail->short_description }}</textarea>
                           <div class="invalid-feedback active">
                              <i class="fa fa-exclamation-circle fa-fw"></i> <span class="short_description_error customerror" id="short_description_error"></span> 
                           </div>
                        </div>
                     </div> 
                     <div class="row"> 
                        <div class="form-group col-md-12">
                           <label class="control-label" for="description">Description</label>
                           <textarea class="form-control" rows="8" placeholder="Enter  description" id="description" name="description" >{{ $productsdetail->description }}</textarea>
                           <div class="invalid-feedback active">
                              <i class="fa fa-exclamation-circle fa-fw"></i> <span class="description_error customerror" id="description_error"></span> 
                           </div>
                        </div> 
                     </div>   
                     <div class="form-group">
                        <div class="form-check">
                           <label class="form-check-label">
                           <input class="form-check-input" type="checkbox" id="status"
                              name="status" value="1" {{ ($productsdetail->status=='1')? "checked" : "" }}/>Status
                           </label>
                        </div>
                     </div>
                     <div class="form-group">
                        <div class="form-check">
                           <label class="form-check-label">
                           <input class="form-check-input" type="checkbox" id="featured"
                              name="featured" value="1" {{ ($productsdetail->featured=='1')? "checked" : "" }}/>Featured
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
                           <label class="control-label" for="gallery">Gallery</label>
                           <input class="form-control" type="file" id="gallery" name="gallery[]" multiple/>
                           <div class="invalid-feedback active">
                              <i class="fa fa-exclamation-circle fa-fw"></i> <span class="gallery_error" id="gallery_error"></span> 
                           </div>
                           <input type="hidden" class="form-control" id="old_gallery" name="old_gallery" value="{{ $productsdetail->gallery }}" /> 
                           @if($productsdetail->gallery !="")
                           <?php  $gallery=explode(',',$productsdetail->gallery); ?>
                              @for($g=0;$g < count($gallery);$g++)                              
                              <img src="{{ asset('storage/uploads/ecommerce/products/'.$gallery[$g]) }}" height="100px" width="100px">
                              @endfor
                           @endif                         
                        </div>
                     </div>
                  </div>
               </div> 
               <div class="tile attrproduct @if($productsdetail->product_type!='Variation')d-none @endif">
                  <h3 class="tile-title">Add Variation Product</h3>
                  <span class="variationproduct">
                  @if($productsdetail->product_type=='Variation')   
                  @foreach($products_variations as $provaridetail)
                  <div class="row form-row">
                     <div class="col-md-3 attributediv">
                        <div class="form-group">
                           <input type="hidden" name="product_variation_id[]" value="{{ $provaridetail->id }}">
                           <label for="parent">Select Attribute <span class="m-l-5 text-danger"> *</span></label>
                           <select onload="getVariationSelected(this,{{ $provaridetail->attribute_variation_id }})" onchange="getVariation(this)" class="form-control custom-select mt-15 attribute_id" name="attribute_id[]" id="attribute_id_1">
                             <option value=""> Select </option>
                             @foreach($attributes as $attribute):
                              <option value="{{ $attribute->id }}" {{ ($provaridetail->attribute_id==$attribute->id)? "selected" : "" }}>{{ $attribute->name }}  </option>
                             @endforeach
                           </select>
                           <div class="invalid-feedback active">
                              <i class="fa fa-exclamation-circle fa-fw"></i> <span class="attribute_id_1_error customerror" id="attribute_id_1_error"></span> 
                           </div>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="variation_values">Select Variation <span class="m-l-5 text-danger"> *</span></label>
                           <select class="form-control variation mt-15 attribute_variation_id variation" name="attribute_variation_id[]" id="attribute_variation_id_1">
                              <option value=""> Select </option>
                              @foreach($attribute_values as $pro_att_val):
                                 <option value="{{ $pro_att_val->id }}" >{{ $pro_att_val->name }}  </option>
                              @endforeach
                           </select>
                           <div class="invalid-feedback active">
                              <i class="fa fa-exclamation-circle fa-fw"></i> <span class="attribute_variation_id_1_error customerror" id="attribute_variation_id_1_error"></span> 
                           </div>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="form-group">
                           <label class="control-label" for="variation_quantity1">Quantity</label>
                           <input class="form-control" type="number" id="variation_quantity_1" min="0" name="variation_quantity[]"/ value="{{ $provaridetail->variation_quantity }}">
                           <div class="invalid-feedback active">
                              <i class="fa fa-exclamation-circle fa-fw"></i> <span class="variation_quantity_1_error customerror" id="variation_quantity_1_error"></span> 
                           </div>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="form-group">
                           <label class="control-label" for="variation_price1">Price</label>
                           <input class="form-control" type="text" id="variation_price_1" name="variation_price[]" value="{{ $provaridetail->variation_price }}"/>
                           <div class="invalid-feedback active">
                              <i class="fa fa-exclamation-circle fa-fw"></i> <span class="variation_price_1_error customerror" id="variation_price_1_error"></span> 
                           </div>
                        </div>                        
                     </div>
                     <div class="col-md-3">
                        <div class="form-group">
                           <label class="control-label" for="variation_special_price1">Special Price</label>
                           <input class="form-control" type="text" id="variation_special_price_1" name="variation_special_price[]" value="{{ $provaridetail->variation_special_price }}"/>
                           <div class="invalid-feedback active">
                              <i class="fa fa-exclamation-circle fa-fw"></i> <span class="variation_special_price_1_error customerror" id="variation_special_price_1_error"></span> 
                           </div>
                        </div>
                     </div>
                     <div class="col-md-3">
                        <div class="form-group">
                           <label for="variation_image">Image <span class="m-l-5 text-danger"> *</span></label>
                           <input id="variation_image_1" type="file" class="form-control  mt-15" name="variation_image[]">
                           
                              <input type="hidden" class="form-control" id="old_variation_image" name="old_variation_image[]" value="{{ $provaridetail->variation_image }}" />
                           @if($provaridetail->variation_image !="")   
                              <img src="{{ asset('storage/uploads/ecommerce/products/'.$provaridetail->variation_image) }}" height="100px" width="100px">
                           @endif
                           <div class="invalid-feedback active">
                              <i class="fa fa-exclamation-circle fa-fw"></i> <span class="variation_image_1_error customerror" id="variation_image_1_error"></span> 
                           </div>                             
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="form-group">
                           <label class="control-label" for="variation_description">Description</label>
                           <textarea class="form-control" type="text" rows="2" id="variation_description" name="variation_description[]">{{ $provaridetail->variation_description }}</textarea>                           
                        </div>
                     </div> 
                     <hr  class="col-md-12">                    
                  </div>
                  @endforeach
                  @endif
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
                           <textarea class="form-control" rows="1" placeholder="Enter Meta Title" id="meta_title" name="meta_title">{{ $productsdetail->meta_title }}</textarea>
                        </div>
                        <div class="form-group col-md-6">
                           <label class="control-label" for="meta_keywords">Meta Keywords</label>
                           <textarea class="form-control" rows="1" placeholder="Enter Meta Title" id="meta_keywords" name="meta_keywords">{{ $productsdetail->meta_keywords }}</textarea>                           
                        </div>
                        <div class="form-group col-md-12">
                           <label class="control-label" for="meta_description">Meta Description</label>
                           <textarea class="form-control" rows="4" placeholder="Enter seo meta description for store" id="meta_description" name="meta_description" >{{ $productsdetail->meta_description }}</textarea>
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
      @endforeach  
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
       $('#category_id').select2();
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
$(document).ready(function () {
   var attropt=Array();
   @foreach($attributes as $attribute)
      attropt+='<option value="{{ $attribute->id }}" >{{ $attribute->name }}  </option>';
   @endforeach
   var len=$('#dataAdd .variationproduct .form-row').length+1;  
   $("#addRow").click(function(){ 
      $("#dataAdd .variationproduct:last").append('<div class="row form-row"><div class="col-md-3 attributediv"><div class="form-group"><label for="parent">Select Attribute<span class="m-l-5 text-danger">*</span></label><select onchange="getVariation(this)" class="form-control custom-select mt-15 attribute_id" name="attribute_id[]" id="attribute_id_'+len+'"><option value="">Select</option>'+attropt+'</select><div class="invalid-feedback active"><i class="fa fa-exclamation-circle fa-fw"></i><span class="attribute_id_'+len+'_error customerror" id="attribute_id_'+len+'_error"></span></div></div></div><div class="col-md-3"><div class="form-group"><label for="variation_values">Select Variation<span class="m-l-5 text-danger">*</span></label><select class="form-control variation mt-15 attribute_variation_id variation" name="attribute_variation_id[]" id="attribute_variation_id_'+len+'"><option value="">Select</option></select><div class="invalid-feedback active"><i class="fa fa-exclamation-circle fa-fw"></i><span class="attribute_variation_id_'+len+'_error customerror" id="attribute_variation_id_'+len+'_error"></span></div></div></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="variation_quantity1">Quantity</label><input class="form-control" type="number" min="0" id="variation_quantity_'+len+'" name="variation_quantity[]"><div class="invalid-feedback active"><i class="fa fa-exclamation-circle fa-fw"></i><span class="variation_quantity_'+len+'_error  customerror" id="variation_quantity_'+len+'_error"></span></div></div></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="variation_price1">Price</label><input class="form-control" type="text" id="variation_price_'+len+'" name="variation_price[]"><div class="invalid-feedback active"><i class="fa fa-exclamation-circle fa-fw"></i><span class="variation_price_'+len+'_error  customerror" id="variation_price_'+len+'_error"></span></div></div></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="variation_special_price1">Special Price</label><input class="form-control" type="text" id="variation_special_price_'+len+'" name="variation_special_price[]"><div class="invalid-feedback active"><i class="fa fa-exclamation-circle fa-fw"></i><span class="variation_special_price_'+len+'_error customerror" id="variation_special_price_'+len+'_error"></span></div></div></div><div class="col-md-3"><div class="form-group"><label for="variation_image">Image<span class="m-l-5 text-danger">*</span></label><input id="variation_image_'+len+'" type="file" class="form-control mt-15" name="variation_image[]"><div class="invalid-feedback active"><i class="fa fa-exclamation-circle fa-fw"></i><span class="variation_image_'+len+'_error customerror" id="variation_image_'+len+'_error"></span></div></div></div><div class="col-md-6"><div class="form-group"><label class="control-label" for="variation_description">Description</label><textarea class="form-control" type="text" rows="2" id="variation_description" name="variation_description[]"></textarea></div></div><hr class="col-md-12"></div>');           
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

$('.attribute_id').trigger('load');

//Get Variation Selected
function getVariationSelected(ele,variation_id){
   
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
         
         var var_length=response.length;
         for(l=0;l<var_length;l++){
            if(response[l].id==variation_id){
               var seleted="selected";
            }else{
               var seleted="";
            }
            opt +=' <option value="'+response[l].id+'" '+seleted+'>'+response[l].name+'</option>';

         }
         $(ele).closest('.attributediv').next().find('.variation').first().html(opt);
      }
   });  
}

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
   var priductId=jQuery('#product_id').val();  
   var url = "{{ route('admin.products.update',':id') }}";
   url = url.replace(':id',priductId);

   if(priductId!='' && priductId!=null){
      var formData = new FormData(this);
      $.ajax({
         type : "post",     
         url:url,
         data:formData,
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
                    title: "Success",
                    text: "Product has been updated successfully",
                    type: "success",
                  }, function () {
                    window.location="{{ route('admin.products') }}";
               })
            }else{
               swal("Validation Error!",'Please check all field and fill valid data' , "error");
               var v=1;
               $('body' ).find('.is-invalid').removeClass('is-invalid');
               $('.customerror').text("");
               $.each(response.errors, function (key, val) {
                 
                  if(key.includes('gallery')==true){
                     $("#gallery" ).addClass('is-invalid');
                     $("#gallery_error" ).text(val[0]);
                  }else if(key.includes('attribute')==true || key.includes('variation')==true){
                     
                     var keyy=key.split('.');
                     console.log(keyy[0]+"_"+v)
                     
                     key1=parseInt(keyy[1])+1;
                     //console.log("#" + keyy[0]+"_"+key1)
                     $("#" + keyy[0]+"_"+key1 ).addClass('is-invalid');
                     $("#" + keyy[0]+"_"+key1+"_error" ).text(val[0]);
                     v++;
                  }else{
                     $("#" + key ).addClass('is-invalid');
                     $("#" + key+"_error" ).text(val[0]);
                  }
               });        
            }
         },
         error: function(requestObject, error, errorThrown) {
            swal("Error!",errorThrown , "error");
           jQuery('.msg').html('<div class="alert alert-danger" role="alert">'+errorThrown+'</div>');
           
         }

      });  
   }else{
      swal({
              title: "Product Error!",
              text: "Please reload page",
              type: "error",
            }, function () {
              window.location.reload();
         })
   }   
})
</script>
@endpush