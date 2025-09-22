<header class="site-header header-style-1 mobile-sider-drawer-menu light-hdr">
    <div class="header-middle-wraper sticky-header ">     
        <div class="header-middle main-bar">
            <div class="logo-header">
                <div class="logo-header-inner logo-header-one">
                    <a href="{{ route('index') }}">
                    <img src="{{ asset('images/logo-light3.png') }}" alt="Logo">
                    </a>
                </div>
            </div>
            
            <div class="header-info-wraper">
                <div class="main-bar-wraper  navbar-expand-lg">

                    <div class="header-bottom">
                        <div class="container-block clearfix">

                            <div class="navigation-bar">
                                <!-- NAV Toggle Button -->
                                <button id="mobile-side-drawer" data-target=".header-nav" data-toggle="collapse" type="button" class="navbar-toggler collapsed">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar icon-bar-first"></span>
                                    <span class="icon-bar icon-bar-two"></span>
                                    <span class="icon-bar icon-bar-three"></span>
                                </button> 

                                <!-- MAIN Vav -->
                                <div class="nav-animation header-nav navbar-collapse collapse d-flex justify-content-between">
                            
                                    <ul class=" nav navbar-nav">
                                        <li class="has-child"><a href="{{route('index')}}">Home</a>
                                                                                            
                                        </li>
                                        
                                        <li class="has-child">
                                            <a href="javascript:;">Vehicles</a>
                                            <ul class="sub-menu">
                                                <li><a href="{{route('vehicles', ['category' => 'car'])}}">Cars</a></li>
                                                <li><a href="{{route('vehicles', ['category' => 'motorcycle'])}}">Motorcycles</a></li>
                                                <li><a href="{{route('vehicles', ['category' => 'scooter'])}}">Scooters</a></li>
                                                <li><a href="{{route('vehicles', ['category' => 'ebike'])}}">E-Bikes</a></li>
                                                <li><a href="{{route('vehicles', ['category' => 'van'])}}">Vans</a></li>                                            
                                            </ul>                                
                                        </li>
                                        <li><a href="{{ route('service') }}">Services</a></li>
                                        <li class="has-child">
                                            <a href="javascript:;">Parts</a>
                                            <ul class="sub-menu">
                                                <li><a href="{{route('parts', ['category' => 'car'])}}">Car Parts</a></li>
                                                <li><a href="{{route('parts', ['category' => 'motorcycle'])}}">Bike Parts</a></li>
                                                <li><a href="{{route('parts', ['category' => 'scooter'])}}">Scooter Parts</a></li>
                                                <li><a href="{{route('parts', ['category' => 'ebike'])}}">Ebike Parts</a></li>
                                                <li><a href="{{route('parts', ['category' => 'other'])}}">Other Parts</a></li>
                                                
                                                                                          
                                            </ul>                          
                                        </li>
                                        
                                        <li><a href="{{ route('contact') }}">Contact</a></li> 
                                        <li><a href="{{ route('about') }}">About</a></li> 
                                    </ul>

                                </div>
                            </div>
                            
                        </div>   
                    </div>

                </div>
                
            </div>
            <!-- Header Right Section-->
            <div class="extra-nav header-1-nav">
                <div class="extra-cell one">
                    <ul class="wt-topbar-left-info">
                        <li>
                            <a href="tel:+61416948717">
                                <span><i class="feather feather-phone-call"></i></span>+61 416 948 717
                            </a>
                        </li>
                        <li>
                            <a href="mailto:services@boomerangrentals.com.au">
                                <span><i class="feather feather-mail"></i></span>services@boomerangrentals.com.au
                            </a>
                        </li>
                    </ul>   
                </div>
                <div class="m-3 d-flex align-items-center">
                    <a href="{{ route('login') }}" class="btn" style="background:#ff6600;color:#fff;border:none;font-weight:600;box-shadow:0 2px 8px rgba(0,0,0,0.04);">Login</a>
                    <!-- <a href="{{ route('register') }}" class="btn btn-primary">Register</a> -->
                </div>
            </div>
            
        </div>
    </div>
    
</header>
