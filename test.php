<!--
Elevar Data Layer V2

This file is automatically updated and should not be edited directly.

https://knowledge.getelevar.com/how-to-customize-data-layer-version-2

Updated: 2022-01-19 06:34:55+00:00
Version: 2.29.2
-->
<!-- Google Tag Manager -->
<script>
	(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({"gtm.start":
			new Date().getTime(),event:"gtm.js"});var f=d.getElementsByTagName(s)[0],
		j=d.createElement(s),dl=l!="dataLayer"?"&l="+l:"";j.async=true;j.src=
		"https://www.googletagmanager.com/gtm.js?id="+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,"script","dataLayer","GTM-M87Q5C6");
</script>
<!-- End Google Tag Manager -->
<script>
	window.dataLayer = window.dataLayer || [];
</script>
<script id="elevar-gtm-suite-config" type="application/json">{"gtm_id": "GTM-M87Q5C6", "event_config": {"cart_reconcile": true, "cart_view": true, "checkout_complete": true, "checkout_step": true, "collection_view": true, "product_add_to_cart": true, "product_add_to_cart_ajax": true, "product_remove_from_cart": true, "product_select": true, "product_view": true, "search_results_view": true, "user": true, "save_order_notes": true}, "gtm_suite_script": "https://shopify-gtm-suite.getelevar.com/shops/d987a2090e03ea2e086a5b98a2fdcc12375f5b26/2.29.2/gtm-suite.js"}</script>

{% if first_time_accessed %}
<!-- Event snippet for Salomon AUS - Transactions conversion page -->
<script>
	gtag('event', 'conversion', {
		'send_to': 'AW-694640509/itPDCNnM7LYBEP2-ncsC',
		'value': 1.0,
		'currency': 'AUD',
		'transaction_id': ''
	});
</script>

<script>
	window.dataLayer = window.dataLayer || [];
	window.dataLayer.push({
		'event': 'transactionComplete'
	});
</script>

