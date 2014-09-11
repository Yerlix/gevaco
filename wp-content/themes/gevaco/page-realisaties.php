<?php
/*
Template Name: Realisaties
*/
?>
<?php get_header(); ?>

<div class="container layout multi-section">
	<section>
		<?php get_sidebar('realisaties'); ?>
		<?php wp_reset_postdata(); ?>

		<article class="main content" itemprop="mainContentOfPage" itemscope itemtype="http://schema.org/WebPageElement">
			<header>
				<?php $page = get_page_by_path('realisaties'); ?>
				<h1><?php the_title() ?></h1>
			</header>
				<nav class="subnavigation">
	    	<!-- Ophalen van de categorieen -->
	      <?php
	        $args = array(
	            'post_type' => 'gallery',
	            'orderby' => 'menu_order',
	            'order' => 'asc',
	            'cat' => 9
	        );
	        $query = new WP_Query($args);
	    	?>
				<!-- Tonen van de categrorieen -->
				<?php if ($query->have_posts()) : ?>
					<ul>
					<?php while ($query->have_posts()) : $query->the_post() ?>
						<li><a href="<?php echo $post->guid; ?>"><?php the_title(); ?></a></li>
					<?php endwhile; ?>
					</ul>
				<?php endif; ?>
				 <?php wp_reset_postdata(); ?> 
				<?php get_template_part('loop', 'page'); ?>
			<footer>
			</footer>
		</article>
		</div>
	</section>
</div>
<?php get_footer(); ?>
