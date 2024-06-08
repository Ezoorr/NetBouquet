<br>
<CENTER>
<table border=0 bgcolor="#6666FF">
<tr><td>
<font color="#99FF33"><b>Etes-vous sur de vouloir supprimer le produit 
<?php echo $_GET["id"] ;
echo " : ";
echo $_GET["nom"]; 
?> ? </b></font>
<br><br>
<CENTER>
<form action="index.php?uc=gererProduit&action=confirmerSupprimerProduit&id=<?php echo $id ?>" method="post">
<input type="submit" name="Submit" value="  OUI  " size="20">
</form>
<br>
<form action="index.php?uc=gererProduit&action=voirTousProduits" method="post">
<input type="submit" name="Submit" value=" NON " size="10">
</form>
</CENTER>
</td></tr></table>
</center>
