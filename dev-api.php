<?php
/**
 * Plugin Name: Custom Products API by Devlent
 * Plugin URI: https://devlent.com
 * Description: Custom endpoint for retriving all products in JSON.
 * Version: 1.0
 * Author: Tomislav Balabanov
 * Author URI: https://tomislavbalabanov.me
 */
// Acess URL Exmaple: http://your-url.com/wp-json/devlent/products
add_action( 'rest_api_init', 'my_register_route');

function my_register_route() {
        register_rest_route( 'devlent', 'products', array(
                'methods' => 'GET',
                'callback' => 'my_posts',
                'permission_callback' => function($request){	  
                  return is_user_logged_in();
                }
        ));
}

function my_posts() {

    $products=array();
    $args = array(
      'post_type' => array('product', 'product_variation'),
      'posts_per_page' => -1
  );
  $loop = new WP_Query( $args );
  if ( $loop->have_posts() ): while ( $loop->have_posts() ): $loop->the_post();

      global $product;
      $type = 'variable';
      $id = $product->get_id();
      $sku = $product->get_sku();
      $stock = $product->get_stock_quantity();
     // $manage = $product->get_manage_stock();
     // $variable = $product->is_type( $type );

     /* if($variable){
       update_post_meta($product->get_id(), '_manage_stock', "no");
       $updated = "true";
      }*/

      $products[ $sku ][ 'STOCK' ] = $stock;
     /* $products[ $sku  ][ 'managable' ] = $manage;
      $products[ $sku ][ 'is-variable' ] = $variable;
      $products[ $sku ][ 'updated!' ] = $updated;*/
  endwhile; endif; wp_reset_postdata();
return rest_ensure_response($products);
}

?>

