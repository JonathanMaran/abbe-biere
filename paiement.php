<?php

if (!empty($_POST)){
    if(!empty($_POST['buy'])){
        if ($_POST['buy']=='yes'){
            ordervalidate($BDD,$_SESSION['idcustomer'],$_SESSION['cart']);
            deletecart();
            header('Location: /index.php?page=home',true,302);
        }
    }
}

include 'header.php'
?>
<main>
    <div class="container">
        <form method="post">
            <label for="buy"></label>
            <button type="submit" name="buy" value="yes" class="btn btn-secondary mb-2">Paiement</button>
        </form>
    </div>
</main>




<?php
include 'footer.php';