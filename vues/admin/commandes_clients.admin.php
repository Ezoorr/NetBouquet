<div style="display: flex; justify-content: center;" class="aymanleplubo">
    <!-- Votre tableau ici -->

    <table width="90%" border="2">
        <tr>
            <th>ID</th>
            <th>Date de commande</th>
            <th>Login utilisateur</th>
        </tr>
        <?php $count = 0; ?>
        
        <?php foreach ($LesNoms as $commande): ?>
            <?php $count++; ?>
            <tr>
                <td><?php echo $commande['id']; ?></td>
                <td><?php echo $commande['dateCommande']; ?></td>
                <td><?php echo $commande['loginUtilisateur']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
 
</div>
  <p>Nombre de commandes : <?php echo $count; ?></p>

<a href='index.php?uc=commandeClient&action=listeCommandes'>Trier par date</a>
<br>
<a href='index.php?uc=commandeClient&action=TrierNom'>Tier par nom</a>
<br>

