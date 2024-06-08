<table width=90%  border='2'>
    <?php
    foreach ($lesProduits as $uneLigne) {
        echo ("<tr><td>" . $uneLigne["id"] . "</td><td> " . $uneLigne["nom"] . "</td><td>" . $uneLigne["description"] . "</td><td>" . $uneLigne["prix"] . " €</td><td>  <img src=images/" . $uneLigne["image"] . "  width='106' height='105'></td></tr> ");
    }
    ?>
</table>
