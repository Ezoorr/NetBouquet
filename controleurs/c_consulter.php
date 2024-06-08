<?php
//pour récupérer l’action qui vient des liens, ou si n'existe pas on met l'acceuil
if(!isset($_REQUEST['action'])){
     $_REQUEST['action'] = 'accueil';
}	
 $action = $_REQUEST['action'];	
 
	switch($action)  {
		case 'accueil' : 	
		{
			include("vues/v_accueil.html");
			break;
		}
		case 'entreprise' : 		
		{
                    include("vues/v_entreprise.html");	
                    break;
		}	
		case 'voirTousProduits' : 	
		{
                    //afficher les catégories dans une liste déroulante
                    $lesCategories = $pdo->getLesCategories();
                    include("vues/v_listeCategories.php");
                    
                    if (isset($_POST["idCategorie"]))
                    {
                        $idCategorie=$_POST["idCategorie"];
                            if ($idCategorie=='Tous')
				$lesProduits = $pdo->getTousLesProduits();
                            else
				$lesProduits = $pdo->getLesProduitsCategorie($idCategorie);    
                    } else
                        $lesProduits = $pdo->getTousLesProduits();   
                     //afficher les produits sous forme de tableau
                     include("vues/v_listeProduits.php");
                    
                    
                    
                    break;
		}	
	}
?>

