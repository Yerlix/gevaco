Changes I did to plugin files and/or not my own pages
-----------------------------------------------------

Changes to meta-box plugin
--------------------------
	File plugins/meta-box/inc/helpers.php line:	357
		ADDED	:
			var image = new google.maps.MarkerImage(
				"' . plugins_url() . '/meta-box/img/marker_gevaco.png",
				null, /* size is determined at runtime */
				null, /* origin is 0,0 */
					null, /* anchor is bottom center of the scaled image */
				new google.maps.Size(42.75, 60)
			);
