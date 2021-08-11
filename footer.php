<?php
/**
 * @package WordPress
 * @subpackage Powered By
 */
?>

	</div><!-- #main -->

	<footer id="colophon" role="contentinfo">
		<div id="footer-columns">
			<div class="foot-col" id="foot-col1">
			<?php
					$args = array(
						'order' => 'ASC',
						'post_type' => 'page',
						'posts_per_page' => '2',
						'tax_query' => array(
								array(
									'taxonomy' => 'footerone',
									'field' => 'slug',
									'terms' => 'footerone'
								)
						),
					);
					$mainarticle = new WP_Query();
					$mainarticle->query( $args );
					
					while ($mainarticle->have_posts()) : $mainarticle->the_post(); ?>
						<a id="main-article" href="<?php the_permalink(); ?>">
							<h2><?php the_title(); ?></h2>
							<?php the_content(); ?>
						</a>
					<?php
				
					endwhile;
				?>
			</div>
			<div class="foot-col" id="foot-col2">
			<h2>Social Media</h2>
			<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Left')) : ?>
							
					<?php endif; ?>
				

				</div>
			<div class="foot-col" id="foot-col3">
				
				
				<?php
					$args = array(
						'order' => 'DESC',
						'posts_per_page' => 1,
						'tax_query' => array(
							array (
								'taxonomy' => 'post_format',
								'terms' => array( 'post-format-aside', 'post-format-image' ),
								'field' => 'slug',
								'operator' => 'NOT IN',
							),
						),
					);
					$recent_articles = new WP_Query();
					$recent_articles->query( $args );
					
					while ($recent_articles->have_posts()) : $recent_articles->the_post(); ?>
						
						<a id="main-article" href="<?php the_permalink(); ?>">
							<h2><?php the_title(); ?></h2>
							<?php the_excerpt(); ?>
						</a>

					
					<?php endwhile;
				?>
				
				<nav id="older-articles">
					<a href="<?php echo home_url( '/' ); ?>blog/">More from our blog &rarr;</a>
				</nav><!-- #older-reports -->
			<!-- #recent-articles --></div>
		</div>
	<div id="copyright-container">	
		<div id="copyright">© 2011 House Price Negotiators</div>
	</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
