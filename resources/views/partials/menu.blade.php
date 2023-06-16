<aside class="main-sidebar sidebar-dark-primary" style="min-height: 917px;">
 <!-- Sidebar -->
 <div class="sidebar">
    <!-- Sidebar user (optional) -->

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route("home") }}" class="nav-link {{ request()->is("home") ? "active" : "" }}">
                    <i class="fas fa-fw fa-tachometer-alt nav-icon"></i>
                    <p>
                        {{ trans('global.dashboard') }}
                    </p>
                </a>
            </li>
            @can('management_access')
            <li class="nav-item has-treeview {{ request()->is("admin/permissions*") ? "menu-open" : "" }} {{ request()->is("admin/roles*") ? "menu-open" : "" }} {{ request()->is("admin/users*") ? "menu-open" : "" }}">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw bi bi-list-task nav-icon"></i>
                    <p>
                        {{ trans('global.management') }}
                        <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @can('user_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "active" : "" }}">
                            <i class="fas fa-fw bi bi-person-fill nav-icon"></i>
                            <p>
                                {{ trans('cruds.user.title') }}
                            </p>
                        </a>
                    </li>
                    @endcan
                    @can('permission_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.permissions.index") }}" class="nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "active" : "" }}">
                            <i class="fas fa-fw bi bi-ticket-perforated-fill nav-icon"></i>
                            <p>
                                {{ trans('cruds.permission.title') }}
                            </p>
                        </a>
                    </li>
                    @endcan
                    @can('role_access')
                    <li class="nav-item">
                        <a href="{{ route("admin.roles.index") }}" class="nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "active" : "" }}">
                            <i class="fas fa-fw bi bi-universal-access nav-icon"></i>
                            <p>
                                {{ trans('cruds.role.title') }}
                            </p>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('teacher_access') 
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw bi bi-file-person-fill nav-icon"></i>
                    <p>
                        {{ trans('global.teachers') }}
                    </p>
                </a>
            </li> 
            @endcan
            @can('student_access')
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw bi bi-people-fill nav-icon"></i>
                    <p>
                        {{ trans('global.students') }}
                    </p>
                </a>
            </li>
            @endcan
            @can('fee_salary_access')
            <li class="nav-item has-treeview">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw bi bi-cash-stack nav-icon"></i>
                    <p>
                        {{ trans('global.fee_salary') }}
                        <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @can('salary_access')
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-fw bi bi-cash nav-icon"></i>
                            <p>
                                {{ trans('global.fee_salary_management.salary') }}
                            </p>
                        </a>
                    </li>
                    @endcan
                    @can('fee_access')
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-fw bi bi-wallet-fill nav-icon"></i>
                            <p>
                                {{ trans('global.fee_salary_management.fees') }}
                            </p>
                        </a>
                    </li>
                    @endcan
                    @can('fee_remainder_access') 
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-fw bi bi-alarm-fill nav-icon"></i>
                            <p>
                                {{ trans('global.fee_salary_management.fees_remainder') }}
                            </p>
                        </a>
                    </li> 
                    @endcan 
                </ul>
            </li> 
            @endcan
            @can('attendence_access')
            <li class="nav-item has-treeview">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw bi bi-building-fill-check nav-icon"></i>
                    <p>
                        {{ trans('global.attendence') }}
                        <i class="right fa fa-fw fa-angle-left nav-icon"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @can('teacher_attendence_access')
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-fw bi bi-person-fill-check nav-icon"></i>
                            <p>
                                {{ trans('global.attendance_management.teacher_attendance') }}
                            </p>
                        </a>
                    </li>
                    @endcan
                    @can('student_attendence_access')
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-fw bi bi-person-lines-fill nav-icon"></i>
                            <p>
                                {{ trans('global.attendance_management.student_attendance') }}
                            </p>
                        </a>
                    </li>
                    @endcan
                </ul>
            </li>
            @endcan
            @can('holiday_schedular_access')
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw bi bi-calendar-check-fill nav-icon"></i>
                    <p>
                        {{ trans('global.holiday_scheduler') }}
                    </p>
                </a>
            </li> 
            @endcan            
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <p>
                        <i class="fas fa-fw fa-sign-out-alt nav-icon"></i>
                        <p>{{ trans('global.logout') }}</p>
                    </p>
                </a>
            </li>
        </ul>
    </nav>
</div>
</aside>