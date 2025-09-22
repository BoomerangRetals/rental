<html lang="en">

<head>
	<!-- META -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="">
    <meta name="author" content="Boomerang Rentals">
    <meta name="robots" content="">    
    <meta name="description" content="">
    
    <!-- FAVICONS ICON -->
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" type="image/x-icon" href="../images/favicon.png">
    
    <!-- PAGE TITLE HERE -->
    <title>Boomerang Rentals</title>
    
    <!-- MOBILE SPECIFIC -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"><!-- BOOTSTRAP STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="../css/animate.min.css"><!-- WOW ANIMATION STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css"><!-- FONTAWESOME STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="../css/lc_lightbox.css"><!-- LC LIGHT BOX POPUP -->
    <link rel="stylesheet" type="text/css" href="../css/feather.css"><!-- FEATHER ICON SHEET -->
    <link rel="stylesheet" type="text/css" href="../css/owl.carousel.min.css"><!-- OWL CAROUSEL STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="../css/magnific-popup.min.css"><!-- MAGNIFIC POPUP STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="../css/swiper-bundle.min.css"><!-- SWIPER Slider -->
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-datetimepicker.min.css"><!-- DATETIMEPICKER STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="../css/style.css"><!-- MAIN STYLE SHEET -->
    <link rel="stylesheet" type="text/css" href="../css/jquery.mCustomScrollbar.min.css"><!-- CUSTOM SCROLLBAR -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->

    @yield('page-css')

</head>

<body>

    <!-- LOADING AREA START ===== -->
    <div class="loading-area">
        <div class="loading-box"></div>
        <div class="loading-pic">
            <img class="loader-gif" src="../images/loader-car.gif" alt="loader Image">
        </div>
    </div>
    

	<div class="page-wraper">
        <!-- HEADER START -->
        @include('layout.header')
        <!-- HEADER END -->

        <!-- CONTENT START -->
        
         @yield('content')
        <!-- CONTENT END -->

        <!-- FOOTER START -->
        @include('layout.footer')
        <!-- FOOTER END -->

        <!-- BUTTON TOP START -->
		<button class="scroltop"><span class="fa fa-angle-up  relative" id="btn-vibrate"></span></button>

 	</div>


<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/689ac351609b391925b4b96c/1j2e8lu2l';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->    


<!-- JAVASCRIPT  FILES ========================================= --> 
<script src="../js/jquery-3.7.1.min.js"></script><!-- JQUERY.MIN JS -->
<script src="../js/popper.min.js"></script><!-- POPPER.MIN JS -->
<script src="../js/bootstrap.min.js"></script><!-- BOOTSTRAP.MIN JS -->
<script src="../js/magnific-popup.min.js"></script><!-- MAGNIFIC-POPUP JS -->
<script src="../js/waypoints.min.js"></script><!-- WAYPOINTS JS -->
<script src="../js/waypoints-sticky.min.js"></script><!-- STICKY HEADER -->
<script src="../js/counterup.min.js"></script><!-- COUNTERUP JS -->
<script src="../js/isotope.pkgd.min.js"></script><!-- MASONRY -->
<script src="../js/imagesloaded.pkgd.min.js"></script><!-- MASONRY -->
<script src="../js/owl.carousel.min.js"></script><!-- OWL SLIDER -->
<script src="../js/theia-sticky-sidebar.js"></script><!-- STICKY SIDEBAR  -->
<script src="../js/lc_lightbox.lite.js" ></script><!-- IMAGE POPUP -->
<script src="../js/swiper-bundle.min.js"></script><!-- SWIPER JS -->
<script src="../js/wow.min.js"></script><!-- WOW ANIMATION JS -->
<script src="../js/custom.js"></script><!-- CUSTOM FUCTIONS -->
<script src="../js/tickerNews.min.js"></script><!-- TICKERNEWS-->
<script src="../js/moment.min.js"></script><!-- REQUIRE FOR BOOTSTRAP DATETIMEPICKER -->
<script src="../js/bootstrap-datetimepicker.min.js"></script><!-- BOOTSTRAP DATETIMEPICKER -->
<script src="../js/jquery.mCustomScrollbar.concat.min.js"></script><!-- CUSTOM SCROLLBAR JS -->
@yield('page-js')

</body>

</html>
