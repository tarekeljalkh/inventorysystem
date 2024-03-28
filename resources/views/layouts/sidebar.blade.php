<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">InventorySystem</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#"><img style="width: 35px" src="{{ asset(config('settings.logo')) }}" alt="IS"></a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('dashboard') }}"><i class="fas fa-fire"></i>
                    <span>Dashboard</span></a></li>

            @if (auth()->user()->role == 'admin')
                <li class="{{ request()->routeIs('users.index') ? 'active' : '' }}"><a class="nav-link"
                        href="{{ route('users.index') }}"><i class="fas fa-users"></i>
                        <span>Users</span></a></li>
            @endif

            <li class="menu-header">System Control</li>

            {{-- <li class="dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                        class="fas fa-columns"></i> <span>Layout</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
                    <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
                    <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
                </ul>
            </li> --}}

            <li class="{{ request()->routeIs('categories.index') ? 'active' : '' }}"><a class="nav-link"
                href="{{ route('categories.index') }}"><i class="fas fa-inbox"></i>
                <span>Categories</span></a></li>

            <li class="{{ request()->routeIs('items.index') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('items.index') }}"><i class="fas fa-sitemap"></i>
                    <span>Items</span></a></li>

            <li class="{{ request()->routeIs('clients.index') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('clients.index') }}"><i class="fas fa-user"></i>
                    <span>Clients</span></a></li>

            <li class="{{ request()->routeIs('checkouts.index') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('checkouts.index') }}"><i class="fas fa-sign-out-alt"></i>
                    <span>Checkout Items</span></a></li>

            <li class="{{ request()->routeIs('reports.index') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('reports.index') }}"><i class="fas fa-newspaper"></i>
                    <span>Reports</span></a></li>


        </ul>

    </aside>
</div>
