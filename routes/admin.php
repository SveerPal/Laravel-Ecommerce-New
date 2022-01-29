<?php 
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\SlidersController;
use App\Http\Controllers\Admin\TestimonialsController;
use App\Http\Controllers\Admin\ClientelesController;
use App\Http\Controllers\Admin\FaqsController;
use App\Http\Controllers\Admin\GalleriesController;
use App\Http\Controllers\Admin\Blog_CategoriesController;
use App\Http\Controllers\Admin\Blog_TagsController;
use App\Http\Controllers\Admin\BlogsController;
use App\Http\Controllers\Admin\UsersController;

use App\Http\Controllers\Admin\ProductCategoriesController;
use App\Http\Controllers\Admin\ProductBrandsController;
use App\Http\Controllers\Admin\ProductAttributesController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\OrdersController;

use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Blog;
use App\Models\Order;
use App\Models\User;

Auth::routes();
Route::group(['prefix'  =>  'admin'], function () {

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
	Route::post('/login', [LoginController::class, 'login'])->name('admin.login.post');
	Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');



    Route::group(['middleware' => ['auth:admin']], function () {

	    Route::get('/', function () {
	    	$pcnt = DB::table('products')->count();
	    	$bcnt = DB::table('blogs')->count();
	    	$ucnt = DB::table('users')->count();
	    	$ocnt = DB::table('orders')->count();
	        return view('admin.dashboard.index',['pcnt'=>$pcnt,'bcnt'=>$bcnt,'ucnt'=>$ucnt,'ocnt'=>$ocnt]);
	    })->name('admin.dashboard');

	    //Settings
	    Route::get('/settings', [SettingController::class,'index'])->name('admin.settings');
		Route::post('/settings', [SettingController::class,'update'])->name('admin.settings.update');

		//Pages
		Route::get('/pages', [PagesController::class, 'index'])->name('admin.pages');
		Route::get('/pages/show/{id}', [PagesController::class, 'show'])->name('admin.pages.show');
		Route::get('/pages/create', [PagesController::class, 'create'])->name('admin.pages.create');
		Route::post('/pages/store', [PagesController::class, 'store'])->name('admin.pages.store');	
		Route::get('/pages/edit/{id}', [PagesController::class, 'edit'])->name('admin.pages.edit');
		Route::post('/pages/update/{id}', [PagesController::class, 'update'])->name('admin.pages.update');
		Route::get('/pages/delete/{id}', [PagesController::class, 'destroy'])->name('admin.pages.delete');

		//Sliders
		Route::get('/sliders', [SlidersController::class, 'index'])->name('admin.sliders');
		Route::get('/sliders/show/{id}', [SlidersController::class, 'show'])->name('admin.sliders.show');
		Route::get('/sliders/create', [SlidersController::class, 'create'])->name('admin.sliders.create');
		Route::post('/sliders/store', [SlidersController::class, 'store'])->name('admin.sliders.store');	
		Route::get('/sliders/edit/{id}', [SlidersController::class, 'edit'])->name('admin.sliders.edit');
		Route::post('/sliders/update/{id}', [SlidersController::class, 'update'])->name('admin.sliders.update');
		Route::get('/sliders/delete/{id}', [SlidersController::class, 'destroy'])->name('admin.sliders.delete');

		//Testimonials
		Route::get('/testimonials', [TestimonialsController::class, 'index'])->name('admin.testimonials');
		Route::get('/testimonials/show/{id}', [TestimonialsController::class, 'show'])->name('admin.testimonials.show');
		Route::get('/testimonials/create', [TestimonialsController::class, 'create'])->name('admin.testimonials.create');
		Route::post('/testimonials/store', [TestimonialsController::class, 'store'])->name('admin.testimonials.store');	
		Route::get('/testimonials/edit/{id}', [TestimonialsController::class, 'edit'])->name('admin.testimonials.edit');
		Route::post('/testimonials/update/{id}', [TestimonialsController::class, 'update'])->name('admin.testimonials.update');
		Route::get('/testimonials/delete/{id}', [TestimonialsController::class, 'destroy'])->name('admin.testimonials.delete');

		//Clienteles
		Route::get('/clienteles', [ClientelesController::class, 'index'])->name('admin.clienteles');
		Route::get('/clienteles/show/{id}', [ClientelesController::class, 'show'])->name('admin.clienteles.show');
		Route::get('/clienteles/create', [ClientelesController::class, 'create'])->name('admin.clienteles.create');
		Route::post('/clienteles/store', [ClientelesController::class, 'store'])->name('admin.clienteles.store');	
		Route::get('/clienteles/edit/{id}', [ClientelesController::class, 'edit'])->name('admin.clienteles.edit');
		Route::post('/clienteles/update/{id}', [ClientelesController::class, 'update'])->name('admin.clienteles.update');
		Route::get('/clienteles/delete/{id}', [ClientelesController::class, 'destroy'])->name('admin.clienteles.delete');

		//FAQ's
		Route::get('/faqs', [FaqsController::class, 'index'])->name('admin.faqs');
		Route::get('/faqs/show/{id}', [FaqsController::class, 'show'])->name('admin.faqs.show');
		Route::get('/faqs/create', [FaqsController::class, 'create'])->name('admin.faqs.create');
		Route::post('/faqs/store', [FaqsController::class, 'store'])->name('admin.faqs.store');	
		Route::get('/faqs/edit/{id}', [FaqsController::class, 'edit'])->name('admin.faqs.edit');
		Route::post('/faqs/update/{id}', [FaqsController::class, 'update'])->name('admin.faqs.update');
		Route::get('/faqs/delete/{id}', [FaqsController::class, 'destroy'])->name('admin.faqs.delete');

		//Gallery
		Route::get('/galleries', [GalleriesController::class, 'index'])->name('admin.galleries');
		Route::get('/galleries/show/{id}', [GalleriesController::class, 'show'])->name('admin.galleries.show');
		Route::get('/galleries/create', [GalleriesController::class, 'create'])->name('admin.galleries.create');
		Route::post('/galleries/store', [GalleriesController::class, 'store'])->name('admin.galleries.store');	
		Route::get('/galleries/edit/{id}', [GalleriesController::class, 'edit'])->name('admin.galleries.edit');
		Route::post('/galleries/update/{id}', [GalleriesController::class, 'update'])->name('admin.galleries.update');
		Route::get('/galleries/delete/{id}', [GalleriesController::class, 'destroy'])->name('admin.galleries.delete');

		//Users
		Route::get('/users', [UsersController::class, 'index'])->name('admin.users');
		Route::get('/users/show/{id}', [UsersController::class, 'show'])->name('admin.users.show');
		Route::get('/users/create', [UsersController::class, 'create'])->name('admin.users.create');
		Route::post('/users/store', [UsersController::class, 'store'])->name('admin.users.store');	
		Route::get('/users/edit/{id}', [UsersController::class, 'edit'])->name('admin.users.edit');
		Route::post('/users/update/{id}', [UsersController::class, 'update'])->name('admin.users.update');
		Route::get('/users/delete/{id}', [UsersController::class, 'destroy'])->name('admin.users.delete');

		//Newsletters
		Route::get('/newsletters', [PagesController::class, 'index'])->name('admin.newsletters');
		Route::get('/newsletters/show/{id}', [PagesController::class, 'show'])->name('admin.newsletters.show');
		Route::get('/newsletters/create', [PagesController::class, 'create'])->name('admin.newsletters.create');
		Route::post('/newsletters/store', [PagesController::class, 'store'])->name('admin.newsletters.store');	
		Route::get('/newsletters/edit/{id}', [PagesController::class, 'edit'])->name('admin.newsletters.edit');
		Route::post('/newsletters/update/{id}', [PagesController::class, 'update'])->name('admin.newsletters.update');
		Route::get('/newsletters/delete/{id}', [PagesController::class, 'destroy'])->name('admin.newsletters.delete');
		
		/* Blogs */
		Route::get('/blogs', [BlogsController::class, 'index'])->name('admin.blogs');
		Route::get('/blogs/show/{id}', [BlogsController::class, 'show'])->name('admin.blogs.show');
		Route::get('/blogs/create', [BlogsController::class, 'create'])->name('admin.blogs.create');
		Route::post('/blogs/store', [BlogsController::class, 'store'])->name('admin.blogs.store');	
		Route::get('/blogs/edit/{id}', [BlogsController::class, 'edit'])->name('admin.blogs.edit');
		Route::post('/blogs/update/{id}', [BlogsController::class, 'update'])->name('admin.blogs.update');
		Route::get('/blogs/delete/{id}', [BlogsController::class, 'destroy'])->name('admin.blogs.delete');

		//Blog Category
		Route::get('/blog-categories', [Blog_CategoriesController::class, 'index'])->name('admin.blog-categories');
		Route::get('/blog-categories/show/{id}', [Blog_CategoriesController::class, 'show'])->name('admin.blog-categories.show');
		Route::get('/blog-categories/create', [Blog_CategoriesController::class, 'create'])->name('admin.blog-categories.create');
		Route::post('/blog-categories/store', [Blog_CategoriesController::class, 'store'])->name('admin.blog-categories.store');	
		Route::get('/blog-categories/edit/{id}', [Blog_CategoriesController::class, 'edit'])->name('admin.blog-categories.edit');
		Route::post('/blog-categories/update/{id}', [Blog_CategoriesController::class, 'update'])->name('admin.blog-categories.update');
		Route::get('/blog-categories/delete/{id}', [Blog_CategoriesController::class, 'destroy'])->name('admin.blog-categories.delete');

		//Blog tag
		Route::get('/blog-tags', [Blog_TagsController::class, 'index'])->name('admin.blog-tags');
		Route::get('/blog-tags/show/{id}', [Blog_TagsController::class, 'show'])->name('admin.blog-tags.show');
		Route::get('/blog-tags/create', [Blog_TagsController::class, 'create'])->name('admin.blog-tags.create');
		Route::post('/blog-tags/store', [Blog_TagsController::class, 'store'])->name('admin.blog-tags.store');	
		Route::get('/blog-tags/edit/{id}', [Blog_TagsController::class, 'edit'])->name('admin.blog-tags.edit');
		Route::post('/blog-tags/update/{id}', [Blog_TagsController::class, 'update'])->name('admin.blog-tags.update');
		Route::get('/blog-tags/delete/{id}', [Blog_TagsController::class, 'destroy'])->name('admin.blog-tags.delete');


		/*********************Ecommerce Section *************************/
		//Product Category
		Route::get('/product-categories', [ProductCategoriesController::class, 'index'])->name('admin.product-categories');
		Route::get('/product-categories/show/{id}', [ProductCategoriesController::class, 'show'])->name('admin.product-categories.show');
		Route::get('/product-categories/create', [ProductCategoriesController::class, 'create'])->name('admin.product-categories.create');
		Route::post('/product-categories/store', [ProductCategoriesController::class, 'store'])->name('admin.product-categories.store');	
		Route::get('/product-categories/edit/{id}', [ProductCategoriesController::class, 'edit'])->name('admin.product-categories.edit');
		Route::post('/product-categories/update/{id}', [ProductCategoriesController::class, 'update'])->name('admin.product-categories.update');
		Route::get('/product-categories/delete/{id}', [ProductCategoriesController::class, 'destroy'])->name('admin.product-categories.delete');

		//Product Brands
		Route::get('/product-brands', [ProductBrandsController::class, 'index'])->name('admin.product-brands');
		Route::get('/product-brands/show/{id}', [ProductBrandsController::class, 'show'])->name('admin.product-brands.show');
		Route::get('/product-brands/create', [ProductBrandsController::class, 'create'])->name('admin.product-brands.create');
		Route::post('/product-brands/store', [ProductBrandsController::class, 'store'])->name('admin.product-brands.store');	
		Route::get('/product-brands/edit/{id}', [ProductBrandsController::class, 'edit'])->name('admin.product-brands.edit');
		Route::post('/product-brands/update/{id}', [ProductBrandsController::class, 'update'])->name('admin.product-brands.update');
		Route::get('/product-brands/delete/{id}', [ProductBrandsController::class, 'destroy'])->name('admin.product-brands.delete');

		//Product Attributes
		Route::get('/product-attributes', [ProductAttributesController::class, 'index'])->name('admin.product-attributes');
		Route::get('/product-attributes/show/{id}', [ProductAttributesController::class, 'show'])->name('admin.product-attributes.show');
		Route::get('/product-attributes/create', [ProductAttributesController::class, 'create'])->name('admin.product-attributes.create');
		Route::post('/product-attributes/store', [ProductAttributesController::class, 'store'])->name('admin.product-attributes.store');	
		Route::get('/product-attributes/edit/{id}', [ProductAttributesController::class, 'edit'])->name('admin.product-attributes.edit');
		Route::post('/product-attributes/update/{id}', [ProductAttributesController::class, 'update'])->name('admin.product-attributes.update');
		Route::get('/product-attributes/delete/{id}', [ProductAttributesController::class, 'destroy'])->name('admin.product-attributes.delete');

		/*Attributes Value*/		
		Route::post('/product-attributes-value/store', [ProductAttributesController::class, 'attributeValueStore'])->name('admin.product-attributes-value.store');
		Route::post('/product-attributes-value/update/{id}', [ProductAttributesController::class, 'attributeValueUpdate'])->name('admin.product-attributes-value.update');
		Route::get('/product-attributes-value/delete/{id}/{attr_id}', [ProductAttributesController::class, 'attributeValueDestroy'])->name('admin.product-attributes-value.delete');
		Route::get('/product-attributes-variation/getvariation/{id}', [ProductAttributesController::class, 'getAttributeVariation'])->name('admin.product-attributes-variation.getvariation');



		/* products */
		Route::get('/products', [ProductsController::class, 'index'])->name('admin.products');
		Route::get('/products/show/{id}', [ProductsController::class, 'show'])->name('admin.products.show');
		Route::get('/products/create', [ProductsController::class, 'create'])->name('admin.products.create');
		Route::post('/products/store', [ProductsController::class, 'store'])->name('admin.products.store');	
		Route::get('/products/edit/{id}', [ProductsController::class, 'edit'])->name('admin.products.edit');
		Route::post('/products/update/{id}', [ProductsController::class, 'update'])->name('admin.products.update');
		Route::get('/products/delete/{id}', [ProductsController::class, 'destroy'])->name('admin.products.delete');

		//Orders
	    Route::get('/orders', [OrdersController::class, 'index'])->name('admin.orders');
		Route::get('/orders/show/{id}', [OrdersController::class, 'show'])->name('admin.orders.show');
		Route::get('/orders/create', [OrdersController::class, 'create'])->name('admin.orders.create');
		Route::post('/orders/store', [OrdersController::class, 'store'])->name('admin.orders.store');	
		Route::get('/orders/edit/{id}', [OrdersController::class, 'edit'])->name('admin.orders.edit');
		Route::post('/orders/update/{id}', [OrdersController::class, 'update'])->name('admin.orders.update');
		Route::get('/orders/delete/{id}', [OrdersController::class, 'destroy'])->name('admin.orders.delete');


	});


});