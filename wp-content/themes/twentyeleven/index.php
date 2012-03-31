<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 */

get_header(); ?>
			


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
						  	create_post($category_name);
						  	header('Location: ./' . $category_name);
						}
						else {
						  print_form();
						}
						
						// In this function we print the name the user provided.
						
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
			<div class="system_category_hentry_nodrag">
				<div class="system_innerstammp index_stammp">
					<div class="clickable_area">
					</div>
					<div class="stammp_form" style="margin: 20px 0 0 20px;">
				
						
				
					</div>
				</div>

			</div>
			
			<?php if ( have_posts() ) : ?>

				<?php twentyeleven_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>

				<?php endwhile; ?>

				

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<div class="stammp">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentyeleven' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
						
					</div><!-- .entry-content -->
					
					</div><!--stammp-->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_sidebar('quickbar'); ?>
<?php get_footer(); ?>