<?php
/**
 * Template Name: HPN Pages
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
						<a id="feature-<?php if ($feature_count ==3 ) { echo $feature_count ?>" href="<?php echo the_permalink(); ?>">
							<h2><?php the_title(); ?></h2>
							<?php the_content(); } else {
							?> " href="#"><?php
							
							}?>
						</a>
					<?php
					$feature_count ++; 
					endwhile;
				?>
			</div><!-- #features -->
			
			<section id="page-article">
				
				
				
					
					
					<?php the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>
				
				
				
			</section><!-- #recent-articles -->
			
			<section id="recent-reports">
				<?php
					// Create a custom WP_Query instance for our Custom Post Type, powered_by_tps_reports
					$args = array(
						'order' => 'DESC',
						'post_type' => 'pb_tps_reports',
					);
					$tps_reports = new WP_Query();
					$tps_reports->query( $args );
					
					$testcount = 1;
				?>
				<?php
				// Loop through our TPS Reports
				while ( $tps_reports->have_posts() ) : $tps_reports->the_post();
								 
				 ?>	
				<ul>
				<li><a href="<?php the_permalink(); ?>"><?php the_content(); ?></a></li>
				<?php 
				
				
				 endwhile;
				?>
				</ul>
				
				<!-- #older-reports -->
			</section><!-- #recent-reports -->
			
		</div><!-- #primary -->

<?php get_footer(); ?>