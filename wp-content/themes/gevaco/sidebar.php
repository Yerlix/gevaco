<aside class="content sidebar">
	<?php
	if ( ! dynamic_sidebar( 'main-sidebar' ) ) :
		// $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
		$post_id = $post->ID;
		$url = get_permalink( $post_id );

		// Sidebar op de contactpagina
	

		// Sidebar op realisaties pagina
		if (strpos($url, 'realisaties') != false || strpos($url, 'gallery') != false){ ?>
			
		<?php
		}


		// Sidebar op de vacatures pagina
		if (strpos($url, 'vacature') != false){
			$page = get_page_by_path( "contact" );
			$id = $page->ID;

			$prefix = 'ge_';

			// ophalen gegevens maatschappelijke zetel
			$mz_name = rwmb_meta( $prefix . 'mz_name', 'type=text', $id);
			$mz_address = rwmb_meta( $prefix . 'mz_address', 'type=text', $id);
			$mz_town = rwmb_meta( $prefix . 'mz_town', 'type=text', $id);

			// Ophalen contact gegevens
			$ct_tel = rwmb_meta( $prefix . 'ct_tel', 'type=text', $id);
			$ct_fax = rwmb_meta( $prefix . 'ct_fax', 'type=text', $id);
			$ct_gsm = rwmb_meta( $prefix . 'ct_gsm', 'type=text', $id);
			$ct_gsmhouder = rwmb_meta( $prefix . 'ct_gsmhouder', 'type=text', $id);
			$ct_email = rwmb_meta( $prefix . 'ct_email', 'type=email', $id);

			// Tonen van de gegevens
			?>
			<h1>Spontaan solliciteren?</h1>
			<div class="side-mz">
				<div class="side-title">Maatschappelijke zetel</div>
				<div class="side-info"><?php echo $mz_name; ?></div>
				<div class="side-info"><?php echo $mz_address; ?></div>
				<div class="side-info"><?php echo $mz_town; ?></div>

				<div><span class="side-label">Tel:</span><span class="side-info"><?php echo $ct_tel; ?></span></div>
				<div><span class="side-label">Fax:</span><span class="side-info"><?php echo $ct_fax; ?></span></div>
				<div><span class="side-label">GSM:</span><span class="side-info"><?php echo $ct_gsm; ?></span><span>(<?php echo $ct_gsmhouder; ?>)</span></div>
				<div class="side-info"><?php echo $ct_email; ?></div>
			</div>

			<div class="divider">PLACEHOLDER DIVIDER</div>

			<!-- Tonen van de vacatures -->
			<div class="vacatures">
				<?php
	                $args = array(
	                    'post_type' => 'vacatures',
	                    'orderby' => 'title',
	                    'order' => 'ASC'
	                );
	                $myQuery = new WP_Query($args);

		            // controleren of er medewerkers ingegeven zijn
					if ($myQuery->have_posts()) : while ($myQuery->have_posts()) : $myQuery->the_post(); ?>
						 <a href="<?php echo the_permalink(); ?>"><?php the_title(); ?></a>
					<?php endwhile; else: ?>
		                <?php gal_part('novacatures'); ?>
		            <?php endif; ?>
			</div>
			<?php
		}
	?>
	<?php endif; ?>
</aside>
