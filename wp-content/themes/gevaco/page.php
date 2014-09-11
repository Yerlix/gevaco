<?php
/*
Template Name: Home
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
				<footer>
					<?php
						$title = rwmb_meta( $prefix . 'title', 'type=text', get_the_ID() );
						$name = rwmb_meta( $prefix . 'name', 'type=text', get_the_ID() );
						$function = rwmb_meta( $prefix . 'function', 'type=text', get_the_ID() );
						if(isset($name)){
							echo '<hr><div itemprop="author" itemscope itemtype="http://schema.org/Person" class="person"><span itemprop="jobTitle" content="ingenieur">'. $title . '</span> <span class="name"><span itemprop="givenName">' . $name[0] . '</span> <span itemprop="familyName">' . $name[1] . '</span></span>	<span class="function" itemprop="jobTitle">' . $function . '</span></div>';
						}
					?>
					<!-- <div itemprop="author" itemscope itemtype="http://schema.org/Person" class="person"><span itemprop="jobTitle" content="ingenieur">ing.</span> <span class="name"><span itemprop="givenName">Philip</span> <span itemprop="familyName">Geypen</span></span>	<span class="function" itemprop="jobTitle">Zaakvoerder</span></div> -->
				</footer>
			</article>
		</div>
	</section>
</div>
<?php get_footer(); ?>
