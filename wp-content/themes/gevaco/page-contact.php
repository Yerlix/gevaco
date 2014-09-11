<?php
/*
Template Name: Contact
*/
?>

<?php get_header(); ?>
<!-- <div id="page-content"> -->
	<?php
		$prefix = 'ge_';
		$pretitle = rwmb_meta( $prefix . 'pretitle', 'type=text');
		$subtitle = rwmb_meta( $prefix . 'side_subtitle', 'type=text');
		$title_class = '';
		if(!empty($subtitle)){
			$title_class = "has-subtitle";
		}
	?>

<div class="container layout multi-section">
	<section>
		<article class="main content contact-form" itemprop="mainContentOfPage" itemscope itemtype="http://schema.org/WebPageElement">
			<header>
				<hgroup>
					<h4 class="subtitle"><?php echo $subtitle; ?></h4>
					<h1 class="<?php echo $title_class; ?>"><?php the_title(); ?></h1>
				</hgroup>
			</header>
				<?php get_template_part('loop', 'page'); ?>
				<?php echo do_shortcode( '[contact-form-7 id="23" title="Contactformulier"]' ); ?>
		</article>
		<?php get_sidebar('contact'); ?>
	</section>
</div>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>
