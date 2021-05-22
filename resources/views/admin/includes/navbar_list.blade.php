<li class="{{ request()->routeIs('dashboard') ? 'active' : null }} has-sub">
    <a class="js-arrow" href="{{ route('dashboard') }}">
        <i class="fas fa-tachometer-alt"></i>Dashboard</a>
</li>

@can('view-inbox')
    <li class="{{ request()->routeIs('contacts.*') ? 'active' : null}} has-sub">
        <a class="js-arrow" href="{{ route('contacts.index') }}">
            <i class="fas fa-inbox"></i>Inbox</a>
    </li>
@endcan
<li class="{{ request()->routeIs('products.*') ? 'active' : null }} has-sub">
    <a class="js-arrow" href="{{ route('products.index') }}">
        <i class="fas fa-clipboard-list"></i>Articles</a>
</li>
@can('view-orders')
    <li class="{{ request()->routeIs('orders.*') ? 'active' : null }} has-sub">
        <a class="js-arrow" href="{{ route('orders.index') }}">
            <i class="fas fa-shopping-cart"></i>Orders</a>
    </li>
@endcan
@can('view-manage-admin')
    <li class="{{ request()->routeIs('admins.*') ? 'active' : null}} has-sub">
        <a class="js-arrow" href="{{ route('admins.index') }}">
            <i class="fas fa-users"></i>Manage admins</a>
    </li>
@endcan
