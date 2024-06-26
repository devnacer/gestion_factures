  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="{{ route('dashboard')}}" class="brand-link">
          <img src="{{ URL::asset('assets/img/logoInvoiceMaster.png') }}" alt="Invoice Master Logo"
              class="brand-image" style="opacity: .9" >
          <span class="brand-text font-weight-light"><b>Invoice</b>Master</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
              <div class="image">
                  <img src="{{ URL::asset('assets/img/user1-128x128.jpg') }}" class="img-circle elevation-2"
                      alt="User Image">
              </div>
              <div class="info">
                  <a href="#" class="d-block">{{ Auth::user()->name }}</a>
              </div>
          </div>

          <!-- SidebarSearch Form -->
          <div class="form-inline">
              <div class="input-group" data-widget="sidebar-search">
                  <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                      aria-label="Search">
                  <div class="input-group-append">
                      <button class="btn btn-sidebar">
                          <i class="fas fa-search fa-fw"></i>
                      </button>
                  </div>
              </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
              <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                  data-accordion="false">
                  <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                  @can('home Page show')
                      <li class="nav-item">
                          <a href="{{ route('dashboard') }}" class="nav-link">
                              <i class="nav-icon fas fa-th"></i>
                              <p>
                                  {{ trans('main-sidebar.Home') }}
                              </p>
                          </a>
                      </li>
                  @endcan

                  @can('Invoices')
                      <li class="nav-item">
                          <a href="#" class="nav-link">
                              <i class="nav-icon fas fa-copy"></i>
                              <p>
                                  {{ trans('main-sidebar.Invoices') }}
                                  <i class="fas fa-angle-left right"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">

                              @can('Invoices List')
                                  <li class="nav-item">
                                      <a href="{{ route('invoices.index') }}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>{{ trans('main-sidebar.Invoices list') }}</p>
                                      </a>
                                  </li>
                              @endcan

                              @can('Paid Invoices')
                                  <li class="nav-item">
                                      <a href="{{ route('invoices.paid') }}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>{{ trans('main-sidebar.Paid invoices') }}</p>
                                      </a>
                                  </li>
                              @endcan

                              @can('Unpaid Invoices')
                                  <li class="nav-item">
                                      <a href="{{ route('invoices.unpaid') }}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>{{ trans('main-sidebar.Unpaid invoices') }}</p>
                                      </a>
                                  </li>
                              @endcan

                              @can('Partially Paid Invoices')
                                  <li class="nav-item">
                                      <a href="{{ route('invoices.partially_paid') }}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>{{ trans('main-sidebar.Partially paid invoices') }}</p>
                                      </a>
                                  </li>
                              @endcan

                              @can('Invoices Archive')
                                  <li class="nav-item">
                                      <a href="{{ route('archive.index') }}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>{{ trans('main-sidebar.Archived invoices') }}</p>
                                      </a>
                                  </li>
                              @endcan

                          </ul>
                      </li>
                  @endcan

                  @can('Reports')
                      <li class="nav-item">
                          <a href="#" class="nav-link">
                              <i class="nav-icon fas fa-chart-pie"></i>
                              <p>
                                  {{ trans('main-sidebar.Reports') }}
                                  <i class="right fas fa-angle-left"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">
                              @can('Invoices Report')
                                  <li class="nav-item">
                                      <a href="{{ route('invoices_report') }}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>{{ trans('main-sidebar.Invoices Reports') }}</p>
                                      </a>
                                  </li>
                              @endcan
                              @can('Customers Report')
                                  <li class="nav-item">
                                      <a href="{{ route('customers_report') }}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>{{ trans('main-sidebar.Customers Reports') }}</p>
                                      </a>
                                  </li>
                              @endcan
                          </ul>
                      </li>
                  @endcan



                  @can('Users')
                      <li class="nav-item">
                          <a href="#" class="nav-link">
                              <i class="nav-icon fas fa-tree"></i>
                              <p>
                                  {{ trans('main-sidebar.Users') }}
                                  <i class="fas fa-angle-left right"></i>
                              </p>
                          </a>

                          <ul class="nav nav-treeview">

                              @can('Users List')
                                  <li class="nav-item">
                                      <a href="{{ route('users.index') }}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>{{ trans('main-sidebar.List of Users') }}</p>
                                      </a>
                                  </li>
                              @endcan

                              @can('Users Permissions')
                                  <li class="nav-item">
                                      <a href="{{ route('roles.index') }}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>{{ trans('main-sidebar.Users Rights') }}</p>
                                      </a>
                                  </li>
                              @endcan

                          </ul>
                      </li>
                  @endcan

                  @can('Settings')
                      <li class="nav-item">
                          <a href="#" class="nav-link">
                              <i class="nav-icon fas fa-edit"></i>
                              <p>
                                  {{ trans('main-sidebar.Settings') }}
                                  <i class="fas fa-angle-left right"></i>
                              </p>
                          </a>
                          <ul class="nav nav-treeview">

                              @can('Sections')
                                  <li class="nav-item">
                                      <a href="{{ route('sections.index') }}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>{{ trans('main-sidebar.Sections') }}</p>
                                      </a>
                                  </li>
                              @endcan

                              @can('Products')
                                  <li class="nav-item">
                                      <a href="{{ route('products.index') }}" class="nav-link">
                                          <i class="far fa-circle nav-icon"></i>
                                          <p>{{ trans('main-sidebar.Products') }}</p>
                                      </a>
                                  </li>
                              @endcan
                          </ul>
                      </li>
                  @endcan


                  <li class="nav-header">EXAMPLES</li>
                  <li class="nav-item">
                      <a href="https://adminlte.io/docs/3.1/" class="nav-link">
                          <i class="nav-icon fas fa-file"></i>
                          <p>Documentation</p>
                      </a>
                  </li>
              </ul>
          </nav>
          <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
  </aside>
