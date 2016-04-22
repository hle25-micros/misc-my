<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package ThemeGrill
 * @subpackage Himalayas
 * @since Himalayas 1.0
 */
?>

<?php get_header(); ?>


	<div id="content" class="site-content">
		<main id="main" class="clearfix">
			<div class="tg-container">
				<div id="primary" class="content-area">

					<?php if ( have_posts() ) : ?>
						<div class="section-title-wrapper">
							<h2 class="main-title"><?php echo 'Search Results'; ?></h2>
						</div>
						<!-- .page-header -->

						<?php while ( have_posts() ) : the_post(); ?>

							<?php 
								$title = get_the_title(); 
								$keys= explode(" ",$s); 
								$title = preg_replace('/('.implode('|', $keys) .')/iu', '<strong class="search-excerpt">\0</strong>', $title); 
							?>
							<div class="title-block_2">
								<h6><a href="<?php the_permalink(); ?>"><?php echo $title; ?></a></h6>
							</div>
							<div class="description-block_2">
								<span class="date_post"><?php the_time('F j, Y') ?></span> <br>
							<?php 
							$excerpt = get_the_excerpt(); 
								$keys= explode(" ",$s); 
								$excerpt = preg_replace('/('.implode('|', $keys) .')/iu', '<strong class="search-excerpt">\0</strong>', $excerpt);
								echo $excerpt;
								 ?>
							</div>
							<hr/>
						<?php endwhile; ?>

						<?php get_template_part( 'navigation', 'search' ); ?>

					<?php else : ?>
					
						<?php get_template_part( 'no-results', 'search' ); ?>

					<?php endif; ?>

				</div><!-- #primary -->
			</div>
		</main>
	</div>


<?php get_footer(); ?>