<!-- MENU SIDEBAR-->
<aside class="menu-sidebar d-none d-lg-block">
    <div class="logo">
        <a href="{{ route('main') }}">
            <img src="{{ asset('img/logo.png') }}" width ="150px" alt="">
        </a>
    </div>
    <div class="menu-sidebar__content js-scrollbar1">
        <nav class="navbar-sidebar">
            <ul class="list-unstyled navbar__list">
               @include('admin.includes.navbar_list')
            </ul>
        </nav>
    </div>
</aside>
<!-- END MENU SIDEBAR-->