<div class="page-sidebar sidebar horizontal-bar">
    <div class="page-sidebar-inner">
        <ul class="menu accordion-menu">
            <li class="nav-heading"><span>Navigation</span></li>
            <li class="active"><a href="{{URL::to('dashboard')}}"><span class="menu-icon icon-speedometer"></span><p>@lang('navigation.dashboard')</p></a></li>
            <li><a href="{{URL::to('profile')}}"><span class="menu-icon icon-user"></span><p>@lang('navigation.profile')</p></a></li>
            <li data-menu="#">
                <a href="{{URL::to('virtual')}}">
                        <span>
                            <i class="glyphicon glyphicon-hdd"></i>
                        </span>
                    <p>@lang('navigation.vps')</p>
                </a>
            </li>
            <li data-menu="#">
                <a href="{{URL::to('dedicated')}}">
                        <span>
                            <i class="glyphicon glyphicon-tasks"></i>
                        </span>
                    <p>@lang('navigation.dedicated')</p>
                </a>
            </li>
            <li data-menu="#">
                <a href="{{URL::to('shop')}}">
                        <span>
                            <i class="glyphicon glyphicon-shopping-cart"></i>
                        </span>
                    <p>@lang('navigation.shop')</p>
                </a>
            </li>
            <li data-menu="profile">
                <a href="{{URL::to('profile')}}">
                        <span>
                            <i class="glyphicon glyphicon-user"></i>
                        </span>
                    <p>@lang('navigation.profile')</p>
                </a>
            </li>
            <li data-menu="inbox">
                <a href="{{URL::to('support')}}">
                        <span>
                            <i class="glyphicon glyphicon-envelope"></i>
                        </span>
                    <p>@lang('navigation.support')</p>
                </a>
            </li>

            <li data-menu="#">
                <a href="{{URL::to('settings')}}">
                        <span>
                            <i class="glyphicon glyphicon-cog"></i>
                        </span>
                    <p>@lang('navigation.settings')</p>
                </a>
            </li>
        </ul>
    </div><!-- Page Sidebar Inner -->
</div><!-- Page Sidebar -->