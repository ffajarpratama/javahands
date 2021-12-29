<div class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #3A2218;">

    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <img src="{{ asset('placeholders/logos/jh-logo-text-white.png') }}" alt="sidebar_brand"
             style="width: 65%; height: auto;">
    </a>

    <hr class="sidebar-divider my-0">

    <div class="nav-item active">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </div>

    <hr class="sidebar-divider">

    <div class="nav-item">
        <a class="nav-link" href="{{ route('admin.products.index', ['category' => 'all_products']) }}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Products</span></a>
    </div>

    <!-- Nav Item - Tables -->
    <div class="nav-item">
        <a class="nav-link" href="{{ route('admin.categories.index') }}">
            <i class="fas fa-fw fa-table"></i>
            <span>Categories</span></a>
    </div>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</div>
