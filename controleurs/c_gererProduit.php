<?php
include("vues/admin/v_sommaire.admin.html");
//pour récupérer l'action qui vient des liens, ou si n'existe pas on à tous produits
//Ajouter le login connecté
include("vues/admin/v_login.admin.php");

if(!isset($_REQUEST['action'])){
     $_REQUEST['action'] = 'voirTousProduits';
}	 
$action = $_REQUEST['action'];	
    switch($action)  {
	case 'voirTousProduits' : 	
	{
            $lesCategories = $pdo->getLesCategories();
             include("vues/admin/v_listeCategories.admin.php");      
                     
                if (isset($_POST["idCategorie"]))
                {
                    $idCategorie=$_POST["idCategorie"];
                           if ($idCategorie=='Tous')
                                $lesProduits = $pdo->getTousLesProduits();
                            else
                                $lesProduits = $pdo->getLesProduitsCategorie($idCategorie);    
                 }else
            $lesProduits = $pdo->getTousLesProduits();   
            include("vues/admin/v_listeProduits.admin.php");
            break;
	}
        
        case "supprimerProduit" :   	//affiche le formulaire de suppression  
        {
            $id=$_REQUEST["id"];
            include("vues/admin/v_formSuppressionProduit.admin.php");  
            break;
        }
        
        case "confirmerSupprimerProduit" :   //effectue la suppression dans la bdd
        {
          $id=$_GET["id"];
            $nbLigne = $pdo->supprimerProduit($id);
                if ($nbLigne != 0 )
                    echo "Suppression du produit ". $id . " effectué";
                else
                {
                    ajouterErreur ("Echec de la suppression du produit " .$id);
                    include("vues/v_erreurs.php");   
                }
                $lesCategories = $pdo->getLesCategories();
                $lesProduits = $pdo->getTousLesProduits();   
                include("vues/admin/v_listeCategories.admin.php");
                include("vues/admin/v_listeProduits.admin.php");   
		break;		           
        }
        
	case "modifierProduit" :   //affiche le formulaire de modification du produit 
        {
            $id=$_GET["id"];
            $leProduit=$pdo->getProduit($id);
            $lesCategories = $pdo->getLesCategories();
            include("vues/admin/v_formModifProduit.admin.php");    
            break;		 
        }
        
	case "confirmerModifierProduit" :   //modifie le produit dans la bdd
	{	
            $id = $_REQUEST["id"];
            $nom = $_POST["nom"];
            $image=$_FILES['image']['name'];
            if ($image=="")
            {  
                $image=$_POST["image"];
                $extension="image/jpg";
            }
            else
                $extension=$_FILES['image']['type'];
            $description =$_POST["description"];;
            $prix = $_POST["prix"];
            $idCategorie=$_POST["idCategorie"];
            
            valideInfosProduit($nom, $image, $description, $prix, $extension);
            $nbErreurs = nbErreurs();
            
           // echo $nbErreurs;
            if ($nbErreurs==0)
            {
                $nbLigne = $pdo->modifierProduit($id, $nom, $image, $description, $prix, $idCategorie);
                //echo "->" . $nbLigne;
                if ($nbLigne != 0 )
                {    
                    echo "<font color='purple'>*** Modification effectuée  ***</font>";
                }
                else
                {
                    ajouterErreur ("Echec de la modification du produit " .$id);
                    include("vues/v_erreurs.php"); 
                }    
             }	else  
                    include("vues/v_erreurs.php");
             
              $lesCategories = $pdo->getLesCategories();
              $lesProduits = $pdo->getTousLesProduits();   
              include("vues/admin/v_listeCategories.admin.php");
              include("vues/admin/v_listeProduits.admin.php");   
            break;
        }
        
	case "ajouterProduit" :   	// affiche le formulaire d’ajout de produit		
        {    
            $lesCategories = $pdo->getLesCategories();
            include("vues/admin/v_formAjoutProduit.admin.php");           
            break;		
         }
         
	case "confirmerAjouterProduit" :   //ajoute le produit dans la bdd
        {
            $nom = $_POST["nom"];
            $image=$_FILES['image']['name'];
            $extension=$_FILES['image']['type'];
            $description =$_POST["description"];;
            $prix = $_POST["prix"];
            $idCategorie=$_POST["idCategorie"];
            
            valideInfosProduit($nom, $image, $description, $prix, $extension);
            $nbErreurs = nbErreurs();
            
            //echo $nbErreurs;
            if ($nbErreurs==0)
            {
                $nbLigne = $pdo->ajouterProduit($nom, $image, $description,$prix,$idCategorie);
            
                    if ($nbLigne != 0 )
                    {    
                        echo "<font color='purple'>*** Ajout du produit ". $pdo->getLastId() . " effectué ***</font>";
                    }
                    else
                    {
                        ajouterErreur ("Echec de l'ajout du produit " .$nom);
                        include("vues/v_erreurs.php"); 
                    }    
             }	else  
                    include("vues/v_erreurs.php"); 
                 
            $lesCategories = $pdo->getLesCategories();
            $lesProduits = $pdo->getTousLesProduits();   
            include("vues/admin/v_listeCategories.admin.php");
            include("vues/admin/v_listeProduits.admin.php");   
            break;	
        }

        
                
                
         	
    }
?>
