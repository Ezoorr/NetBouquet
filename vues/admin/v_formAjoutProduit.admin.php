<!-- enctype="multipart/form-data obligatoire pour file -->
<br>
<center><h2 class='texteAccueil'>AJOUTER UN PRODUIT </h2></center>
<center>
    <form name="modif" enctype="multipart/form-data" method="post" action="index.php?uc=gererProduit&action=confirmerAjouterProduit">
      <table border="0" width="90%" bgcolor="#6666FF" cellspacing="0" cellpadding="6">
		<tr>
		<td colspan="2"><center><font color="#99FF33"><b>Remplir tous les champs</b></font></center></td>
		</tr>
        <tr>
          <td width="27%" height="23">Nom</td>
          <td width="75%" height="23"><input type="text" name="nom" size="50" maxlength='40'></td>
        </tr>
		<tr>
          <td width="27%" height="23">Description</td>
          <td width="75%" height="23"><textarea rows="2" cols="40" name="description"></textarea></td>
        </tr>
		
		<tr>
          <td width="27%" height="23">Image</td>
          <td width="75%" height="23"><input type="file" name="image" size="30" maxlength='30'></td>
        </tr>		
		<tr>
          <td width="27%" height="23">Prix (xx.xx)</td>
          <td width="75%" height="23"><input type="text" name="prix" size="6" maxlength='6'></td>
        </tr>
        <tr>
          <td width="27%" height="23">Categorie</td>
          <td width="75%" height="23">
			
		<select name="idCategorie">
		<?php
			foreach($lesCategories as $uneCategorie) 
			{
				$id = $uneCategorie["id"];
				$libelle= $uneCategorie["libelle"];
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

