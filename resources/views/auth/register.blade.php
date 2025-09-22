<!DOCTYPE html>

<html
  lang="en"
  class="light-style customizer-hide"
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

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../images/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons -->
    <link rel="stylesheet" href="../../assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="../../assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="../../assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../../assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../../assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/typeahead-js/typeahead.css" />
    <!-- Vendor -->
    <link rel="stylesheet" href="../../assets/vendor/libs/formvalidation/dist/css/formValidation.min.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="../../assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="../../assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../../assets/js/config.js"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
     
          <!-- Register Card -->
          <div class="card mb-4 mt-2">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center mb-4 mt-2">
                <a href="{{url('/')}}" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                   <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="64" height="64" viewBox="0 0 64 64">
                    <image xlink:href="data:image/png;base64,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" x="0" y="0" width="64" height="64"/>
                  </svg>
                  </span>
                  <span class="app-brand-text demo text-body fw-bold ms-1">Boomerang rentals</span>
                </a>
				
              </div>
              <!-- /Logo -->
			  <div class="text-center">
              <h4 class="mb-1 pt-2">Adventure starts here 🚀</h4>
              <p class="mb-4">Create User From Here</p>
              @if ($errors->any())
               <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
               </div>
              <form id="formAuthentication" class="mb-3" method="POST" action="{{ route('register') }}">
			   @csrf
         @honeypot
			  <div class="row">
			  <div class="col-md-6 mb-3">
                  <label for="given_name" class="form-label">Given Name</label>
                  <input
                    type="text"
                    class="form-control"
                    id="given_name"
                    name="given_name"
                    placeholder="Enter your given name"
                    autofocus
                  />
                </div>
                <div class="col-md-6 mb-3">
                  <label for="surname" class="form-label">Surname</label>
                  <input
                    type="text"
                    class="form-control"
                    id="surname"
                    name="surname"
                    placeholder="Enter your surname"
                    autofocus
                  />
                </div>
				
                
			</div>	
				<div class="row">
                <div class="col-md-6 mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" />
                </div>
				
				<div class="col-md-6 mb-3">
                  <label for="address" class="form-label">Address</label>
                  <input
                    type="text"
                    class="form-control"
                    id="address"
                    name="address"
                    placeholder="Enter your address"
                    autofocus
                  />
                </div>
				</div>	
				<div class="row">
				
				<div class="col-md-6 mb-3">
                  <label for="phone" class="form-label">Phone</label>
                  <input
                    type="text"
                    class="form-control"
                    id="phone"
                    name="phone"
                    placeholder="Enter your phone number"
                    autofocus
                  />
                </div>
				
				
				<div class="col-md-6 mb-3 form-password-toggle">
                  <label class="form-label" for="password">Password</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
					  required
                    />
                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                  </div>
                </div>
				</div>	
				<div class="row">
                
				<div class="col-md-6 mb-3 form-password-toggle">
                  <label class="form-label" for="confirm-password">Confirm Password</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="confirm-password"
                      class="form-control"
                      name="password_confirmation"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="confirm-password"
					  required
                    />
                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                  </div>
                </div>
				</div>	
				

                </div>
                <button class="btn btn-primary d-grid w-100">Sign up</button>
              </form>

              <p class="text-center">
                <span>Already have an account?</span>
                <a href="{{ route('login') }}">
                  <span>Sign in instead</span>
                </a>
              </p>

              
            </div>
          </div>
          <!-- Register Card -->
    
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../../assets/vendor/libs/popper/popper.js"></script>
    <script src="../../assets/vendor/js/bootstrap.js"></script>
    <script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../../assets/vendor/libs/node-waves/node-waves.js"></script>

    <script src="../../assets/vendor/libs/hammer/hammer.js"></script>
    <script src="../../assets/vendor/libs/i18n/i18n.js"></script>
    <script src="../../assets/vendor/libs/typeahead-js/typeahead.js"></script>

    <script src="../../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../../assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js"></script>
    <script src="../../assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js"></script>
    <script src="../../assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js"></script>

    <!-- Main JS -->
    <script src="../../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../../assets/js/pages-auth.js"></script>
  </body>
</html>
