<h2>Sélectionner une catégorie</h2>
<!-- <form action="index.php?lien=lesProduits&action=uneCategorie" method="post">-->
<form action="index.php?uc=gererProduit&action=voirTousProduits" method="post">
<select name="idCategorie">
<option value="Tous">Tous
<?php
	foreach($lesCategories as $uneCategorie) 
	{
		$id = $uneCategorie["id"];
		$libelle= $uneCategorie["libelle"];
		echo ("<option value=$id>$libelle") ;	
	}
?>
</select>
<input type="submit" value="OK">
</form>