<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 * @since Twenty Eleven 1.0
 */
?>

<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<!-- GZIP Compression -->

<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link type="text/css" href="/wp-includes/css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="Stylesheet" />
<link type="text/css" rel="stylesheet" href="http://adamkochanowicz.com/clrwheel/js/chosen/chosen.css" />
<link href='http://fonts.googleapis.com/css?family=Rock+Salt' rel='stylesheet' type='text/css'>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>

</head>

<body <?php body_class(); ?>>

<div id="page" class="hfeed">


	<div id="main">
	
		<div id="primary">
			<div id="quickbar">
				<ul class="quickbarul">
					<a href="/"><div style="float:left;margin:5px 5px 0  0;"><img src="/wp-includes/images/pntiny.png" /></div></a>
					<li><a href="/">stammp</a></li>
					<li class="bartitle">featured</li>
					<li class="bartitle-extended"><a href="/trivia/">/trivia</a></li>
					<li class="bartitle-extended"><a href="/quotes/">/quotes</a></li>
					<li class="bartitle-extended"><a href="/radiohead/">/radiohead</a></li>
					<li class=""><strong><a href="/tricks">Tricks</a></strong></li>
					<div style="float:right;line-height:0;">
						<?php get_search_form(); ?>
					</div>
					
				<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('quickbar')) : ?>
				<?php endif; ?>	
			</div>