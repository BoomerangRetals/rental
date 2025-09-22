@extends('layout.app')

@section('page-css')
<style>
.services-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.services-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.service-icon {
    color: #28a745;
    margin-right: 8px;
}

.cta-card {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: white;
}

.cta-card .btn {
    background: white;
    color: #e74c3c;
    border: none;
}

.cta-card .btn:hover {
    background: #f8f9fa;
    color: #c0392b;
    transform: translateY(-2px);
}
</style>
@endsection


@section('content')
<div class="page-content">

    <!-- INNER PAGE BANNER -->
    <div class="bg-image d-flex align-items-end text-white"
        style="background-image: url('images/service-bg.jpg'); height: 640px; background-size: cover; background-position: center;">
        <div class="container mb-5">
            <h1 class="display-4 fw-bold text-uppercase fst-italic"></h1>
        </div>
    </div>
    <!-- INNER PAGE BANNER END -->


    <!--ABOUT US SECTION START-->
    <div class="section-full site-bg-white twm-abus3-section-wrap wow fadeInDown" data-wow-offset="100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-6 col-lg-12 col-md-12">
                    <div class=" twm-abus-st2-section">
                        <!-- TITLE START-->
                        <div class="section-head left">
                            <div class="twm-sm-title left">Services</div>
                            <h2 class="twm-large-title site-text-dark">
                                We’re Here to Serve You Better
                            </h2>
                            <div class="section-head-detail">
                                We provide expert maintenance and repair services for all types of vehicles – whether you ride on two wheels or drive four. Our skilled technicians specialize in servicing bikes, electric bikes, cars, and vans, ensuring every vehicle leaves our workshop in peak condition.
                            </div>
                        </div>
                        <!-- TITLE END-->
                        <div class="twm-inline-list2">
                            <ul>
                                <li>Experienced & certified technician</li>
                                <li>Transparent pricing with no hidden fees</li>
                                <li>Service for all major makes and models</li>
                            </ul>
                        </div>
                        <div class="twm-btn-left">
                            <a href="#" class="site-button">
                                <em>Read More</em>
                            </a>
                        </div>

                        <div class="twm-abus-st2-large-title">
                            <h2 class="twm-title">Services</h2>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12 col-md-12 twm-abus3-right-pic">
                    <div class="twm-abus3-right-content">
                        <div class="twm-serv-media">
                            <img src="images/service-image.png" alt="#">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--ABOUS US SECTION END-->

    <!--Facilities SECTION START-->
    <div class="section-full p-t120 p-b120 site-bg-white twm-facilities-section-wrap wow fadeInDown"
        data-wow-offset="100" data-wow-delay="0.2">
        <div class="container">

            <div class="section-content">
                <div class="row twm-step-towards-section">

                    <div class="col-lg-3 col-md-6 col-sm-6 m-b30">
                        <div class="twm-facilities-bx">
                            <div class="twm-media">
                                <img src="images/icons/courier.png" alt="image">
                            </div>
                            <div class="twm-content">
                                <h3 class="twm-title">Certified technicians</h3>
                                <p>Ensure your vehicle is in the hands of certified professionals who guarantee quality service and repairs.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6 m-b30">
                        <div class="twm-facilities-bx">
                            <div class="twm-media">
                                <img src="images/icons/parking-area.png" alt="image">
                            </div>
                            <div class="twm-content">
                                <h3 class="twm-title">Inspection Report</h3>
                                <p>
                                    Get a detailed inspection report to ensure your vehicle is safe and roadworthy.
                                    <br>
                                    <br>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6 m-b30">
                        <div class="twm-facilities-bx">
                            <div class="twm-media">
                                <img src="images/icons/biological.png" alt="image">
                            </div>
                            <div class="twm-content">
                                <h3 class="twm-title">Transparent pricing</h3>
                                <p>We provide clear and upfront pricing for all services, ensuring no hidden fees or surprises.
                                    <br><br>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6 m-b30">
                        <div class="twm-facilities-bx">
                            <div class="twm-media">
                                <img src="images/icons/maps.png" alt="image">
                            </div>
                            <div class="twm-content">
                                <h3 class="twm-title">Visit Today</h3>
                                <p>
                                    Select The Shortest and Best Route To 79 Yerrick Road, Lakemba, NSW 2195
                                    <br>
                                    <br>
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
    <!--Facilities SECTION END-->

    <!--SERVICES LIST SECTION START-->
    <div class="section-full py-5 bg-light">
        <div class="container">
            <!-- TITLE START-->
            <div class="row justify-content-center mb-5">
                <div class="col-lg-8 text-center">
                    <div class="twm-sm-title text-uppercase text-muted mb-2">Our Services</div>
                    <h2 class="display-5 fw-bold text-dark mb-3">Complete Automotive Services</h2>
                    <p class="lead text-muted">
                        From routine maintenance to complex repairs, we offer a comprehensive range of automotive services for all vehicle types.
                    </p>
                </div>
            </div>
            <!-- TITLE END-->

            <div class="row g-4">
                <!-- Column 1 - Maintenance & Servicing -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm services-card">
                        <div class="card-body p-4">
                            <h5 class="card-title text-primary border-bottom border-danger pb-2 mb-3">
                                Maintenance & Servicing
                            </h5>
                            <ul class="list-unstyled mb-0">
                                <li class="d-flex align-items-center py-2">
                                    <i class="feather feather-check-circle service-icon me-2"></i>
                                    <span class="text-muted">Logbook & Basic Servicing</span>
                                </li>
                                <li class="d-flex align-items-center py-2">
                                    <i class="feather feather-check-circle service-icon me-2"></i>
                                    <span class="text-muted">Pre-Purchase Inspections</span>
                                </li>
                                <li class="d-flex align-items-center py-2">
                                    <i class="feather feather-check-circle service-icon me-2"></i>
                                    <span class="text-muted">Roadworthy & Safety Certificates</span>
                                </li>
                                <li class="d-flex align-items-center py-2">
                                    <i class="feather feather-check-circle service-icon me-2"></i>
                                    <span class="text-muted">Timing Belt/Chain</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Column 2 - Mechanical Services -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm services-card">
                        <div class="card-body p-4">
                            <h5 class="card-title text-primary border-bottom border-danger pb-2 mb-3">
                                Mechanical Services
                            </h5>
                            <ul class="list-unstyled mb-0">
                                <li class="d-flex align-items-center py-2">
                                    <i class="feather feather-check-circle service-icon me-2"></i>
                                    <span class="text-muted">Engine</span>
                                </li>
                                <li class="d-flex align-items-center py-2">
                                    <i class="feather feather-check-circle service-icon me-2"></i>
                                    <span class="text-muted">Brakes</span>
                                </li>
                                <li class="d-flex align-items-center py-2">
                                    <i class="feather feather-check-circle service-icon me-2"></i>
                                    <span class="text-muted">Clutch</span>
                                </li>
                                <li class="d-flex align-items-center py-2">
                                    <i class="feather feather-check-circle service-icon me-2"></i>
                                    <span class="text-muted">Transmission</span>
                                </li>
                                <li class="d-flex align-items-center py-2">
                                    <i class="feather feather-check-circle service-icon me-2"></i>
                                    <span class="text-muted">Differential</span>
                                </li>
                                <li class="d-flex align-items-center py-2">
                                    <i class="feather feather-check-circle service-icon me-2"></i>
                                    <span class="text-muted">Cooling</span>
                                </li>
                                <li class="d-flex align-items-center py-2">
                                    <i class="feather feather-check-circle service-icon me-2"></i>
                                    <span class="text-muted">Suspension / Steering</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Column 3 - Electrical & Climate -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm services-card">
                        <div class="card-body p-4">
                            <h5 class="card-title text-primary border-bottom border-danger pb-2 mb-3">
                                Electrical & Climate
                            </h5>
                            <ul class="list-unstyled mb-0">
                                <li class="d-flex align-items-center py-2">
                                    <i class="feather feather-check-circle service-icon me-2"></i>
                                    <span class="text-muted">Air Conditioning</span>
                                </li>
                                <li class="d-flex align-items-center py-2">
                                    <i class="feather feather-check-circle service-icon me-2"></i>
                                    <span class="text-muted">Auto Electrical</span>
                                </li>
                                <li class="d-flex align-items-center py-2">
                                    <i class="feather feather-check-circle service-icon me-2"></i>
                                    <span class="text-muted">Batteries</span>
                                </li>
                                <li class="d-flex align-items-center py-2">
                                    <i class="feather feather-check-circle service-icon me-2"></i>
                                    <span class="text-muted">Installation</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Column 4 - Body & Appearance -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm services-card">
                        <div class="card-body p-4">
                            <h5 class="card-title text-primary border-bottom border-danger pb-2 mb-3">
                                Body & Appearance
                            </h5>
                            <ul class="list-unstyled mb-0">
                                <li class="d-flex align-items-center py-2">
                                    <i class="feather feather-check-circle service-icon me-2"></i>
                                    <span class="text-muted">Auto Glass</span>
                                </li>
                                <li class="d-flex align-items-center py-2">
                                    <i class="feather feather-check-circle service-icon me-2"></i>
                                    <span class="text-muted">Auto Trimming</span>
                                </li>
                                <li class="d-flex align-items-center py-2">
                                    <i class="feather feather-check-circle service-icon me-2"></i>
                                    <span class="text-muted">Wheel Repair</span>
                                </li>
                                <li class="d-flex align-items-center py-2">
                                    <i class="feather feather-check-circle service-icon me-2"></i>
                                    <span class="text-muted">Tyre</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Column 5 - Additional Services -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm services-card">
                        <div class="card-body p-4">
                            <h5 class="card-title text-primary border-bottom border-danger pb-2 mb-3">
                                Additional Services
                            </h5>
                            <ul class="list-unstyled mb-0">
                                <li class="d-flex align-items-center py-2">
                                    <i class="feather feather-check-circle service-icon me-2"></i>
                                    <span class="text-muted">Towing</span>
                                </li>
                                <li class="d-flex align-items-center py-2">
                                    <i class="feather feather-check-circle service-icon me-2"></i>
                                    <span class="text-muted">Locksmith</span>
                                </li>
                                <li class="d-flex align-items-center py-2">
                                    <i class="feather feather-check-circle service-icon me-2"></i>
                                    <span class="text-muted">Driving School</span>
                                </li>
                                <li class="d-flex align-items-center py-2">
                                    <i class="feather feather-check-circle service-icon me-2"></i>
                                    <span class="text-muted">Miscellaneous</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Column 6 - Call to Action -->
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm cta-card">
                        <div class="card-body p-4 d-flex flex-column justify-content-center text-center">
                            <h5 class="card-title text-white border-bottom border-light pb-2 mb-3">
                                Need Help?
                            </h5>
                            <p class="text-white-50 mb-4">
                                Contact us for any service not listed above or for a custom quote.
                            </p>
                            <div class="mt-auto">
                                <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">
                                    Get Quote
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--SERVICES LIST SECTION END-->


    <!--LET'S YOUR ADVENTURE SECTION START-->
    <div class="section-full p-t150 p-b120 site-bg-dark twm-step-towards-section-wrap wow fadeInDown"
        data-wow-offset="100" data-wow-delay="0.2">
        <div class="twm-half-bg-pic" style="background-image: url(images/half-bg-pic.jpg);"></div>
        <div class="container">

            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <!-- TITLE START-->
                    <div class="section-head left">
                        <div class="twm-sm-title left">One step towards you</div>
                        <!-- <h2 class="twm-large-title site-text-white">Let's Your Adventure Begin</h2> -->
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
                                <h3 class="twm-title">Book Your Service Today</h3>
                                <p>Whether it’s a regular tune-up or an unexpected issue, we’re ready to help. Drop by, call us, or book online — and experience professional vehicle service that puts your needs first.
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
                                <h3 class="twm-title">Friendly customer support</h3>
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
                                <h3 class="twm-title">Routine Maintenance & Checkups</h3>
                                <p>
                                    Regular inspections to keep your vehicle running smoothly and prevent future issues.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
    <!--LET'S YOUR ADVENTURE SECTION END-->


    <!-- Contact Form SECTION START -->
    <div class="section-full p-t150 p-b120 site-bg-white twm-contact-section-wrap">

        <div class="container">

            <div class="section-content">
                <div class="twm-contact-section">
                    <div class="row">

                        <div class="col-xl-7 col-lg-6 col-md-12">
                            <div class="twm-maskingtext m-b50">
                                <h1>Get In Touch</h1>
                                <img src="images/text-masking-pic.jpg" alt="Image">
                            </div>
                            <div class="twm-get-info-wrap">

                                <ul>

                                    <li>
                                        <div class="twm-get-info">
                                            <div class="twm-media">
                                                <i class="feather feather-phone-call"></i>
                                            </div>
                                            <div class="twm-content">
                                                <p>Phone</p>
                                                <h3 class="twm-title"><a href="tel:456-789-1012">0416 748 717</a></h3>
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="twm-get-info">
                                            <div class="twm-media">
                                                <i class="feather feather-mail"></i>
                                            </div>
                                            <div class="twm-content">
                                                <p>Email</p>
                                                <h3 class="twm-title">services@boomerangrentals.com.au</h3>
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="twm-get-info">
                                            <div class="twm-media">
                                                <i class="feather feather-home"></i>
                                            </div>
                                            <div class="twm-content">
                                                <p>Address</p>
                                                <h3 class="twm-title">79 Yerrick Road, Lakemba, NSW 2195</h3>
                                            </div>
                                        </div>
                                    </li>

                                </ul>

                                <div class="twm-social">
                                    <h3 class="twm-title">Follow Us</h3>
                                    <ul>
                                        <li><a href="https://www.facebook.com"><i
                                                    class="fa-brands fa-x-twitter"></i></a></li>
                                        <li><a href="https://www.x.com"><i class="feather feather-facebook"></i></a>
                                        </li>
                                        <li><a href="https://www.instagram.com"><i
                                                    class="feather feather-instagram"></i></a></li>
                                        <li><a href="https://www.pinterest.com/"><i
                                                    class="fa-brands fa-pinterest-p"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-5 col-lg-6 col-md-12">
                            <div class="twm-contact-page-detail">
                                <!-- TITLE START-->
                                <div class="section-head left ">
                                    <h2 class="twm-large-title">Contact Form</h2>
                                    <p class="p-text">Feel free to contact
                                        us for any kind of information.
                                    </p>
                                </div>
                                <!-- TITLE END-->

                                <div class="twm-contact-page-form">


                                    <div class="contact-form-outer">
                                        <form class="cons-contact-form" method="post" action="form-handler2.php">

                                            <div class="row">

                                                <div class="col-lg-6 col-md-6">
                                                    <div class="form-group mb-4">
                                                        <input name="username" type="text" required=""
                                                            class="form-control" placeholder="First Name">
                                                    </div>
                                                </div>

                                                <div class="col-lg-6 col-md-6">
                                                    <div class="form-group mb-4">
                                                        <input name="username" type="text" required=""
                                                            class="form-control" placeholder="Last Name">
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 col-md-12">
                                                    <div class="form-group mb-4">
                                                        <input name="email" type="text" class="form-control" required=""
                                                            placeholder="Email">
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 col-md-12">
                                                    <div class="form-group mb-4">
                                                        <input name="phone" type="text" class="form-control" required=""
                                                            placeholder="Phone">
                                                    </div>
                                                </div>


                                                <div class="col-lg-12">
                                                    <div class="form-group mb-5">
                                                        <textarea name="message" class="form-control" rows="3"
                                                            placeholder="Message"></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <button type="submit" class="site-button dark-bg"><em>Submit
                                                            Now</em></button>
                                                </div>

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

    </div>
    <!-- Contact Form SECTION END -->

</div>
@endsection
