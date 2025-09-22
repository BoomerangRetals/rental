@extends('layout.app')

@section('content')
<div class="page-content">

            <!--BANNER START-->
            <div class="twm-home-1-banner-wrap">
                <div class="twm-home-1-banner"  style="background-image: url(images/main-slider/slider1/slider.png);">
                    <div class="twm-banner-LR-wrap">
                        <div class="twm-banner-left">
                            <div class="twm-banner-left-info">
                                <div class="twm-banner-left-content">

                                    <div class="twm-sm-title left">Premium</div>
                                    <h2 class="twm-banner-title">
                                        <em class="txt-type" data-wait="3000" data-words='["The Best Rental", "Wide Range of"]'></em>
                                        Cars<span>,</span>Bikes<span>,</span>Scooters<br><span>&</span>E-Bikes
                                    </h2>

                                    <div class="twm-banner-search-tabs">

                                        <h3 class="twm-tabs-title">
                                            Available For Rent
                                        </h3>

                                        <div class="twm-banner-tabs-filter">
                                            <nav>
                                                <div class="nav nav-tabs" id="nav-tab">
                                                    <!-- Car Tabs-->
                                                    <div class="nav-link active" data-bs-toggle="tab" data-bs-target="#nav-Car">
                                                        <div class="twm-tabs-bx">
                                                            <div class="tabs-media">
                                                                <img src="images/tabs-icon/car.png" alt="#">
                                                            </div>
                                                            <div class="tabs-title">Car</div>
                                                        </div>
                                                    </div>
                                                    <!-- Van Tabs-->
                                                    <div class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-Van">
                                                        <div class="twm-tabs-bx">
                                                            <div class="tabs-media">
                                                                <img src="images/tabs-icon/van.png" alt="#">
                                                            </div>
                                                            <div class="tabs-title">Van</div>
                                                        </div>
                                                    </div>
                                                   
                                                   
                                                    <!-- Bike Tabs-->
                                                    <div class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-bike">
                                                        <div class="twm-tabs-bx">
                                                            <div class="tabs-media">
                                                                <img src="images/tabs-icon/bike.png" alt="#">
                                                            </div>
                                                            <div class="tabs-title">Bike</div>
                                                        </div>
                                                    </div>
                                                

                                                

                                               
                                                 <!-- E - Bike Tabs-->
                                                    <div class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-ebike">
                                                        <div class="twm-tabs-bx">
                                                            <div class="tabs-media">
                                                                <img src="images/tabs-icon/ebike.png" alt="#">
                                                            </div>
                                                            <div class="tabs-title">EBike</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </nav>
                                            <div class="tab-content" id="nav-tabContent">
                                                <!-- Car Detail -->
                                                <div class="tab-pane fade show active" id="nav-Car">
                                                    <div class="twm-tabs-search-section">

                                                        <form>
                                                            <div class="row m-b20">
                                                                <div class="col-xxl-4 col-xl-6 col-lg-6 col-sm-4">
                                                                    <div class="form-group">
                                                                        <label>Choose Vehicle type</label>
                                                                        <select class="form-select form-control" aria-label="Default select example">
                                                                            <option selected>Model</option>
                                                                            <option value="1">Yamaha</option>
                                                                            <option value="2">Honda</option>
                                                                            <option value="3">Suzuki</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-4 col-xl-6 col-lg-6 col-sm-4">
                                                                    <div class="form-group">
                                                                        <label>Pick up Location</label>
                                                                        <input class="form-control" placeholder="Type...">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-4 col-xl-6 col-lg-6 col-sm-4">
                                                                    <div class="form-group">
                                                                        <label>Drop off Location</label>
                                                                        <input class="form-control" placeholder="Type...">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-6 col-xl-6 col-lg-6">
                                                                    <div class="form-group form-group-2column-wrap twm-input-with-icon">
                                                                        <label>Pick up date and time</label>
                                                                        <div class="form-group-2column">
                                                                            <div class="input-group date datepicker">
                                                                                <input class="form-control" placeholder="Date">
                                                                                <span class="input-group-append input-group-addon">
                                                                                    <span class="input-group-text">
                                                                                        <i class="fa fa-solid fa-calendar-days"></i>
                                                                                    </span>
                                                                                </span>
                                                                            </div>
                                                                            <div class="input-group time timepicker">
                                                                                <input class="form-control" placeholder="Time">
                                                                                <span class="input-group-append input-group-addon">
                                                                                    <span class="input-group-text">
                                                                                        <i class="fa-regular fa-clock"></i>
                                                                                    </span>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-6 col-xl-6 col-lg-6">
                                                                    <div class="form-group form-group-2column-wrap twm-input-with-icon">
                                                                        <label>Return date and time</label>
                                                                        <div class="form-group-2column">
                                                                            <div class="input-group date datepicker">
                                                                                <input class="form-control" placeholder="Date">
                                                                                <span class="input-group-append input-group-addon">
                                                                                    <span class="input-group-text">
                                                                                        <i class="fa fa-solid fa-calendar-days"></i>
                                                                                    </span>
                                                                                </span>
                                                                            </div>
                                                                            <div class="input-group time timepicker">
                                                                                <input class="form-control" placeholder="Time">
                                                                                <span class="input-group-append input-group-addon">
                                                                                    <span class="input-group-text">
                                                                                        <i class="fa-regular fa-clock"></i>
                                                                                    </span>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <div class="twm-tabs-search-btn">
                                                                <a href="cars-grid-4.html" class="site-button">
                                                                    <em>Find A vehicle</em>
                                                                </a>
                                                            </div>
                                                        </form>
                                                            
                                                    </div>
                                                </div>
                                                <!-- Van Detail -->
                                                <div class="tab-pane fade" id="nav-Van">
                                                    <div class="twm-tabs-search-section">

                                                        <form>
                                                            <div class="row m-b20">
                                                                <div class="col-xxl-4 col-xl-6 col-lg-6 col-sm-4">
                                                                    <div class="form-group">
                                                                        <label>Choose Vehicle type</label>
                                                                        <select class="form-select form-control" aria-label="Default select example">
                                                                            <option selected>Model</option>
                                                                            <option value="1">Yamaha</option>
                                                                            <option value="2">Honda</option>
                                                                            <option value="3">Suzuki</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-4 col-xl-6 col-lg-6 col-sm-4">
                                                                    <div class="form-group">
                                                                        <label>Pick up Location</label>
                                                                        <input class="form-control" placeholder="Type...">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-4 col-xl-6 col-lg-6 col-sm-4">
                                                                    <div class="form-group">
                                                                        <label>Drop off Location</label>
                                                                        <input class="form-control" placeholder="Type...">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-6 col-xl-6 col-lg-6">
                                                                    <div class="form-group form-group-2column-wrap twm-input-with-icon">
                                                                        <label>Pick up date and time</label>
                                                                        <div class="form-group-2column">
                                                                            <div class="input-group date datepicker">
                                                                                <input class="form-control" placeholder="Date">
                                                                                <span class="input-group-append input-group-addon">
                                                                                    <span class="input-group-text">
                                                                                        <i class="fa fa-solid fa-calendar-days"></i>
                                                                                    </span>
                                                                                </span>
                                                                            </div>
                                                                            <div class="input-group time timepicker">
                                                                                <input class="form-control" placeholder="Time">
                                                                                <span class="input-group-append input-group-addon">
                                                                                    <span class="input-group-text">
                                                                                        <i class="fa-regular fa-clock"></i>
                                                                                    </span>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-6 col-xl-6 col-lg-6">
                                                                    <div class="form-group form-group-2column-wrap twm-input-with-icon">
                                                                        <label>Return date and time</label>
                                                                        <div class="form-group-2column">
                                                                            <div class="input-group date datepicker">
                                                                                <input class="form-control" placeholder="Date">
                                                                                <span class="input-group-append input-group-addon">
                                                                                    <span class="input-group-text">
                                                                                        <i class="fa fa-solid fa-calendar-days"></i>
                                                                                    </span>
                                                                                </span>
                                                                            </div>
                                                                            <div class="input-group time timepicker">
                                                                                <input class="form-control" placeholder="Time">
                                                                                <span class="input-group-append input-group-addon">
                                                                                    <span class="input-group-text">
                                                                                        <i class="fa-regular fa-clock"></i>
                                                                                    </span>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <div class="twm-tabs-search-btn">
                                                                <a href="cars-grid-4.html" class="site-button">
                                                                    <em>Find A vehicle</em>
                                                                </a>
                                                            </div>
                                                        </form>
                                                            
                                                    </div>
                                                </div>
                                                <!-- Minibus Detail -->
                                                <div class="tab-pane fade" id="nav-Minibus">
                                                    <div class="twm-tabs-search-section">

                                                        <form>
                                                            <div class="row m-b20">
                                                                <div class="col-xxl-4 col-xl-6 col-lg-6 col-sm-4">
                                                                    <div class="form-group">
                                                                        <label>Choose Vehicle type</label>
                                                                        <select class="form-select form-control" aria-label="Default select example">
                                                                            <option selected>Model</option>
                                                                            <option value="1">Yamaha</option>
                                                                            <option value="2">Honda</option>
                                                                            <option value="3">Suzuki</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-4 col-xl-6 col-lg-6 col-sm-4">
                                                                    <div class="form-group">
                                                                        <label>Pick up Location</label>
                                                                        <input class="form-control" placeholder="Type...">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-4 col-xl-6 col-lg-6 col-sm-4">
                                                                    <div class="form-group">
                                                                        <label>Drop off Location</label>
                                                                        <input class="form-control" placeholder="Type...">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-6 col-xl-6 col-lg-6">
                                                                    <div class="form-group form-group-2column-wrap twm-input-with-icon">
                                                                        <label>Pick up date and time</label>
                                                                        <div class="form-group-2column">
                                                                            <div class="input-group date datepicker">
                                                                                <input class="form-control" placeholder="Date">
                                                                                <span class="input-group-append input-group-addon">
                                                                                    <span class="input-group-text">
                                                                                        <i class="fa fa-solid fa-calendar-days"></i>
                                                                                    </span>
                                                                                </span>
                                                                            </div>
                                                                            <div class="input-group time timepicker">
                                                                                <input class="form-control" placeholder="Time">
                                                                                <span class="input-group-append input-group-addon">
                                                                                    <span class="input-group-text">
                                                                                        <i class="fa-regular fa-clock"></i>
                                                                                    </span>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-6 col-xl-6 col-lg-6">
                                                                    <div class="form-group form-group-2column-wrap twm-input-with-icon">
                                                                        <label>Return date and time</label>
                                                                        <div class="form-group-2column">
                                                                            <div class="input-group date datepicker">
                                                                                <input class="form-control" placeholder="Date">
                                                                                <span class="input-group-append input-group-addon">
                                                                                    <span class="input-group-text">
                                                                                        <i class="fa fa-solid fa-calendar-days"></i>
                                                                                    </span>
                                                                                </span>
                                                                            </div>
                                                                            <div class="input-group time timepicker">
                                                                                <input class="form-control" placeholder="Time">
                                                                                <span class="input-group-append input-group-addon">
                                                                                    <span class="input-group-text">
                                                                                        <i class="fa-regular fa-clock"></i>
                                                                                    </span>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <div class="twm-tabs-search-btn">
                                                                <a href="cars-grid-4.html" class="site-button">
                                                                    <em>Find A vehicle</em>
                                                                </a>
                                                            </div>
                                                        </form>
                                                            
                                                    </div>
                                                </div>
                                                <!-- Coupe Detail-->
                                                <div class="tab-pane fade" id="nav-ebike">
                                                    <div class="twm-tabs-search-section">

                                                        <form>
                                                            <div class="row m-b20">
                                                                <div class="col-xxl-4 col-xl-6 col-lg-6 col-sm-4">
                                                                    <div class="form-group">
                                                                        <label>Choose Ebike type</label>
                                                                        <select class="form-select form-control" aria-label="Default select example">
                                                                            <option selected>Model</option>
                                                                            <option value="1">NCM Milano Plus</option>
                                                                            <option value="2">Mono</option>
                                                                            <option value="3">Sun Mono Aura</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-4 col-xl-6 col-lg-6 col-sm-4">
                                                                    <div class="form-group">
                                                                        <label>Pick up Location</label>
                                                                        <input class="form-control" placeholder="Type...">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-4 col-xl-6 col-lg-6 col-sm-4">
                                                                    <div class="form-group">
                                                                        <label>Drop off Location</label>
                                                                        <input class="form-control" placeholder="Type...">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-6 col-xl-6 col-lg-6">
                                                                    <div class="form-group form-group-2column-wrap twm-input-with-icon">
                                                                        <label>Pick up date and time</label>
                                                                        <div class="form-group-2column">
                                                                            <div class="input-group date datepicker">
                                                                                <input class="form-control" placeholder="Date">
                                                                                <span class="input-group-append input-group-addon">
                                                                                    <span class="input-group-text">
                                                                                        <i class="fa fa-solid fa-calendar-days"></i>
                                                                                    </span>
                                                                                </span>
                                                                            </div>
                                                                            <div class="input-group time timepicker">
                                                                                <input class="form-control" placeholder="Time">
                                                                                <span class="input-group-append input-group-addon">
                                                                                    <span class="input-group-text">
                                                                                        <i class="fa-regular fa-clock"></i>
                                                                                    </span>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-6 col-xl-6 col-lg-6">
                                                                    <div class="form-group form-group-2column-wrap twm-input-with-icon">
                                                                        <label>Return date and time</label>
                                                                        <div class="form-group-2column">
                                                                            <div class="input-group date datepicker">
                                                                                <input class="form-control" placeholder="Date">
                                                                                <span class="input-group-append input-group-addon">
                                                                                    <span class="input-group-text">
                                                                                        <i class="fa fa-solid fa-calendar-days"></i>
                                                                                    </span>
                                                                                </span>
                                                                            </div>
                                                                            <div class="input-group time timepicker">
                                                                                <input class="form-control" placeholder="Time">
                                                                                <span class="input-group-append input-group-addon">
                                                                                    <span class="input-group-text">
                                                                                        <i class="fa-regular fa-clock"></i>
                                                                                    </span>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <div class="twm-tabs-search-btn">
                                                                <a href="cars-grid-4.html" class="site-button">
                                                                    <em>Find A vehicle</em>
                                                                </a>
                                                            </div>
                                                        </form>
                                                            
                                                    </div>
                                                </div>
                                                <!-- Bike Details-->
                                                <div class="tab-pane fade" id="nav-bike">
                                                    <div class="twm-tabs-search-section">

                                                        <form>
                                                            <div class="row m-b20">
                                                                <div class="col-xxl-4 col-xl-6 col-lg-6 col-sm-4">
                                                                    <div class="form-group">
                                                                        <label>Choose Vehicle type</label>
                                                                        <select class="form-select form-control" aria-label="Default select example">
                                                                            <option selected>Model</option>
                                                                            <option value="1">Yamaha</option>
                                                                            <option value="2">Honda</option>
                                                                            <option value="3">Suzuki</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-4 col-xl-6 col-lg-6 col-sm-4">
                                                                    <div class="form-group">
                                                                        <label>Pick up Location</label>
                                                                        <input class="form-control" placeholder="Type...">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-4 col-xl-6 col-lg-6 col-sm-4">
                                                                    <div class="form-group">
                                                                        <label>Drop off Location</label>
                                                                        <input class="form-control" placeholder="Type...">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-6 col-xl-6 col-lg-6">
                                                                    <div class="form-group form-group-2column-wrap twm-input-with-icon">
                                                                        <label>Pick up date and time</label>
                                                                        <div class="form-group-2column">
                                                                            <div class="input-group date datepicker">
                                                                                <input class="form-control" placeholder="Date">
                                                                                <span class="input-group-append input-group-addon">
                                                                                    <span class="input-group-text">
                                                                                        <i class="fa fa-solid fa-calendar-days"></i>
                                                                                    </span>
                                                                                </span>
                                                                            </div>
                                                                            <div class="input-group time timepicker">
                                                                                <input class="form-control" placeholder="Time">
                                                                                <span class="input-group-append input-group-addon">
                                                                                    <span class="input-group-text">
                                                                                        <i class="fa-regular fa-clock"></i>
                                                                                    </span>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xxl-6 col-xl-6 col-lg-6">
                                                                    <div class="form-group form-group-2column-wrap twm-input-with-icon">
                                                                        <label>Return date and time</label>
                                                                        <div class="form-group-2column">
                                                                            <div class="input-group date datepicker">
                                                                                <input class="form-control" placeholder="Date">
                                                                                <span class="input-group-append input-group-addon">
                                                                                    <span class="input-group-text">
                                                                                        <i class="fa fa-solid fa-calendar-days"></i>
                                                                                    </span>
                                                                                </span>
                                                                            </div>
                                                                            <div class="input-group time timepicker">
                                                                                <input class="form-control" placeholder="Time">
                                                                                <span class="input-group-append input-group-addon">
                                                                                    <span class="input-group-text">
                                                                                        <i class="fa-regular fa-clock"></i>
                                                                                    </span>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
    
                                                            <div class="twm-tabs-search-btn">
                                                                <a href="cars-grid-4.html" class="site-button">
                                                                    <em>Find A vehicle</em>
                                                                </a>
                                                            </div>
                                                        </form>
                                                            
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    
                                </div>
                             </div>
                        </div>
                        <div class="twm-banner-right">
                            <div class="twm-banner-right-section">
                                <div class="twm-banner-r-content">
                                    <div class="twm-banner-r-bx">
                                        <h1 class="twm-bnr-title">Toyota</h1>
                                        <div class="twm-banner-product-price">
                                            <div class="twm-product-name">CH-R</div>
                                            <div class="twm-price-section">
                                                <div class="v-price" id="number_notification">$350</div>
                                                <div class="v-duration">/ Week</div>
                                            </div>
                                         </div>
                                    </div>
                                </div>
                                <div class="twm-banner-media">
                                    <img src="images/main-slider/slider1/car.png" alt="Car Pic">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
            <!--BANNER END-->

            <!--WIDE RANGE SECTION START-->
            <div class="section-full p-t150 p-b120 site-bg-white twm-w-range-section-wrap wow fadeInDown" data-wow-offset="100" data-wow-delay="0.2">
                <div class="container">

                   
                    <!-- TITLE START-->
                    <div class="section-head center ">
                        <div class="twm-sm-title left">Find your car by car brand</div>
                        <h2 class="twm-large-title site-text-dark">Wide Range Of Commercial 
                            And Luxury Cars
                        </h2>
                    </div>
                    <!-- TITLE END-->
                    

                    <div class="section-content">
                        <div class="row twm-w-range-section">
                            
                            <!--One block-->
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="twm-cntr-with-icon">
                                    <div class="icon-media">
                                        <img src="images/icons/rental.png" alt="">
                                    </div>
                                    <span class="counter">4500</span> <em class="symble">+</em>
                                    <h3 class="icon-content-info">Client Served</h3>
                                </div> 
                            </div>

                            <!--Two block-->
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="twm-cntr-with-icon">
                                    <div class="icon-media">
                                        <img src="images/icons/man.png" alt="">
                                    </div>
                                    <span class="counter">2750</span> <em class="symble">+</em>
                                    <h3 class="icon-content-info">Happy Customers</h3>
                                </div> 
                            </div>

                            <!--Three block-->
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="twm-cntr-with-icon">
                                    <div class="icon-media">
                                        <img src="images/icons/car-insurance.png" alt="">
                                    </div>
                                    <span class="counter">600</span> <em class="symble">+</em>
                                    <h3 class="icon-content-info">Vehicle In Stock Cars</h3>
                                </div> 
                            </div>

                            <!--Four block-->
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="twm-cntr-with-icon">
                                    <div class="icon-media">
                                        <img src="images/icons/work-time.png" alt="">
                                    </div>
                                    <span class="counter">12</span> <em class="symble">+</em>
                                    <h3 class="icon-content-info">Years Experience</h3>
                                </div> 
                            </div>

                        </div>

                    </div>

                </div>
            </div>
            <!--WIDE RANGE SECTION END-->

            <!--EXPLORE BRAND START-->
            <div class="section-full twm-explore-section-wrap site-bg-primary">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-12">
                            <!-- TITLE START-->
                            <div class="section-head left">
                                <div class="twm-sm-title left site-text-white">Car Brands</div>
                                <h2 class="twm-large-title site-text-white">Explore Our Premium Brands</h2>
                            </div>
                            <!-- TITLE END-->
                        </div>
                        <div class="col-xl-6 col-lg-12">
                            <div class="twm-mid-section-car">
                                <div class="twm-media">
                                    <img src="images/explore-sec-image.png" alt="Image">
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-12">
                            <div class="twm-mid-section-btn">
                                <a href="cars-grid-4.html" class="site-button">
                                    <em>View All Brands</em>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--EXPLORE BRAND END-->

            <!--CLIENT SLIDER START-->
            <div class="twm-client-slider1-wrap site-bg-white">
                <div class="twm-client-slider1">
                    <div class="owl-carousel home-client-carousel3 owl-btn-vertical-center">
                    
                        
                        
                        
                        <div class="item">
                            <div class="ow-client-logo">
                                <div class="client-logo client-logo-media">
                                <a href="cars-grid-4.html"><img src="images/client-logo/dark/p1.png" alt=""></a></div>
                            </div>
                        </div>
                        
                        <div class="item">
                            <div class="ow-client-logo">
                                <div class="client-logo client-logo-media">
                                <a href="cars-grid-4.html"><img src="images/client-logo/dark/p2.png" alt=""></a></div>
                            </div>
                        </div>
                        
                        <div class="item">
                            <div class="ow-client-logo">
                                <div class="client-logo client-logo-media">
                                <a href="cars-grid-4.html"><img src="images/client-logo/dark/p3.png" alt=""></a></div>
                            </div>
                        </div>
                        
                        <div class="item">
                            <div class="ow-client-logo">
                                <div class="client-logo client-logo-media">
                                <a href="cars-grid-4.html"><img src="images/client-logo/dark/p4.png" alt=""></a></div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- CLIENT SLIDER END -->

            <!--ABOUT US SECTION START-->
            <div class="section-full site-bg-white p-t150 p-b120 twm-abus-section-wrap wow fadeInDown" data-wow-offset="100" data-wow-delay="0.2">
                <div class="container">
                    <div class="row twm-abus-section">

                        <div class="col-lg-7 col-md-12">
                            <div class="twm-abus-left">
                                <div class="twm-media">
                                    <img src="images/abus-pic.jpg" alt="Image">
                                    <div class="twm-abus-video">
                                        <a href="https://vimeo.com/337649532" class="mfp-video ">
                                            <i class="icon fa fa-play"></i>
                                        </a>
                                    </div>
                                    <div class="twm-abus-year-section">
                                        <div class="tem-abus-year-content">
                                            <span>Since</span>
                                            <h2 class="year-title">2023</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="twm-media2">
                                    <img src="images/car-pic1.png" alt="Image">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-5 col-md-12">
                            <!-- TITLE START-->
                            <div class="section-head left aside-section">
                                <div class="twm-sm-title left">About Us</div>
                                <h2 class="twm-large-title site-text-dark">
                                    We’ve Proudly Provided Expert Assistance To Countless People And Businesses In This Field—Helping Them Achieve Their Goals With Confidence And Efficiency
                                </h2>
                                <div class="section-head-detail">
                                    We Provide Affordable And Convenient Rental And Repair Services For Bikes, E-Bikes, Cars, Motorcycles, And Scooters. Whether You're A Local Resident Or An International Student Living In Or Around Sydney, We're Here To Keep You On The Move With Reliable Vehicles And Expert Maintenance Support.
                                </div>
                            </div>
                            <!-- TITLE END-->
                            <div class="twm-inline-list2">
                                <ul>
                                    <li>A Wide Range of Vehicles Available</li>
                                    <li>You Get 24/7 Roadside Assistance</li>
                                    <li>We Are The Sydney’s Popular Provider</li>
                                </ul>
                            </div>
                            <div class="twm-btn-left">
                                <a href="about-us.html" class="site-button">
                                    <em>Read More</em>
                                </a>
                             </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!--ABOUS US SECTION END-->

            <!--LET'S YOUR ADVENTURE SECTION START-->
            <div class="section-full p-t150 p-b120 site-bg-dark twm-step-towards-section-wrap wow fadeInDown" data-wow-offset="100" data-wow-delay="0.2">
            <div class="twm-half-bg-pic" style="background-image: url(images/half-bg-pi.jpg);"></div>
            <div class="container">

              <div class="row">
                  <div class="col-lg-6 col-md-12">
                      <!-- TITLE START-->
                      <div class="section-head left">
                          <div class="twm-sm-title left">One step towards you</div>
                          <h2 class="twm-large-title site-text-white">Let's Your Adventure Begin</h2>
                      </div>
                      <!-- TITLE END-->
                  </div>
              </div>

              <div class="section-content">
                  <div class="row twm-step-towards-section">
                      
                      <div class="col-xl-4 col-lg-4 col-md-4 m-b30">
                          <div class="twm-icon-style-left large-set in-dark-area">
                              <div class="twm-media">
                                  <img src="images/icons/label.png" alt="image">
                              </div>
                              <div class="twm-content">
                                  <h3 class="twm-title">Deals For Every Budget</h3>
                                  <p>Incredible prices on every car, van, bike 
                                      and package worldwide Book vehicles at 
                                      incredible prices worldwide
                                  </p>
                              </div>
                          </div>
                      </div>

                      <div class="col-xl-4 col-lg-4 col-md-4 m-b30">
                          <div class="twm-icon-style-left large-set in-dark-area">
                              <div class="twm-media">
                                  <img src="images/icons/customer-support.png" alt="image">
                              </div>
                              <div class="twm-content">
                                  <h3 class="twm-title">24/7 Road Assistance</h3>
                                  <p>
                                      We are ready to assist you and provide 
                                      reliable support. Who Will keep you moving 
                                      forward with confidence and mental peace.
                                  </p>
                              </div>
                          </div>
                      </div>

                      <div class="col-xl-4 col-lg-4 col-md-4 m-b30">
                          <div class="twm-icon-style-left large-set in-dark-area">
                              <div class="twm-media">
                                  <img src="images/icons/parking-area.png" alt="image">
                              </div>
                              <div class="twm-content">
                                  <h3 class="twm-title">Free Pick-Up & Drop-Off</h3>
                                  <p>
                                      Enjoy free pickup and drop-off services,
                                      which adds an extra layer of ease to your 
                                      car rental experience.
                                  </p>
                              </div>
                          </div>
                      </div>

                  </div>

              </div>

            </div>
            </div>
            <!--LET'S YOUR ADVENTURE SECTION END--> 

            <!--OUR VEHICLE FLEET SECTION START -->
            <div class="section-full p-t150 p-b120 site-bg-white twm-blog-section-wrap wow fadeInDown" data-wow-offset="100" data-wow-delay="0.2">
                <div class="container-fluid">

                   
                    <!-- TITLE START-->
                    <div class="section-head center ">
                        <div class="twm-sm-title left">Choose your car</div>
                        <h2 class="twm-large-title site-text-dark">Our Vehicle Fleet</h2>
                    </div>
                    <!-- TITLE END-->
                    

                    <div class="section-content">
                        <div class="owl-carousel twm-vehicle-fleet-carousel m-b30">
                            
                            <!--One block-->
                            @foreach($vehicles as $vehicle)
                                <div class="item">
                                    <div class="twm-vehicle-fleet-bx">
                                        <div class="twm-media">
                                            <div class="twm-media-pic">
                                               <img src="{{ $vehicle->thumbnail }}" alt="{{ $vehicle->brand }} {{ $vehicle->model }}" style="width: 800px; height: 300px;">


                                            </div>
                                            <div class="twm-price-section">
                                                <div class="v-price">${{ $vehicle->weekly }}</div>
                                                <div class="v-duration">/ Week</div>
                                                <a href="" class="v-detail"><em>Detail</em></a>
                                            </div>
                                        </div>
                                        <div class="twm-vehicle-fleet-content">
                                            <h3 class="twm-v-title">
                                                <a href="">
                                                    {{ $vehicle->brand }} {{ $vehicle->model }}
                                                </a>
                                            </h3>
                                            <ul class="twm-vehicle-facility">
                                                <li><span><img src="{{ asset('images/icons/car-seat.png') }}" alt="Seats"></span>{{ $vehicle->seats }} Seats</li>
                                                <li><span><img src="{{ asset('images/icons/bag.png') }}" alt="Bags"></span>{{ $vehicle->doors }} Doors</li>
                                                <li><span><img src="{{ asset('images/icons/car.png') }}" alt="Body Type"></span>{{ $vehicle->body_type }}</li>
                                            </ul>
                                            <ul class="twm-vehicle-fuel-type">
                                                <li>{{ $vehicle->fuel }}</li>
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                           

                        </div>

                    </div>

                </div>
            </div>
            <!--OUR VEHICLE FLEET SECTION END-->

            <!--WHY CHOOSE US SECTION START-->
            <div class="section-full site-bg-white twm-w-chooseus-section-wrap wow fadeInDown" data-wow-offset="100" data-wow-delay="0.2">
                <div class="container">
                    <div class="row twm-w-chooseus-section">
                        <div class="col-lg-5 col-md-12">
                            <!-- TITLE START-->
                            <div class="section-head left ">
                                <div class="twm-sm-title left">Our Features</div>
                                <h2 class="twm-large-title site-text-dark">Why Choose Us?</h2>
                                <div class="section-head-detail">
                                    Discover a world of convenience, safety, and customization, paving the way for unforgettable adventures and seamless mobility solutions.
                                </div>
                            </div>
                            <!-- TITLE END-->

                            <div class="twm-list-icon-style1">
                                <ul>
                                    <li>
                                        <div class="twm-list-icon-style-bx">
                                            <div class="twm-icon-bx">
                                                <span>
                                                    <img src="images/w-choose-icon/icon-1.png" alt="image">
                                                </span>
                                            </div>
                                            <div class="twm-icon-bx-detail">
                                                <h3 class="twm-title">Deals For Every Budget</h3>
                                                <p>Incredible prices on every car, van, bike and package 
                                                    worldwide Book vehicles at incredible.
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="twm-list-icon-style-bx">
                                            <div class="twm-icon-bx">
                                                <span>
                                                    <img src="images/w-choose-icon/icon-2.png" alt="image">
                                                </span>
                                            </div>
                                            <div class="twm-icon-bx-detail">
                                                <h3 class="twm-title">Flexible Pricing</h3>
                                                <p>customization, paving the way for unforgettable
                                                    adventures seamless mobility solutions.
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="twm-list-icon-style-bx">
                                            <div class="twm-icon-bx">
                                                <span>
                                                    <img src="images/w-choose-icon/icon-3.png" alt="image">
                                                </span>
                                            </div>
                                            <div class="twm-icon-bx-detail">
                                                <h3 class="twm-title">Quality At Minimum Expense</h3>
                                                <p>customization, paving the way for unforgettable
                                                    adventures seamless mobility solutions.
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="twm-list-icon-style-bx">
                                            <div class="twm-icon-bx">
                                                <span>
                                                    <img src="images/w-choose-icon/icon-4.png" alt="image">
                                                </span>
                                            </div>
                                            <div class="twm-icon-bx-detail">
                                                <h3 class="twm-title">Free Pick-Up & Drop-Off</h3>
                                                <p>Enjoy free pickup and drop-off services, adding an
                                                    extra layer of ease to your car rental experience.
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-12">
                            <div class="twm-w-chooseus-media">
                                <div class="twm-media">
                                    <img src="images/need-h-pic.png" alt="Image">
                                </div>
                                <div class="twm-need-help-bx">
                                    <div class="twm-need-help-content">
                                        <span>Need any help ?</span>
                                        <h3 class="twm-title">+61 416 948 717</h3>
                                    </div>
                                    <div class="twm-need-help-icon">
                                        <img src="images/24-clock.png" alt="icon">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--WHY CHOOSE US SECTION END-->

            <!--CATEGORIES SECTION START -->
            <div class="section-full p-t150 site-bg-white twm-categories-section-wrap wow fadeInDown" data-wow-offset="100" data-wow-delay="0.2">
                <div class="container">

                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <!-- TITLE START-->
                            <div class="section-head left ">
                                <div class="twm-sm-title left">Categories</div>
                                <h2 class="twm-large-title site-text-dark">A Look At All Types Of Vehicles</h2>
                            </div>
                            <!-- TITLE END-->
                        </div>
                    </div>

                    <div class="section-content">
                        <div class="owl-carousel twm-categories-carousel next-prev-top-right">
                            
                            <!--One block-->
                            <div class="item">
                                <div class="twm-categories-type">
                                    <div class="twm-media">
                                        <img src="images/vehicle/suv.png" alt="Image">
                                        <div class="twm-media-link">
                                            <a href="cars-detail.html" class="twm-media-link-content">SUV</a>
                                        </div>
                                    </div>
                                </div> 
                            </div>

                            <!--Two block-->
                            <div class="item">
                                <div class="twm-categories-type">
                                    <div class="twm-media">
                                        <img src="images/vehicle/sedan.png" alt="Image">
                                        <div class="twm-media-link">
                                            <a href="cars-detail.html" class="twm-media-link-content">Sedan</a>
                                        </div>
                                    </div>
                                </div> 
                            </div>

                            <!--Three block-->
                            <!-- <div class="item">
                                <div class="twm-categories-type">
                                    <div class="twm-media">
                                        <img src="images/vehicle/pic14.jpg" alt="Image">
                                        <div class="twm-media-link">
                                            <a href="cars-detail.html" class="twm-media-link-content">Harley Davidson</a>
                                        </div>
                                    </div>
                                </div> 
                            </div> -->

                            <!--Four block-->
                            <div class="item">
                                <div class="twm-categories-type">
                                    <div class="twm-media">
                                        <img src="images/vehicle/hatch.png" alt="Image">
                                        <div class="twm-media-link">
                                            <a href="cars-detail.html" class="twm-media-link-content">Hatchback</a>
                                        </div>
                                    </div>
                                </div> 
                            </div>

                            <!--Five block-->
                            <!-- <div class="item">
                                <div class="twm-categories-type">
                                    <div class="twm-media">
                                        <img src="images/vehicle/pic3.jpg" alt="Image">
                                        <div class="twm-media-link">
                                            <a href="cars-detail.html" class="twm-media-link-content">Coupe</a>
                                        </div>
                                    </div>
                                </div> 
                            </div> -->

                            <!--Six block-->
                            <div class="item">
                                <div class="twm-categories-type">
                                    <div class="twm-media">
                                        <img src="images/vehicle/hybrid.jpg" alt="Image">
                                        <div class="twm-media-link">
                                            <a href="cars-detail.html" class="twm-media-link-content">Hybrid</a>
                                        </div>
                                    </div>
                                </div> 
                            </div>

                        </div>

                    </div>

                </div>
            </div>
            <!--CATEGORIES SECTION END -->

            <!--WORKING STEPS SECTION START-->
            <div class="section-full p-t150 site-bg-white twm-w-steps-section-wrap wow fadeInDown" data-wow-offset="100" data-wow-delay="0.2" style="background-image: url(images/step-bg.png);">
                <div class="container">

                    
                    <!-- TITLE START-->
                    <div class="section-head center ">
                        <div class="twm-sm-title left">How it Work</div>
                        <h2 class="twm-large-title site-text-dark">Following Working Steps</h2>
                    </div>
                    <!-- TITLE END-->
                     

                    <div class="section-content">
                        <div class="row twm-w-steps-section">
                            
                            <div class="col-lg-3 col-md-6 m-b30">
                                <div class="twm-w-steps">
                                    <div class="twm-w-step-count">
                                        <span>01</span>
                                    </div>
                                    <div class="twm-w-step-detail">
                                        <h3 class="twm-title">Choose A Car</h3>
                                        <p>Browse Our Wide Range Of Cars And Select The One That Best Suits Your Needs</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 m-b30">
                                <div class="twm-w-steps">
                                    <div class="twm-w-step-count">
                                        <span>02</span>
                                    </div>
                                    <div class="twm-w-step-detail">
                                        <h3 class="twm-title">Pick Up Date</h3>
                                        <p>Select Your Preferred Pick-Up Date To Reserve The Vehicle That Suits Your Needs </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 m-b30">
                                <div class="twm-w-steps">
                                    <div class="twm-w-step-count">
                                        <span>03</span>
                                    </div>
                                    <div class="twm-w-step-detail">
                                        <h3 class="twm-title">Confirm Your Booking</h3>
                                        <p>Review Your Selection And Confirm Your Booking To Secure Your Vehicle </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-6 m-b30">
                                <div class="twm-w-steps">
                                    <div class="twm-w-step-count">
                                        <span>04</span>
                                    </div>
                                    <div class="twm-w-step-detail">
                                        <h3 class="twm-title">Enjoy Driving</h3>
                                        <p>Hit The Road With Confidence And Comfort In The Vehicle You’ve Chosen. </p>
                                    </div>
                                </div>
                            </div>
                            

                        </div>

                        <div class="twm-adv-show">
                            <img src="images/adv-ca.png" alt="Image">
                        </div>

                    </div>

                </div>
            </div>
            <!--WORKING STEPS SECTION END-->

            <!--TESTIMONIAL SECTION START-->
            <div class="section-full p-t150 site-bg-white twm-testimonial-section-wrap wow fadeInDown" data-wow-offset="100" data-wow-delay="0.2">
                <div class="container">

                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <!-- TITLE START-->
                            <div class="section-head left ">
                                <div class="twm-sm-title left">Reviews</div>
                                <h2 class="twm-large-title site-text-dark">What Our Customers Say</h2>
                            </div>
                            <!-- TITLE END-->
                        </div>
                    </div>

                    <div class="section-content">
                        <div class="owl-carousel twm-blog-carousel next-prev-top-right">
                            
                            <!--One block-->
                            <div class="item">
                                <div class="twm-testimonial2">
                                    <div class="twm-testimonial-head">
                                        <div class="media-pic">
                                            <img src="images/testimonial/pic1.jpg" alt="Image">
                                        </div>
                                        <div class="twm-author-detail">
                                            <h3 class="twm-title">Kevin Martin</h3>
                                            <div class="twm-position">Customer</div>
                                        </div>
                                    </div>
                                    
                                    <div class="twm-testimonial-detail">
                                        <p>I Was Very Impresed Lorem posuere in miss and drana 
                                            en the nisan semere sceriun amiss etiam ornare in 
                                            the miss drana is lorem fermen mauris.
                                        </p>
                                        <div class="twm-rating-wrap">
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                        </div> 
                                    </div>
                                        
                                    <div class="twm-quote-icon">
                                        <img src="images/quote.png" alt="#">
                                    </div>
                                    
                                </div> 
                            </div>

                            <!--Two block-->
                            <div class="item">
                                <div class="twm-testimonial2">
                                    <div class="twm-testimonial-head">
                                        <div class="media-pic">
                                            <img src="images/testimonial/pic2.jpg" alt="Image">
                                        </div>
                                        <div class="twm-author-detail">
                                            <h3 class="twm-title">Devid Cullen</h3>
                                            <div class="twm-position">Customer</div>
                                        </div>
                                    </div>
                                    
                                    <div class="twm-testimonial-detail">
                                        <p>I Was Very Impresed Lorem posuere in miss and drana 
                                            en the nisan semere sceriun amiss etiam ornare in 
                                            the miss drana is lorem fermen mauris.
                                        </p>
                                        <div class="twm-rating-wrap">
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                        </div> 
                                    </div>
                                        
                                    <div class="twm-quote-icon">
                                        <img src="images/quote.png" alt="#">
                                    </div>
                                    
                                </div> 
                            </div>

                            <!--Three block-->
                            <div class="item">
                                <div class="twm-testimonial2">
                                    <div class="twm-testimonial-head">
                                        <div class="media-pic">
                                            <img src="images/testimonial/pic3.jpg" alt="Image">
                                        </div>
                                        <div class="twm-author-detail">
                                            <h3 class="twm-title">Piter Has</h3>
                                            <div class="twm-position">Customer</div>
                                        </div>
                                    </div>
                                    
                                    <div class="twm-testimonial-detail">
                                        <p>I Was Very Impresed Lorem posuere in miss and drana 
                                            en the nisan semere sceriun amiss etiam ornare in 
                                            the miss drana is lorem fermen mauris.
                                        </p>
                                        <div class="twm-rating-wrap">
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                        </div> 
                                    </div>
                                        
                                    <div class="twm-quote-icon">
                                        <img src="images/quote.png" alt="#">
                                    </div>
                                    
                                </div> 
                            </div>

                            <!--Four block-->
                            <div class="item">
                                <div class="twm-testimonial2">
                                    <div class="twm-testimonial-head">
                                        <div class="media-pic">
                                            <img src="images/testimonial/pic1.jpg" alt="Image">
                                        </div>
                                        <div class="twm-author-detail">
                                            <h3 class="twm-title">Kevin Martin</h3>
                                            <div class="twm-position">Customer</div>
                                        </div>
                                    </div>
                                    
                                    <div class="twm-testimonial-detail">
                                        <p>I Was Very Impresed Lorem posuere in miss and drana 
                                            en the nisan semere sceriun amiss etiam ornare in 
                                            the miss drana is lorem fermen mauris.
                                        </p>
                                        <div class="twm-rating-wrap">
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                        </div> 
                                    </div>
                                        
                                    <div class="twm-quote-icon">
                                        <img src="images/quote.png" alt="#">
                                    </div>
                                    
                                </div> 
                            </div>

                            <!--Five block-->
                            <div class="item">
                                <div class="twm-testimonial2">
                                    <div class="twm-testimonial-head">
                                        <div class="media-pic">
                                            <img src="images/testimonial/pic2.jpg" alt="Image">
                                        </div>
                                        <div class="twm-author-detail">
                                            <h3 class="twm-title">Devid Cullen</h3>
                                            <div class="twm-position">Customer</div>
                                        </div>
                                    </div>
                                    
                                    <div class="twm-testimonial-detail">
                                        <p>I Was Very Impresed Lorem posuere in miss and drana 
                                            en the nisan semere sceriun amiss etiam ornare in 
                                            the miss drana is lorem fermen mauris.
                                        </p>
                                        <div class="twm-rating-wrap">
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                        </div> 
                                    </div>
                                        
                                    <div class="twm-quote-icon">
                                        <img src="images/quote.png" alt="#">
                                    </div>
                                    
                                </div> 
                            </div>

                            <!--Six block-->
                            <div class="item">
                                <div class="twm-testimonial2">
                                    <div class="twm-testimonial-head">
                                        <div class="media-pic">
                                            <img src="images/testimonial/pic3.jpg" alt="Image">
                                        </div>
                                        <div class="twm-author-detail">
                                            <h3 class="twm-title">Piter Has</h3>
                                            <div class="twm-position">Customer</div>
                                        </div>
                                    </div>
                                    
                                    <div class="twm-testimonial-detail">
                                        <p>I Was Very Impresed Lorem posuere in miss and drana 
                                            en the nisan semere sceriun amiss etiam ornare in 
                                            the miss drana is lorem fermen mauris.
                                        </p>
                                        <div class="twm-rating-wrap">
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                            <span><i class="fa fa-star"></i></span>
                                        </div> 
                                    </div>
                                        
                                    <div class="twm-quote-icon">
                                        <img src="images/quote.png" alt="#">
                                    </div>
                                    
                                </div> 
                            </div>

                        </div>

                    </div>

                </div>
            </div>
            <!--TESTIMONIAL SECTION END-->
            
            <!--OUR BLOG SECTION START-->
            
            <!--OUR BLOG SECTION END-->

     
        </div>
@endsection