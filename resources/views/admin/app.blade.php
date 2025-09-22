<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../../assets/"
  data-template="vertical-menu-template"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Boomerang Rentals</title>

    <meta name="description" content="Boomerang Rentals" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
  

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css') }}" />
    <!-- <link rel="stylesheet" href="../../assets/vendor/fonts/iconify-icons.css" /> -->

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
    @notifyCss
    <!-- Page CSS -->

    @yield('pagecss')
    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
     
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
         

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="" class="app-brand-link">
              <span class="app-brand-logo demo">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64" height="64" viewBox="0 0 64 64">
                    <image xlink:href="data:image/png;base64,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" x="0" y="0" width="64" height="64"/>
                  </svg>
              </span>
              <span class="app-brand-text menu-text fw-bold">Boomerang</span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
              <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
              <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1">
            <!-- Dashboards -->
            <li class="menu-item">
              <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Dashboard">Dashboard</div>
                <div class="badge bg-label-primary rounded-pill ms-auto"></div>
              </a>
              
            </li>
            <li class="menu-item">
              <a href="" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-car"></i>
                <div data-i18n="Fleet">Fleet</div>
                <div class="badge bg-label-primary rounded-pill ms-auto"></div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="{{ route('fleet') }}" class="menu-link">
                    <div data-i18n="Fleet List">Fleet List</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('fleet.available') }}" class="menu-link">
                    <div data-i18n="Available Fleet">Available Fleet</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('fleet.running') }}" class="menu-link">
                    <div data-i18n="Running Fleet">Running Fleet</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('fleet.notready') }}" class="menu-link">
                    <div data-i18n="Not Ready Fleet">Not Ready Fleet</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('addfleet') }}" class="menu-link">
                    <div data-i18n="Add Fleet">Add Fleet</div>
                  </a>
                </li>
              </ul>
              
            </li>
            <li class="menu-item">
              <a href="" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-package"></i>
                <div data-i18n="Parts">Parts</div>
                <div class="badge bg-label-primary rounded-pill ms-auto"></div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="{{ route('admin.parts.car') }}" class="menu-link">
                    <div data-i18n="Car Parts">Car parts</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('admin.parts.motorcycle') }}" class="menu-link">
                    <div data-i18n="Motorcycle Parts">Motorcycle Parts</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('admin.parts.ebike') }}" class="menu-link">
                    <div data-i18n="Ebike Parts">Ebike Parts</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('admin.parts.other') }}" class="menu-link">
                    <div data-i18n="Other Parts">Other Parts</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('addparts') }}" class="menu-link">
                    <div data-i18n="Add Parts">Add Parts</div>
                  </a>
                </li>
                
                
                
              </ul>
              
            </li>
            <li class="menu-item">
              <a href="" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div data-i18n="Customer">Customer</div>
                <div class="badge bg-label-primary rounded-pill ms-auto"></div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="{{ route('admin.customers.list') }}" class="menu-link">
                    <div data-i18n="Customers">Customers</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('admin.vehicle.lookup') }}" class="menu-link">
                    <div data-i18n="Customer Vehicles">Customer Vehicles</div>
                  </a>
                </li>
                
                
                
              </ul>
              
            </li>
            
            <li class="menu-item has-sub">
              <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon ti ti-tool"></i>
                <div data-i18n="Services">Services</div>
                <div class="badge bg-label-primary rounded-pill ms-auto"></div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="{{ route('admin.services.list') }}" class="menu-link">
                    <div data-i18n="Service Catalog">Service Catalog</div>
                  </a>
                </li>
                
              </ul>
            </li>

            <!-- Invoice Management -->
            <li class="menu-item has-sub">
              <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon ti ti-file-invoice"></i>
                <div data-i18n="Invoices">Invoices</div>
                <div class="badge bg-label-primary rounded-pill ms-auto"></div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="{{ route('admin.invoices.list') }}" class="menu-link">
                    <div data-i18n="Invoice List">Invoice List</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('admin.invoices.create') }}" class="menu-link">
                    <div data-i18n="Create Invoice">Create Invoice</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('admin.consolidated-invoices.list') }}" class="menu-link">
                    <div data-i18n="Consolidated Invoices">Consolidated Invoices</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('admin.consolidated-invoices.create') }}" class="menu-link">
                    <div data-i18n="Create Consolidated">Create Consolidated</div>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Settings (only for super/admin) -->
            @if(Auth::user() && (Auth::user()->role === 'super' || Auth::user()->role === 'admin'))
            <li class="menu-item has-sub">
              <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon ti ti-settings"></i>
                <div data-i18n="Settings">Settings</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="{{ route('admin.settings') }}" class="menu-link">
                    <div data-i18n="System Settings">System Settings</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('admin.team.list') }}" class="menu-link">
                    <div data-i18n="Team Management">Team Management</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('admin.owner.edit') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-crown"></i>
                    <div data-i18n="Business Owner">Business Owner</div>
                  </a>
                </li>
                @if(Auth::user()->role === 'super')
                <li class="menu-item">
                  <a href="{{ route('admin.users.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-users"></i>
                    <div data-i18n="User Management">User Management</div>
                  </a>
                </li>
                <li class="menu-item">
                  <a href="{{ route('admin.users.create') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-user-plus"></i>
                    <div data-i18n="Add User">Add User</div>
                  </a>
                </li>
                @endif
              </ul>
            </li>
            @endif
            <!-- Log History (only for super) -->
            @if(Auth::user() && Auth::user()->role === 'super')
            <li class="menu-item has-sub">
              <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-eye"></i>
                <div data-i18n="Log History">Log History</div>
                <div class="badge bg-label-primary rounded-pill ms-auto"></div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item">
                  <a href="{{ route('admin.activitylog') }}" class="menu-link">
                    <div data-i18n="Activity Log">Activity Log</div>
                  </a>
                </li>
              </ul>
            </li>
            @endif

           
         

            <!-- Layouts -->
            

           

           
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="ti ti-menu-2 ti-sm"></i>
              </a>
            </div>

            <!-- Page Title Section -->
            <div class="navbar-nav align-items-center">
              <div class="nav-item d-flex align-items-center">
                <h4 class="fw-normal text-heading mb-0 text-nowrap" style="font-family: inherit; font-weight: 500; color: #566a7f; font-size: 1.125rem;">
                  @yield('page-title', 'Dashboard')
                </h4>
              </div>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
               
              

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Language -->
                
                <!--/ Language -->

                <!-- Style Switcher -->
                <li class="nav-item me-2 me-xl-0">
                  <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
                    <i class="ti ti-md"></i>
                  </a>
                </li>
                <!--/ Style Switcher -->
               
                <!-- Notification --><!--
                <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
                  <a
                    class="nav-link dropdown-toggle hide-arrow"
                    href="javascript:void(0);"
                    data-bs-toggle="dropdown"
                    data-bs-auto-close="outside"
                    aria-expanded="false"
                  >
                    <i class="ti ti-bell ti-md"></i>
                    <span class="badge bg-danger rounded-pill badge-notifications">5</span>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end py-0">
                    <li class="dropdown-menu-header border-bottom">
                      <div class="dropdown-header d-flex align-items-center py-3">
                        <h5 class="text-body mb-0 me-auto">Notification</h5>
                        <a
                          href="javascript:void(0)"
                          class="dropdown-notifications-all text-body"
                          data-bs-toggle="tooltip"
                          data-bs-placement="top"
                          title="Mark all as read"
                          ><i class="ti ti-mail-opened fs-4"></i
                        ></a>
                      </div>
                    </li>
                    <li class="dropdown-notifications-list scrollable-container">
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item list-group-item-action dropdown-notifications-item">
                          <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                              <div class="avatar">
                                <img src="../../assets/img/avatars/1.png" alt class="h-auto rounded-circle" />
                              </div>
                            </div>
                            <div class="flex-grow-1">
                              <h6 class="mb-1">Congratulation Lettie 🎉</h6>
                              <p class="mb-0">Won the monthly best seller gold badge</p>
                              <small class="text-muted">1h ago</small>
                            </div>
                            <div class="flex-shrink-0 dropdown-notifications-actions">
                              <a href="javascript:void(0)" class="dropdown-notifications-read"
                                ><span class="badge badge-dot"></span
                              ></a>
                              <a href="javascript:void(0)" class="dropdown-notifications-archive"
                                ><span class="ti ti-x"></span
                              ></a>
                            </div>
                          </div>
                        </li>
                        <li class="list-group-item list-group-item-action dropdown-notifications-item">
                          <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                              <div class="avatar">
                                <span class="avatar-initial rounded-circle bg-label-danger">CF</span>
                              </div>
                            </div>
                            <div class="flex-grow-1">
                              <h6 class="mb-1">Charles Franklin</h6>
                              <p class="mb-0">Accepted your connection</p>
                              <small class="text-muted">12hr ago</small>
                            </div>
                            <div class="flex-shrink-0 dropdown-notifications-actions">
                              <a href="javascript:void(0)" class="dropdown-notifications-read"
                                ><span class="badge badge-dot"></span
                              ></a>
                              <a href="javascript:void(0)" class="dropdown-notifications-archive"
                                ><span class="ti ti-x"></span
                              ></a>
                            </div>
                          </div>
                        </li>
                        <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                          <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                              <div class="avatar">
                                <img src="../../assets/img/avatars/2.png" alt class="h-auto rounded-circle" />
                              </div>
                            </div>
                            <div class="flex-grow-1">
                              <h6 class="mb-1">New Message ✉️</h6>
                              <p class="mb-0">You have new message from Natalie</p>
                              <small class="text-muted">1h ago</small>
                            </div>
                            <div class="flex-shrink-0 dropdown-notifications-actions">
                              <a href="javascript:void(0)" class="dropdown-notifications-read"
                                ><span class="badge badge-dot"></span
                              ></a>
                              <a href="javascript:void(0)" class="dropdown-notifications-archive"
                                ><span class="ti ti-x"></span
                              ></a>
                            </div>
                          </div>
                        </li>
                        <li class="list-group-item list-group-item-action dropdown-notifications-item">
                          <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                              <div class="avatar">
                                <span class="avatar-initial rounded-circle bg-label-success"
                                  ><i class="ti ti-shopping-cart"></i
                                ></span>
                              </div>
                            </div>
                            <div class="flex-grow-1">
                              <h6 class="mb-1">Whoo! You have new order 🛒</h6>
                              <p class="mb-0">ACME Inc. made new order $1,154</p>
                              <small class="text-muted">1 day ago</small>
                            </div>
                            <div class="flex-shrink-0 dropdown-notifications-actions">
                              <a href="javascript:void(0)" class="dropdown-notifications-read"
                                ><span class="badge badge-dot"></span
                              ></a>
                              <a href="javascript:void(0)" class="dropdown-notifications-archive"
                                ><span class="ti ti-x"></span
                              ></a>
                            </div>
                          </div>
                        </li>
                        <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                          <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                              <div class="avatar">
                                <img src="../../assets/img/avatars/9.png" alt class="h-auto rounded-circle" />
                              </div>
                            </div>
                            <div class="flex-grow-1">
                              <h6 class="mb-1">Application has been approved 🚀</h6>
                              <p class="mb-0">Your ABC project application has been approved.</p>
                              <small class="text-muted">2 days ago</small>
                            </div>
                            <div class="flex-shrink-0 dropdown-notifications-actions">
                              <a href="javascript:void(0)" class="dropdown-notifications-read"
                                ><span class="badge badge-dot"></span
                              ></a>
                              <a href="javascript:void(0)" class="dropdown-notifications-archive"
                                ><span class="ti ti-x"></span
                              ></a>
                            </div>
                          </div>
                        </li>
                        <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                          <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                              <div class="avatar">
                                <span class="avatar-initial rounded-circle bg-label-success"
                                  ><i class="ti ti-chart-pie"></i
                                ></span>
                              </div>
                            </div>
                            <div class="flex-grow-1">
                              <h6 class="mb-1">Monthly report is generated</h6>
                              <p class="mb-0">July monthly financial report is generated</p>
                              <small class="text-muted">3 days ago</small>
                            </div>
                            <div class="flex-shrink-0 dropdown-notifications-actions">
                              <a href="javascript:void(0)" class="dropdown-notifications-read"
                                ><span class="badge badge-dot"></span
                              ></a>
                              <a href="javascript:void(0)" class="dropdown-notifications-archive"
                                ><span class="ti ti-x"></span
                              ></a>
                            </div>
                          </div>
                        </li>
                        <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                          <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                              <div class="avatar">
                                <img src="../../assets/img/avatars/5.png" alt class="h-auto rounded-circle" />
                              </div>
                            </div>
                            <div class="flex-grow-1">
                              <h6 class="mb-1">Send connection request</h6>
                              <p class="mb-0">Peter sent you connection request</p>
                              <small class="text-muted">4 days ago</small>
                            </div>
                            <div class="flex-shrink-0 dropdown-notifications-actions">
                              <a href="javascript:void(0)" class="dropdown-notifications-read"
                                ><span class="badge badge-dot"></span
                              ></a>
                              <a href="javascript:void(0)" class="dropdown-notifications-archive"
                                ><span class="ti ti-x"></span
                              ></a>
                            </div>
                          </div>
                        </li>
                        <li class="list-group-item list-group-item-action dropdown-notifications-item">
                          <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                              <div class="avatar">
                                <img src="../../assets/img/avatars/6.png" alt class="h-auto rounded-circle" />
                              </div>
                            </div>
                            <div class="flex-grow-1">
                              <h6 class="mb-1">New message from Jane</h6>
                              <p class="mb-0">Your have new message from Jane</p>
                              <small class="text-muted">5 days ago</small>
                            </div>
                            <div class="flex-shrink-0 dropdown-notifications-actions">
                              <a href="javascript:void(0)" class="dropdown-notifications-read"
                                ><span class="badge badge-dot"></span
                              ></a>
                              <a href="javascript:void(0)" class="dropdown-notifications-archive"
                                ><span class="ti ti-x"></span
                              ></a>
                            </div>
                          </div>
                        </li>
                        <li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                          <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                              <div class="avatar">
                                <span class="avatar-initial rounded-circle bg-label-warning"
                                  ><i class="ti ti-alert-triangle"></i
                                ></span>
                              </div>
                            </div>
                            <div class="flex-grow-1">
                              <h6 class="mb-1">CPU is running high</h6>
                              <p class="mb-0">CPU Utilization Percent is currently at 88.63%,</p>
                              <small class="text-muted">5 days ago</small>
                            </div>
                            <div class="flex-shrink-0 dropdown-notifications-actions">
                              <a href="javascript:void(0)" class="dropdown-notifications-read"
                                ><span class="badge badge-dot"></span
                              ></a>
                              <a href="javascript:void(0)" class="dropdown-notifications-archive"
                                ><span class="ti ti-x"></span
                              ></a>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </li>
                    <li class="dropdown-menu-footer border-top">
                      <a
                        href="javascript:void(0);"
                        class="dropdown-item d-flex justify-content-center text-primary p-2 h-px-40 mb-1 align-items-center"
                      >
                        View all notifications
                      </a>
                    </li>
                  </ul>
                </li>-->
                <!--/ Notification -->

                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="{{ Auth::user()->photo ? asset('storage/' . Auth::user()->photo) : asset('assets/img/avatars/1.png') }}" alt class="h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="javascript:void(0);">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="../../assets/img/avatars/1.png" alt class="h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">{{ Auth::user()->given_name }}</span>
                            <small class="text-muted">{{ strtoupper(Auth::user()->type) }}</small>
                          </div>
                        </div>
                      </a>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{ route('profile.edit') }}">
                        <i class="ti ti-user-check me-2 ti-sm"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    @if(Auth::user() && (Auth::user()->role === 'super' || Auth::user()->role === 'admin'))
                    <li>
                      <a class="dropdown-item" href="{{ route('admin.settings') }}">
                        <i class="ti ti-settings me-2 ti-sm"></i>
                        <span class="align-middle">Settings</span>
                      </a>
                    </li>
                    @endif
                    
                    
                    
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="javascript:void(0)" id="logout-link">
                        <i class="ti ti-logout me-2 ti-sm"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                    <form id="logout-form" method="POST" action="{{ route('logout') }}">
                        @csrf
                    </form>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
              
            <!-- Search Small Screens -->
            <div class="navbar-search-wrapper search-input-wrapper d-none">
              <input
                type="text"
                class="form-control search-input container-xxl border-0"
                placeholder="Search..."
                aria-label="Search..."
              />
              <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
            </div>
          </nav>
         <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
              <x-notify::notify />
              @yield('content')
            </div>
            <!-- / Content -->
          </div>
          <!-- / Content wrapper -->


             <!-- Footer -->
             <footer class="content-footer footer bg-footer-theme">
                <div class="container-xxl">
                  <div
                    class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column"
                  >
                    <div>
                      ©
                      <script>
                        document.write(new Date().getFullYear());
                      </script>
                       Creative Engine. For support call +610425779590
                    </div>
                    
                  </div>
                </div>
              </footer>
              <!-- / Footer -->
  
              <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
          </div>
          <!-- / Layout page -->
        </div>
  
        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
  
        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
      </div>
      <!-- / Layout wrapper -->
      <!-- Logout submit -->
      <script>
        document.getElementById('logout-link').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('logout-form').submit();
        });
    </script>
    <!-- / logout submit -->
      <!-- Core JS -->
      <!-- build:js assets/vendor/js/core.js -->
      <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
      <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
      <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
      <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
      <script src="{{ asset('assets/vendor/libs/node-waves/node-waves.js') }}"></script>
  
      <script src="{{ asset('assets/vendor/libs/hammer/hammer.js') }}"></script>
      <script src="{{ asset('assets/vendor/libs/i18n/i18n.js') }}"></script>
      <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
  
      <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
      <!-- endbuild -->
  
      <!-- Vendors JS -->
      <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
      <script src="{{ asset('assets/vendor/libs/datatables/jquery.dataTables.js') }}"></script>
      <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
      <script src="{{ asset('assets/vendor/libs/datatables-responsive/datatables.responsive.js') }}"></script>
      <script src="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.js') }}"></script>
      <script src="{{ asset('assets/vendor/libs/datatables-buttons/datatables-buttons.js') }}"></script>
      <script src="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.js') }}"></script>
      <script src="{{ asset('assets/vendor/libs/datatables-buttons/buttons.html5.js') }}"></script>
      <script src="{{ asset('assets/vendor/libs/datatables-buttons/buttons.print.js') }}"></script>
      @notifyJs
      <!-- Main JS -->
  <script src="{{ asset('assets/js/main.js') }}"></script>

  {{-- Page-specific scripts (e.g., Select2 init) --}}
  @stack('scripts')

      <!-- page js -->
      @yield('pagejs')
  


            
        </body>
    </html>









