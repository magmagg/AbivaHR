
<?php

if($_GET['req'] == 'true')
{

 $to      = 'genil@skyrocket.ph';
 $subject = 'Request Quotation';
 $message .=
 '<table id="theTable" class="quotation-table table table-bordered" style="width:100%">
 <th>Products</th>
 <th>Model</th>
 <th>SKU</th>
 <th>Quantity</th>
 <th>Price</th>
 <tr>';


   foreach( WC()->cart->get_cart() as $cart_item )
   {
      $product_id = $cart_item['product_id'];
      $post_content = get_post($product_id);

      $message .= '<td>' . $post_content->post_title . '</td>';
      $message .= '<td>';
          $prod_model = wp_get_post_terms( $product_id, 'pa_model');
      $message .= $prod_model[0]->name;
      $message .= '</td>';
      $message .= '<td>' . get_post_meta($product_id, '_sku' , true) . '</td>';
      $message .= '<td>' . $cart_item['quantity'] . '</td>';
      $message .= '<td>';
          $reg_price = get_post_meta( $product_id, '_regular_price');
      $message .=  $reg_price[0];
      $message .= '</td></tr>';
   }
 $message .= '<tr>';
 $message .= '<td>Shipping and Handling Fees</td>';
 $message .= '<td></td>';
 $message .= '<td></td>';
 $message .= '<td>' . $shipping_qty = 1 . '</td>';
 $message .= '<td>' . $woocommerce->cart->shipping_total . '</td>';
 $message .= '</tr>';

 $message .= '<tr>';
 $message .= '<td>Total</td>';
 $message .= '<td></td>';
 $message .= '<td></td>';
 $message .= '<td">' . $woocommerce->cart->cart_contents_count + $shipping_qty . '</td>';
 $message .= '<td">' . $woocommerce->cart->total . '</td>';
 $message .= '</tr></table>';
 $message .= '<p>*Prices are subject to change without prior notice. Quotation expires on the third day after issuance or on the date indicated on the Quotation document. Please visit Complink.com.ph for more details.</p>';
}

 $headers = 'From: '.$_POST['email'] . "\r\n" .
   'X-Mailer: PHP/' . phpversion();
 $headers .= "MIME-Version: 1.0\r\n";
 $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

 if(mail($to, $subject, $message, $headers)){
   echo true;
 }else{
   echo false;
 }
 exit;
?>
HAHAAHAHHAA
