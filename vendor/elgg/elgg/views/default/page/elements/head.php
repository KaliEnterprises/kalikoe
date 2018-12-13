<?php
/**
 * The HTML head
 *
 * @internal It's dangerous to alter this view.
 * 
 * @uses $vars['title'] The page title
 * @uses $vars['metas'] Array of meta elements
 * @uses $vars['links'] Array of links
 */

$metas = elgg_extract('metas', $vars, array());
$links = elgg_extract('links', $vars, array());

echo elgg_format_element('title', array(), $vars['title'], array('encode_text' => true));
foreach ($metas as $attributes) {
	echo elgg_format_element('meta', $attributes);
}
foreach ($links as $attributes) {
	echo elgg_format_element('link', $attributes);
}

$stylesheets = elgg_get_loaded_css();

foreach ($stylesheets as $url) {
	echo elgg_format_element('link', array('rel' => 'stylesheet', 'href' => $url));
}

// A non-empty script *must* come below the CSS links, otherwise Firefox will exhibit FOUC
// See https://github.com/Elgg/Elgg/issues/8328
?>
<script>
	<?php // Do not convert this to a regular function declaration. It gets redefined later. ?>
	require = function () {
		// handled in the view "elgg.js"
		_require_queue.push(arguments);
	};
	_require_queue = [];

	
</script>

  <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
  <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <script type="text/javascript" src="slick/slick.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>




<?php
if (elgg_is_logged_in()) {
?>

<div class="load_slider_active">
<div class="first_load_slider main_activity" style="display:none";>
<div class="w3-content">
  <div class="mySlides">
  <img  src="/mod/custom_index/image/slide1.png" style="width:100%">
  <a class="next" onclick="plusSlides(1)">Next</a>
  <h4>Welcome to Kalikoe</h4>
  <p>Home of the social media tournaments.
  </div>
  <div class="mySlides">
  <img  src="/mod/custom_index/image/slide2.png" style="width:100%">
  <a class="next" onclick="plusSlides(1)">Next</a>
    <h4>Earn money every day</h4>
  <p>You can now earn digital money whenever you watch, comment, or like your favorite videos. </p>
  </div>
  <div class="mySlides">
  <img src="/mod/custom_index/image/slide3.png" style="width:100%">
  <a class="next" onclick="plusSlides(1)">Next</a>
   <h4>Win Badges and Trophies</h4>
  <p>If you create videos you can earn digital money and badges that will unlock rewards.</p>
  </div>
  <div class="mySlides">
  <img  src="/mod/custom_index/image/slide4.png" style="width:100%">
  <a class="next" onclick="plusSlides(1)">Next</a>
  <h4>Check the leaderboard</h4>
 <p>Every 24 hours the top 5 creators will win a virtual trophy and bonus KSD coins.
</p>


</div>
<div class="mySlides">
<img  src="/mod/custom_index/image/slide5.png" style="width:100%">
 <a class="next" onclick="plusSlides(1)">Next</a>
<h4>How to spend KSD</h4>
  <p>KSD (Kalikoe Dollars) are used to play games, use premium services, or exchange for local cash.</p>
</div>
<div class="mySlides">
<p class="skipBtn" type="button">Finish</p>
<h4>Open menu to see other pages</h4>
  <p>To open the menu bar to see other pages,Please click on finish button</p>
</div>

</div>

</div>
</div>
<?php
}
?>
  <script>
          $('.skipBtn').click(function() 
          {
            $('.first_load_slider').hide();
          });

             $(document).ready(function() 
              {
               $( "html" ).removeClass( "load_slider_active" );
               $('.first_load_slider').hide();
              if(window.location.href.indexOf("videos/all") > -1) 
              {
              $('.first_load_slider').css("display", "block");
              }
});
   
   $(document).ready(function() {
    var dialogShown = $.cookie('dialogShown');

    if (!dialogShown) {
        $(window).load(function(){
            $( ".first_load_slider" ).dialog();
            $.cookie('dialogShown', 1);
        });
    }
    else {
        $(".first_load_slide").hide();
    }
});


   /* slider code */
             var slideIndex = 1;
             showSlides(slideIndex);

             function plusSlides(n) {
               showSlides(slideIndex += n);
             }

             function currentSlide(n) {
               showSlides(slideIndex = n);
             }

              function showSlides(n) 
              {
                   var i;
                   var slides = document.getElementsByClassName("mySlides");

                   if (n > slides.length) {slideIndex = 1}    
                   if (n < 1) {slideIndex = slides.length}
                   for (i = 0; i < slides.length; i++) 
                    {
                       slides[i].style.display = "none";  
                    }
 
                    slides[slideIndex-1].style.display = "block";  
 
              }
    /*---slider code end */
</script>

<style type="text/css">
  .first_load_slider {
    position: fixed;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    z-index: 99999;
    background: rgba(0,0,0,0.65);
    overflow: auto;
}
.w3-content {
    max-width: 700px;
    min-width: 300px;
    left: 0;
    right: 0;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);  
    padding: 30px;
    background-color: #fff;
    margin: 0 auto;
    border-radius: 6px;
}
.w3-content a {
    float: right;
    padding: 0.25em 0.5em;
    font-weight: bold;
    right: inherit;
    left: inherit;
    display: block;
    max-width: max-content;
}
html.load_slider_active {
    overflow: hidden;
}
.w3-content img {
  max-width: 400px;
  display: block;
  margin: 0 auto;
  margin-bottom: 15px;
}
.w3-content h4{
  font-weight: bold;
}
.w3-content p{
  font-size:15px;
}

.skipBtn {
    float: right;
    position: relative;
    border: 0;
    padding: 0.25em 0.5em;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    color: #0398e2;
    
}
.skipBtn:hover {
  color: #4a4a4a;
}
.slick-arrow.slick-disabled {
  display: none !important;
}

</style>

