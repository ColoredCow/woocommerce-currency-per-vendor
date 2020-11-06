# WooCommerce Currency Per Vendor

A WooCommerce multi-vendor extension that let's you set currency specific to each vendor in a multi-vendor eCommerce store. The price of the products created by a vendor will be set in the vendor's currency. 

Especially useful when you have vendor from different countries all over the globe.

## Dependencies

1. [WooCommerce](https://wordpress.org/plugins/woocommerce/)
1. [WCFM Marketplace](https://wordpress.org/plugins/wc-multivendor-marketplace/)

### Installation steps

1. Clone this repository and add it inside your WordPress site's `plugins/` directory.
1. Go to the WP Admin Dashboard and activate the plugin.


### Usage

At this point, the only way to set a vendor specific currency is by executing a database `insert` query.

```sql
INSERT INTO `wp_usermeta` (`user_id`, `meta_key`, `meta_value`)
VALUES (<vendor-id>,  '_wcpv_currency', 'INR');
```

> _Note: Don't forget to update `wp_` with your WordPress table prefix in the above query._
