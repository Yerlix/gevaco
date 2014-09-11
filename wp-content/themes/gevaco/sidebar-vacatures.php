<!-- Get page ID -->
<?php
  $pages = get_pages(array(
    'meta_key' => '_wp_page_template',
    'meta_value' => 'page-vacatures.php'
  ));
  foreach($pages as $page){
    $vacaturespageID = $page->post_id;
  }

  $pages = get_pages(array(
    'meta_key' => '_wp_page_template',
    'meta_value' => 'page-contact.php'
  ));
  foreach($pages as $page){
    $contactpageID = $page->post_id;
  }
?>

<?php
  $prefix = 'ge_';
  $va_title = rwmb_meta( $prefix . 'va_title', 'type=text', $vacaturespageID);

  $mz_name = rwmb_meta( $prefix . 'mz_name', 'type=text', $contactpageID);
  $mz_address = rwmb_meta( $prefix . 'mz_address', 'type=text', $contactpageID);
  $mz_town = rwmb_meta( $prefix . 'mz_town', 'type=text', $contactpageID);

  $ct_tel = rwmb_meta( $prefix . 'ct_tel', 'type=text', $contactpageID);
  $ct_fax = rwmb_meta( $prefix . 'ct_fax', 'type=text', $contactpageID);
  $ct_gsm = rwmb_meta( $prefix . 'ct_gsm', 'type=text', $contactpageID);
  $ct_gsmhouder = rwmb_meta( $prefix . 'ct_gsmhouder', 'type=text', $contactpageID);
  $ct_email = rwmb_meta( $prefix . 'ct_email', 'type=email', $contactpageID);

  $va_info = rwmb_meta( $prefix . 'va_info', 'type=textarea', $vacaturespageID);
  $va_notfound = rwmb_meta( $prefix . 'va_notfound', 'type=textarea', $vacaturespageID);
?>
<aside class="content sidebar">
	<div class="wrapper">
		<h2><?php echo $va_title; ?></h2>
	</div>

	<div class="wrapper">
  	<div class="intro"><?php echo $va_info; ?></div>
    <div class="contact-info">
			<div><?php echo $mz_name; ?></div>
			<div itemprop="streetAddress"><?php echo $mz_address; ?></div>
			<div itemprop="addressLocality"><?php echo $mz_town; ?></div>
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
    </div>
	</div>
</aside>