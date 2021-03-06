<?php
include('db.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Keopi</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Resort Inn Responsive , Smartphone Compatible web template , Samsung, LG, Sony Ericsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
		function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->

<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/font-awesome.css" rel="stylesheet">
<link rel="stylesheet" href="css/chocolat.css" type="text/css" media="screen">
<link href="css/easy-responsive-tabs.css" rel='stylesheet' type='text/css'/>
<link rel="stylesheet" href="css/flexslider.css" type="text/css" media="screen" property="" />
<link rel="stylesheet" href="css/jquery-ui.css" />
<link href="css/style.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/modernizr-2.6.2.min.js"></script>

<!--fonts-->
<link href="//fonts.googleapis.com/css?family=Oswald:300,400,700" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Federo" rel="stylesheet">
<link href="//fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
<!--//fonts-->

</head>
<!-- styles -->
<style type = "text/css">
	body
	{
		background-color: #FDF2E9;
	}
	.w3_navigation
	{
		background-color: #935116;
	}
	h3
	{
		color: #935116;
	}
	.copy
	{
		background-color: #935116;
	}
	#myImg
	{
	  border-radius: 0px;
	  cursor: pointer;
	  transition: 0.3s;
	}

	#myImg:hover {opacity: 0.7;}

	/* The Modal (background) */
	.modal
	{
	  display: none; /* Hidden by default */
	  position: fixed; /* Stay in place */
	  z-index: 1; /* Sit on top */
	  padding-top: 100px; /* Location of the box */
	  left: 0;
	  top: 0;
	  width: 100%; /* Full width */
	  height: 100%; /* Full height */
	  overflow: auto; /* Enable scroll if needed */
	  background-color: rgb(0,0,0); /* Fallback color */
	  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
	}

	/* Modal Content (Image) */
	.modal-content
	{
	  margin: auto;
	  display: block;
	  width: 100%;
	  max-width: 700px;
	}

	/* Caption of Modal Image (Image Text) - Same Width as the Image */
	#caption
	{
	  margin: auto;
	  display: block;
	  width: 80%;
	  max-width: 700px;
	  text-align: center;
	  color: #ccc;
	  padding: 10px 0;
	  height: 150px;
	}

	/* Add Animation - Zoom in the Modal */
	.modal-content, #caption
	{
	  animation-name: zoom;
	  animation-duration: 0.6s;
	}

	@keyframes zoom
	{
	  from {transform:scale(0)}
	  to {transform:scale(1)}
	}

	/* The Close Button */
	.close
	{
	  position: absolute;
	  top: 15px;
	  right: 35px;
	  color: #f1f1f1;
	  font-size: 40px;
	  font-weight: bold;
	  transition: 0.3s;
	}

	.close:hover,
	.close:focus
	{
	  color: #bbb;
	  text-decoration: none;
	  cursor: pointer;
	}

	/* 100% Image Width on Smaller Screens */
	@media only screen and (max-width: 700px)
	{
	  .modal-content
	  {
		width: 100%;
	  }
	}

	*
	{
	  box-sizing: border-box;
	}

	/* Position the image container (needed to position the left and right arrows) */
	.container {
	  position: relative;
	}

	/* Add a pointer when hovering over the thumbnail images */
	.cursor
	{
	  cursor: pointer;
	}

	/* Next & previous buttons */
	.prev,
	.next
	{
	  cursor: pointer;
	  position: absolute;
	  top: 40%;
	  width: auto;
	  padding: 16px;
	  margin-top: -50px;
	  color: white;
	  font-weight: bold;
	  font-size: 20px;
	  border-radius: 0 3px 3px 0;
	  user-select: none;
	  -webkit-user-select: none;
	}

	/* Position the "next button" to the right */
	.next
	{
	  right: 0;
	  border-radius: 3px 0 0 3px;
	}

	/* On hover, add a black background color with a little bit see-through */
	.prev:hover,
	.next:hover
	{
	  background-color: rgba(0, 0, 0, 0.8);
	}

	/* Number text (1/3 etc) */
	.numbertext
	{
	  color: #f2f2f2;
	  font-size: 30px;
	  padding: 8px 12px;
	  position: absolute;
	  top: 0;
	}

	/* Container for image text */
	.caption-container
	{
	  text-align: center;
	  background-color: #222;
	  font-size: 40px;
	  color: white;
	}

	.row:after {
	  content: "";
	  display: table;
	  clear: both;
	}

	/* Six columns side by side */
	.column {
	  float: left;
	  width: 25%;
	}

	/* Add a transparency effect for thumnbail images */
	.demo {
	  opacity: 0.6;
	}

	.active,
	.demo:hover {
	  opacity: 1;
	}

</style>

<body>
<!-- start header -->
<div class="w3_navigation">
	<div class="container">
		<nav class="navbar navbar-default">
			<div class="navbar-header navbar-left">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<h1><a class="navbar-brand" href="home.php"><span>Keopi</span><p class="logo_w3l_agile_caption">Your Local Cafe</p></a></h1>
			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
				<nav class="menu menu--iris">
					<ul class="nav navbar-nav menu__list">
						<li class="menu__item menu__item--current"><a href="home.php" class="menu__link">Home</a></li>
						<li class="menu__item"><a href="menu.php" class="menu__link">Menu</a></li>
						<li class="menu__item"><a href="login.html" class="menu__link">Login</a></li>
					</ul>
				</nav>
			</div>
		</nav>
	</div>
</div>
<!-- //end header -->

<!-- banner -->
<div id="home" class="w3ls-banner">
<!-- start banner-text -->
	<div class="slider">
		<div class="callbacks_container">
			<ul class="rslides callbacks callbacks1" id="slider4">
				<li>
					<div class="w3layouts-banner-top" style="background-image: url(img/bg.jpg); height: 100%;">
						<div class="container">
							<div class="agileits-banner-info">
								<h4>Keopi</h4>
									<h3>We know what you love</h3>
										<p>Welcome to our coffee shop</p>
							</div>
						</div>
					</div>
				</li>
			</ul>
		</div>

		<div class="clearfix"> </div>

	</div>
</div>
<!-- //end banner -->

<!-- //start about -->
 <div class="about-wthree" id="about" style="background: #FDF2E9; padding-bottom: 20px;">
	  <div class="container">
			<div class="row">
				<div class="col-sm-6 text-right">
					<h3 class="title-w3-agileits title-black-wthree">ABOUT OUR CAFE</h3>
					<p class="about-para-w3ls"> Keopi is a family-owned business in a stop-and-go cafe to delight you with refreshments as you pass by. Take a break from the woes of travel and grab a drink from Keopi! We offer a variety of beverages, from caffenated drinks to sweet ades. </p>
					<br>
				</div>
				<div class="col-sm-6 text-center">

					<img src="img/caramel.jpg" width="500" onclick="currentSlide(1)" alt="Caramel">
				</div>
			</div>


		 </div>
		</div>

		<div class="about-wthree" id="about" style="background: #935116; padding-bottom: 20px; color: white !important; ">
	 	  <div class="container">
	 			<div class="row">
					<div class="col-sm-6 text-center">
	 					<img src="img/chocolatechip.jpg" width="500" onclick="currentSlide(1)" alt="Caramel">
	 				</div>
	 				<div class="col-sm-6 text-right">
	 					<h3 class="title-w3-agileits title-black-wthree">GRAB A BITE!</h3>
	 					<p class="about-para-w3ls" style="color: white;"> We don't restrict our menu to drinks only. When you go hungry on your rides, we also sell sandwiches to fill your empty stomach. If you've got a sweet tooth, we have pastries for you too! </p>
	 					<br>
	 				</div>

	 			</div>


	 		 </div>
	 		</div>

<section class="contact-w3ls" id="contact">
	<div class="container">
		<div class="col-lg-12 col-md-12 col-sm-12 contact-w3-agile1">
			<h4>Connect With Us</h4>
			<p class="contact-agile1"><strong>Phone :</strong>+63 912 345 6789</p>
			<p class="contact-agile1"><strong>Email :</strong> <a href="mailto:keopi@gmail.com">keopi@gmail.com</a></p>
			<p class="contact-agile1"><strong>Address :</strong>1241 Jose Abad Santos Ave Gapan City, Central Luzon, 3105</p>

			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3848.3329811699614!2d120.93831531479803!3d15.304128889357553!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397204adc35a22f%3A0x211986c613371aa5!2s1241%20Jose%20Abad%20Santos%20Ave%2C%20Gapan%20City%2C%20Nueva%20Ecija!5e0!3m2!1sen!2sph!4v1650877973750!5m2!1sen!2sph"></iframe>
		</div>
		<div class="clearfix"></div>
	</div>
</section>
<!-- //end contact -->

<!--//start footer -->
<div class="copy">
    <p>?? 2022 Keopi Coffee Shop . All Rights Reserved | Brought To You by Tonga</a> </p>
</div>
<!--//end footer -->

<!-- js -->
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>

<!-- contact form -->
<script src="js/jqBootstrapValidation.js"></script>
<!-- //contact form -->

<!-- Calendar -->
		<script src="js/jquery-ui.js"></script>
		<script>
				$(function() {
				$( "#datepicker,#datepicker1,#datepicker2,#datepicker3" ).datepicker();
				});
		</script>
<!-- //Calendar -->

<!-- start-smoth-scrolling -->
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$(".scroll").click(function(event){
			event.preventDefault();
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
		});
	});
