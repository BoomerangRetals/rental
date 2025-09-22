@extends('layout.app')

@section('content')
<div class="page-content">

            <!-- INNER PAGE BANNER -->
           
            <!-- INNER PAGE BANNER END -->   


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

            <!--HOW IT WORK SECTION START-->
            <div class="section-full site-bg-light twm-how-it-work-wrap wow fadeInDown" data-wow-offset="100" data-wow-delay="0.2">
                 <div class="section-content">

                    <div class="twm-how-it-work-section container-fluid">
                        <div class="row">
                        
                            <div class="col-lg-6 col-md-12">
                               <div class="twm-how-it-work-media">
                                   <img src="images/toyota-w.png" alt="#">
                               </div> 
                            </div>
    
                            <div class="col-lg-6 col-md-12">

                                <div class="twm-how-it-work-content">
                                    <!-- TITLE START-->
                                    <div class="section-head left">
                                        <div class="twm-sm-title left">How To Start</div>
                                        <h2 class="twm-large-title site-text-dark">Just A Few Steps</h2>
                                    </div>
                                    <!-- TITLE END-->
                                    <div class="row">

                                        <div class="col-lg-6 col-md-6 col-sm-6 m-b30">
                                            <div class="twm-w-steps-st2">
                                                <div class="twm-w-step-count">
                                                    <span>01</span>
                                                </div>
                                                <div class="twm-w-step-detail">
                                                    <h3 class="twm-title">Choose A Car</h3>
                                                    <p>Browse Our Wide Range Of Cars And Select The One That Best Suits Your Needs</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-6 m-b30">
                                            <div class="twm-w-steps-st2">
                                                <div class="twm-w-step-count">
                                                    <span>02</span>
                                                </div>
                                                <div class="twm-w-step-detail">
                                                    <h3 class="twm-title">Pick Up Date</h3>
                                                    <p>Select Your Preferred Pick-Up Date To Reserve The Vehicle That Suits Your Needs </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-6 m-b30">
                                            <div class="twm-w-steps-st2">
                                                <div class="twm-w-step-count">
                                                    <span>03</span>
                                                </div>
                                                <div class="twm-w-step-detail">
                                                    <h3 class="twm-title">Confirm Your Booking</h3>
                                                    <p>Review Your Selection And Confirm Your Booking To Secure Your Vehicle  </p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-6 m-b30">
                                            <div class="twm-w-steps-st2">
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
                                </div>
                                
                            </div>
                     
    
                        </div>
                    </div>
                    

                </div>

                
            </div>

            <!--OWNER SECTION START (Dynamic, Beautiful)-->
            @if($owner)
            <div class="section-full p-t120 p-b80 site-bg-white twm-owner-section-wrap wow fadeInDown" data-wow-offset="100" data-wow-delay="0.2">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="section-head center mb-5">
                                <div class="twm-sm-title left text-uppercase">Business Owner</div>
                                <h2 class="twm-large-title site-text-dark">Meet Our Owner</h2>
                            </div>
                            <div class="twm-owner-content bg-white rounded-4 p-5 text-center position-relative" style="box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.18); border: 3px solid; border-image: linear-gradient(135deg, #764ba2 0%, #667eea 100%) 1; background: linear-gradient(135deg, #f8fafc 60%, #e0e7ff 100%);">
                                <div class="position-relative d-inline-block mb-4">
                                    <img src="{{ $owner->photo ? $owner->photo : asset('images/default-user.png') }}" alt="{{ $owner->name }}" class="rounded-circle border border-4" style="border-color: #764ba2; width: 180px; height: 180px; object-fit: cover; box-shadow: 0 4px 24px 0 rgba(118,75,162,0.18);">
                                    <span class="position-absolute bottom-0 end-0 translate-middle p-2" style="background: linear-gradient(135deg, #764ba2 0%, #667eea 100%); border: 2px solid #fff; border-radius: 50%;">
                                        <i class="feather feather-star text-white" style="font-size: 1.5rem;"></i>
                                    </span>
                                </div>
                                <h3 class="mb-2 fw-bold" style="font-size: 2rem; color: #4b2994; letter-spacing: 1px;">{{ $owner->name }}</h3>
                                <h5 class="mb-3 fw-semibold" style="color: #667eea;">{{ $owner->business_title ?? $owner->position }}</h5>
                                @if($owner->company_message)
                                <div class="twm-company-message mb-4 p-4 rounded-3" style="background: linear-gradient(90deg, #e0e7ff 0%, #f8fafc 100%); border-left: 5px solid #764ba2;">
                                    <h6 class="mb-2 fw-semibold" style="color: #764ba2;">
                                        <i class="feather feather-message-circle me-2"></i>Message from Owner
                                    </h6>
                                    <p class="mb-0 fst-italic" style="font-size: 1.1rem; line-height: 1.6; color: #4b2994;">
                                        "{{ $owner->company_message }}"
                                    </p>
                                </div>
                                @endif
                                <div class="row mt-4">
                                    @if($owner->vision_statement)
                                    <div class="col-md-6 mb-3">
                                        <div class="twm-vision-card h-100 p-4 border-0 rounded-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #fff; box-shadow: 0 2px 12px 0 rgba(102,126,234,0.15);">
                                            <div class="d-flex align-items-center mb-2">
                                                <i class="feather feather-eye me-2" style="font-size: 1.2rem; color: #fff;"></i>
                                                <span class="fw-bold" style="color: #fff; text-shadow: 0 1px 2px #4b2994;">Vision</span>
                                            </div>
                                            <p class="mb-0" style="line-height: 1.6; color: #f8fafc; text-shadow: 0 1px 2px #4b2994;">{{ $owner->vision_statement }}</p>
                                        </div>
                                    </div>
                                    @endif
                                    @if($owner->thoughts)
                                    <div class="col-md-6 mb-3">
                                        <div class="twm-thoughts-card h-100 p-4 border-0 rounded-3" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); color: #fff; box-shadow: 0 2px 12px 0 rgba(240,147,251,0.15);">
                                            <div class="d-flex align-items-center mb-2">
                                                <i class="feather feather-heart me-2" style="font-size: 1.2rem; color: #fff;"></i>
                                                <span class="fw-bold" style="color: #fff; text-shadow: 0 1px 2px #f5576c;">Philosophy</span>
                                            </div>
                                            <p class="mb-0" style="line-height: 1.6; color: #f8fafc; text-shadow: 0 1px 2px #f5576c;">{{ $owner->thoughts }}</p>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="row mt-4">
                                    <div class="col-12 d-flex justify-content-center align-items-center flex-wrap gap-3">
                                        @if($owner->email)
                                            <a href="mailto:{{ $owner->email }}" class="btn btn-outline-primary btn-lg d-flex align-items-center">
                                                <i class="feather feather-mail me-2"></i>Contact Owner
                                            </a>
                                        @endif
                                        @if($owner->phone)
                                            <a href="tel:{{ $owner->phone }}" class="btn btn-primary btn-lg d-flex align-items-center">
                                                <i class="feather feather-phone me-2"></i>{{ $owner->phone }}
                                            </a>
                                        @endif
                                    </div>
                                    @if($owner->facebook || $owner->instagram || $owner->snap)
                                    <div class="col-12 mt-4">
                                        <h6 class="text-muted mb-3">Connect with {{ explode(' ', $owner->name)[0] }}</h6>
                                        <div class="d-flex justify-content-center gap-3">
                                            @if($owner->facebook)
                                                <a href="{{ $owner->facebook }}" class="btn btn-outline-primary rounded-circle" style="width: 50px; height: 50px;" target="_blank">
                                                    <i class="feather feather-facebook"></i>
                                                </a>
                                            @endif
                                            @if($owner->instagram)
                                                <a href="{{ $owner->instagram }}" class="btn btn-outline-primary rounded-circle" style="width: 50px; height: 50px;" target="_blank">
                                                    <i class="feather feather-instagram"></i>
                                                </a>
                                            @endif
                                            @if($owner->snap)
                                                <a href="{{ $owner->snap }}" class="btn btn-outline-primary rounded-circle" style="width: 50px; height: 50px;" target="_blank">
                                                    <i class="feather feather-camera"></i>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <!--OWNER SECTION END-->

            <!--HOW IT WORK SECTION END-->

           

            <!--TEAM SECTION START-->
            <div class="section-full p-t150 p-b120 site-bg-white twm-testimonial-section-wrap wow fadeInDown" data-wow-offset="100" data-wow-delay="0.2">
                <div class="container">

                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <!-- TITLE START-->
                            <div class="section-head left ">
                                <div class="twm-sm-title left">TEAM</div>
                                <h2 class="twm-large-title site-text-dark">Team Members</h2>
                            </div>
                            <!-- TITLE END-->
                        </div>
                    </div>

                    <div class="section-content">

                        <div class="owl-carousel twm-team-carousel next-prev-top-right m-b30">
                            @forelse ($teams as $team)
                            <div class="item">
                                <div class="twm-team-section">
                                    <div class="twm-team-info">
                                        <a class="twm-l-title" href="team-detail.html">
                                            <h2 class="twm-title">{{ $team->name }}</h2>
                                        </a>
                                        <div class="twm-s-title">{{ $team->position }}</div>
                                    </div>
                                    <div class="twm-team-media">
                                        <a href="team-detail.html">
                                            <img  src="{{ $team->photo }}" alt="#">
                                        </a>
                                        <div class="twm-team-social">
                                            <ul>
                                                
                                                <li>
                                                    <a href="{{ $team->facebook }}">
                                                        <i class="feather feather-facebook"></i>
                                                        <span>Facebook</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ $team->instagram }}">
                                                        <i class="feather feather-instagram"></i>
                                                        <span>Instagram</span>
                                                    </a>
                                                </li>
                                                
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="item">
                                <div class="text-center py-5">
                                    <p class="text-muted">No team members to display at the moment.</p>
                                </div>
                            </div>
                            @endforelse
                            
                            
                        </div>

                    </div>

                </div>
            </div>
            <!--TEAM SECTION END-->

            <!--TESTIMONIAL SECTION START-->
            <div class="section-full p-t150  p-b120 site-bg-dark twm-testimonial-section-wrap wow fadeInDown" data-wow-offset="100" data-wow-delay="0.2">
                <div class="container">

                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <!-- TITLE START-->
                            <div class="section-head left ">
                                <div class="twm-sm-title left">REVIEWS</div>
                                <h2 class="twm-large-title site-text-white">Our Customers Review</h2>
                            </div>
                            <!-- TITLE END-->
                        </div>
                    </div>

                    <div class="section-content">
                        <div class="owl-carousel twm-blog-carousel next-prev-top-right m-b30">
                            @foreach ($reviews as $review)
                            <div class="item">
                                <div class="twm-testimonial2 drk-view">
                                    <div class="twm-testimonial-head">
                                        <div class="media-pic">
                                            <img src="images/testimonial/pic1.jpg" alt="Image">
                                        </div>
                                        <div class="twm-author-detail">
                                            <h3 class="twm-title">{{ $review->name }}</h3>
                                            <div class="twm-position">Customer</div>
                                        </div>
                                    </div>
                                    
                                    <div class="twm-testimonial-detail">
                                        <p>{{ $review->comment }}
                                        </p>
                                        <div class="twm-rating-wrap">
                                            @for ($i = 0; $i < $review->rating; $i++)
                                                <span><i class="fa fa-star"></i></span>
                                            @endfor
                                        </div> 
                                    </div>
                                        
                                    <div class="twm-quote-icon">
                                        <img src="images/quote.png" alt="#">
                                    </div>
                                    
                                </div> 
                            </div>
                            @endforeach
                            <!--One block-->
                            

                            <!--Two block-->


                        </div>
                    </div>

                </div>
            </div>
            <!--TESTIMONIAL SECTION END-->

            <!--ABOUT US SECTION START-->
            <div class="section-full site-bg-light twm-abus-section-wrap wow fadeInDown" data-wow-offset="100" data-wow-delay="0.2">
                <div class="row">
                    <div class="col-lg-6 col-md-12">
                        <div class=" twm-abus-st2-section">
                            <!-- TITLE START-->
                            <div class="section-head left">
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
                            
                            <div class="twm-abus2-left">
                                <div class="twm-abus-video">
                                    <a href="https://vimeo.com/337649532" class="mfp-video ">
                                        <i class="icon fa fa-play"></i>
                                    </a>
                                </div>
                                <div class="twm-abus2-year-section">
                                    <div class="tem-abus-year-content">
                                        <span>Since</span>
                                        <h2 class="year-title">2019</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 twm-abus2-right-pic" style="background-image:url(images/f-rent.png) ">
                        <div class="abus2-right-pic">
                            <h2 class="twm-title">For Rental</h2>
                        </div>
                    </div>
                    
                </div>
            </div>
            <!--ABOUS US SECTION END-->
            

        </div>
@endsection        