<?php
/*session_reset();*/
session_start();
// j'initialise mon panier

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
 }


?>
<pre>
<?php
var_dump($_SESSION['cart']); ?>
</pre>
