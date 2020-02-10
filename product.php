

<!-- main product -->
<main style="min-height: calc(100vh - 144px - 56px - 64px)">
    <div class="container">
        <div class="col-12 text-center">
            <p><?=$message?></p>
            <!-- titre -->
            <h2><?= $view_product['name'] ?></h2>
        </div>
        <div class="container">
            <div class="row align-items-center ">
                <div class="col-md-6 text-center ">
                    <img src="/photos/<?= $view_product['photo_link'] ?>.jpeg" alt="<?= $view_product['photo_link'] ?>"
                         class="m-2" height="300em"
                         id="phototitre">
                </div>

                <div class="col-6 text-center h5 ">
                    <?= $view_product['description'] ?>
                    <div class="row align-items-center"
                    <div class="col-md-6 text-center h4 ">
                        <div class="col-4">
                            <?= $view_product['price'] ?> €<br>
                            dont tva <?= $tva ?> €
                        </div>
                        <form class="form-inline" method="post" action="index.php?page=products&id=<?= $id ?>">
                            <div class="form-group mx-sm-3 mb-2">
                                <label for="qte" class="sr-only">Quantité</label>
                                <input type="number" min="0" class="form-control" id="qte" name="qte"
                                       placeholder="Quantité">
                            </div>
                            <button type="submit" class="btn btn-secondary mb-2">Ajouter au panier</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>


    </div>
</main>
