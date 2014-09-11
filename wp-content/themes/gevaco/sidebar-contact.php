<?php
	// $post_id = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'] ;
	$post_id = $post->ID;
	$prefix = 'ge_';

	// ophalen titel
	$title = rwmb_meta( $prefix . 'side_title', 'type=text');

	// ophalen gegevens maatschappelijke zetel
	$mz_title = rwmb_meta( $prefix . 'mz_title', 'type=text');
	$mz_name = rwmb_meta( $prefix . 'mz_name', 'type=text');
	$mz_address = rwmb_meta( $prefix . 'mz_address', 'type=text');
	$mz_town = rwmb_meta( $prefix . 'mz_town', 'type=text');

	// Ophalen google maps (juiste methode nog zoeken)
	$map_extra = rwmb_meta( $prefix . 'map_extra', 'type=text');
	$args = array(
	    'type'         => 'map',
	    'width'        => '100%', // Map width, default is 640px
	    'height'       => '250px', // Map height, default is 480px
	    'zoom'         => 10,  // Map zoom, default is the value set in admin, and if it's omitted - 14
	    'marker'       => true, // Display marker? Default is 'true',
	    'marker_title' => '', // Marker title when hover
	    'marker_settings' => array(					  // Use your own marker for maps
		    	'url'	=> get_template_directory_uri() . '/images/marker_gevaco.png', // Give an image for the marker
		    	// 'url'	=> get_template_directory_uri() . '/images/icon.png', // Give an image for the marker
		    	'size'	=> '42.75,60'
	    	),
	    'info_window'  => $map_extra, // Info window content, can be anything. HTML allowed.
	);
	$map = rwmb_meta( 'loc', $args ); // For current post

	// Ophalen contact gegevens
	$ct_tel = rwmb_meta( $prefix . 'ct_tel', 'type=text');
	$ct_fax = rwmb_meta( $prefix . 'ct_fax', 'type=text');
	$ct_gsm = rwmb_meta( $prefix . 'ct_gsm', 'type=text');
	$ct_gsmhouder = rwmb_meta( $prefix . 'ct_gsmhouder', 'type=text');
	$ct_email = rwmb_meta( $prefix . 'ct_email', 'type=email');

	// Ophalen magazijn gegevens
	$ma_title = rwmb_meta( $prefix . 'ma_title', 'type=text');
	$ma_address = rwmb_meta( $prefix . 'ma_address', 'type=text');

	// Ophalen overige gegevens
	$ov_title = rwmb_meta( $prefix . 'ov_title', 'type=text');
	$ov_btw = rwmb_meta( $prefix . 'ov_btw', 'type=text');
	$ov_rsz = rwmb_meta( $prefix . 'ov_rsz', 'type=text');
	$ov_reg = rwmb_meta( $prefix . 'ov_reg', 'type=text');
	$ov_bank = rwmb_meta( $prefix . 'ov_bank', 'type=text');
	$ov_bic = rwmb_meta( $prefix . 'ov_bic', 'type=text');
	$ov_iban = rwmb_meta( $prefix . 'ov_iban', 'type=text');

	// Tonen van de gegevens
	?>
<aside class="content sidebar contact-info" itemscope itemtype="http://schema.org/GeneralContractor">
	<div class="wrapper">
		<h2><?php echo $title; ?></h2>
	</div>
	<div class="wrapper" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
		<h3><?php echo $mz_title; ?></h3>
		<div><?php echo $mz_name; ?></div>
		<div itemprop="streetAddress"><?php echo $mz_address; ?></div>
		<div itemprop="addressLocality"><?php echo $mz_town; ?></div>
	</div>
	<div class="google-map"><?php echo $map; ?></div>
	<div class="wrapper">
		<dl>
			<!-- phone -->
			<dt>Tel:</dt>
			<dd itemprop="telephone"><?php echo $ct_tel; ?></dd>
			<!-- fax -->
			<dt>Fax:</dt>
			<dd itemprop="faxnumber"><?php echo $ct_fax; ?></dd>
			<!-- GSM -->
			<dt>GSM:</dt>
			<dd itemprop="telephone"><?php echo $ct_gsm; ?></dd>
			<!-- email -->
			<dt class="visually-hidden">Email:</dt>
			<dd class="wide"><a href="mailto:<?php echo $ct_email; ?>" itemprop="email"><?php echo $ct_email; ?></a></dd>
		</dl>
		<!-- <div><span class="side-label">Tel:</span><span itemprop="telephone"><?php echo $ct_tel; ?></span></div>
		<div><span class="side-label">Fax:</span><span itemprop="faxNumber"><?php echo $ct_fax; ?></span></div>
		<div><span class="side-label">GSM:</span><span itemprop="telephone"><?php echo $ct_gsm; ?></span><span>(<?php echo $ct_gsmhouder; ?>)</span></div>
		<div class="side-info"><?php echo $ct_email; ?></div> -->
	</div>

	<div class="wrapper">
		<h3><?php echo $ma_title; ?></h3>
		<div class="side-info"><?php echo $ma_address; ?></div>
	</div>

	<div class="wrapper field-fiscal-data">
		<h3><?php echo $ov_title; ?></h3>
		<dl>
			<!-- BTW -->
			<dt>BTW:</dt>
			<dd><?php echo $ov_btw; ?></dd>
			<!-- BTW -->
			<!-- <dt>Reg.:</dt>
			<dd><?php echo $ov_reg; ?></dd> -->
		</dl>
		<!-- <div><span class="side-label">BTW:</span><span class="side-info"><?php echo $ov_btw; ?></span></div> -->
		<!-- <div><span class="side-label">RSZ:</span><span class="side-info"><?php echo $ov_rsz; ?></span></div> -->
		<!-- <div><span class="side-label">Reg. Nr.:</span><span class="side-info"><?php echo $ov_reg; ?></span></div> -->
		<!-- <div><span class="side-label">Bank:</span><span class="side-info"><?php echo $ov_bank; ?></span></div> -->
		<!-- <div><span class="side-label">BIC:</span><span class="side-info"><?php echo $ov_bic; ?></span></div> -->
		<!-- <div><span class="side-label">IBAN:</span><span class="side-info"><?php echo $ov_iban; ?></span></div> -->
	</div>
</aside>