<?php get_header(); ?>

<div class="container layout multi-section">
	<section>
		<?php get_sidebar('vacatures'); ?>
		<?php wp_reset_postdata(); ?>

		<article class="main content" itemprop="mainContentOfPage" itemscope itemtype="http://schema.org/WebPageElement">
			<header>
				<h1><?php the_title() ?></h1>
			</header>
				<?php the_content(); ?>
			<footer>
			</footer>
		</article>
		</div>
	</section>
	</div>

<?php get_footer(); ?>