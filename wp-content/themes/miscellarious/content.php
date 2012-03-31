<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>
<div id="set"><!-- Controls the z-index from jqui -->
	<?php
		$this_category_id = get_query_var('cat');
		foreach(get_the_category() as $category){ $category_id = $category->cat_ID; }

		$thisID = $id;
		
		/* TODO: The whole process is slow because the db call happens before page load. Get the variables later via js and apply to containers using js loop */
		
		//Retrieve x and y coordinates
		
		$posx = get_post_meta($post->ID, 'x_coord', true);
		$posy = get_post_meta($post->ID, 'y_coord', true);
		$zIndex = get_post_meta($post->ID, 'zIndex', true);
		
		$color = array("red", "blue", "green", "yellow", "purple", "red", "blue", "green", "yellow", "purple");
		
		//assign color by category ID's modulus value
		$idModulus = ($category_id % 10);
		$backgroundColor = $color[$idModulus];
		
	if ($posx!=null && $this_category_id != null): ?>
		<article id="post-<?php the_ID(); ?>" class="stammp" style="top:<?php echo($posy)?>px;left:<?php 
		echo($posx)?>px;float:none;position:absolute;z-index:<?php echo($zIndex)?>;">
	<?php else : ?>
		<article id="post-<?php the_ID(); ?>" class="stammp">
	<?php endif; ?>
	
		<div class="innerstammp <?php echo($backgroundColor)?>stammp">
		
		<header class="entry-header">
			

			<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php twentyeleven_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>

			<?php if ( comments_open() && ! post_password_required() ) : ?>
			<!--
<div class="comments-link">
				<?php comments_popup_link( '<span class="leave-reply">' . __( '', 'twentyeleven' ) . '</span>', _x( '1', 'comments number', 'twentyeleven' ), _x( '%', 'comments number', 'twentyeleven' ) ); ?>
			</div>
-->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<?php if ( is_search() ) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentyeleven' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<?php endif; ?>

		<footer class="footer-meta">
			<?php $show_sep = false; ?>
			<?php if ( is_sticky() ) : ?>
				<div class="littleleft"><h3 class="entry-format"><?php _e( 'Sponsored', 'twentyeleven' ); ?></h3></div>
			<?php endif; ?>
			<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'twentyeleven' ) );
				if ( $categories_list ):
			?>
			<span class="cat-links">
<?php printf( __( '<span class="%1$s"></span> %2$s', 'twentyeleven' ), 'entry-utility-prep entry-utility-prep-cat-links', $categories_list );
				$show_sep = true; ?>
			</span>
			<?php endif; // End if categories ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'twentyeleven' ) );
				if ( $tags_list ):
				if ( $show_sep ) : ?>
			<span class="sep"> | </span>
				<?php endif; // End if $show_sep ?>
			<span class="tag-links">
				<?php printf( __( '<span class="%1$s">Tagged</span> %2$s', 'twentyeleven' ), 'entry-utility-prep entry-utility-prep-tag-links', $tags_list );
				$show_sep = true; ?>
			</span>
			<?php endif; // End if $tags_list ?>
			<?php endif; // End if 'post' == get_post_type() ?>

<!--Disabling comments permanently.
			<?php if ( comments_open() ) : ?>
			<?php if ( $show_sep ) : ?>
			<span class="sep"> | </span>
			<?php endif; // End if $show_sep ?>
			<span class="comments-link"><?php comments_popup_link( '<span class="leave-reply">' . __( 'C', 'twentyeleven' ) . '</span>', __( '<b>1</b>', 'twentyeleven' ), __( '<b>%</b> Replies', 'twentyeleven' ) ); ?></span>
			<?php endif; // End if comments_open() ?>
-->

			<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- #entry-meta -->
		</div><!--innerstammp-->
	</article><!-- #post-<?php the_ID(); ?> -->
</div>