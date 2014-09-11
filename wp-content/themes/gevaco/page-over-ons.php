<?php
/*
Template Name: Over ons
*/
?>


<?php get_header(); ?>
<!-- <div id="page-content"> -->
	<?php //get_template_part('loop', 'page'); ?>
<!-- </div> -->

<div class="container layout single-section">
	<section class="content">
		<div class="content-wrapper">
			<div class="side-img" itemprop="primaryImageOfPage" itemscope itemtype="http://schema.org/ImageObject">
			<?php
			// afbeelding ophalen en weergeven. Slechts eerste afbeelding wordt getoond
				$prefix = 'ge_';
				$images = rwmb_meta( $prefix . 'side_img', 'type=image' );
				$array_keys = array_keys($images);
				$imgid = reset($array_keys);
			    echo "<img src='{$images[$imgid]['full_url']}' alt='{$images[$imgid]['alt']}' />";
			?>
				<!-- <img src="<?php echo get_template_directory_uri(); ?>/images/villa_gevaco_1.JPG" alt="Villa Gevaco" itemprop="contentURL"> -->
			</div>
			<article itemprop="mainContentOfPage" itemscope itemtype="http://schema.org/WebPageElement">
				<header>
						<h1><?php the_title(); ?></h1>
				</header>
				<?php get_template_part('loop', 'page'); ?>
			</article>
		</div>
	</section>
</div>
<?php get_footer(); ?>
