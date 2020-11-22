<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <div class="app-sidebar__user"><img class="app-sidebar__user-avatar img-fluid"
                                        src="{{auth()->user()->image_path}}"
                                         style="border-radius: 50%" width="40px"
                                        alt="User Image">
        <div>
            <p class="app-sidebar__user-name">{{ auth()->user()->name }}</p>
            <p class="app-sidebar__user-designation">Frontend Developer</p>
        </div>
    </div>
    <ul class="app-menu">
        <li><a class="app-menu__item " href="{{ route('admin.home') }}"><i
                    class="app-menu__icon fa fa-dashboard"></i><span
                    class="app-menu__label">@lang('site.dashboard')</span></a></li>

        @if(auth()->user()->hasPermissionTo('read_users'))
        <li><a class="app-menu__item " href="{{ route('users.index') }}"><i
                    class="app-menu__icon fa fa-users"></i><span
                    class="app-menu__label">@lang('site.users')</span></a></li>
        @endif
        @if(auth()->user()->hasPermissionTo('read_categories'))
            <li><a class="app-menu__item " href="{{ route('categories.index') }}"><i
                        class="app-menu__icon fa fa-list"></i><span
                        class="app-menu__label">@lang('site.categories')</span></a></li>
        @endif


        @if(auth()->user()->hasPermissionTo('read_roles'))
        <li><a class="app-menu__item " href="{{ route('roles.index') }}"><i
                    class="app-menu__icon fa fa-lock"></i><span
                    class="app-menu__label">@lang('site.roles')</span></a></li>
        @endif

        @if(auth()->user()->hasPermissionTo('read_settings'))

                    <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-gear"></i><span class="app-menu__label">@lang('site.settings')</span><i class="treeview-indicator fa fa-angle-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a class="treeview-item" href="{{ route('setting.social.login') }}"><i class="icon fa fa-circle-o"></i> Social Login</a></li>
                            <li><a class="treeview-item" href="{{ route('setting.social.links') }}"><i class="icon fa fa-circle-o"></i> Social Links</a></li>
                        </ul>
                    </li>

        @endif


        {{--        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">UI Elements</span><i class="treeview-indicator fa fa-angle-right"></i></a>--}}
        {{--            <ul class="treeview-menu">--}}
        {{--                <li><a class="treeview-item" href="bootstrap-components.html"><i class="icon fa fa-circle-o"></i> Bootstrap Elements</a></li>--}}
        {{--                <li><a class="treeview-item" href="https://fontawesome.com/v4.7.0/icons/" target="_blank" rel="noopener"><i class="icon fa fa-circle-o"></i> Font Icons</a></li>--}}
        {{--                <li><a class="treeview-item" href="ui-cards.html"><i class="icon fa fa-circle-o"></i> Cards</a></li>--}}
        {{--                <li><a class="treeview-item" href="widgets.html"><i class="icon fa fa-circle-o"></i> Widgets</a></li>--}}
        {{--            </ul>--}}
        {{--        </li>--}}
    </ul>
</aside>
