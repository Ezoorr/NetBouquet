<table width=90%  border='2'>
    <?php
    foreach ($lesProduits as $uneLigne) {
        $nom=$uneLigne["nom"];
        $id=$uneLigne["id"];
        echo ("<tr><td>" . $uneLigne["id"] . "</td><td> " . $uneLigne["nom"] . "</td><td>" . $uneLigne["description"] . "</td><td>" . $uneLigne["prix"] . " €</td><td>  <img src=images/" . $uneLigne["image"] . "  width='106' height='105'></td>
        <td><a href='index.php?uc=gererProduit&action=supprimerProduit&id=$id&nom=$nom'>Supprimer</a> <br>
            <a href='index.php?uc=gererProduit&action=modifierProduit&id=$id&nom=$nom'>Modifier</a> </td>
        </tr> ");
    }
    ?>
</table>