</script>
<!-- start-smoth-scrolling -->

<!-- //start flexSlider -->
				<script defer src="js/jquery.flexslider.js"></script>
				<script type="text/javascript">
				$(window).load(function(){
				  $('.flexslider').flexslider({
					animation: "slide",
					start: function(slider){
					  $('body').removeClass('loading');
					}
				  });
				});
			  </script>
<!-- //end flexSlider -->

<script src="js/responsiveslides.min.js"></script>
			<script>
						// You can also use "$(window).load(function() {"
						$(function () {
						  // Slideshow 4
						  $("#slider4").responsiveSlides({
							auto: true,
							pager:true,
							nav:false,
							speed: 500,
							namespace: "callbacks",
							before: function () {
							  $('.events').append("<li>before event fired.</li>");
							},
							after: function () {
							  $('.events').append("<li>after event fired.</li>");
							}
						  });

						});
			</script>
<!--search-bar-->
	<script src="js/main.js"></script>
<!--//search-bar-->

<!--tabs-->
<script src="js/easy-responsive-tabs.js"></script>

<script>
$(document).ready(function () {
$('#horizontalTab').easyResponsiveTabs({
type: 'default', //Types: default, vertical, accordion
width: 'auto', //auto or any width like 600px
fit: true,   // 100% fit in a container
closed: 'accordion', // Start closed if in accordion view
activate: function(event) { // Callback function if tab is switched
var $tab = $(this);
var $info = $('#tabInfo');
var $name = $('span', $info);
$name.text($tab.text());
$info.show();
}
});
$('#verticalTab').easyResponsiveTabs({
type: 'vertical',
width: 'auto',
fit: true
});
});
</script>
<!--//tabs-->

<!-- smooth scrolling -->
	<script type="text/javascript">
		$(document).ready(function() {
		/*
			var defaults = {
			containerID: 'toTop', // fading element id
			containerHoverID: 'toTopHover', // fading element hover id
			scrollSpeed: 1200,
			easingType: 'linear'
			};
		*/
		$().UItoTop({ easingType: 'easeOutQuart' });
		});
	</script>

	<div class="arr-w3ls">
	<a href="#home" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
	</div>
<!-- //smooth scrolling -->

<script type="text/javascript" src="js/bootstrap-3.1.1.min.js"></script>
</body>
</html>
