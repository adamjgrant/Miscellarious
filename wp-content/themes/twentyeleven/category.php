<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */

get_header(); ?>

		<section id="primary">

			<div id="content" role="main">
			
			<div id="newstack">
				<div id="newstack_x"></div>
				<?php
						// $_POST is a magic PHP variable that will always contain
						// any form data that was posted to this page.
						// We check here to see if the textfield called 'name' had
						// some data entered into it, if so we process it, if not we
						// output the form.
						if (isset($_POST['post_category'])) {
							$category_name_before = $_POST['post_category'];
							
							//parts of string to replace
							$replacethis = array(' ','<','\'');
							//what to replace them with
							$withthis = array('_','','');
							
							//the new title after the replacements
							$category_name = str_replace($replacethis, $withthis, $category_name_before);
							
							//$category_formatted_2 = str_replace("<","",$category_name);
							//$category_formatted_1 = str_replace("\'","",$category_2);
							//$category_formatted = str_replace(" ","_",$category_formatted_1);
						  	create_post_category($category_name);
						  	header('Location: ../' . $category_name);
						}
						else {
						  print_form();
						}
						
						// In this function we print the name the user provided.
						
						/*
function create_post($category_formatted) {
						  // $name should be validated and checked here depending on use.
						  // In this case we just HTML escape it so nothing nasty should
						  // be able to get through:
						  echo 'Saving entry to database...';
						
						// Insert the post into the database
						require_once('./wp-config.php');
						require_once('./wp-includes/wp-db.php');
						require_once('./wp-includes/taxonomy.php');
						require_once('./wp-admin/includes/taxonomy.php');
 						wp_create_category($category_formatted);
						  
						}
*/
						
						// This function is called when no name was sent to us over HTTP.
						function print_form() {
						  echo '
						  	<div id="indexheader">New Stack</div>
						    <form action="./" method="post" id="newpost">
								<input title="e.g. \'Recipes\'" type="text" name="post_category" id="post_stammp" />';
								
								
								echo '<div id="bottomfloat">
									<div id="littleright">
									<input type="submit" value="stammp" id="stammpbutton" /></div>
								</div>
							</form>
						  ';
						  
						}
						?>
			</div>
			
			<div class="system_hentry_nodrag">
				<div class="system_innerstammp index_stammp">
					<div class="clickable_area">
					</div>
					<div class="stammp_form" style="margin: 20px 0 0 20px;">
				
						
				
					</div>
				</div>

			</div>
			
			<div id="newstack_category">
				<div id="newstack_category_x"></div>
				<?php
					
					// $_POST is a magic PHP variable that will always contain
					// any form data that was posted to this page.
					// We check here to see if the textfield called 'name' had
					// some data entered into it, if so we process it, if not we
					// output the form.
					if (isset($_POST['post_title'])) {
						$title_before = $_POST['post_title'];
						
						$content_before = $_POST['post_content'];
						
												//parts of string to replace
						$replacethis = array(
							'->',
							'<-',
							'<', 
							'>', 
							'img:troll',
							'img:pokerface',
							'img:leanback',
							'img:foreveralone',
							'img:ruserious',
							'img:closeenough',
							'img:yuno',
							'img:okay',
							'img:allthethings',
							'img:dontevencare',
							'img:jackiechan',
							'arrow:right',
							'arrow:left',
							'|^',
							'|v'
						);
						//what to replace them with
						$withthis = array(
							'arrow:right',
							'arrow:left',
							'', 
							'',
							'<div title="img:troll" class="custom_image imgtroll"></div>',
							'<div title="img:pokerface" class="custom_image imgpokerface"></div>',
							'<div title="img:leanback" class="custom_image imgleanback"></div>',
							'<div title="img:foreveralone" class="custom_image imgforeveralone"></div>',
							'<div title="img:ruserious" class="custom_image imgruserious"></div>',
							'<div title="img:closeenough" class="custom_image imgcloseenough"></div>',
							'<div title="img:yuno" class="custom_image imgyuno"></div>',
							'<div title="img:okay" class="custom_image imgokay"></div>',
							'<div title="img:allthethings" class="custom_image imgallthethings"></div>',
							'<div title="img:dontevencare" class="custom_image imgdontevencare"></div>',
							'<div title="img:jackiechan" class="custom_image imgjackiechan"></div>',
							'<div class=\'arrow-right\'></div>',
							'<div class=\'arrow-left\'></div>',
							'<div class=\'arrow-up\'></div>',
							'<div class=\'arrow-down\'></div>'
						);
						
						//the new title after the replacements
						$content_1 = str_replace($replacethis, $withthis, $content_before);
						
						$category_id = get_query_var('cat');
						
						/* convert twitter @s and #s and create embeds for youtube links */
						$content = twitterify($content_1);
							if($content!=null) {
								/* Make a new post */
							  	create_post($content_before, $content, $category_id);
								header('Location: ./');
							}
					}
					else {
					  print_form_category();
					}
					
					/* Link Twitter hashtags and handles. */
					/* Also embeds youtube links */
					function twitterify($ret) {
					  $ret = preg_replace("#(^|[\n ])([\w]+?://[\w]+[^ \"\n\r\t< ]*)#", "\\1\[link removed\]", $ret);
					  $ret = preg_replace("#(^|[\n ])((www|ftp)\.[^ \"\t\n\r< ]*)#", "\\1\[link removed\]", $ret);
					  $ret = preg_replace("/@(\w+)/", "<a href=\"http://www.twitter.com/\\1\" target=\"_blank\">@\\1</a>", $ret);
					  $ret = preg_replace("/#(\w+)/", "<a href=\"http://search.twitter.com/search?q=\\1\" target=\"_blank\">#\\1</a>", $ret);
					  $ret = preg_replace('#(http://(www.)?youtube.com)?/(v/|watch\?v\=)([-|~_0-9A-Za-z]+)&?.*?#i','<iframe title="YouTube video player" width="130" height="120" src="http://www.youtube.com/embed/$4" frameborder="0" allowfullscreen></iframe>', $ret);
					return $ret;
					}
					
					
					// In this function we print the name the user provided.
					function create_post($title, $content, $category_id) {
					  // $name should be validated and checked here depending on use.
					  // In this case we just HTML escape it so nothing nasty should
					  // be able to get through:
					  echo 'Saving entry to database...';
					
					  // Create post object
 					 $my_post = array(
     				'post_title' => $title,
     				'post_content' => $content,
     				'post_status' => 'publish',
     				'post_author' => 1,
     				'post_category' => array($category_id)
  					);

					// Insert the post into the database
 					wp_insert_post( $my_post );
					  
					}
					
					function create_post_category($category_formatted) {
						  // $name should be validated and checked here depending on use.
						  // In this case we just HTML escape it so nothing nasty should
						  // be able to get through:
						  echo 'Saving entry to database...';
						
						// Insert the post into the database
						require_once('./wp-config.php');
						require_once('./wp-includes/wp-db.php');
						require_once('./wp-includes/taxonomy.php');
						require_once('./wp-admin/includes/taxonomy.php');
 						wp_create_category($category_formatted);
						  
					}
					
					// This function is called when no name was sent to us over HTTP.
					function print_form_category() {
					  echo '
					    <form action="./" method="post" id="newpost">
							<input style="display:none" title="Stammp title" type="text" name="post_title" id="post_title" />
							<textarea cols="20" rows="5" title="Express yourself" name="post_content" id="post_content" wrap="soft"></textarea>
							<div id="bottomfloat">
								<div id="littleright"><input type="submit" value="stammp" /></div>
							</div>
						</form>
					  ';
					}
					?>
			</div>
			<div class="system_hentry_nodrag">
				<div class="system_category_innerstammp category_stammp">
					<div class="clickable_category_area">
					</div>
					<div class="stammp_form" style="width:130px;margin-left: 20px;background:#F9F5BD;">
						
					</div>
				</div>
			</div>
			
			<!--div id="set"-->
			<?php $current_category = single_cat_title("", false); ?>

			<?php if ( have_posts() ) : ?>



				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>

				<?php endwhile; ?>
				<div id="set">
				

			<?php else : ?>
				<div id="set">
				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Start Stammping', 'twentyeleven' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'You are the first to suggest this stack! Make your first sticky with the form to the left.', 'twentyeleven' ); ?></p>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->
				</div>
			<?php endif; ?>

			</div><!-- #content -->
		</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
<script>
/* This has to stay here, otherwise, moving items on the front page will screw up z-index saves within categories. */
	$( "#set .stammp" ).draggable({ stack: "#set .stammp" });
</script>