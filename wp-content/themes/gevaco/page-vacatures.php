<?php
/*
Template Name: Vacatures
*/
?>

<?php get_header(); ?>
	<div class="container layout multi-section">
		<section>

			<article class="main content" itemprop="mainContentOfPage" itemscope itemtype="http://schema.org/WebPageElement">
				<header>
					<h1><?php the_title() ?></h1>
				</header>
					<nav class="subnavigation">
				    	<!-- Ophalen van de categorieen -->
				      <?php
				        $args = array(
				            'post_type' => 'vacatures'
				        );
				        $query = new WP_Query($args);
				    	?>
							<!-- Tonen van de categrorieen -->
							<?php if ($query->have_posts()){?>
								<ul>
								<?php while ($query->have_posts()) : $query->the_post() ?>
									<li><a href="<?php echo $post->guid; ?>"><?php the_title(); ?></a></li>
								<?php endwhile; ?>
								</ul>
				    	<?php }else{ ?>
					    		<p>
					          <?php
					            if(!empty($va_notfound)){
					              echo $va_notfound;
					            } else {
					              echo 'Er zijn momenteel geen vacatures.';
					            }
					          ?>
					        </p>
				    	<?php } ?>
					</nav>
					<?php get_template_part('loop', 'page'); ?>
				<footer>
				</footer>
			</article>
		<?php get_sidebar('vacatures'); ?>
		<?php wp_reset_postdata(); ?>
		</section>
	</div>

<?php get_footer(); ?>