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
		 
		 	<div class="ab-w3l-spa" >
                           <h3 class="title-w3-agileits title-black-wthree">ABOUT OUR CAFE</h3>
					   <p class="about-para-w3ls">Our cafe offers a wide variety of coffee-based products, as well as non-coffee based products. We also offer other food & drink related items such as iced tea and lemonade, with the additions of sandwiches as well as dessert related items with pastries.</p>
		        </div>
				<br>
				<!-- Trigger the Modal -->
				<center>
					<img id="myImg" src="img/menu.png" alt="Keopi Menu" style="width:700%;max-width:500px">
				</center>
		 </div>
		</div>
			    

					<!-- The Modal -->
					<div id="myModal" class="modal">

					  <!-- The Close Button -->
					  <span class="close">&times;</span>

					  <!-- Modal Content (The Image) -->
					  <img class="modal-content" id="img01">

					  <!-- Modal Caption (Image Text) -->
					  <div id="caption"></div>
				</center>
					</div>
				

<script>			
// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}
</script>
		   	<!-- Container for the image gallery -->
		   	<div style="background: #935116; padding-top: 20px; padding-bottom: 20px;"  >
		   		<center><h2 style="color:white;">WHAT WE SELL</h2></center>
			<br>
				<div class="container">
				<center>
				  <!-- Full-width images with number text -->
				  <div class="mySlides">
					<div class="numbertext">1 / 4</div>
					  <img src="img/caramel.jpg" style="width:100%">
				  </div>

				  <div class="mySlides">
					<div class="numbertext">2 / 4</div>
					  <img src="img/chocolatechip.jpg" style="width:100%">
				  </div>

				  <div class="mySlides">
					<div class="numbertext">3 / 4</div>
					  <img src="img/eggbaconcheese.jpg" style="width:100%">
				  </div>

				  <div class="mySlides">
					<div class="numbertext">4 / 4</div>
					  <img src="img/strawberrymilk.jpg" style="width:100%">
				  </div>
				</center>

				  <!-- Next and previous buttons -->
				  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
				  <a class="next" onclick="plusSlides(1)">&#10095;</a>

				  <!-- Image text -->
				  <div class="caption-container" style="background: #FDF2E9;">
				  	<br>
					<p id="caption" style="color: black; padding-bottom: 0px;">Our Products</p>
				  </div>

				  <!-- Thumbnail images -->
				  <center>
				  <div class="row">
					<div class="column">
					  <img class="demo cursor" src="img/caramel.jpg" height="300" width="250" onclick="currentSlide(1)" alt="Caramel">
					</div>
					<div class="column">
					  <img class="demo cursor" src="img/chocolatechip.jpg" height="300" width="250" onclick="currentSlide(2)" alt="Chocolate Chip">
					</div>
					<div class="column">
					  <img class="demo cursor" src="img/eggbaconcheese.jpg" height="300" width="250" onclick="currentSlide(3)" alt="Egg Bacon Cheese">
					</div>
					<div class="column">
					  <img class="demo cursor" src="img/strawberrymilk.jpg" height="300" width="250" onclick="currentSlide(4)" alt="Strawberry Milk">
					</div>
				  </div>
				  </center>
				</div>
		   	</div>
			
<script>
let slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("demo");
  let captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>
    </div>
</div>
<!-- //end about -->

<!-- //start contact -->
<section class="contact-w3ls" id="contact">
	<div class="container">
		<div class="col-lg-6 col-md-6 col-sm-6 contact-w3-agile2" data-aos="flip-left">
			<div class="contact-agileits">
				<h4>Contact Us</h4>
				<p class="contact-agile2">Sign Up For Our Services</p>
				<form  method="post" name="sentMessage" id="contactForm" >
					<br><br>
					<div class="control-group form-group">

                            <label class="contact-p1">Full Name:</label>
                            <input type="text" class="form-control" name="name" id="name" required >
                            <p class="help-block"></p>

                    </div>
                    <div class="control-group form-group">

                            <label class="contact-p1">Phone Number:</label>
                            <input type="tel" class="form-control" name="phone" id="phone" required >
							<p class="help-block"></p>

                    </div>
                    <div class="control-group form-group">

                            <label class="contact-p1">Email Address:</label>
                            <input type="email" class="form-control" name="email" id="email" required >
							<p class="help-block"></p>

                    </div>


                    <input type="submit" name="sub" value="Send Now" class="btn btn-primary">

				</form>
				<?php
				if(isset($_POST['sub']))
				{
					$name =$_POST['name'];
					$phone = $_POST['phone'];
					$email = $_POST['email'];
					$approval = "Not Allowed";
					$sql = "INSERT INTO `contact`(`fullname`, `phoneno`, `email`,`cdate`,`approval`) VALUES ('$name','$phone','$email',now(),'$approval')" ;


					if(mysqli_query($con,$sql))
					echo"OK";

				}
				?>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 contact-w3-agile1" data-aos="flip-right">
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
    <p>© 2022 Keopi Coffee Shop . All Rights Reserved | Brought To You by Tonga</a> </p>
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
