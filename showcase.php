<?php
/**
 * Template Name: Home page
 *
 * A custom home page for the Powered By theme
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage Powered By
 */

get_header(); ?>

		<div id="primary">
			<div id="site-intro">
				<?php if ( ! dynamic_sidebar( 'sidebar-2' ) ) : ?>
				<p><?php bloginfo( 'description' ); ?></p>
				<?php endif; ?>
			</div><!-- #site-intro -->
			<div id="call-to-action"><a id="call-to-action-button" href="/?page_id=47"></a></div>
			<div id="features">
				<?php
					$args = array(
						'order' => 'ASC',
						'post_type' => 'page',
						'posts_per_page' => '3',
						'tax_query' => array(
								array(
									'taxonomy' => 'featured',
									'field' => 'slug',
									'terms' => 'featured'
								)
						),
					);
					$features = new WP_Query();
					$features->query( $args );
					$feature_count = 1;
					while ($features->have_posts()) : $features->the_post(); ?>
						<a id="feature-<?php echo $feature_count ?>" href="#">
							<h2><?php the_title(); ?></h2>
							<?php the_content(); ?>
						</a>
					<?php
					$feature_count ++; 
					endwhile;
				?>
			</div><!-- #features -->
			
			<section id="home-article">
				
				
				<?php
					$args = array(
						'order' => 'ASC',
						'post_type' => 'page',
						'posts_per_page' => '1',
						'tax_query' => array(
								array(
									'taxonomy' => 'homebody',
									'field' => 'slug',
									'terms' => 'homebody'
								)
						),
					);
					$mainarticle = new WP_Query();
					$mainarticle->query( $args );
					
					while ($mainarticle->have_posts()) : $mainarticle->the_post(); ?>
						
							
							<?php the_content(); ?>
						
					<?php
				
					endwhile;
				?>
				
			</section><!-- #recent-articles -->
			
			<section id="recent-reports">
				<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Home Page Intro Area')) : ?>
							
					<?php endif; ?>				
				<!-- #older-reports -->
			</section><!-- #recent-reports -->
			
		</div><!-- #primary -->

<?php get_footer(); ?>
