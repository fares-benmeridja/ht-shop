<!-- HEADER DESKTOP-->
<header class="header-desktop">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap">
                <div class="header-button">
                    <div class="account-wrap">
                        <div class="account-item clearfix js-item-menu">
                            <div class="content">
                                <a class="js-acc-btn">{{ auth()->user()->full_name }}</a>
                            </div>
                            <div class="account-dropdown js-dropdown">
                                <div class="info clearfix">
                                    <div class="content">
                                        <h5 class="name">
                                            <a>{{ auth()->user()->full_name }}</a>
                                        </h5>
                                        <span class="email">{{ auth()->user()->email }}</span>
                                    </div>
                                </div>
                                <div class="account-dropdown__body">
                                    <div class="account-dropdown__item">
                                        <a href="{{ route('profil') }}">
                                            <i class="zmdi zmdi-account"></i>Account</a>
                                    </div>
                                </div>
                                <div class="account-dropdown__footer">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="zmdi zmdi-power"></i>
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- HEADER DESKTOP-->