<!DOCTYPE html>
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes() ?>><![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8" <?php language_attributes() ?>><![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9" <?php language_attributes() ?>><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" <?php language_attributes() ?>><!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo( 'charset' ) ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width">
		<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
		<title><?php wp_title( '|', true, 'right' ) ?> Gevaco</title>
		<meta name="author" content="">
		<link rel="author" href="">
		<link rel="icon" type="png" href="<?php echo get_template_directory_uri(); ?>/images/icon.png" />
		<?php wp_head() ?>

    <noscript>
			<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/img.css" />
		</noscript>
		<!--[if lt IE 9]>
			<script src="<?php echo get_template_directory_uri(); ?>/js/vendor/html5shiv/dist/html5shiv.min.js"></script>
		<![endif]-->
		<link href='http://fonts.googleapis.com/css?family=Arvo:400,700,400italic|Open+Sans:300' rel='stylesheet' type='text/css'>

    </head>
    <?php
		if ( has_post_thumbnail()) {
			$img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
			$img_url = $img[0];
		} else {
			$img_url = get_template_directory_uri() . "/images/villa_gevaco_2.JPG";
		}
	?>
    <body <?php body_class() ?> itemscope itemtype="http://schema.org/WebPage" style="background-image:url(<?php echo $img_url; ?>);">
        <!--[if lt IE 8]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
			<header role="banner" class="main-header">
				<div class="mobile-trigger">
					<a href="javascript:;" class="trigger">
						Ontdek meer
					</a>
				</div>
				<div class="layout">
					<div class="nav-container">
						<nav role="navigation">
							<ul>
								<li class="mobile-logo"><a href="<?php home_url(); ?>/"><img src="<?php echo get_template_directory_uri(); ?>/images/gevaco_logo.png" alt="Logo Gevaco - bouwbedrijf"></a></li>
								<li><a href="<?php home_url(); ?>/over-ons"><span>Over ons</span><span class="sub">Onze visie</span></a></li>
								<li><a href="<?php home_url(); ?>/realisaties"><span>Realisaties</span><span class="sub">Afbeeldingen</span></a></li>
								<li class="desktop-logo"><a href="<?php home_url(); ?>/"><img src="<?php echo get_template_directory_uri(); ?>/images/gevaco_logo.png" alt="Logo Gevaco - bouwbedrijf"></a></li>
								<li><a href="<?php home_url(); ?>/vacature"><span>Vacatures</span><span class="sub">Soliciteren</span></a></li>
								<li><a href="<?php home_url(); ?>/contact"><span>Bedrijf</span><span class="sub">Info - contact</span></a></li>
							</ul>
						</nav>
						<a href="javascript:;" class="close">×</a>
					</div>
				</div>
			</header>