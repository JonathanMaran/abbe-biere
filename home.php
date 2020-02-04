<?php
include 'pdo.php';
include 'config.php';
$description= 'le culte de la biere';
?>
        <div>
            <?php foreach ($commentaires as $commentaire) {
                ?> <p> <?php echo $commentaire['text']; ?><br><?php echo $commentaire['pseudo']; ?><br></p>
                <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link "
                       href="commentModify.php?idcomment=<?php echo $commentaire['id']; ?>&idarticle=<?php echo $idarticle; ?>">Modifier
                        ce commentaire</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link "
                       href="commentDelete.php?idcomment=<?php echo $commentaire['id']; ?>&idarticle=<?php echo $idarticle; ?>">Supprimer
                        ce commentaire</a>
                </li>

                </ul><?php
            } ?>
        </div>';
