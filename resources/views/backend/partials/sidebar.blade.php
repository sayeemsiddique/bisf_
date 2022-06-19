<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
    <!--begin::Brand-->
    <div class="brand flex-column-auto" id="kt_brand" style="padding: 10px">
        <!--begin::Logo-->
        <a href="{{route('index')}}" class="brand-logo">
            
            <img alt="Logo" src="{{asset('frontend/assets/img/logo.png')}}" style="max-height: 45px;"/> 
            <h6 class="mt-1 ml-5" style="color: #f1f1f1; font-size:12px;"> {{ $setting->sub_title ?? ''}}</h6>
        </a>
        <!--end::Logo-->
        <!--begin::Toggle-->
        {{-- <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
            <span class="svg-icon svg-icon svg-icon-xl">
                <i style="color: #6e3cbc;" class="fab fa-uncharted"></i>
            </span>
        </button> --}}
        <!--end::Toolbar-->
    </div>
    <!--end::Brand-->
    <!--begin::Aside Menu-->
    <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper" style="background: #EBF9CF !important;">
        <!--begin::Menu Container-->
        <div id="kt_aside_menu" class="aside-menu mb-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
            <!--begin::Menu Nav-->
            <ul class="menu-nav">
                <li class="menu-item {{ session('lsbm') == 'dashboard' ? ' menu-item-active ' : '' }} " aria-haspopup="true">
                    <a href="{{route('admin.index')}}" class="menu-link">
                        <span class="svg-icon menu-icon">
                            <i style="color: #6e3cbc;" class="fas fa-th"></i>
                        </span>
                        <span class="menu-text">Dashboard</span>
                    </a>
                </li>

                @can('inventory_management')
                    <!-- user management -->
                    <li class="menu-item menu-item-submenu {{ session('lsbm') == 'inventory_management' ? ' menu-item-open ' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                        <a href="javascript:;" class="menu-link menu-toggle">
                            <span class="svg-icon menu-icon">
                                <i style="color: #6e3cbc;" class="fab fa-uncharted"></i>
                                
                            </span>
                            <span class="menu-text">Inventory Management</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="menu-submenu">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">
                                <li class="menu-item menu-item-parent " aria-haspopup="true">
                                    <span class="menu-link">
                                        <span class="menu-text">Inventory Management</span>
                                    </span>
                                </li>

                                @can('product_stock')
                                    <li class="menu-item {{ session('lsbsm') == 'product_stock' ? ' menu-item-active ' : '' }}" aria-haspopup="true">
                                        <a href="{{route('admin.product.stock')}}" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Product Stock</span>
                                        </a>
                                    </li>
                                @endcan

                                @can('material_product_stock')
                                    <li class="menu-item {{ session('lsbsm') == 'material_product_stock' ? ' menu-item-active ' : '' }}" aria-haspopup="true">
                                        <a href="{{route('admin.product.material_stock')}}" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Material Product Stock</span>
                                        </a>
                                    </li>
                                @endcan

                            </ul>
                        </div>
                    </li>
                @endcan

                {{-- Manage Bank --}}
                @can('manage_bank')
                    <!-- user management -->
                    <li class="menu-item menu-item-submenu {{ session('lsbm') == 'manage_bank' ? ' menu-item-open ' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                        <a href="javascript:;" class="menu-link menu-toggle">
                            <span class="svg-icon menu-icon">
                                <i style="color: #6e3cbc;" class="fab fa-uncharted"></i>
                            </span>
                            <span class="menu-text">Bank Management</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="menu-submenu">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">
                                <li class="menu-item menu-item-parent " aria-haspopup="true">
                                    <span class="menu-link">
                                        <span class="menu-text">Bank Management</span>
                                    </span>
                                </li>

                                @can('add_bank')
                                    <li class="menu-item {{ session('lsbsm') == 'add_bank' ? ' menu-item-active ' : '' }}" aria-haspopup="true">
                                        <a href="{{route('admin.bank.create')}}" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Add Bank Account</span>
                                        </a>
                                    </li>
                                @endcan
                                
                                @can('all_banks')
                                    <li class="menu-item {{ session('lsbsm') == 'all_banks' ? ' menu-item-active ' : '' }}" aria-haspopup="true">
                                        <a href="{{route('admin.bank.index')}}" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">All Bank Accounts</span>
                                        </a>
                                    </li>
                                @endcan

                            </ul>
                        </div>
                    </li>
                @endcan
                
                @can('user_management')
                    <!-- user management -->
                    <li class="menu-item menu-item-submenu {{ session('lsbm') == 'roles' ? ' menu-item-open ' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                        <a href="javascript:;" class="menu-link menu-toggle">
                            <span class="svg-icon menu-icon">
                                <i style="color: #6e3cbc;" class="fab fa-uncharted"></i>
                            </span>
                            <span class="menu-text">User Management</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="menu-submenu">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">
                                <li class="menu-item menu-item-parent " aria-haspopup="true">
                                    <span class="menu-link">
                                        <span class="menu-text">User Management</span>
                                    </span>
                                </li>

                                @can('add_user')
                                    <li class="menu-item {{ session('lsbsm') == 'addUser' ? ' menu-item-active ' : '' }}" aria-haspopup="true">
                                        <a href="{{route('admin.user.create')}}" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Add User</span>
                                        </a>
                                    </li>
                                @endcan
                                
                                @can('all_users')
                                    <li class="menu-item {{ session('lsbsm') == 'allUsers' ? ' menu-item-active ' : '' }}" aria-haspopup="true">
                                        <a href="{{route('admin.user.index')}}" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">All Users List</span>
                                        </a>
                                    </li>
                                @endcan

                                @can('all_roles')
                                    <li class="menu-item {{ session('lsbsm') == 'allRoles' ? ' menu-item-active ' : '' }}" aria-haspopup="true">
                                        <a href="{{route('admin.role.index')}}" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">All Roles</span>
                                        </a>
                                    </li>
                               @endcan

                                @can('all_permissions')
                                    <li class="menu-item {{ session('lsbsm') == 'permissions' ? ' menu-item-active ' : '' }}" aria-haspopup="true">
                                        <a href="{{route('admin.permission.index')}}" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">All Permissions</span>
                                        </a>
                                    </li>
                                @endcan
                                
                                @can('assign_permission')
                                    <li class="menu-item {{ session('lsbsm') == 'assignPerm' ? ' menu-item-active ' : '' }}" aria-haspopup="true">
                                        <a href="{{route('admin.rolePermission.index')}}" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Assign Permission</span>
                                        </a>
                                    </li>
                                @endcan

                                
                            </ul>
                        </div>
                    </li>
                @endcan

                {{-- Manage page --}}
                @can('manage_page')
                    <!-- user management -->
                    <li class="menu-item menu-item-submenu {{ session('lsbm') == 'manage_page' ? ' menu-item-open ' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                        <a href="javascript:;" class="menu-link menu-toggle">
                            <span class="svg-icon menu-icon">
                                <i style="color: #6e3cbc;" class="fab fa-uncharted"></i>
                            </span>
                            <span class="menu-text">Pages Management</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="menu-submenu">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">
                                <li class="menu-item menu-item-parent " aria-haspopup="true">
                                    <span class="menu-link">
                                        <span class="menu-text">Pages Management</span>
                                    </span>
                                </li>

                                @can('edit_page')
                                    <li class="menu-item {{ session('lsbsm') == 'about_us' ? ' menu-item-active ' : '' }}" aria-haspopup="true">
                                        <a href="{{route('admin.page.aboutus')}}" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">About Us</span>
                                        </a>
                                    </li>
                                @endcan
                                
                                @can('edit_page')
                                    <li class="menu-item {{ session('lsbsm') == 'contact_us' ? ' menu-item-active ' : '' }}" aria-haspopup="true">
                                        <a href="{{route('admin.page.contactus')}}" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Contact Us</span>
                                        </a>
                                    </li>
                                @endcan

                            </ul>
                        </div>
                    </li>
                @endcan
                
                @can('settings')
                    <li class="menu-item menu-item-submenu {{ session('lsbm') == 'settings' ? ' menu-item-open ' : '' }}"  aria-haspopup="true" data-menu-toggle="hover">
                        <a href="javascript:;" class="menu-link menu-toggle">
                            <span class="svg-icon menu-icon">
                                <i style="color: #6e3cbc;" class="fab fa-uncharted"></i>
                            </span>
                            <span class="menu-text">Settings</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="menu-submenu">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">
                                <li class="menu-item menu-item-parent" aria-haspopup="true">
                                    <span class="menu-link">
                                        <span class="menu-text">Settings</span>
                                    </span>
                                </li>
                                @can('product_setting')
                                    <li class="menu-item menu-item-submenu {{ session('lsbsm') == 'product_setting' ? ' menu-item-open ' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                                        <a href="javascript:;" class="menu-link menu-toggle">
                                            <i class="menu-bullet menu-bullet-line">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Product</span>
                                            
                                            <i class="menu-arrow"></i>
                                        </a>
                                        <div class="menu-submenu">
                                            <i class="menu-arrow"></i>
                                            <ul class="menu-subnav">
                                                @can('all_category')
                                                    <li class="menu-item {{ session('lsbssm') == 'all_category' ? ' menu-item-active ' : '' }}" aria-haspopup="true">
                                                        <a href="{{route('admin.category.index')}}" class="menu-link">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">All Categories</span>
                                                        </a>
                                                    </li>
                                                @endcan
                                                @can('all_brand')
                                                    <li class="menu-item {{ session('lsbssm') == 'all_brand' ? ' menu-item-active ' : '' }}" aria-haspopup="true">
                                                        <a href="{{route('admin.brand.index')}}" class="menu-link">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">All Brands</span>
                                                        </a>
                                                    </li>
                                                @endcan

                                                @can('all_varient_type')
                                                    <li class="menu-item {{ session('lsbssm') == 'all_varient_type' ? ' menu-item-active ' : '' }}" aria-haspopup="true">
                                                        <a href="{{route('admin.varienttype.index')}}" class="menu-link">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">Manage Varient Type</span>
                                                        </a>
                                                    </li>
                                                @endcan

                                                @can('all_vat_type')
                                                    <li class="menu-item {{ session('lsbssm') == 'all_vat_type' ? ' menu-item-active ' : '' }}" aria-haspopup="true">
                                                        <a href="{{route('admin.vat.index')}}" class="menu-link">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">Manage Vat Type</span>
                                                        </a>
                                                    </li>
                                                @endcan

                                                @can('all_product')
                                                    <li class="menu-item {{ session('lsbssm') == 'all_product' ? ' menu-item-active ' : '' }}" aria-haspopup="true">
                                                        <a href="{{route('admin.product.index')}}" class="menu-link">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">All Products</span>
                                                        </a>
                                                    </li>
                                                @endcan

                                                @can('add_product')
                                                    <li class="menu-item {{ session('lsbssm') == 'add_product' ? ' menu-item-active ' : '' }}" aria-haspopup="true">
                                                        <a href="{{route('admin.product.create')}}" class="menu-link">
                                                            <i class="menu-bullet menu-bullet-dot">
                                                                <span></span>
                                                            </i>
                                                            <span class="menu-text">Add Product</span>
                                                        </a>
                                                    </li>
                                                @endcan

                                                @can('all_material_product')
                                                <li class="menu-item {{ session('lsbssm') == 'all_material_product' ? ' menu-item-active ' : '' }}" aria-haspopup="true">
                                                    <a href="{{route('admin.product.material_index')}}" class="menu-link">
                                                        <i class="menu-bullet menu-bullet-dot">
                                                            <span></span>
                                                        </i>
                                                        <span class="menu-text">Material Product</span>
                                                    </a>
                                                </li>
                                                @endcan
                                                
                                            </ul>
                                        </div>
                                    </li>
                                @endcan

                                @can('customer_setting')
                                <li class="menu-item menu-item-submenu {{ session('lsbsm') == 'customer_setting' ? ' menu-item-open ' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                                    <a href="javascript:;" class="menu-link menu-toggle">
                                        <i class="menu-bullet menu-bullet-line">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Customer Setting</span>
                                        
                                        <i class="menu-arrow"></i>
                                    </a>

                                    @can('add_customer')
                                    <div class="menu-submenu">
                                        <i class="menu-arrow"></i>
                                        <ul class="menu-subnav">
                                            <li class="menu-item {{ session('lsbssm') == 'add_customer' ? ' menu-item-active ' : '' }}" aria-haspopup="true">
                                                <a href="{{ route('admin.customer.create_customer') }}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">Add Customer</span>
                                                </a>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                    @endcan

                                    @can('all_customers')
                                    <div class="menu-submenu">
                                        <i class="menu-arrow"></i>
                                        <ul class="menu-subnav">
                                            <li class="menu-item {{ session('lsbssm') == 'all_customers' ? ' menu-item-active ' : '' }}" aria-haspopup="true">
                                                <a href="{{ route('admin.customer.all_customer') }}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">All Customer List</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    @endcan

                                    @can('blocked_customer')
                                    <div class="menu-submenu">
                                        <i class="menu-arrow"></i>
                                        <ul class="menu-subnav">
                                            <li class="menu-item {{ session('lsbssm') == 'blocked_customer' ? ' menu-item-active ' : '' }}" aria-haspopup="true">
                                                <a href="{{ route('admin.customer.blocked_customer') }}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">Blocked Customer List</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    @endcan

                                </li>
                                @endcan

                                @can('corporate_setting')
                                <li class="menu-item menu-item-submenu {{ session('lsbsm') == 'corporate_setting' ? ' menu-item-open ' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                                    <a href="javascript:;" class="menu-link menu-toggle">
                                        <i class="menu-bullet menu-bullet-line">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Corporate Consumer Setting</span>
                                        
                                        <i class="menu-arrow"></i>
                                    </a>

                                    @can('add_corporate')
                                    <div class="menu-submenu">
                                        <i class="menu-arrow"></i>
                                        <ul class="menu-subnav">
                                            <li class="menu-item {{ session('lsbssm') == 'add_corporate' ? ' menu-item-active ' : '' }}" aria-haspopup="true">
                                                <a href="{{ route('admin.customer.create_corporate') }}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">Add Corporate Consumer</span>
                                                </a>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                    @endcan

                                    @can('all_corporates')
                                    <div class="menu-submenu">
                                        <i class="menu-arrow"></i>
                                        <ul class="menu-subnav">
                                            <li class="menu-item {{ session('lsbssm') == 'all_corporates' ? ' menu-item-active ' : '' }}" aria-haspopup="true">
                                                <a href="{{ route('admin.customer.all_corporate') }}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">All Corporate Consumer List</span>
                                                </a>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                    @endcan

                                    @can('pending_corporate')
                                    <div class="menu-submenu">
                                        <i class="menu-arrow"></i>
                                        <ul class="menu-subnav">
                                            <li class="menu-item {{ session('lsbssm') == 'pending_corporate' ? ' menu-item-active ' : '' }}" aria-haspopup="true">
                                                <a href="{{ route('admin.customer.pending_corporate') }}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">Pending Corporate Consumer List</span>
                                                </a>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                    @endcan

                                    @can('approved_corporate')
                                    <div class="menu-submenu">
                                        <i class="menu-arrow"></i>
                                        <ul class="menu-subnav">
                                            <li class="menu-item {{ session('lsbssm') == 'approved_corporate' ? ' menu-item-active ' : '' }}" aria-haspopup="true">
                                                <a href="{{ route('admin.customer.approved_corporate') }}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">Approved Corporate Consumer List</span>
                                                </a>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                    @endcan

                                    @can('blocked_corporate')
                                    <div class="menu-submenu">
                                        <i class="menu-arrow"></i>
                                        <ul class="menu-subnav">
                                            <li class="menu-item {{ session('lsbssm') == 'blocked_corporate' ? ' menu-item-active ' : '' }}" aria-haspopup="true">
                                                <a href="{{ route('admin.customer.blocked_corporate') }}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">Blocked Corporate Consumer List</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    @endcan

                                    @can('declined_corporate')
                                    <div class="menu-submenu">
                                        <i class="menu-arrow"></i>
                                        <ul class="menu-subnav">
                                            <li class="menu-item {{ session('lsbssm') == 'declined_corporate' ? ' menu-item-active ' : '' }}" aria-haspopup="true">
                                                <a href="{{ route('admin.customer.declined_corporate') }}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">Declined Corporate Consumer List</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    @endcan

                                </li>
                                @endcan

                                @can('dealer_setting')
                                <li class="menu-item menu-item-submenu {{ session('lsbsm') == 'dealer_setting' ? ' menu-item-open ' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                                    <a href="javascript:;" class="menu-link menu-toggle">
                                        <i class="menu-bullet menu-bullet-line">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Dealer Setting</span>
                                        <i class="menu-arrow"></i>
                                    </a>

                                    @can('add_dealer')
                                    <div class="menu-submenu">
                                        <i class="menu-arrow"></i>
                                        <ul class="menu-subnav">
                                            <li class="menu-item {{ session('lsbssm') == 'add_dealer' ? ' menu-item-active ' : '' }}" aria-haspopup="true">
                                                <a href="{{ route('admin.customer.create_dealer') }}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">Add Dealer</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    @endcan

                                    @can('all_dealers')
                                    <div class="menu-submenu">
                                        <i class="menu-arrow"></i>
                                        <ul class="menu-subnav">
                                            <li class="menu-item {{ session('lsbssm') == 'all_dealers' ? ' menu-item-active ' : '' }}" aria-haspopup="true">
                                                <a href="{{ route('admin.customer.all_dealer') }}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">All Dealer List</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    @endcan

                                    @can('pending_dealer')
                                    <div class="menu-submenu">
                                        <i class="menu-arrow"></i>
                                        <ul class="menu-subnav">
                                            <li class="menu-item {{ session('lsbssm') == 'pending_dealer' ? ' menu-item-active ' : '' }}" aria-haspopup="true">
                                                <a href="{{ route('admin.customer.pending_dealer') }}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">Pending Dealer List</span>
                                                </a>
                                            </li>
                                            
                                        </ul>
                                    </div>
                                    @endcan

                                    @can('approved_dealer')
                                    <div class="menu-submenu">
                                        <i class="menu-arrow"></i>
                                        <ul class="menu-subnav">
                                            <li class="menu-item {{ session('lsbssm') == 'approved_dealer' ? ' menu-item-active ' : '' }}" aria-haspopup="true">
                                                <a href="{{ route('admin.customer.approved_dealer') }}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">Approved Dealer List</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    @endcan

                                    @can('blocked_dealer')
                                    <div class="menu-submenu">
                                        <i class="menu-arrow"></i>
                                        <ul class="menu-subnav">
                                            <li class="menu-item {{ session('lsbssm') == 'blocked_dealer' ? ' menu-item-active ' : '' }}" aria-haspopup="true">
                                                <a href="{{ route('admin.customer.blocked_dealer') }}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">Blocked Dealer List</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    @endcan

                                    @can('declined_dealer')
                                    <div class="menu-submenu">
                                        <i class="menu-arrow"></i>
                                        <ul class="menu-subnav">
                                            <li class="menu-item {{ session('lsbssm') == 'declined_dealer' ? ' menu-item-active ' : '' }}" aria-haspopup="true">
                                                <a href="{{ route('admin.customer.declined_dealer') }}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="menu-text">Declined Dealer List</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    @endcan

                                </li>
                                @endcan
                                
                                <li class="menu-item menu-item-submenu  {{ session('lsbsm') == 'org_setting' ? ' menu-item-open ' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                                    <a href="javascript:;" class="menu-link menu-toggle">
                                        <i class="menu-bullet menu-bullet-line">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Organization Setting</span>
                                        <i class="menu-arrow"></i>
                                    </a>
                                    <div class="menu-submenu">
                                        <i class="menu-arrow"></i>
                                        <ul class="menu-subnav">

                                            @can('all_department')
                                                <li class="menu-item {{ session('lsbssm') == 'all_department' ? ' menu-item-active ' : '' }}" aria-haspopup="true">
                                                    <a href="{{route('admin.department.index')}}" class="menu-link">
                                                        <i class="menu-bullet menu-bullet-dot">
                                                            <span></span>
                                                        </i>
                                                        <span class="menu-text">Manage Department</span>
                                                    </a>
                                                </li>
                                            @endcan
                                            
                                            @can('all_designation')
                                                <li class="menu-item {{ session('lsbssm') == 'all_designation' ? ' menu-item-active ' : '' }}" aria-haspopup="true">
                                                    <a href="{{route('admin.designation.index')}}" class="menu-link">
                                                        <i class="menu-bullet menu-bullet-dot">
                                                            <span></span>
                                                        </i>
                                                        <span class="menu-text">Manage Designation</span>
                                                    </a>
                                                </li>
                                            @endcan

                                            @can('all_vehicles')
                                                <li class="menu-item {{ session('lsbssm') == 'all_vehicles' ? ' menu-item-active ' : '' }}" aria-haspopup="true">
                                                    <a href="{{route('admin.vehicle.index')}}" class="menu-link">
                                                        <i class="menu-bullet menu-bullet-dot">
                                                            <span></span>
                                                        </i>
                                                        <span class="menu-text">Manage Vehicle</span>
                                                    </a>
                                                </li>
                                            @endcan
                                        </ul>
                                    </div>
                                </li>

                                @can('order_settings')
                                <li class="menu-item {{ session('lsbsm') == 'order_settings' ? ' menu-item-active ' : '' }}" aria-haspopup="true">
                                    <a href="{{ route('admin.setting.setting_edit', ['id'=>1]) }}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-line">
                                            <span></span>
                                        </i>
                                        <span class="menu-text">Order Setting</span>
                                    </a>
                                    
                                </li>
                                @endcan
                            </ul>
                        </div>
                    </li>
                @endcan

                {{-- Manage order --}}
                @can('manage_order')
                    <li class="menu-item menu-item-submenu {{ session('lsbm') == 'manage_order' ? ' menu-item-open ' : '' }}" aria-haspopup="true" data-menu-toggle="hover">
                        <a href="javascript:;" class="menu-link menu-toggle">
                            <span class="svg-icon menu-icon">
                                <i style="color: #6e3cbc;" class="fab fa-uncharted"></i>
                            </span>
                            <span class="menu-text">Order Management</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="menu-submenu">
                            <i class="menu-arrow"></i>
                            <ul class="menu-subnav">
                                <li class="menu-item menu-item-parent " aria-haspopup="true">
                                    <span class="menu-link">
                                        <span class="menu-text">Order Management</span>
                                    </span>
                                </li>
                                
                                @can('order_list')
                                    <li class="menu-item {{ session('lsbsm') == 'order_list' ? ' menu-item-active ' : '' }}" aria-haspopup="true">
                                        <a href="{{route('admin.order.index')}}" class="menu-link">
                                            <i class="menu-bullet menu-bullet-dot">
                                                <span></span>
                                            </i>
                                            <span class="menu-text">Order List</span>
                                        </a>
                                    </li>
                                @endcan

                            </ul>
                        </div>
                    </li>
                @endcan

                @can('website_settings')
                <li class="menu-item {{ session('lsbm') == 'setup' ? ' menu-item-active ' : '' }}" aria-haspopup="true">
                    <a href="{{ route('admin.setting.edit', ['id'=>1]) }}" class="menu-link">
                        <span class="svg-icon menu-icon">
                            <i style="color: #6e3cbc;" class="fab fa-uncharted"></i>
                        </span>
                        <span class="menu-text">Website Settings</span>
                    </a>
                </li>
                @endcan
                
                {{-- logout --}}
                <li class="menu-item" aria-haspopup="true">
                    <a target="_blank" href="{{ route('logout') }}" class="menu-link" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <span class="svg-icon menu-icon">
                            <i style="color: #6e3cbc;" class="fab fa-uncharted"></i>
                        </span>
                        <span class="menu-text">Logout</span>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </a>
                </li>

            </ul>
            <!--end::Menu Nav-->
        </div>
        <!--end::Menu Container-->
    </div>
    <!--end::Aside Menu-->
</div>