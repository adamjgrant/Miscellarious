<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

<!--
	</div>
	<?php $current_category = single_cat_title("", false); ?>
	<div id="bg_url">
		<?php if ($current_category ==null)
			echo('<a href="/"><div><span class="biglogo">stammp</span></div></a>');
		else
			echo("/" . $current_category)
		?>
	</div>
-->
	
	<footer id="colophon" role="contentinfo">
	<div id="credits"><?php twentyeleven_content_nav( 'nav-below' ); ?><a href="http://clrwheel.com/">clrwheel</a></div>
	

			<?php
				/* A sidebar in the footer? Yep. You can can customize
				 * your footer with three columns of widgets.
				 */
				get_sidebar( 'footer' );
			?>

	</footer><!-- #colophon -->
	
</div><!-- #page -->


	<script type="text/javascript" src="/wp-includes/js/jquery/jquery-1.6.2.min.js"></script>
	<script type="text/javascript" src="/wp-includes/js/jquery/jquery-labelify.js"></script>
	<script type="text/javascript" src="/wp-includes/js/jquery/jquery-ui-1.8.16.custom.min.js"></script>

	<script>
	$(document).ready(function(){
	$("#newstack").hide();
	$("#newstack_category").hide();
	
  $(".clickable_area").click(function(){
    $("#newstack").fadeIn('fast', function() {});
    $("#post_stammp").focus();
    $(".system_innerstammp").fadeOut('fast', function() {});
    
   });
   
   $("#newstack_x").click(function(){
    $("#newstack").fadeOut('slow', function() {});
    $(".system_innerstammp").fadeIn('slow', function() {});
   });
   
  $(".clickable_category_area").click(function(){
    $("#newstack_category").fadeIn('fast', function() {});
    $("#post_content").focus();
    $(".system_category_innerstammp").fadeOut('fast', function() {});
    
   });
   
   $("#newstack_category_x").click(function(){
    $("#newstack_category").fadeOut('slow', function() {});
    $(".system_category_innerstammp").fadeIn('slow', function() {});
   });
	
/*
		$(".system_hentry_nodrag").click(function(){
	    	$(".system_hentry_nodrag").animate({width:"500px"});
	 	});
*/
 	});
 	</script>

	<?php 
	$category_id = get_query_var('cat');
	if ($category_id != null): ?>
	<script>
	$(document).ready(function(){
	
	$.extend($.support, {
        touch: "ontouchend" in document
		});
		
		//
		// Hook up touch events
		//
		$.fn.addTouch = function() {
		        if ($.support.touch) {
		                this.each(function(i,el){
		                        el.addEventListener("touchstart", iPadTouchHandler, false);
		                        el.addEventListener("touchmove", iPadTouchHandler, false);
		                        el.addEventListener("touchend", iPadTouchHandler, false);
		                        el.addEventListener("touchcancel", iPadTouchHandler, false);
		                });
		        }
		};
		
		var lastTap = null;  
		$("#state").html('<div class="success">LOADING</div>').hide().fadeIn(500);
 		$(":text").labelify();
 		$( ".stammp" ).draggable({ 
			snap: true, 
			snap: ".hentry_nodrag, .stammp, #set",
			connectToSortable: "#set",
		}).mousemove(function(){
						var coord = $(this).position();
						var postid = $(this).attr('id');
						var postZIndex = $(this).css("zIndex");
						var formattedId = postid.substring(5, postid.length);  
		 }).mouseup(function(){ 
		 		
		 		/* create coordinate array */
				var coords=[];
				/* set the coordinates equal to the div just moved */
				var coord = $(this).position();
				/* get the z-index of the div */
				var postZIndex = $(this).css("zIndex");
				/* get the id of the div */
				var postid = $(this).attr('id');
				var formattedId = postid.substring(5, postid.length);
				var item={ coordTop:  coord.top, coordLeft: coord.left, coordId: formattedId, postZIndex: postZIndex };
			   	coords.push(item);
				var order = { coords: coords };
				$.post('/updatecoords.php', 'data='+$.toJSON(order), function(response){
						if(response == "success") {
							$("#state").html('<div class="success">saved</div>').hide().fadeIn(1000);
							setTimeout(function(){ $('#state').fadeOut(1000); }, 2000); }
						else if (response == "fail") {
							$("#state").html('<div class="success">Could not get data</div>').hide().fadeIn(1000);
							setTimeout(function(){ $('#state').fadeOut(1000); }, 2000); } 
						else {
							$("#state").html('<div class="success">unknown error</div>').hide().fadeIn(1000);
							setTimeout(function(){ $('#state').fadeOut(1000); }, 2000); }
						});	
				}).addTouch();
				});
		
		</script>
		
		<?php else: ?>
		<script>
		$(document).ready(function(){
 		$(":text").labelify();
 		$( ".stammp" ).draggable({ 
			snap: true, 
			snap: ".hentry_nodrag, .stammp, #set",
			connectToSortable: "#set",
		})
			});
		</script>
		<?php endif; ?>
		
   		<script> 
		$( "#newstack" ).draggable({ });
		
		
		/* Document has been loaded */
		setTimeout(function(){ $('#state').fadeOut(1000); }, 1);
		
	</script>
	
	<script type="text/javascript">
  	var _gaq = _gaq || [];
  	_gaq.push(['_setAccount', 'UA-1315296-17']);
  	_gaq.push(['_trackPageview']);
  	
  	(function() {
  	  var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
  	  ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
  	  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  	})();
	</script>
	
	<script type="text/javascript" src="/wp-includes/js/jquery/jquery.json-2.3.min.js"></script>
	<script type="text/javascript" src="/wp-includes/js/jquery/jquery.ui.ipad.altfix.js"></script>
	<script type="text/javascript" src="/wp-includes/js/jquery/jquery.ui.touch.js"></script>
	
<?php wp_footer(); ?>

</body>
</html>