<script>
	(function() {
		const configElement = document.getElementById("elevar-gtm-suite-config");

		if (!configElement) {
			console.error("Elevar Data Layer: Config element not found");
			return;
		}

		const config = JSON.parse(configElement.textContent);

		const script = document.createElement("script");
		script.type = "text/javascript";
		script.src = config.gtm_suite_script;

		script.onerror = function() {
			console.error("Elevar Data Layer: JS script failed to load");
		};
		script.onload = function() {
			if (!window.ElevarGtmSuite) {
				console.error("Elevar Data Layer: `ElevarGtmSuite` is not defined");
				return;
			}

			if (config.event_config.user) {
				window.ElevarGtmSuite.handlers.user({
				{%- if checkout -%}
				cartTotal: "{{- checkout.total_price | times: 0.01 | json -}}",
					currencyCode: {{- checkout.currency | json -}},
				{%- else -%}
				cartTotal: "{{- cart.total_price | times: 0.01 | json -}}",
					currencyCode: {{- cart.currency.iso_code | json -}},
				{%- endif -%}
				{%- if customer -%}
				customer: {
					id: "{{- customer.id | json -}}",
						email: {{- customer.email | json -}},
					firstName: {{- customer.first_name | json -}},
					lastName: {{- customer.last_name | json -}},
					phone: {{- customer.phone | json -}},
					city: {{- customer.default_address.city | json -}},
					zip: {{- customer.default_address.zip | json -}},
					address1: {{- customer.default_address.address1 | json -}},
					address2: {{- customer.default_address.address2 | json -}},
					country: {{- customer.default_address.country | json -}},
					province: {{- customer.default_address.province | json -}},
					provinceCode: {{- customer.default_address.province_code | json -}},
					orderCount: "{{- customer.orders_count | json -}}",
						totalSpent: "{{- customer.total_spent | times: 0.01 | json -}}",
						tags: {{- customer.tags | join: ', ' | json -}}
				}
				{%- endif -%}
			});
			}

			const cartData = {
				attributes: {{- cart.attributes | json -}},
			cartTotal: "{{- cart.total_price | times: 0.01 | json -}}",
				currencyCode: {{- cart.currency.iso_code | json -}},
			items: [
				{%- for line_item in cart.items -%}
			{
				{%- if line_item.sku != blank -%}
				id: {{- line_item.sku | json -}},
				{%- else -%}
				id: "{{- line_item.product_id | json -}}",
				{%- endif -%}
				name: {{- line_item.product.title | json -}},
				brand: {{- line_item.vendor | json -}},
				category: {{- line_item.product.type | json -}},
				variant: {{- line_item.variant.title | json -}},
				price: "{{- line_item.final_price | times: 0.01 | json -}}",
					position: {{- forloop.index0 -}},
				quantity: "{{- line_item.quantity | json -}}",
					productId: "{{- line_item.product_id | json -}}",
				variantId: "{{- line_item.variant_id -}}",
				compareAtPrice: "{{- line_item.variant.compare_at_price | times: 0.01 | json -}}",
				image: "{{- line_item.image | img_url -}}"
			},
			{%- endfor -%}
		]
		}
			;

			if (config.event_config.save_order_notes) {
				window.ElevarGtmSuite.handlers.cookieReconcile(cartData);
				window.ElevarGtmSuite.handlers.paramReconcile(cartData);
			}

			{%- if checkout -%}
			if (config.event_config.checkout_complete && Shopify && Shopify.Checkout && Shopify.Checkout.page === "thank_you") {
				window.ElevarGtmSuite.handlers.checkoutComplete({%- if checkout -%}
				{
					currencyCode: {{- checkout.currency | json -}},
					actionField: {
						{%- if order.id -%}
						id: {{- order.id | json -}},
						{%- else -%}
						id: {{- checkout.id | json -}},
						{%- endif -%}
						{%- if order.name -%}
						order_name: {{- order.name | json -}},
						{%- endif -%}
						affiliation: {{- shop.name | json -}},
						revenue: "{{- checkout.total_price | times: 0.01 | json -}}",
							tax: "{{- checkout.tax_price | times: 0.01 | json -}}",
							shipping: "{{- checkout.shipping_price | times: 0.01 | json -}}",
						{% if checkout.discount_applications %}
						coupon: {{ checkout.discount_applications[0].title | json }},
						{% endif %}
						subTotal: "{{- checkout.line_items_subtotal_price | times: 0.01 | json -}}",
							discountAmount: "{{- checkout.discounts_amount | times: 0.01 | json -}}"
					},
					{%- if checkout.customer -%}
					customer: {
						id: "{{- checkout.customer.id | json -}}",
							email: {{- checkout.email | json -}},
						firstName: {{- checkout.billing_address.first_name | json -}},
						lastName: {{- checkout.billing_address.last_name | json -}},
						{%- if checkout.customer.phone -%}
						phone: {{- checkout.customer.phone | json -}},
						{%- elsif checkout.billing_address.phone -%}
						phone: {{- checkout.billing_address.phone | json -}},
						{%- else -%}
						phone: {{- checkout.shipping_address.phone | json -}},
						{%- endif -%}
						city: {{- checkout.billing_address.city | json -}},
						zip: {{- checkout.billing_address.zip | json -}},
						address1: {{- checkout.billing_address.address1 | json -}},
						address2: {{- checkout.billing_address.address2 | json -}},
						country: {{- checkout.billing_address.country | json -}},
						province: {{- checkout.billing_address.province | json -}},
						provinceCode: {{- checkout.billing_address.province_code | json -}},
						orderCount: "{{- checkout.customer.orders_count | json -}}",
							totalSpent: "{{- checkout.customer.total_spent | times: 0.01 | json -}}",
							tags: {{- checkout.customer.tags | json -}}
					},
					{%- endif -%}
					items: [
						{%- for line_item in checkout.line_items -%}
					{
						id: {{- line_item.sku | json -}},
						name: {{- line_item.product.title | json -}},
						brand: {{- line_item.vendor | json -}},
						category: {{- line_item.product.type | json -}},
						variant: {{- line_item.variant.title | json -}},
						price: "{{- line_item.final_price | times: 0.01 | json -}}",
							quantity: "{{- line_item.quantity | json -}}",
						productId: "{{- line_item.product_id | json -}}",
						variantId: "{{- line_item.variant_id -}}",
						image: "{{- line_item.image | img_url -}}"
					},
					{%- endfor -%}
				],
					landingSite: {{- checkout.landing_site | json -}}
				}
				{%- endif -%}
			);
			}
			if (Shopify && Shopify.Checkout && Shopify.Checkout.page !== "thank_you") {
				const checkoutStep = {%- if checkout -%}
				{
					currencyCode: {{- checkout.currency | json -}},
					items: [
						{%- for line_item in checkout.line_items -%}
					{
						id: {{- line_item.sku | json -}},
						name: {{- line_item.product.title | json -}},
						brand: {{- line_item.vendor | json -}},
						category: {{- line_item.product.type | json -}},
						variant: {{- line_item.variant.title | json -}},
						price: "{{- line_item.final_price | times: 0.01 | json -}}",
							quantity: "{{- line_item.quantity | json -}}",
						productId: "{{- line_item.product_id | json -}}",
						variantId: "{{- line_item.variant_id -}}",
						compareAtPrice: "{{- line_item.variant.compare_at_price | times: 0.01 | json -}}",
						image: "{{- line_item.image | img_url -}}"
					},
					{%- endfor -%}
				]
				}
				{%- endif -%}
				;

				if (config.event_config.cart_reconcile) {
					window.ElevarGtmSuite.handlers.cartReconcile(checkoutStep);
				}
				if (config.event_config.checkout_step) {
					window.ElevarGtmSuite.handlers.checkoutStep(checkoutStep);
				}
			}
			{%- endif -%}
		};

		document.body.appendChild(script);
	})();
