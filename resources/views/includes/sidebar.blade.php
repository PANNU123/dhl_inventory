 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
      <img src="{{asset('assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{route('backend.dashboard')}}" class="nav-link {{Route::is('dashboard') ? "active" : ""}}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
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
            <a href="{{route('backend.uom')}}" class="nav-link {{Route::is('uom*') ? "active" : ""}}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                UOM
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('backend.product')}}" class="nav-link {{Route::is('product*') ? "active" : ""}}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Product
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


          
          {{-- menu-open --}}
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
