<?php
/**
 * @package WordPress
 * @subpackage Powered By
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
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
		echo ' | ' . sprintf( __( 'Page %s', 'powered-by' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); 
	wp_enqueue_script('mort_calc', get_bloginfo('stylesheet_directory'). '/js/hpnmortgage.js');
?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php bloginfo( 'template_directory' ); ?>/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed">
	<div id="branding" role="banner">
			<hgroup>
				<h1 id="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><span id="logo-span"></span><?php bloginfo( 'name' ); ?></a><span id="trademark">&reg;</span></h1>
				
			
								<div id="phonenum"><div id="today-date"><?php echo date('l jS F Y'); ?></div><div id="num">  <?php
				_e( '08003 102 103', 'powered-by' );
				 ?></div><div id="email-banner"><a href="mailto:info@hpn-ltd.co.uk">info@hpn-ltd.co.uk</a></div></div>
				 <h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
			</hgroup>

			<nav id="access" role="navigation">
				<h1 class="section-heading"><?php _e( 'Main Menu', 'powered-by' ); ?></h1>
				<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'powered-by' ); ?>"><?php _e( 'Skip to content', 'powered-by' ); ?></a></div>

				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>

			</nav><!-- #access -->

			<?php if( has_nav_menu( 'secondary' ) ) : ?>
			<nav id="secondary-access" role="navigation">
				<h1 class="section-heading"><?php _e( 'Secondary Menu', 'powered-by' ); ?></h1>
				<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'powered-by' ); ?>"><?php _e( 'Skip to content', 'powered-by' ); ?></a></div>

				<?php wp_nav_menu( array( 'theme_location' => 'secondary' ) ); ?>
			</nav><!-- #access -->
			<?php endif; ?>
			
	</header><!-- #branding -->
	<?php if (is_front_page()){
	?>	
	<div id="slideshow">
		<?php  dgtheme_belowmenu();
		?>
	</div>
	<?php	
	} ?>

	<div id="main">