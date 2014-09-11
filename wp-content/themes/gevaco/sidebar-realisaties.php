<aside class="content sidebar">
  <!-- get page ID -->
  <?php
    $pages = get_pages(array(
      'meta_key' => '_wp_page_template',
      'meta_value' => 'page-realisaties.php'
    ));
    foreach($pages as $page){
      $pageID = $page->post_id;
    }
  ?>

	<?php $re_info = rwmb_meta( 'ge_re_info', 'type=textarea', $pageID); ?>
  <?php $re_nav_title = rwmb_meta( 'ge_re_nav_title', 'type=text', $pageID); ?>
	<?php $re_notfound = rwmb_meta( 'ge_re_notfound', 'type=text', $pageID); ?>
	<div class="wrapper">
		<h2><?php echo $re_nav_title; ?></h2>
  	<div class="intro"><?php echo $re_info; ?></div>
	</div>
  <nav class="subnavigation">
    	<!-- Ophalen van de categorieen -->
      <?php
        $args = array(
            'post_type' => 'gallery',
            'orderby' => 'menu_order',
            'order' => 'asc',
            'category__not_in' => array(9)
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
    	<?php else : ?>
        <p>
          <?php
            if(!empty($re_notfound)){
              echo $re_notfound;
            } else {
              echo 'Er zijn geen realisaties gevonden.';
            }
          ?>
        </p>
      <?php endif; ?>
	</nav>
</aside>