<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('admin.dashboard.index') }}" class="app-brand-link">
            <span class="app-brand-logo demo">
                <img width="40" height="40" src="{{ asset('assets/admin/img/logo.png') }}" alt="logo-admin">
            </span>
            <span class="app-brand-text demo menu-text fw-bold">HoangGiang</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        @if (userHasPermission('admin.dashboard.index'))
            <li class="menu-item {{ request()->routeIs('admin.dashboard.index') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-smart-home"></i>
                    <div>Dashboards</div>
                </a>
            </li>
        @endif
        <!-- /. Dashboards -->

        @if (userHasAnyPermission(['admin.services.index']))
            <li class="menu-header small">
                <span class="menu-header-text" data-i18n="DANH MỤC">DỊCH VỤ</span>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.services*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-user"></i>
                    <div data-i18n="Danh mục">Dịch vụ</Div>
                </a>
                <ul class="menu-sub">
                    @if (userHasPermission('admin.services.create'))
                        <li class="menu-item {{ request()->routeIs('admin.services.create') ? 'active' : '' }}">
                            <a href="{{ route('admin.services.create') }}" class="menu-link">
                                <div data-i18n="Phòng ban">Tạo dịch vụ</div>
                            </a>
                        </li>
                    @endif
                    @if (userHasPermission('admin.services.index'))
                        <li
                            class="menu-item {{ request()->routeIs('admin.services.index') | request()->routeIs('admin.services.edit') ? 'active' : '' }}">
                            <a href="{{ route('admin.services.index') }}" class="menu-link">
                                <div data-i18n="Phòng ban">DS dịch vụ</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        @if (userHasAnyPermission(['admin.images.index']))
            <li class="menu-header small">
                <span class="menu-header-text" data-i18n="DANH MỤC">HÌNH ẢNH</span>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.images*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon ti ti-photo-scan"></i>
                    <div data-i18n="Danh mục">Hình ảnh</Div>
                </a>
                <ul class="menu-sub">
                    @if (userHasPermission('admin.images.create'))
                        <li class="menu-item {{ request()->routeIs('admin.images.create') ? 'active' : '' }}">
                            <a href="{{ route('admin.images.create') }}" class="menu-link">
                                <div data-i18n="Phòng ban">Tạo Hình ảnh</div>
                            </a>
                        </li>
                    @endif
                    @if (userHasPermission('admin.images.index'))
                        <li
                            class="menu-item {{ request()->routeIs('admin.images.index') | request()->routeIs('admin.images.edit') ? 'active' : '' }}">
                            <a href="{{ route('admin.images.index') }}" class="menu-link">
                                <div data-i18n="Phòng ban">DS Hình ảnh</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        @if (userHasAnyPermission(['admin.galleries.index']))
            <li class="menu-header small">
                <span class="menu-header-text" data-i18n="DANH MỤC">DANH MỤC</span>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.galleries*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-category"></i>
                    <div data-i18n="Danh mục">Danh mục</Div>
                </a>
                <ul class="menu-sub">
                    @if (userHasPermission('admin.galleries.index'))
                        <li
                            class="menu-item {{ request()->routeIs('admin.galleries.index') | request()->routeIs('admin.galleries.edit') ? 'active' : '' }}">
                            <a href="{{ route('admin.galleries.index') }}" class="menu-link">
                                <div data-i18n="Phòng ban">DS Danh mục</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        @if (userHasAnyPermission(['admin.branches.index']))
            <li class="menu-header small">
                <span class="menu-header-text" data-i18n="DANH MỤC">Chi nhánh</span>
            </li>
            <li class="menu-item {{ request()->routeIs('admin.branches*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon ti ti-comet"></i><div data-i18n="Danh mục">Chi nhánh</Div>
                </a>
                <ul class="menu-sub">
                    @if (userHasPermission('admin.branches.create'))
                        <li class="menu-item {{ request()->routeIs('admin.branches.create') ? 'active' : '' }}">
                            <a href="{{ route('admin.branches.create') }}" class="menu-link">
                                <div data-i18n="Phòng ban">Tạo Chi nhánh</div>
                            </a>
                        </li>
                    @endif
                    @if (userHasPermission('admin.branches.index'))
                        <li
                            class="menu-item {{ request()->routeIs('admin.branches.index') | request()->routeIs('admin.branches.edit') ? 'active' : '' }}">
                            <a href="{{ route('admin.branches.index') }}" class="menu-link">
                                <div data-i18n="Phòng ban">DS Chi nhánh</div>
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        @if (userHasAnyPermission(['admin.homestays.index']))
        <li class="menu-header small">
            <span class="menu-header-text" data-i18n="DANH MỤC">Homestay</span>
        </li>
        <li class="menu-item {{ request()->routeIs('admin.homestays*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon ti ti-comet"></i><div data-i18n="Danh mục">Homestay</Div>
            </a>
            <ul class="menu-sub">
                @if (userHasPermission('admin.homestays.create'))
                    <li class="menu-item {{ request()->routeIs('admin.homestays.create') ? 'active' : '' }}">
                        <a href="{{ route('admin.homestays.create') }}" class="menu-link">
                            <div data-i18n="Phòng ban">Tạo Homestay</div>
                        </a>
                    </li>
                @endif
                @if (userHasPermission('admin.homestays.index'))
                    <li
                        class="menu-item {{ request()->routeIs('admin.homestays.index') | request()->routeIs('admin.homestays.edit') ? 'active' : '' }}">
                        <a href="{{ route('admin.homestays.index') }}" class="menu-link">
                            <div data-i18n="Phòng ban">DS Homestay</div>
                        </a>
                    </li>
                @endif
            </ul>
        </li>
    @endif
        <!-- Categories -->
        @if (userHasAnyPermission([
            ]))
            <li class="menu-header small">
                <span class="menu-header-text" data-i18n="DANH MỤC">DANH MỤC</span>
            </li>
            <li
                class="menu-item {{ request()->routeIs('admin.departments*')
                    ? 'active open'
                    : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-category"></i>
                    <div data-i18n="Danh mục">Danh mục</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ request()->routeIs('admin.dashboard.index') ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard.index') }}" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-smart-home"></i>
                            <div>Dashboards</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endif
        <!-- /. Categories -->

        <!-- Systems -->
        @if (userHasAnyPermission([
                'admin.systems.generals',
                'admin.systems.apis',
                'admin.systems.edit',
                'admin.users.index',
                'admin.roles.index',
                'admin.coach-systems.edit',
            ]))
            <li class="menu-header small">
                <span class="menu-header-text" data-i18n="CẤU HÌNH HỆ THỐNG">CẤU HÌNH HỆ THỐNG</span>
            </li>
            <li
                class="menu-item {{ request()->routeIs('admin.systems*') |
                request()->routeIs('admin.roles*') |
                request()->routeIs('admin.users*') |
                request()->routeIs('admin.coach-systems*')
                    ? 'active open'
                    : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-settings"></i>
                    <div data-i18n="Cấu hình hệ thống">Cấu hình hệ thống</div>
                </a>
                <ul class="menu-sub">
                    @if (userHasAnyPermission(['admin.users.index', 'admin.roles.index']))
                        <li
                            class="menu-item {{ request()->routeIs('admin.roles*') | request()->routeIs('admin.user*') ? 'active open' : '' }}">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons ti ti-shopping-cart"></i>
                                <div data-i18n="Phân quyền">Phân quyền</div>
                            </a>
                            <ul class="menu-sub">
                                @if (userHasPermission('admin.users.index'))
                                    <li class="menu-item {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.users.index') }}" class="menu-link">
                                            <div data-i18n="DS Người dùng">DS Người dùng</div>
                                        </a>
                                    </li>
                                @endif

                                @if (userHasPermission('admin.roles.index'))
                                    <li class="menu-item {{ request()->routeIs('admin.roles*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.roles.index') }}" class="menu-link">
                                            <div data-i18n="DS Role">DS Role</div>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                    @endif

                    @if (userHasAnyPermission([
                            'admin.systems.generals',
                            'admin.systems.apis',
                            'admin.systems.edit',
                            'admin.coach-systems.generals',
                            'admin.coach-systems.apis',
                            'admin.coach-systems.edit',
                        ]))
                        <li
                            class="menu-item {{ request()->routeIs('admin.systems*') | request()->routeIs('admin.coach-systems*') ? 'active open' : '' }}">
                            <a href="javascript:void(0);" class="menu-link menu-toggle">
                                <i class="menu-icon tf-icons ti ti-shopping-cart"></i>
                                <div data-i18n="Cấu hình chung">Cấu hình chung</div>
                            </a>
                            <ul class="menu-sub">
                                @if (userHasPermission('admin.systems.generals'))
                                    <li
                                        class="menu-item {{ request()->routeIs('admin.systems.generals') ? 'active' : '' }}">
                                        <a href="{{ route('admin.systems.generals') }}" class="menu-link">
                                            <div data-i18n="Chung">Chung</div>
                                        </a>
                                    </li>
                                @endif

                                {{-- @if (userHasPermission('admin.systems.apis'))
                                    <li
                                        class="menu-item {{ request()->routeIs('admin.systems.apis') ? 'active' : '' }}">
                                        <a href="{{ route('admin.systems.apis') }}" class="menu-link">
                                            <div data-i18n="APIs">APIs</div>
                                        </a>
                                    </li>
                                @endif --}}

                                {{-- @if (userHasPermission('admin.systems.services'))
                                    <li
                                        class="menu-item {{ request()->routeIs('admin.systems.services') ? 'active' : '' }}">
                                        <a href="{{ route('admin.systems.services') }}" class="menu-link">
                                            <div data-i18n="Dịch vụ thứ 3">Dịch vụ thứ 3</div>
                                        </a>
                                    </li>
                                @endif --}}

                                @if (userHasPermission('admin.systems.socials'))
                                    <li
                                        class="menu-item {{ request()->routeIs('admin.systems.socials') ? 'active' : '' }}">
                                        <a href="{{ route('admin.systems.socials') }}" class="menu-link">
                                            <div data-i18n="Mạng xã hội">Mạng xã hội</div>
                                        </a>
                                    </li>
                                @endif
                                {{--
                                @if (userHasPermission('admin.systems.config-contracts'))
                                    <li
                                        class="menu-item {{ request()->routeIs('admin.systems.config-contracts') ? 'active' : '' }}">
                                        <a href="{{ route('admin.systems.config-contracts') }}" class="menu-link">
                                            <div data-i18n="Contract">Hợp đồng</div>
                                        </a>
                                    </li>
                                @endif --}}
                                {{-- @if (userHasPermission('admin.systems.config-shareholders'))
                                    <li
                                        class="menu-item {{ request()->routeIs('admin.systems.config-shareholders') ? 'active' : '' }}">
                                        <a href="{{ route('admin.systems.config-shareholders') }}" class="menu-link">
                                            <div data-i18n="shareholder">shareholder</div>
                                        </a>
                                    </li>
                                @endif --}}



                                {{-- @if (userHasPermission('admin.systems.notifications'))
                                    <li
                                        class="menu-item {{ request()->routeIs('admin.systems.notifications') ? 'active' : '' }}">
                                        <a href="{{ route('admin.systems.notifications') }}" class="menu-link">
                                            <div data-i18n="Notifications">Notifications</div>
                                        </a>
                                    </li>
                                @endif --}}
                            </ul>
                        </li>
                    @endif
                </ul>
            </li>
        @endif
        <!-- /. Systems -->
    </ul>
</aside>
