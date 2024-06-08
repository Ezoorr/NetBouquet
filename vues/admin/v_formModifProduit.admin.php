<!-- enctype="multipart/form-data obligatoire pour file -->
<?php
//récupération des variables provenant du lien Modifier
$id=$_GET["id"];
$nom=$_GET["nom"];
$image = $leProduit["image"];
$description=$leProduit["description"];;
$prix=$leProduit["prix"];;
$idCategorie=$leProduit["idCategorie"];;
?>

<br>
<center><h2 class='texteAccueil'>MODIFIER LE PRODUIT N° <?php echo $id; ?></h2></center>
<center>
    <form name="modif" enctype="multipart/form-data" method="post" action="index.php?uc=gererProduit&action=confirmerModifierProduit&id=<?php echo $id; ?>">
      <table border="0" width="90%" bgcolor="#6666FF" cellspacing="0" cellpadding="6">
		<tr>
		<td colspan="2"><center><font color="#99FF33"><b>Remplir tous les champs</b></font></center></td>
		</tr>
        <tr>
          <td width="27%" height="23">Nom</td>
          <td width="75%" height="23"><input type="text" name="nom" size="50" maxlength='40' value="<?php echo $nom; ?>"></td>
        </tr>
		<tr>
          <td width="27%" height="23">Description</td>
          <td width="75%" height="23"><textarea rows="2" cols="40" name="description"> <?php echo $description; ?>  </textarea></td>
        </tr>
		
		<tr>
          <td width="27%" height="23">Image <?php echo "<font color='white'> $image </font>"; ?>    </td>
          <td width="75%" height="23"><input type="file" name="image" size="30" maxlength='30'></td>
          <input type="hidden" name="image" size="6" maxlength='6' value="<?php echo $image; ?>">
        </tr>		
		<tr>
          <td width="27%" height="23">Prix (xx.xx)</td>
          <td width="75%" height="23"><input type="text" name="prix" size="6" maxlength='6' value="<?php echo $prix; ?>"></td>
        </tr>
        <tr>
          <td width="27%" height="23">Categorie</td>
          <td width="75%" height="23">
			
		<select name="idCategorie">
		<?php 
                //A COMPLETER POUR SELECTIONNER CELUI DE LA BASE DE DONNEES
			foreach($lesCategories as $uneCategorie) 
			{
				$id = $uneCategorie["id"];
				$libelle= $uneCategorie["libelle"];
                                if ($idCategorie==$id)
                                    echo ("<option value=$id SELECTED>$libelle") ;	
                                else
                                    echo ("<option value=$id>$libelle") ;
			}
		?>
		</select>
		   </td>
		   </tr>
		   <tr><td colspan="2" align="center">
		<input type='submit' value='Valider'>&nbsp;&nbsp;&nbsp;&nbsp;
		<input type='reset' value='Rétablir'>
		</td></tr>
	</form>  	
<!-----------------fin formulaire--------------------- -->
	</table>
</center>