</script>

{% endif %}

<!-- Scripts you want to run on every visit -->
<!-- google dynamic remarketing tag for order confirmation page -->
<script type="text/javascript">
	var id = new Array();
	{% for line_item in order.line_items %}
	id.push('shopify_US_{{line_item.product.id}}_{{line_item.variant.id}}');
	{% endfor %}
	var google_tag_params = {
		ecomm_prodid: id,
		ecomm_pagetype: 'purchase',
		ecomm_totalvalue: parseFloat('{{ subtotal_price | money_without_currency | remove: ","}}')}
</script>

<script>
	dataLayer.push({
		'event': 'fireRemarketingTag',
		'google_tag_params':google_tag_params
	});
</script>
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M87Q5C6" height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->


<!-- Meta Pixel Code -->
<script>
	!function(f,b,e,v,n,t,s)
	{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		n.callMethod.apply(n,arguments):n.queue.push(arguments)};
		if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
		n.queue=[];t=b.createElement(e);t.async=!0;
		t.src=v;s=b.getElementsByTagName(e)[0];
		s.parentNode.insertBefore(t,s)}(window, document,'script',
		'https://connect.facebook.net/en_US/fbevents.js');
	fbq('init', '720899218918550');
	var checkout = window.Shopify.checkout;
	var value_total_checkout_money = parseFloat(checkout.total_price_set.presentment_money.amount);
	var checkout_money_currency = checkout.total_price_set.presentment_money.currency_code).toString();
	fbq('track', 'Purchase', {
		value: value_total_checkout_money,
		currency: checkout_money_currency,
		content_type: "product_group"
	});
</script>
<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=720899218918550&ev=PageView&noscript=1"/></noscript>
<!-- End Meta Pixel Code -->

<!-- Meta Pixel Code -->
<script>
    !function(f,b,e,v,n,t,s)
	{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
		n.callMethod.apply(n,arguments):n.queue.push(arguments)};
		if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
		n.queue=[];t=b.createElement(e);t.async=!0;
		t.src=v;s=b.getElementsByTagName(e)[0];
		s.parentNode.insertBefore(t,s)}(window, document,'script',
		'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '720899218918550');
        fbq('track', 'ViewContent');
        {
            'value': {{ product.price|money|json }},
            'currency': {{ shop.currency }},
            'content_ids': {{ product.id|json }},
            'content_type': {{ product.type|json }},
            'content_name': {{ product.title|json }}
        }
	);
</script>
<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=720899218918550&ev=PageView&noscript=1"/></noscript>
<!-- End Meta Pixel Code -->