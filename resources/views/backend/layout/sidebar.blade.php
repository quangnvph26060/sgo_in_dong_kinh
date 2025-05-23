<div class="sidebar" data-background-color="dark">
    <div class="e">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="" class="logo">
                <img src="{{ asset('backend/assets/img/logo-sgo-media-optimized.png') }}" alt="navbar brand"
                    class="navbar-brand img-fluid" height="20" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item {{ request()->routeIs('admin.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.index') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li
                    class="nav-item {{ request()->routeIs('admin.contact.*', 'admin.supports.*', 'admin.intro-steps.*') ? 'active' : '' }}">
                    <a data-bs-toggle="collapse" href="#sideb-config"
                        {{ request()->routeIs('admin.contact.*', 'admin.supports.*', 'admin.intro-steps.*') ? 'aria-expanded=true' : '' }}>
                        <i class="fas fa-cogs"></i>
                        <p>Cấu hình</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse {{ request()->routeIs('admin.contact.*', 'admin.supports.*', 'admin.intro-steps.*') ? 'show' : '' }}"
                        id="sideb-config">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="{{ route('admin.contact.show') }}"
                                    class="{{ request()->routeIs('admin.contact.*') ? 'active' : '' }}">
                                    <span class="sub-item">Cấu hình chung</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.supports.index') }}"
                                    class="{{ request()->routeIs('admin.supports.*') ? 'active' : '' }}">
                                    <span class="sub-item">Cấu hình hỗ trợ</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.intro-steps.save') }}"
                                    class="{{ request()->routeIs('admin.intro-steps.*') ? 'active' : '' }}">
                                    <span class="sub-item">Cấu hình hướng dẫn</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.product.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.product.index') }}">
                        <i class="fas fa-box"></i>
                        <p>Quản lý sản phẩm</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.category.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.category.index') }}">
                        <i class="fas fa-list"></i>
                        <p>Quản lý danh mục</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.news.index') }}">
                        <i class="fas fa-pencil-alt"></i>
                        <p>Quản lý bài viết</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.slider.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.slider.create') }}">
                        <i class="fas fa-image"></i>
                        <p>Quản lý sliders</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.partners.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.partners.index') }}">
                        <i class="fas fa-users"></i>
                        <p>Quản lý đối tác</p>
                    </a>
                </li>

                <li class="nav-item {{ request()->routeIs('admin.form.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.form.index') }}">
                        <i class="fa-regular fa-address-book"></i>
                        <p>Yêu cầu liên hệ</p>
                    </a>
                </li>
            </ul>

        </div>
    </div>
</div>
