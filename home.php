<?php

$products = productsindex($BDD);
?>
<div class="row col-8">
<?php foreach ($products as $ligne) : ?>
    <div class="card mx-auto mb-2 text-center align-items-center" style="width: 18rem">
        <img src="/photos/<?= $ligne['photo_link']?>.jpeg" alt="photo de <?= $ligne['photo_link']?>" class="card-img-top">
        <div class="card-body">
        <a href="product.php?id=<?= $ligne['id']; ?>"><h2><?= $ligne['name']; ?></h2></a>
        <p><?= $ligne['description']; ?></p>
            <p><?= $ligne['price']; ?> €</p>
        </div>
    </div>
<?php endforeach; ?>
</div>




