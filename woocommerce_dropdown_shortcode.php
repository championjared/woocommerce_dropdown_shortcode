<?php 
/*
Modified to working version by Jared; 14.10.14
Originally written by Remi Corshon [remicorson.com]

Free to use under MIT license
Copyright (c) 2014 Llama Logic
*/


add_shortcode('product_categories_dropdown', 'custom_woocommerce_category_drop');
function custom_woocommerce_category_drop()
{
	//Extract relevant information
	extract(shortcode_atts( array(
		'count'			=> '0',
		'hierarchical'	=> '0',
		'orderby'		=> ''
	), $atts));
	
	ob_start();
	$c = $count;
	$h = $hierarchical;
	$o = ( isset ($orderby ) && $orderby != '' ) ? $orderby : 'order';
	
	woocommerce_product_dropdown_categories($c, $h, 0, $o);
	
	?>
	
		<script type='text/javascript'>
	/* <![CDATA[ */
	jQuery(document).ready( function() {
		jQuery('.dropdown_product_cat').attr('id','dropdown_product_cat');
		
		var product_cat_dropdown = document.getElementById("dropdown_product_cat");
		function onProductCatChange() {
			if ( product_cat_dropdown.options[product_cat_dropdown.selectedIndex].value !=='' ) {
				location.href = "<?php echo home_url(); ?>/?product_cat="+product_cat_dropdown.options[product_cat_dropdown.selectedIndex].value;
			}
		}
		product_cat_dropdown.onchange = onProductCatChange;
	} );
	/* ]]> */
	</script>
	
	<?php 
	
	return ob_get_clean();
}


?>