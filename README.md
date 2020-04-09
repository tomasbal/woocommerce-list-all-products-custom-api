# woocommerce-list-all-products-custom-api
Custom endpoint for listing all the products along their sku and stock. 

When activated this plugin it will create endpoint on: http://website.com/wp-json/devlent/products

That will list all the products by SKU and their current stock like this:

{
"711120":{
  "STOCK":1,
  "ID":28376
},
"711200":{
  "STOCK":1,
   "ID":28371
  }
}

## How to use it:

1. Download the plugin
2. Upload and activate it on WordPress
3. Acess the url to test http://<your-website-url>/wp-json/devlent/products
