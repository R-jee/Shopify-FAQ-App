<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-NYV62M90GQ"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'G-NYV62M90GQ');
</script>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
			new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
		'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-P2LDDTT');
</script>

<script>
	(function() {
		var gtmId = "GTM-P2LDDTT";
		window.dataLayer = window.dataLayer || [];
		dataLayer.push({ ecommerce: null });

		// Prevent double-tracking if an upsell is seen or the order status page has been seen
		{% if first_time_accessed == true and post_purchase_page_accessed == false %}
		var checkout = window.Shopify.checkout;
		dataLayer.push({
			"event": "purchase",
			"ecommerce": {
				"transaction_id": "{{ order.order_number }}",
				"value": parseFloat(checkout.total_price_set.presentment_money.amount),
				"discount": parseFloat(getDiscountAmount()),
				"currency": (checkout.total_price_set.presentment_money.currency_code).toString(),
				"items": items()
			}
		});

		function getDiscountAmount(line_item_count) {
			if (checkout.discount === null || typeof checkout.discount === 'undefined') return '0';
			if (checkout.discount.length === 0) return '0';
			if (line_item_count === undefined) {
				return checkout.discount.amount;
			} else {
				if (checkout.line_items[line_item_count].discount_allocations[0].amount === null || typeof checkout.line_items[line_item_count].discount_allocations[0].amount === 'undefined') return '0';
				if (checkout.line_items[line_item_count].discount_allocations[0].amount === 0) return '0';
				return checkout.line_items[line_item_count].discount_allocations[0].amount;
			};
		};

		function items(){
			var jsonarray = [];
			for (var line_item_count = 0; line_item_count < checkout.line_items.length; line_item_count++){
				var jsonobj = {
					"item_id": (checkout.line_items[line_item_count].product_id).toString(),
					"item_name": (checkout.line_items[line_item_count].title).toString(),
					"price": parseFloat(checkout.line_items[line_item_count].line_price),
					"quantity": parseFloat(checkout.line_items[line_item_count].quantity)
				};
				jsonarray.push(jsonobj)
			};
			return jsonarray;
		};
		{% endif %}

		// Google Tag Manager
		(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
				new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
			j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
			'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
		})(window,document,'script','dataLayer',gtmId);
	})();
</script>
