<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php _e( 'Delivery Note', 'woocommerce-delivery-notes' ); ?></title>
	<link rel="stylesheet" href="<?php echo wcdn_template_url(); ?>css/style.css" type="text/css" media="screen,print" charset="utf-8"/>
	<script type="text/javascript">
		function openPrintWindow() {
		    window.print();
		}
	</script>
</head>

<body>
	<div id="container">
		<div id="header">
			<div class="options">
				<a href="#print" onclick="javascript:openPrintWindow();return false;"><?php _e( 'Print Page', 'woocommerce-delivery-notes' ); ?></a>
			</div><!-- .entry-content -->
		</div><!-- #header -->

		<div id="content">			
			<div id="page">
				<div id="wcdn-head">
					<div class="wcdn-heading"><?php _e( 'Delivery Note', 'woocommerce-delivery-notes' ); ?></div>
					<div class="company-name"><?php
						if ( wcdn_custom_company_name() ) {
							echo wcdn_custom_company_name();
						} else {
							echo wcdn_company_name();
						} ?></div>
					<div class="company-info"><?php echo wcdn_company_info(); ?></div>
				</div>
				
				<div id="order-listing">
					<h3><?php _e( 'Recipient:', 'woocommerce-delivery-notes' ); ?></h3>
					<div class="shipping-info">
						<br /><?php if( wcdn_shipping_company() ) : ?><?php echo wcdn_shipping_company(); ?><br /><?php endif; ?>
						<?php echo wcdn_shipping_name(); ?><br />
						<?php echo wcdn_shipping_address_1(); ?><br />
						<?php if( wcdn_shipping_address_2() ) : ?><?php echo wcdn_shipping_address_2(); ?><br /><?php endif; ?>
						<?php echo wcdn_shipping_city(); ?>, <?php echo wcdn_shipping_state(); ?><br />
						<?php echo wcdn_shipping_postcode(); ?>

						<?php if( wcdn_shipping_country() ) : ?><br /><?php echo wcdn_shipping_country(); ?><?php endif; ?>
					</div><!-- .shipping-info -->
					
					<table id="order-info">
						<tbody>
							<tr>
								<th class="order-number-label"><?php _e( 'Order No.', 'woocommerce-delivery-notes' ); ?></th>
								<td class="order-number"><?php echo wcdn_order_number(); ?></td>
							</tr>
							<tr>
								<th class="order-date-label"><?php _e( 'Order Date', 'woocommerce-delivery-notes' ); ?></th>
								<td class="order-date"><?php echo wcdn_order_date(); ?></td>
							</tr>
						</tbody>
					</table><!-- #order-info -->
				</div><!-- #order-listing -->
				
				<div id="order-items">
					<table>
						<thead>
							<tr>
								<th class="description" id="description-label"><?php _e( 'Product Name', 'woocommerce-delivery-notes' ); ?></th>
								<th class="quantity" id="quantity-label"><?php _e( 'Quantity', 'woocommerce-delivery-notes' ); ?></th>
								<th class="price" id="price-label"><?php _e( 'Price', 'woocommerce-delivery-notes' ); ?></th>
							</tr>
						</thead>
						<tfoot>
							<?php $items = wcdn_get_order_items(); foreach( $items as $item ) : ?><tr>
								<td class="description"><?php echo $item['name']; ?><?php if( $item['variation'] ) : ?> <span class="variation"><?php echo $item['variation']; ?></span><?php endif; ?>
<?php if( $item['sku'] || $item['weight'] ) : ?><br /><?php endif; ?><?php if( $item['sku'] ) : ?><span class="sku"><?php _e( 'SKU:', 'woocommerce-delivery-notes' ); ?> <?php echo $item['sku']; ?></span><?php endif; ?><?php if( $item['weight'] ) : ?><span class="weight"> <?php _e( 'Weight:', 'woocommerce-delivery-notes' ); ?> <?php echo $item['weight']; ?></span><?php endif; ?></td>
								<td class="quantity"><?php echo $item['quantity']; ?></td>
								<td class="price"><?php echo $item['price'] ?></td>
							<tr><?php endforeach; ?>
						</tfoot>
					</table>
				</div><!-- #order-items -->
				
				<div id="order-summary">
					<table>
						<tbody>
							<tr>
								<th class="description" id="subtotal-label"><?php _e( 'Subtotal', 'woocommerce-delivery-notes' ); ?></th>
								<td class="price" id="subtotal-number"><?php echo wcdn_order_subtotal(); ?></td>
							</tr>
							<?php if ( wcdn_has_shipping() ) : ?>
							<tr>
								<th class="description" id="tax-label"><?php _e( 'Shipping', 'woocommerce-delivery-notes' ); ?></th>
								<td class="price" id="tax-number"><?php echo wcdn_order_shipping(); ?></td>
							</tr>
							<?php endif; ?>
							<?php if( wcdn_has_tax() ) : ?>
							<tr>
								<th class="description" id="tax-label"><?php _e( 'Tax', 'woocommerce-delivery-notes' ); ?></th>
								<td class="price" id="tax-number"><?php echo wcdn_order_tax(); ?></td>
							</tr>
							<?php endif; ?>
							<?php if( wcdn_has_discount() ) : ?>
							<tr>
								<th class="description" id="tax-label"><?php _e( 'Discount', 'woocommerce-delivery-notes' ); ?></th>
								<td class="price" id="tax-number"><?php echo wcdn_order_discount(); ?></td>
							</tr>
							<?php endif; ?>
							<tr>
								<th class="description" id="total-label"><?php _e( 'Grand Total', 'woocommerce-delivery-notes' ); ?></th>
								<td class="price" id="total-number"><?php echo wcdn_order_total(); ?></td>
							</tr>
						</tbody>
					</table>
				</div><!-- #order-summery -->
	
				<div id="order-notes">
					<div class="notes-personal"><?php echo wcdn_personal_notes(); ?></div>
					<div class="notes-shipping"><?php echo wcdn_shipping_notes(); ?></div>
					<div class="notes-policies"><?php echo wcdn_policies_conditions(); ?></div>
				</div>

				<div id="wcdn-footer">
					<div class="wcdn-footer-imprint"><?php echo wcdn_footer_imprint(); ?></div>
				</div>
			</div><!-- #page -->
		</div><!-- #content -->
		
		<div id="footer">
			<div class="options">
				<a href="#print" onclick="javascript:openPrintWindow();return false;"><?php _e( 'Print Page', 'woocommerce-delivery-notes' ); ?></a>
			</div><!-- .options -->
		</div><!-- #footer -->
	</div><!-- #container -->
</body>
</html>
