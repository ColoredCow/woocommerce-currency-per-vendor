# WooCommerce Currency Per Vendor

A WooCommerce multi-vendor extension that let's you set currency specific to each vendor in a multi-vendor eCommerce store.

## Dependencies

1. [WooCommerce](https://wordpress.org/plugins/woocommerce/)
1. [WCFM Marketplace](https://wordpress.org/plugins/wc-multivendor-marketplace/)

### Installation steps

1. Clone this repository and add it inside your WordPress site's `plugins/` directory.
1. Go to the WP Admin Dashboard and activate the plugin.


### Usage

Once the configurations are complet. Use this function to get the currency for the procuct

```php
wcpv_get_product_currency( $product_id );
```
