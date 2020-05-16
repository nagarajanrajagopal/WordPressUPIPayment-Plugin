<?php
/**
 * Plugin Name: WP UPI Payment Plugin
 * Plugin URI: https://www.kiasa.in/plugin
 * Description: This plugin lets Wordpress admin to get payments using UPI apps like BHIM, Google Pay, PhonePe or any Banking UPI app. NOT FOR WOOCOMMERCE SITES. Works for customers in India
 * Author: Kiasa
 * Author URI: http://kiasa.in/
 * Version: 1.0.0
 *
 * Copyright: (c) 2019, Kiasa LLP
 *
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * @package   WC-Gateway-UPI
 * 
 * Warranty information
 *      
 */
 
 
 /**
 * Prevent direct calling
 */
 
defined( 'ABSPATH' ) or exit;


add_shortcode( 'kiasa', 'wpupipayment_sc_handler' );

function wpupipayment_sc_handler( $atts ) {
    $atts = shortcode_atts( array(
		'msg' => 'Click to donate!',
		'upivpa' => 'kiasa@upi',
		'price' => ''
	), $atts );
    $upivpa = $atts['upivpa'];
    $price = $atts['price'];
    $msg = $atts['msg'];
     $admin_email = get_bloginfo('admin_email');
?>


<script>
    function myFunction() {
        document.getElementById("mydiv").style.visibility = "visible"; 
    }
    
    function check()
    {
        
	var custname = document.getElementById("name").value;
	var custmobile = document.getElementById("mobile").value;
	var custemail = document.getElementById("email").value;
		

	 var phoneno = /^\d{10}$/;  
      if(!(custmobile.match(phoneno)))
      {  
         document.getElementById("err").innerHTML = "Not a valid mobile number";
         return false;  
      }  
      
     if (!validateEmail(custemail)) {
         document.getElementById("err").innerHTML = "Not a valid email address";
         return false;
     }
     return true;
    
}

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

</script>
 <button onclick="myFunction()"><?php echo $msg ?> </button> 
 
 <div id="mydiv" style="visibility: hidden">
<form action="https://kiasa.in/WP-UPI-payment/wp.php" method="post" onsubmit="return check()">
  Name:<p></p>
  <input type="text" name="name" id="name" required>
  <p></p>
  Mobile:<br>
  <input type="text" name="mobile" id="mobile" required>
  Email:<br>
  <input type="text" name="email" id="email" required>
  <br><br>
   <input  type="hidden" name="upivpa" value="<?php echo $upivpa; ?>">
    <input  type="hidden" name="price" value="<?php echo $price; ?>">
    <input  type="hidden" name="admin_email" value="<?php echo $admin_email; ?>">
  <input type="submit" value="Submit">
  <div id="err"> </div>
</form> 

</div> 
<?php
}
?>
