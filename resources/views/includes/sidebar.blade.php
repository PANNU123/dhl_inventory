 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{route('backend.dashboard')}}" class="brand-link">
      <img src="{{asset('assets/dist/img/DHL-Logo.png')}}" alt="DHL Logo" class="elevation-2" style="height: 100px;width: 230px;">
{{--      <span class="brand-text font-weight-light">AdminLTE 3</span>--}}
    </a>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{route('backend.dashboard')}}" class="nav-link {{Route::is('backend.dashboard') ? "active" : ""}}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
            <li class="nav-item">
                <a href="{{route('backend.route')}}" class="nav-link {{Route::is('backend.route*') ? "active" : ""}}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Route
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('backend.vendor')}}" class="nav-link {{Route::is('backend.vendor*') ? "active" : ""}}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Vendor
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('backend.vehicle') }}" class="nav-link {{Route::is('backend.vehicle*') ? "active" : ""}}">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        Vehicle
                    </p>
                </a>
            </li>

            {{-- menu-open --}}
            <li class="nav-item {{Route::is('backend.category*') || Route::is('backend.sub.category*') || Route::is('backend.uom*') || Route::is('backend.product*')  ? "menu-open" : ""}}">
                <a href="#" class="nav-link {{Route::is('backend.category*') || Route::is('backend.sub.category*') || Route::is('backend.uom*') || Route::is('backend.product*') ? "active" : ""}}">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Products
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('backend.category')}}" class="nav-link {{Route::is('backend.category*') ? "active" : ""}}">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Category
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('backend.sub.category')}}" class="nav-link {{Route::is('backend.sub.category*') ? "active" : ""}}">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Sub Category
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('backend.uom')}}" class="nav-link {{Route::is('backend.uom*') ? "active" : ""}}">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                UOM
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('backend.product')}}" class="nav-link {{Route::is('backend.product*') ? "active" : ""}}">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Product
                            </p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item ">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Request Products
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('backend.request.product.create')}}" class="nav-link {{Route::is('backend.backend.request.product*') ? "active" : ""}}">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Commercial
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('backend.request.product')}}" class="nav-link {{Route::is('backend.backend.request.product*') ? "active" : ""}}">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Product Review
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('backend.request.product.approved')}}" class="nav-link {{Route::is('backend.backend.request.product*') ? "active" : ""}}">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                               Approved Product
                            </p>
                        </a>
                    </li>
                </ul>
            </li>

          <li class="nav-item ">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                User Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('backend.user.list')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('backend.role.list')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Role</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
    </div>
  </aside>
