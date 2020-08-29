<div class="c-wrapper">
    <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
        <button class="c-header-toggler c-class-toggler d-lg-none mr-auto" type="button" data-target="#sidebar"
            data-class="c-sidebar-show"><span class="c-header-toggler-icon"></span></button><a
            class="c-header-brand d-sm-none" href="#"><img class="c-header-brand"
                src="{{ env('APP_URL', '') }}/assets/brand/coreui-base.svg" width="97" height="46"
                alt="CoreUI Logo"></a>
        <button class="c-header-toggler c-class-toggler ml-3 d-md-down-none" type="button" data-target="#sidebar"
            data-class="c-sidebar-lg-show" responsive="true"><span class="c-header-toggler-icon"></span></button>
        <?php
            use App\MenuBuilder\FreelyPositionedMenus;
            if(isset($appMenus['top menu'])){
                FreelyPositionedMenus::render( $appMenus['top menu'] , 'c-header-', 'd-md-down-none');
            }
        ?>
        <ul class="c-header-nav ml-auto mr-4">
            <li class="c-header-nav-item d-md-down-none mx-2">
                <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                    aria-expanded="false">
                    <svg class="c-icon">
                        <use xlink:href="{{ env('APP_URL', '') }}/icons/sprites/free.svg#cil-bell"></use>
                    </svg>
                    <span class="badge badge-pill badge-danger">5</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg pt-0">
                    <div class="dropdown-header bg-light"><strong>You have 5 notifications</strong></div><a
                        class="dropdown-item" href="#">
                        <svg class="c-icon mfe-2 text-success">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user-follow"></use>
                        </svg> New user registered</a><a class="dropdown-item" href="#">
                        <svg class="c-icon mfe-2 text-danger">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user-unfollow"></use>
                        </svg> User deleted</a><a class="dropdown-item" href="#">
                        <svg class="c-icon mfe-2 text-info">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-chart"></use>
                        </svg> Sales report is ready</a><a class="dropdown-item" href="#">
                        <svg class="c-icon mfe-2 text-success">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-basket"></use>
                        </svg> New client</a><a class="dropdown-item" href="#">
                        <svg class="c-icon mfe-2 text-warning">
                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
                        </svg> Server overloaded</a>
                    <div class="dropdown-header bg-light"><strong>Server</strong></div><a class="dropdown-item d-block"
                        href="#">
                        <div class="text-uppercase mb-1"><small><b>CPU Usage</b></small></div><span
                            class="progress progress-xs">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 25%" aria-valuenow="25"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </span><small class="text-muted">348 Processes. 1/4 Cores.</small>
                    </a><a class="dropdown-item d-block" href="#">
                        <div class="text-uppercase mb-1"><small><b>Memory Usage</b></small></div><span
                            class="progress progress-xs">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 70%"
                                aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                        </span><small class="text-muted">11444GB/16384MB</small>
                    </a><a class="dropdown-item d-block" href="#">
                        <div class="text-uppercase mb-1"><small><b>SSD 1 Usage</b></small></div><span
                            class="progress progress-xs">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 95%" aria-valuenow="95"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </span><small class="text-muted">243GB/256GB</small>
                    </a>
                </div>
            </li>
            <li class="c-header-nav-item d-md-down-none mx-2"><a class="c-header-nav-link">
                    <svg class="c-icon">
                        <use xlink:href="{{ env('APP_URL', '') }}/icons/sprites/free.svg#cil-list-rich"></use>
                    </svg></a></li>
            <li class="c-header-nav-item d-md-down-none mx-2"><a class="c-header-nav-link">
                    <svg class="c-icon">
                        <use xlink:href="{{ env('APP_URL', '') }}/icons/sprites/free.svg#cil-envelope-open"></use>
                    </svg></a></li>
            <li class="c-header-nav-item dropdown"><a class="c-header-nav-link" data-toggle="dropdown" href="#"
                    role="button" aria-haspopup="true" aria-expanded="false">
                    <div class="c-avatar"><img class="c-avatar-img"
                            src="{{ env('APP_URL', '') }}/assets/img/avatars/1.jpg" alt="user@email.com"></div>
                </a>
                <div class="dropdown-menu dropdown-menu-right pt-0">
                    <div class="dropdown-header bg-light py-2"><strong>Settings</strong></div><a class="dropdown-item"
                        href="#">
                        <svg class="c-icon mr-2">
                            <use xlink:href="{{ env('APP_URL', '') }}/icons/sprites/free.svg#cil-user"></use>
                        </svg> Profile</a><a class="dropdown-item" href="#">
                        <svg class="c-icon mr-2">
                            <use xlink:href="{{ env('APP_URL', '') }}/icons/sprites/free.svg#cil-settings"></use>
                        </svg> Settings</a>
                    <div class="dropdown-divider"></div><a class="dropdown-item" href="#">                       
                        <svg class="c-icon mr-2">
                            <use xlink:href="{{ env('APP_URL', '') }}/icons/sprites/free.svg#cil-account-logout"></use>
                        </svg>
                        <form action="{{ env('APP_URL', '') }}/logout" method="POST"> @csrf <button type="submit"
                                class="btn btn-ghost-dark btn-block">Logout</button></form>
                    </a>
                </div>
            </li>
        </ul>

        <!-- BreadCrumbs here -->
        @include('layouts.shared.breadcrumb')
    </header>
