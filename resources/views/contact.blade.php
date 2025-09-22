@extends('layout.app')
@section('page-css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
@endsection
@section('content')
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
                                                        <h3 class="twm-title"><a href="tel:456-789-1012">041 694 8717</a></h3>
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
                                                <li><a href="https://www.facebook.com"><i class="fa-brands fa-x-twitter"></i></a></li>
                                                <li><a href="https://www.x.com"><i class="feather feather-facebook"></i></a></li>
                                                <li><a href="https://www.instagram.com"><i class="feather feather-instagram"></i></a></li>
                                                <li><a href="https://www.pinterest.com/"><i class="fa-brands fa-pinterest-p"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-5 col-lg-6 col-md-12">
                                    <div class="twm-contact-page-detail">
                                        <!-- TITLE START-->
                                        <div class="section-head left ">
                                            <h2 class="twm-large-title">Contact Form</h2>
                                            <p class="p-text">Enter your details. And you can feel free to contact 
                                                us for any kind of information.
                                            </p>
                                        </div>
                                        <!-- TITLE END-->

                                        <div class="twm-contact-page-form">
                                        
        
                                            <div class="contact-form-outer">
                                                <form class="cons-contact-form" method="post" action="phpmailer/mail.php">
                                        
                                                    <div class="row">
                
                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="form-group mb-4">
                                                                <input name="username" type="text" required="" class="form-control" placeholder="First Name">
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 col-md-6">
                                                            <div class="form-group mb-4">
                                                                <input name="username" type="text" required="" class="form-control" placeholder="Last Name">
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-lg-12 col-md-12">
                                                            <div class="form-group mb-4">
                                                            <input name="email" type="text" class="form-control" required="" placeholder="Email">
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-lg-12 col-md-12">
                                                            <div class="form-group mb-4">
                                                                <input name="phone" type="text" class="form-control" required="" placeholder="Phone">
                                                            </div>
                                                        </div>
                                                        
                                                       
                                                        <div class="col-lg-12">
                                                            <div class="form-group mb-5">
                                                            <textarea name="message" class="form-control" rows="3" placeholder="Message"></textarea>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-12">
                                                            <button type="submit" class="site-button dark-bg"><em>Submit Now</em></button>
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

            <div class="gmap-outline">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3313.186649494646!2d151.0773820757792!3d-33.91921702322609!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b12bc2e2b8e9e6d%3A0x2e7e6e5e2e7e6e5e!2s79%20Yerrick%20Rd%2C%20Lakemba%20NSW%202195%2C%20Australia!5e0!3m2!1sen!2sau!4v1718191234567!5m2!1sen!2sau"
        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div> 

            <div class="section-full p-b120">
                <div class="container">
                    <div class="section-content">
                        <div class="twm-get-info-section">
                            <div class="row">
                                
                                <div class="col-lg-4 col-md-6">
                                    <div class="twm-get-info-wrap st02-small">
                                        <h3 class="wm-h-title">Sydney</h3>
                                        <ul>
            
                                            <li>
                                                <div class="twm-get-info">
                                                    <div class="twm-media">
                                                        <i class="feather feather-phone-call"></i>
                                                    </div>
                                                    <div class="twm-content">
                                                        <p>Phone</p>
                                                        <h3 class="twm-title"><a href="tel:456-789-1012">041 694 8717</a></h3>
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
                                                        <h3 class="twm-title">79 Yerrick Rd, Lakemba NSW 2195</h3>
                                                    </div>
                                                </div>
                                            </li>
            
                                        </ul>
                                    </div>
                                </div>
    
    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection