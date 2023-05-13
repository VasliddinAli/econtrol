@php

$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();
//dd($prefix);
@endphp

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('dashboard') }}" class="text-light">
        <span class="text-light text-center ml-4">E-Controller</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('backend/dist/img/logo.png') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('dashboard') }}" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ ($route == 'dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home nav-icon"></i>
                        <p>Asosiy</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('all.ceo') }}" class="nav-link {{ ($route == 'all.ceo') ? 'active' : '' }}">
                        <i class="fas fa-user nav-icon"></i>
                        <p>CEO</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('all.device') }}" class="nav-link {{ ($route == 'all.device') ? 'active' : '' }}">
                        <i class="fas fa-mobile nav-icon"></i>
                        <p>Qurilmalar</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('all.employee') }}" class="nav-link {{ ($route == 'all.employee') ? 'active' : '' }}">
                        <i class="fas fa-users nav-icon"></i>
                        <p>Hodimlar</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('all.attendance') }}" class="nav-link {{ ($route == 'all.attendance') ? 'active' : '' }}">
                        <i class="fas fa-table nav-icon"></i>
                        <p>Davomat</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>