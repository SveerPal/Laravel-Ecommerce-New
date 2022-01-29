<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user">
        <div>
            <p class="app-sidebar__user-name">{{ Auth::guard('admin')->user()->name }}</p>
            <p class="app-sidebar__user-designation">Frontend Developer</p>
        </div>
    </div>
    <ul class="app-menu">
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.dashboard' ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="app-menu__icon fas fa-tachometer-alt"></i>
                <span class="app-menu__label">Dashboard</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.sliders' ? 'active' : '' }}" href="{{ route('admin.sliders') }}"><i class="app-menu__icon fas fa-sliders-h"></i>
                <span class="app-menu__label">Sliders</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.pages' ? 'active' : '' }}" href="{{ route('admin.pages') }}"><i class="app-menu__icon fa fa-file"></i>
                <span class="app-menu__label">Pages</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.testimonials' ? 'active' : '' }}" href="{{ route('admin.testimonials') }}"><i class="app-menu__icon fa fa-quote-left"></i>
                <span class="app-menu__label">Testimonials</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.clienteles' ? 'active' : '' }}" href="{{ route('admin.clienteles') }}"><i class="app-menu__icon fa fa-user"></i>
                <span class="app-menu__label">Clienteles</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.newsletters' ? 'active' : '' }}" href="{{ route('admin.newsletters') }}"><i class="app-menu__icon fas fa-envelope-open-text"></i>
                <span class="app-menu__label">Newstter</span>
            </a>
        </li>
        <li class="treeview @if(Route::is('admin.blog-categories') or Route::is('admin.blog-categories.create') or Route::is('admin.blog-categories.show') or Route::is('admin.blog-categories.edit') or Route::is('admin.blogs') or Route::is('admin.blogs.create') or Route::is('admin.blogs.show') or Route::is('admin.blogs.edit') or Route::is('admin.blog-tags') or Route::is('admin.blog-tags.create') or Route::is('admin.blog-tags.show') or Route::is('admin.blog-tags.edit'))   is-expanded @endif">
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.blog-categories' ? 'active' : '' }}" href="#" data-toggle="treeview"><i class="app-menu__icon fas fa-blog"></i>

                <span class="app-menu__label">Blogs</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a class="treeview-item @if(Route::is('admin.blogs') or Route::is('admin.blogs.create') or Route::is('admin.blogs.show') or Route::is('admin.blogs.edit')) active @endif" href="{{ route('admin.blogs') }}"><i class="icon fas fa-blog"></i>Blogs</a>
                </li>
                <li>
                    <a class="treeview-item @if(Route::is('admin.blog-categories') or Route::is('admin.blog-categories.create') or Route::is('admin.blog-categories.show') or Route::is('admin.blog-categories.edit')) active @endif" href="{{ route('admin.blog-categories') }}"><i class="icon fa fa-list"></i> Blog Categories</a>
                </li>
                <li>
                    <a class="treeview-item @if(Route::is('admin.blog-tags') or Route::is('admin.blog-tags.create') or Route::is('admin.blog-tags.show') or Route::is('admin.blog-tags.edit')) active @endif" href="{{ route('admin.blog-tags') }}"><i class="icon fas fa-tags"></i> Blog Tags</a>
                </li>
            </ul>
        </li>        
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.faqs' ? 'active' : '' }}" href="{{ route('admin.faqs') }}"><i class="app-menu__icon fa fa-question-circle"></i>
                <span class="app-menu__label">FAQ'S</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.galleries' ? 'active' : '' }}" href="{{ route('admin.galleries') }}"><i class="app-menu__icon fas fa-photo-video"></i>
                <span class="app-menu__label">Gallery</span>
            </a>
        </li>        
        <li class="treeview @if(Route::is('admin.product-categories') or Route::is('admin.product-categories.create') or Route::is('admin.product-categories.show') or Route::is('admin.product-categories.edit') or Route::is('admin.products') or Route::is('admin.products.create') or Route::is('admin.products.show') or Route::is('admin.products.edit') or Route::is('admin.product-brands') or Route::is('admin.product-brands.create') or Route::is('admin.product-brands.show') or Route::is('admin.product-brands.edit') or Route::is('admin.product-attributes') or Route::is('admin.product-attributes.create') or Route::is('admin.product-attributes.show') or Route::is('admin.product-attributes.edit'))   is-expanded @endif">
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.product-categories' ? 'active' : '' }}" href="#" data-toggle="treeview"><i class="app-menu__icon fas fa-store"></i>

                <span class="app-menu__label">Store</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a class="treeview-item @if(Route::is('admin.products') or Route::is('admin.products.create') or Route::is('admin.products.show') or Route::is('admin.products.edit')) active @endif" href="{{ route('admin.products') }}"><i class="icon fa fa-shopping-bag"></i>Products</a>
                </li>
                <li>
                    <a class="treeview-item @if(Route::is('admin.product-categories') or Route::is('admin.product-categories.create') or Route::is('admin.product-categories.show') or Route::is('admin.product-categories.edit')) active @endif" href="{{ route('admin.product-categories') }}"><i class="icon fa fa-list-alt"></i> Category</a>
                </li>
                <li>
                    <a class="treeview-item @if(Route::is('admin.product-brands') or Route::is('admin.product-brands.create') or Route::is('admin.product-brands.show') or Route::is('admin.product-brands.edit')) active @endif" href="{{ route('admin.product-brands') }}"><i class="icon fas fa-list"></i> Brands</a>
                </li>
                <li>
                    <a class="treeview-item @if(Route::is('admin.product-attributes') or Route::is('admin.product-attributes.create') or Route::is('admin.product-attributes.show') or Route::is('admin.product-attributes.edit')) active @endif" href="{{ route('admin.product-attributes') }}"><i class="icon fas fa-tag"></i> Attributes</a>
                </li>
            </ul>
        </li>
        <li class="treeview @if(Route::is('admin.orders') or Route::is('admin.orders.create') or Route::is('admin.orders.show') or Route::is('admin.orders.edit'))   is-expanded @endif">
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.orders' ? 'active' : '' }}" href="#" data-toggle="treeview"><i class="app-menu__icon fas fa-receipt"></i>
                <span class="app-menu__label">Orders</span>
                <i class="treeview-indicator fa fa-angle-right"></i>
            </a>
            <ul class="treeview-menu">
                <li>
                    <a class="treeview-item @if(Route::is('admin.orders') or Route::is('admin.orders.create') or Route::is('admin.orders.show') or Route::is('admin.orders.edit')) active @endif" href="{{ route('admin.orders') }}"><i class="icon fas fa-receipt"></i>Order</a>
                </li>
                <li>
                    <a class="treeview-item" href="#" target="_blank" rel="noopener noreferrer"><i class="icon fas fa-file-invoice-dollar"></i> Coupan Code</a>
                </li>                
            </ul>
        </li>
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.users' ? 'active' : '' }}" href="{{ route('admin.users') }}"><i class="app-menu__icon fa fa-users"></i>
                <span class="app-menu__label">Users</span>
            </a>
        </li>                 
        <li>
            <a class="app-menu__item {{ Route::currentRouteName() == 'admin.settings' ? 'active' : '' }}" href="{{ route('admin.settings') }}">
                <i class="app-menu__icon fa fa-cogs"></i>
                <span class="app-menu__label">Settings</span>
            </a>
        </li>
        <li>
            <a class="app-menu__item" href="{{ route('admin.logout') }}"><i class="app-menu__icon fas fa-sign-out-alt"></i>
                <span class="app-menu__label">Logout</span>
            </a>
        </li>
    </ul>
</aside>